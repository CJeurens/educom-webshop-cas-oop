<?php

class DataSanitizer
{
    public $data;

    public function sanitize($data)
    {
        if (gettype($data)==="array")
        {
            $return = array();
            foreach ($data as $key=>$value)
            {
                $add = array($key=>$this->sanitizer($value));
                $return = array_merge($return,$add);
            }
            return $return;
        }

        else
        {
            $return = $this->sanitizer($data);
            return $return;
        }
    }

    protected function sanitizer($value)
    {
        $value = trim($value);
        $value = stripslashes($value);
        $value = htmlspecialchars($value);
        return $value;
    }

}

?>