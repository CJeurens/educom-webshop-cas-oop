<?php

require_once "appdoc.php";

class TextDoc extends AppDoc
{
    public function __construct($content)       //is het een goed idee om een array mee te krijgen en die hier uit elkaar te trekken?
    {
        parent::__construct(
            $content["title"],
            $content["header"],
            $content["navlinks"],
            $content["session"],
            $content["author"]
        );
        $this->text = $content["text"];
    }

    public function showMainContent()
    {
        foreach ($this->text as $paragraph)
        {
            print "<p>".$paragraph."</p>".PHP_EOL;
        }
    }
    
}

?>