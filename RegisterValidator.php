<?php

require_once "Validator.php";

class RegisterValidator extends Validator
{
    public function __construct($data)
    {
        parent::__construct($data);
    }

    public function validateEmail($field)
    {
        if (!filter_var($field["email"]["value"],FILTER_VALIDATE_EMAIL))
        {
            $field["email"]["error"] = "Invalid e-mail";
            return $field;
        }

        if(!empty($this->user_info))
        {
            $field["email"]["error"] = "E-mail already registered";
            return $field;
        }
        $field["email"]["valid"] = TRUE;
        return $field;
    }

    public function addValidation($field, $fields)
    {
        if (isset($field["email"]))
        {
            $this->user_info = $user_info = array();

            $sql = "SELECT * FROM users WHERE email='".$field["email"]["value"]."'";
            require_once "UserManager.php";
            $user = new UserManager;
            $this->user_info = $user->getUserInfo($sql);
        }

        if (array_key_exists("email",$field))
        {
            $field = $this->validateEmail($field);
        }

        if(isset($fields["email"]) && $fields["email"]["valid"] && array_key_exists("rpassword",$field))
        {
            if (strcmp($fields["password"]["value"],$field["rpassword"]["value"]) == 0)
            {
                $field["rpassword"]["valid"] = TRUE;
            }
            else
            {
                $field["rpassword"]["error"] = "Incorrect repeat password";
            }
        }
        return $field;
    }
}


?>