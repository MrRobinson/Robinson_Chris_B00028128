<?php
/**
 * Created by PhpStorm.
 * User: Chris Robinson
 * this class is used to take in user login details
 * and allows them to post in the forum.php page
 */
namespace Itb;

/**
 * Class ForumPost
 * @package Itb
 */
class ForumPost
{
    /**
     * forum name
     * @var
     */
    private $ForumName;

    /**
     * forum email
     * @var
     */
    private $ForumEmail;

    /**
     * forum comments
     * @var
     */
    private $ForumComments;

    /**
     * forum date and time
     * @var
     */
    private $ForumDateTime;

    /**
     * get forum name
     * @return mixed
     */
    public function getForumName()
    {
        return $this->ForumName;
    }

    /**
     * get forum email
     * @return mixed
     */
    public function getForumEmail()
    {
        return $this->ForumEmail;
    }

    /**
     * get forum comments
     * @return mixed
     */
    public function getForumComments()
    {
        return $this->ForumComments;
    }

    /**
     * get forum date and time
     * @return mixed
     */
    public function getForumDateTime()
    {
        return $this->ForumDateTime;
    }

    /**
     * used to prepare connection statement
     * @var null|\PDO
     */
    private $conn;

    /**
     * construct DB connection from UserDatabase
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
     * connect to Forum DB and input details
     * @param $ForumName
     * @param $ForumEmail
     * @param $ForumComments
     * @return \PDOStatement
     */
    public function forumPost($ForumName, $ForumEmail, $ForumComments)
    {
        try {
            $stmt = $this->conn->prepare("INSERT INTO ForumPost(ForumName,ForumEmail,ForumComments)
                                                       VALUES(:ForumName, :ForumEmail, :ForumComments)");

            $stmt->bindparam(":ForumName", $ForumName);
            $stmt->bindparam(":ForumEmail", $ForumEmail);
            $stmt->bindparam(":ForumComments", $ForumComments);

            $stmt->execute();

            return $stmt;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    /**
     * get all details from ForumDatabase
     * @return array
     */
    public function getAll()
    {
        $sql ='SELECT * FROM ForumPost ORDER BY ForumDateTime DESC';

        $stmt = $this->conn->prepare($sql);
        $stmt->setFetchMode(\PDO::FETCH_CLASS, '\\Itb\\ForumPost');
        $stmt->execute();

        $userPosts = $stmt->fetchAll();

        return $userPosts;
    }
}
