<?php
/**
 * Created by PhpStorm.
 * User: Chris Robinson
 * this class is used to connect to the Yarn DB
 * and get all from the DB as well as ID for the
 * shop page
 */
namespace Itb;

/**
 * Class YarnDatabase
 * @package Itb
 */
class YarnDatabase
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
     *  db PDO
     * @var \PDO
     */
    private $dbh;
    /**
     * db connection error message
     * @var string
     */
    private $error;

    /**
     * construct DB connection to YarnProducts
     * YarnDatabase constructor.
     */
    public function __construct()
    {
        $dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->dbname;
        // Try connect to DB
        try {
            $options = array(\PDO::ATTR_PERSISTENT => true, \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION);
            $this->dbh = new \PDO($dsn, $this->user, $this->pass, $options);
        } catch (\PDOException $e) {
            $this->error = $e->getMessage();
            print 'Unable to connect to Database - Please check connection settings';
            print '<br>';
            print  $e->getMessage();
        }
    }

    /**
     * get PDO
     * @return \PDO
     */
    public function getDbh()
    {
        return $this->dbh;
    }

    /**
     * get error message
     * @return string
     */
    public function getError()
    {
        return $this->error;
    }

    /**
     * get all details from YarnProducts DB
     * @return array
     */
    public function getAll()
    {
        $db = new YarnDatabase();
        $connection = $db->getDbh();

        $sql = 'SELECT * FROM YarnProducts';

        $statement = $connection->prepare($sql);
        $statement->setFetchMode(\PDO::FETCH_CLASS, '\\Itb\\Yarn');
        $statement->execute();

        $yarnProducts = $statement->fetchAll();

        return $yarnProducts;
    }

    /**
     * get id only from YarnProducts for shoppingCart use
     * @param $YarnId
     * @return mixed|null
     */
    public static function getOneById($YarnId)
    {
        $db = new YarnDatabase();
        $connection = $db->getDbh();

        $statement = $connection->prepare('SELECT * from YarnProducts WHERE YarnId=:id');
        $statement->bindParam(':id', $YarnId, \PDO::PARAM_INT);
        $statement->setFetchMode(\PDO::FETCH_CLASS, '\\Itb\\Yarn');
        $statement->execute();

        if ($object = $statement->fetch()) {
            return $object;
        } else {
            return null;
        }
    }
}
