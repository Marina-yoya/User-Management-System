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

    public function create($sql, $params = [])
    {
        try {
            $stmt = $this->connection->prepare($sql);
            $stmt->execute($params);
            return $this->connection->lastInsertId();
        } catch (PDOException $e) {
            die("Creation failed: " . $e->getMessage()); 
        }
    }

    public function read($sql, $params = [])
    {
        $stmt = $this->connection->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function update($sql, $params = [])
    {
        try {
            $stmt = $this->connection->prepare($sql);
            $stmt->execute($params);
            return true;
        } catch (PDOException $e) {
            echo "Update failed: " . $e->getMessage();
            return false;
        }
    }

    public function delete($sql, $params = [])
    {
        try {
            $stmt = $this->connection->prepare($sql);
            $stmt->execute($params);
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }
}




?>