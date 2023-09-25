<?php

require_once "_src/views/appdoc.php";

class CartDoc extends AppDoc
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
        $this->session = $session = $content["session"];
        $this->model = new ShopManager;
    }

    protected function showMainContent()
    {
        print "
        <div class='cart'>
        <table style='width:50%'>
            <tr style='text-decoration-line:underline;font-weight:bold'>
                <td></td>
                <td>ID</td>
                <td></td>
                <td>Name</td>
                <td>Amount</td>
                <td>Price per unit</td>
                <td>Subtotal</td>
            </tr>";

        $price_total = 0;
        $products = $this->session["cart"][$this->session["userID"]];
        foreach ($products as $product)
        {
            [$prod_info] = $this->model->getProduct($product["id"]);
            $product = array_merge($product,$prod_info);
            print "
            <tr>
                <td><form method='post'><button type='submit' name='remove' value='".$product["id"]."'>X</button><input type='hidden' name='page' value='cart'></form></td>
                <td>".$product["id"]."</td>
                <td><img src=assets/".$product["imgurl"]." width='32' height='32'></td>
                <td><a href='?page=detail&product=".$product["id"]."'>".$product["name"]."</a></td>
                <td>".$product["units"]."</td>
                <td>".htmlspecialchars('€').$product["unitprice"]."</td>
                <td>".htmlspecialchars('€').number_format($product["units"]*$product["unitprice"],2)."</td>
            </tr>";
            $price_total += ($product["units"]*$product["unitprice"]);
        }

        print "
        <tr style='text-decoration-line:underline;font-weight:bold;vertical-align:bottom;height:48px'>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td>Total</td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td>".htmlspecialchars('€').number_format($price_total,2)."</td>
        </tr>
        ";

        print "
        </table>
        </div>";

        print"
        <div class='cart'><form method='post'>
        <button type='submit' name='cart_submit' value='TRUE' style='width:240px;height:48px'>Place order</button>
        </form></div>
        ";
    }
    
}

?>