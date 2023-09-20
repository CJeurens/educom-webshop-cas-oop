<?php

class UserManager
{
    public $errors;
    public Crud $crud;

    public function __construct($val_data)
    {
        $this->val_data = $val_data;
        $this->crud = new Crud;
    }

    public function loginChecker()
    {
        if($this->val_data["email"]["valid"] && $this->val_data["password"]["valid"])
        {
            if($user = $this->getUserByEmail($this->val_data["email"]["value"]))
            {
                if(strcmp($this->val_data["password"]["value"],$user["password"]) == 0)
                {
                    return $user["username"];
                }
                else
                {
                    $this->errors["password"] = "Incorrect password";
                    return FALSE;
                }
            }
            else
            {
                $this->errors["email"] = "E-mail not registered";
                return FALSE;
            }
        }
    }

    public function registerChecker()
    {
        if($this->val_data["email"]["valid"] && 
        $this->val_data["password"]["valid"] && 
        $this->val_data["username"]["valid"])
        {
            if($user = $this->getUserByEmail($this->val_data["email"]["value"]))
            {
                $this->errors["email"] = "E-mail already registered";
                return FALSE;
            }
            else
            {
                if(strcmp($this->val_data["password"]["value"],$this->val_data["rpassword"]["value"]) == 0)
                {
                    $this->writeUserToDb(
                        $this->val_data["email"]["value"],
                        $this->val_data["username"]["value"],
                        $this->val_data["password"]["value"]
                    );
                    return $this->val_data["username"]["value"];
                }
                else
                {
                    $this->errors["rpassword"] = "Incorrect repeat password";
                    return FALSE;
                }
            }
        }
    }

    public function getUserByEmail($email)
    {
        $sql = "SELECT * FROM users WHERE email=:email";
        $params = ["email" => $email];
        return $this->crud->selectOne($sql, $params);
    }

    public function writeUserToDb($email,$username,$password)
    {
        $sql = "INSERT INTO users (email, username, password) VALUES (:email,:username,:password)";
        $params = 
        [
            "email" => $email,
            "username" => $username,
            "password" => $password
        ];
        return $this->crud->executeQuery($sql, $params);
    }
}

?>