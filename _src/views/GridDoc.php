<?php

require_once "_src/views/appdoc.php";

class GridDoc extends AppDoc
{
    public function __construct($content)
    {
        parent::__construct(
            $content["title"],
            $content["header"],
            $content["navlinks"],
            $content["session"],
            $content["author"]
        );
        $this->items = $content["items"];
    }

    protected function showMainContent()
    {
        print "
        <div class='flex-container'>";
                foreach ($this->items as $item)     //TODO: maak generieker
                {
                    print   "
                    <div class=item>
                        <a href='?page=detail&product=".$item["id"]."'>
                        <img src=assets/".$item["imgurl"]." width='94' height='94'><br>
                        ".$item["name"]."</a><br>
                        ".htmlspecialchars('€').$item["unitprice"]. "
                    </div>";
                }
        print "
        </div>";
    }
    
}

?>