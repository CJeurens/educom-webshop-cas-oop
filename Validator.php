<?php

class Validator
{
    public function __construct($data)
    {
        $this->data = $data;
    }

    public function validateEmail($field)
    {
        if (array_key_exists("email",$field))
        {
            $field["email"]["valid"] = FALSE;
            if (!filter_var($field["email"]["value"],FILTER_VALIDATE_EMAIL))
            {
                $field["email"]["error"] = "Invalid e-mail";
            }
            else
            {
                $field["email"]["valid"] = TRUE;
            }
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
                $field = $this->validateEmail($field);
                $field[$key]["valid"] = TRUE;
            }
            $fields = array_merge($fields,$field);
        }
        return $fields;
    }
}


?>