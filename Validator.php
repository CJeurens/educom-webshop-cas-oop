<?php

class Validator
{

    public static $val_data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function addValidation($field, $fields)
    {
        if (array_key_exists("email",$field))
        {
            $field = $this->validateEmail($field);
        }
        return $field;
    }

    public function validateEmail($field)
    {
        if (!filter_var($field["email"]["value"],FILTER_VALIDATE_EMAIL))
        {
            $field["email"]["error"] = "Invalid e-mail";
        }
        else
        {
            $field["email"]["valid"] = TRUE;
        }
        return $field;
    }

    public function validate()
    {
        $fields = array();

        foreach ($this->data as $key=>$value)
        {
            unset($field);
            $field[$key] = $value;
            $field[$key]["error"] = "";
            $field[$key]["valid"] = FALSE;
            if(empty($field[$key]["value"]))
            {
                $field[$key]["error"] = "Please fill in field";
            }
            else
            {
                $field = $this->addValidation($field, $fields);
            }
            $fields = array_merge($fields,$field);
        }

        self::$val_data = $fields;

        if(!empty($fields["email"]["valid"]) && !empty($fields["password"]["valid"]))
        {
            return $this->user_info["username"];
        }
    }
}


?>