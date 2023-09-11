<?php

class SessionManager
{
    public function doLoginSession($username)
    {
        $_SESSION["userID"] = $username;
    }
}

?>