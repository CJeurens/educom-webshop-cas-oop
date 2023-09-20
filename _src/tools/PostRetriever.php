<?php

class PostRetriever
{
    public function __construct(DataSanitizer $sanitize)
    {
        $this->sanitize = $sanitize;
    }

    public function retrieve($inputs)
    {
        $return = array();
        foreach ($inputs as $input)
        {
            $add = array(
                $input => ["value" =>(isset($_POST[$input]) ? $this->sanitize->sanitize($_POST[$input]) : "")]
            );
            $return = array_merge($return,$add);
        }
        return $return;
    }
}

?>