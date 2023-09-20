<?php

function dump($data)
{
    $data = array($data);
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
    foreach($data as $value)
    {
        print "============DEBUG============
        ".PHP_EOL;
        print_r($value);
        print "
        ".PHP_EOL;
    }

}

function post()
{
    print "</pre>
    </div>
    ";
}

?>