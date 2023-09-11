<?php
class Login
{
    public function __construct($user)
    {
        $this->user = $user;
    }

    public function show()
    {
        if (!empty($this->user["userID"]))
        {
            print "Welcome ".$this->user["userID"]."!
            <input type='hidden' value='logout' form='logout' name='page'>";
            //showShoppingCart();
            print "<button type='submit'> Log out </button>
            ";
        }
        
        else
        {
            print "<a href='?page=login'>Log in/register</a>";
        }
    }
}
?>