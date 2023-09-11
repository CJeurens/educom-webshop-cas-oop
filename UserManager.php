<?php

class UserManager
{
    public function getUserInfo($sql)
    {
        $this->sql = $sql;
        
        return $this->connect();
    }

    public function executeQuery($conn)
    {
        $stmt = $conn->prepare($this->sql);
        $stmt->execute();
        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);

        foreach ($stmt->fetchAll() as $values)
        {
            $info = $values;
            return $info;
        };
    }

    public function connect()
    {
        require_once "\config\Settings.php"; //plaats boven root
        $servername = Settings::SERVER_NAME;
        $username = Settings::SERVER_USER;
        $password = Settings::SERVER_PASS;
        $database = "users";

        try
        {
            $conn = new PDO
            (
                "mysql:host=$servername;
                dbname=$database",
                $username,
                $password
            );
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $return = $this->executeQuery($conn);
        }
        catch(PDOException $e)
        {
            print "Error: " . $e->getMessage();
        }

        $conn = NULL;
        return $return;
    }
}

?>