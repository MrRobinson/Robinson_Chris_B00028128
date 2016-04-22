<?php
/**
 * Created by PhpStorm.
 * User: Chris Robinson
 * this class is used to get items from newsletter database
 */

namespace Itb;

use \PDO;

/**
 * Class NewsLetter
 * @package Itb
 */
class NewsLetter
{
    /**
     * newsletter name
     * @var
     */
    private $NewsName;
    /**
     * newsletter email
     * @var
     */
    private $NewsEmail;

    /**
     * get newsletter name
     * @return mixed
     */
    public function getNewsName()
    {
        return $this->NewsName;
    }

    /**
     * get newsletter email
     * @return mixed
     */
    public function getNewsEmail()
    {
        return $this->NewsEmail;
    }

    /**
     * used to prepare connection statement
     * @var null|\PDO
     */
    public $conn;

    /**
     * construct DB connection from Database
     * ForumPost constructor.
     */
    public function __construct()
    {
        $database = new UserDatabase();
        $db = $database->dbConnection();
        $this->conn = $db;
    }

    /**
     * used to prepare sql statement from DB
     * @param $sql
     * @return \PDOStatement
     */
    public function runQuery($sql)
    {
        $stmt = $this->conn->prepare($sql);
        return $stmt;
    }

    /**
     * connect to NewsLetter and input details
     * @param $NewsName
     * @param $NewsEmail
     * @return \PDOStatement
     */
    public function newsLetter($NewsName, $NewsEmail)
    {
        try {
            $stmt = $this->conn->prepare("INSERT INTO NewsLetter(NewsName,NewsEmail)
                                                       VALUES(:NewsName, :NewsEmail)");

            $stmt->bindparam(":NewsName", $NewsName);
            $stmt->bindparam(":NewsEmail", $NewsEmail);

            $stmt->execute();

            return $stmt;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}
