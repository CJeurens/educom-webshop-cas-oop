<?php

require_once "_src/views/htmldoc.php";

class AppDoc extends HtmlDoc
{
    public function __construct($title, $header, $navlinks, $session, $author)
    {
        $this->title = $title;
        $this->header = $header;
        $this->navlinks = $navlinks;
        $this->session = $session;
        $this->author = $author;
    }

    protected function showHeadContent() 
    { 
        print "<meta charset='UTF-8'><title>".$this->title.
        "</title><link rel='stylesheet' href='/educom-webshop-oop-cas/assets/stylesheet.css'>";
    }

    protected function showMainContent()
    {
        //abstract class?
    }

    protected function showBodyContent()
    {
        require_once "_src/views/header.php";
        $header = new Header($this->header);
        $header->show();
        
        require_once "_src/views/navbar.php";
        $navbar = new NavBar($this->navlinks, $this->session);
        $navbar->show();

        print "<div class=content>";
        $this->showMainContent();
        print "</div>";
        
        require_once "_src/views/footer.php";
        $footer = new Footer($this->author);
        $footer->show();
    }

}

?>