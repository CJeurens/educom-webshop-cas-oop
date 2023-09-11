<?php

class PageView
{
    public function displayPage($content)
    {
        $view = "";

        switch ($content["type"])
        {
            case "text":
                require_once "TextDoc.php";
                $view = new TextDoc($content);
                break;
            case "form":
                require_once "FormDoc.php";
                $view = new FormDoc($content);
                break;
        }
        if (empty($view))
        {
            print "Please return to where you came from :)";
        }
        else
        {
            $view->show();
        }
    }
}

?>