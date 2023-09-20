<?php

class Crud
{
    protected $conn;
    protected $sql;
    protected $stmt;
    public function __construct()
    {
        try
        {
            $this->conn = new PDO
            (
                "mysql:host=".Settings::SERVER_NAME.";
                dbname=".Settings::SERVER_DB,
                Settings::SERVER_USER,
                Settings::SERVER_PASS
            );
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        catch(PDOException $e)
        {
            print "Error: " . $e->getMessage();
        }
    }

    public function selectOne($sql, $params)
    {
        $this->executeQuery($sql, $params);
        $this->stmt->setFetchMode(PDO::FETCH_ASSOC);
        return $this->stmt->fetch();
    }

    public function selectAll($sql, $params)
    {
        $this->executeQuery($sql, $params);
        $this->stmt->setFetchMode(PDO::FETCH_ASSOC);
        return $this->stmt->fetchAll();
    }

    public function executeQuery($sql, $params)
    {
        $this->stmt = $this->conn->prepare($sql);
        foreach ($params as $name => $info)
        {
            $this->stmt->bindValue(":".$name,$info);
        }
        return $this->stmt->execute();
    }
}

?>