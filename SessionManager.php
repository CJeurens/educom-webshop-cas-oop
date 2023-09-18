<?php

class SessionManager
{
    public function doLoginSession($username)
    {
        $_SESSION["userID"] = $username;
    }

    public function doLogoutSession()
    {
        $_SESSION["userID"] = "";
    }
}

?>