<?php

function dump($dump, $title = "DEBUG")
{
    $data[] = [$title=>$dump];
    $GLOBALS["debug_data"] = array_merge($GLOBALS["debug_data"],$data);
}

function debug($data)
{
    pre();
    msg($data);
    post();
}

function pre()
{
    print "<div class=debug><pre>".PHP_EOL;
}

function msg($data)
{
    foreach($data as $dump)
    {
        foreach($dump as $title=>$value)
        {
            print "============$title============
            ".PHP_EOL;
            print_r($value);
            print "
            ".PHP_EOL;
        }
    }

}

function post()
{
    print "</pre>
    </div>
    ";
}

?>