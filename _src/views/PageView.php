<?php

class PageView
{
    public function displayPage($content)
    {
        $view = "";

        switch ($content["type"])
        {
            case "text":
                require_once "_src/views/TextDoc.php";
                $view = new TextDoc($content);
                break;
            case "form":
                require_once "_src/views/FormDoc.php";
                $view = new FormDoc($content);
                break;
            case "grid":
                require_once "_src/views/GridDoc.php";
                $view = new GridDoc($content);
                break;
            case "detail":
                require_once "_src/views/DetailDoc.php";
                $view = new DetailDoc($content);
                break;
            case "cart":
                require_once "_src/views/CartDoc.php";
                $view = new CartDoc($content);
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