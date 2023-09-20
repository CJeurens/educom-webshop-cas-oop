<?php
class NavBar
{
    public function __construct(array $links, $user)
    {
        $this->links = $links;
        $this->user = $user;
    }

    public function show()
    {
        print "
        <div class='navbar'>
            <ul class='nav'>".PHP_EOL;
            
                foreach ($this->links as $link=>$name)
                {
                    print "             <li><a href='?page=".$link."'>".htmlspecialchars($name)."</a> | </li>".PHP_EOL;
                }
                print "             <span class='account'><form method='post' id='logout' name='logout'><input type='hidden' name='page' value='logout'>";
                
                require_once "_src/views/login.php";
                $login = new Login($this->user);
                $login->show(); print "</form></span>
            </ul>
        </div>
        </div>
        ";
    }
}
?>