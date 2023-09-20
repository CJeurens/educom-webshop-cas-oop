<?php

class GetRetriever
{
    public function __construct(DataSanitizer $sanitize)
    {
        $this->sanitize = $sanitize;
    }

    public function get()
    {
        return $this->sanitize->sanitize($_GET);
    }
}

?>