<?php

require_once "_src/views/appdoc.php";

class DetailDoc extends AppDoc
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
        $this->item = $content["item"];
        $this->user = $content["session"]["userID"];
    }

    protected function showMainContent()
    {//TODO: verwijder styling
        print "<div class=product_detail>   
        <img style='float:left;margin-right:16px' src=assets/".$this->item["imgurl"]." width='384' height='384'>
        <section class=product_description>
        <h1>".$this->item["name"]."</h1>
        <p>".htmlspecialchars('€').$this->item["unitprice"]."</p>
        ";

        if(!empty($this->user))
        {
            print "<form method='post'>
            <input type='number' style='width:32px' name='units' min='1' max='4' value='1'>
            <button type='submit' name='id' value='".$this->item["id"]."'>!!!BUY BUY BUY!!!</button>
            <input type='hidden' name='page' value='shop'>
            </form>";
        }
        else
        {                                                                   //TODO: verwijder GET
            print "<a href='?page=login&referral=".$_GET["product"]."'>
            <button>Log in to purchase</button>
            </a>";
        }
        print "</section></div>"; 
    }
    
}

?>