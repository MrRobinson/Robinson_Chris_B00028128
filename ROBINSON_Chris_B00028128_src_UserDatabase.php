<?php
/**
 * Created by PhpStorm.
 * User: Chris Robinson
 * this class is used to connect to the User DB
 */
namespace Itb;

use \PDO;

/**
 * Class UserDatabase
 * @package Itb
 */
class UserDatabase
{
    /**
     * set host from index.php
     * @var string
     */
    private $host = DB_HOST;
    /**
     * set ser from index.php
     * @var string
     */
    private $user = DB_USER;
    /**
     * set pass from index.php
     * @var string
     */
    private $pass = DB_PASS;
    /**
     * set dbname from index.php
     * @var string
     */
    private $dbname = DB_NAME;
    /**
     * used to prepare connection statement
     * @var
     */
    public $conn;

    /**
     * connect to DB using username/password/host/DB
     * return connection
     * @return null|PDO
     */
    public function dbConnection()
    {
        $this->conn = null;
        try {
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->dbname, $this->user, $this->pass);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $exception) {
            echo "Connection error: " . $exception->getMessage();
        }

        return $this->conn;
    }
}
