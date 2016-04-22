<?php
/**
 * Created by PhpStorm.
 * User: Chris Robinson
 * this class is used to allow for login and logout
 * by querying the DB for user details and allow
 * for a user session
 */
namespace Itb;

use \PDO;

/**
 * Class User
 * @package Itb
 */
class User extends UserDatabase
{
    /**
     * used to prepare connection statement
     * @var null|PDO
     */
    public $conn;

    /**
     * used to construct a Database
     * User constructor.
     */
    public function __construct()
    {
        $database = new UserDatabase();
        $db = $database->dbConnection();
        $this->conn = $db;
    }

    /**
     * used to prepare sql statement for query
     * @param $sql
     * @return \PDOStatement
     */
    public function runQuery($sql)
    {
        $stmt = $this->conn->prepare($sql);
        return $stmt;
    }

    /**
     * used to get parameters of signup.php and insert them into the userLogin DB
     * @param $UserName
     * @param $UserEmail
     * @param $UserPassword
     * @return \PDOStatement
     */
    public function register($UserName, $UserEmail, $UserPassword)
    {
        try {
            $new_password = password_hash($UserPassword, PASSWORD_DEFAULT);

            $stmt = $this->conn->prepare("INSERT INTO UserDatabase(UserName,UserEmail,UserPassword)
                                                       VALUES(:UserName, :UserEmail, :UserPassword)");

            $stmt->bindparam(":UserName", $UserName);
            $stmt->bindparam(":UserEmail", $UserEmail);
            $stmt->bindparam(":UserPassword", $new_password);

            $stmt->execute();

            return $stmt;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    /**
     * used to allow the user to login by checking username or email and password
     * and compares to existing database information
     * @param $UserName
     * @param $UserEmail
     * @param $UserPassword
     * @return bool
     */
    public function doLogin($UserName, $UserEmail, $UserPassword)
    {
        try {
            $stmt = $this->conn->prepare("SELECT * FROM UserDatabase WHERE UserName=:UserName OR UserEmail=:UserEmail LIMIT 1");
            $stmt->execute(array(':UserName'=>$UserName, ':UserEmail'=>$UserEmail));
            $userRow=$stmt->fetch(PDO::FETCH_ASSOC);
            if ($stmt->rowCount() == 1) {
                if (password_verify($UserPassword, $userRow['UserPassword'])) {
                    $_SESSION['user_session'] = $userRow['UserId'];
                    return true;
                } else {
                    return false;
                }
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    /**
     * if the user is logged in. create a user session
     * @return bool
     */
    public function is_loggedin()
    {
        if (isset($_SESSION['user_session'])) {
            return true;
        }
    }

    /**
     * redirect the user to correct page when logged in and out
     * @param $url
     */
    public function redirect($url)
    {
        header("Location: $url");
    }

    /**
     * direct user to logout and
     * destroy session once logged out
     * @return bool
     */
    public function doLogout()
    {
        session_destroy();
        unset($_SESSION['user_session']);

        $pageTitle = 'Logged Out';

        require_once __DIR__ . '/../templates/logout.php';

        return true;
    }
}
