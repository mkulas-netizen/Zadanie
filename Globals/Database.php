<?php


namespace Globals;

use PDOException;
use PDO;

class Database
{


    private PDO $db;
    private $statemat;
    private int $fetchType = PDO::FETCH_OBJ;


    public function __construct(
        $server = DB_SERVER,
        $port = DB_PORT,
        $dbname = DB_NAME,
        $user = DB_USER,
        $pass = DB_PASSW
    )
    {
        try {
            $this->db = new PDO(
                "mysql:host=$server;
                     port=$port;
                     dbname=$dbname",
                "$user",
                "$pass",
                array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
        } catch (PDOException $exception) {
            echo "Error while database connect " . $exception->getMessage();

        }
    }

    /**
     * @param int $fetchType
     */
    public function setFetchType($fetchType)
    {
        $this->fetchType = $fetchType;
    }


    public function getAll($query, $data = []): array
    {
        return $this->query($query, $data)->fetchAll($this->fetchType);
    }


    public function getOne($query, $data = [])
    {
        return $this->query($query, $data)->fetch($this->fetchType);
    }


    public function query($query, $data = [] )
    {
        $this->statemat = $this->db->prepare($query);
        $this->statemat->execute($data);
        return $this->statemat;
    }


    public function lastId()
    {
        $this->statemat = $this->db->lastInsertId();
        return $this->statemat;
    }

}