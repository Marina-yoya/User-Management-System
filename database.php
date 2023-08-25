<?php

class Database
{
    private $host;
    private $username;
    private $dbname;
    private $connection;

    public function __construct($host, $username, $dbname)
    {
        $this->host = $host;
        $this->username = $username;

        $this->dbname = $dbname;

        $this->connect();
    }

    private function connect()
    {
        try {
            $this->connection = new PDO("mysql:host=$this->host;dbname=$this->dbname", $this->username);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
        } catch (PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }
    }

    public function query($sql)
    {
        return $this->connection->query($sql);
    }

    public function execute($sql, $params = [])
    {
        $stmt = $this->connection->prepare($sql);
        $stmt->execute($params);
        return $stmt;
    }
}

?>