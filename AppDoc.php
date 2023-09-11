<?php

require_once "htmldoc.php";

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
        "</title><link rel='stylesheet' href='/educom-webshop-database-cas/oop/stylesheet.css'>";
    }

    protected function showMainContent()
    {
        print "test";
    }

    protected function showBodyContent()
    {
        require_once "header.php";
        $header = new Header($this->header);
        $header->show();
        
        require_once "navbar.php";
        $navbar = new NavBar($this->navlinks, $this->session);
        $navbar->show();

        print "<div class=content>";
        $this->showMainContent();
        print "</div>";
        
        require_once "footer.php";
        $footer = new Footer($this->author);
        $footer->show();
    }

}

?>