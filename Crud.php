<?php

class Crud
{
    protected $conn;
    protected $sql;
    protected $stmt;

    public function getUserByEmail($email)
    {
        $this->connect();
        $sql = "SELECT * FROM users WHERE email='".$email."'";
        return $this->executeQuery($sql);
    }

    public function writeUserToDb($email,$username,$password)
    {
        $this->connect();
        $sql = "INSERT INTO users (email, username, password) VALUES ('".$email."','".$username."','".$password."')";
        return $this->executeQuery($sql);
    }

    public function executeQuery($sql)
    {
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);

        foreach ($stmt->fetchAll() as $values)
        {
            $this->info = $info = array();
            $this->info = array_merge($info,$values);
        }
        $this->conn = NULL;
        return $this->info = isset($this->info) ? $this->info : "";

    }

    public function connect()
    {
        require_once ".\config\Settings.php"; //plaats boven root
        $servername = Settings::SERVER_NAME;
        $username = Settings::SERVER_USER;
        $password = Settings::SERVER_PASS;
        $database = "users";

        try
        {
            $this->conn = new PDO
            (
                "mysql:host=$servername;
                dbname=$database",
                $username,
                $password
            );
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        catch(PDOException $e)
        {
            print "Error: " . $e->getMessage();
        }

    }
}

?>