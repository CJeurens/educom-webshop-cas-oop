<?php

class PageModel
{
    public function getPageContent($request)
    {

        $navlinks = array(
            "home"      => "🏠HOME",         //"link address" => "link display name"
            "about"     => "ℹ️ABOUT",
            "contact"   => "📞CONTACT"
            /*"shop"      => "🛍️SHOP"*/
        );

        $author = "Cas Jeurens";
        $session = $_SESSION;
        $content = array();

        switch ($request["page"])
        {
            case "home":
                $content = array(
                    "title"     => "🏠HOME",
                    "header"    => "🏠DIT IS HOME",
                    "navlinks"  => $navlinks,
                    "session"   => $session,
                    "author"    => $author,
                    "type"      => "text",
                    "text"      => array
                    (
                        "Van harte welkom op deze zeer mooie webpagina!"
                    )
                );
                break;
            case "about":
                $content = array(
                    "title"     => "ℹ️ABOUT",
                    "header"    => "ℹ️DIT IS ABOUT",
                    "navlinks"  => $navlinks,
                    "session"   => $session,
                    "author"    => $author,
                    "type"      => "text",
                    "text"      => array
                    (
                        "Deze webpagina is speciaal ontwikkeld om mij te helpen de html-taal te leren.",
                        "Ik heb biologie gestudeerd aan Wageningen University & Research waar ik coole dingen heb geleerd over plantjes, diertjes en ander gespuis.",
                        "Tevens ben ik opgegroeid in Roermond waar ik talloze vlaaien heb gegeten. Mijn favoriet is appel-citroen."
                    )
                );
                break;
            case "contact":
                $content = array(
                    "title"     => "📞CONTACT",
                    "header"    => "📞DIT IS CONTACT",
                    "navlinks"  => $navlinks,
                    "session"   => $session,
                    "author"    => $author,
                    "type"      => "form",
                    "form"      => "contact",
                    "method"    => "POST",
                    "fields"    => array
                    (
                        "name"  =>  array
                        (
                            "name"      =>  "name",
                            "label"     =>  "Name:",
                            "type"      =>  "text",
                            "value"     =>  "''"        //default value
                        ),
                        "email" =>  array
                        (
                            "name"      =>  "email",
                            "label"     =>  "E-mail:",
                            "type"      =>  "text",
                            "value"     =>  "''"
                        ),
                        "msg" =>  array
                        (
                            "name"      =>  "msg",
                            "label"     =>  "Message:",
                            "type"      =>  "textarea",
                            "value"     =>  "''"
                        ),
                        "submit" =>  array
                        (
                            "name"      =>  "submit",
                            "label"     =>  "",
                            "type"      =>  "submit",
                            "value"     =>  "Send"
                        ),
                        "hidden" =>  array
                        (
                            "name"      =>  "page",
                            "label"     =>  "",
                            "type"      =>  "hidden",
                            "value"     =>  "contact"
                        )
                    )
                );
                break;
            case "login":
                $content = array(
                    "title"     => "👤ACCOUNT",
                    "header"    => "👤ACCOUNT",
                    "navlinks"  => $navlinks,
                    "session"   => $session,
                    "author"    => $author,
                    "type"      => "form",
                    "form"      => "login",
                    "method"    => "POST",
                    "fields"    => array
                    (
                        "email" =>  array(
                                        "name"  =>  "email",
                                        "label" =>  "E-mail:",
                                        "type"  =>  "text",
                                        "value" =>  "''"
                        ),
                        "password"  =>  array(
                                        "name"  =>  "password",
                                        "label" =>  "Password:",
                                        "type"  =>  "text",
                                        "value" =>  "''"
                        ),
                        "submit" =>  array(
                                        "name"  =>  "''",
                                        "label" =>  "<a style=font-size:14px; href='?page=register'>Register account</a>",
                                        "type"  =>  "submit",
                                        "value" =>  "'Log in'"
                        ),
                        "hidden" =>  array(
                                        "name"  =>  "page",
                                        "label" =>  "",
                                        "type"  =>  "hidden",
                                        "value" =>  "login"
                        )
                    )
                );
                break;
            case "register":
                $content = array(
                    "title"     => "👤ACCOUNT",
                    "header"    => "👤ACCOUNT",
                    "navlinks"  => $navlinks,
                    "session"   => $session,
                    "author"    => $author,
                    "type"      => "form",
                    "form"      => "register",
                    "method"    => "POST",
                    "fields"    => array
                    (
                        "email" =>  array(
                                        "name"  =>  "email",
                                        "label" =>  "E-mail:",
                                        "type"  =>  "text",
                                        "value" =>  "''"
                        ),
                        "username" =>  array(
                                        "name"  =>  "username",
                                        "label" =>  "Username:",
                                        "type"  =>  "text",
                                        "value" =>  "''"
                        ),
                        "password"  =>  array(
                                        "name"  =>  "password",
                                        "label" =>  "Password:",
                                        "type"  =>  "text",
                                        "value" =>  "''"
                        ),
                        "rpassword"  =>  array(
                                        "name"  =>  "rpassword",
                                        "label" =>  "Repeat password:",
                                        "type"  =>  "text",
                                        "value" =>  "''"
                        ),
                        "submit" =>  array(
                                        "name"  =>  "''",
                                        "label" =>  "<a style=font-size:14px; href='?page=login'>Log in instead</a>",
                                        "type"  =>  "submit",
                                        "value" =>  "Register"
                        ),
                        "hidden" =>  array(
                                        "name"  =>  "page",
                                        "label" =>  "",
                                        "type"  =>  "hidden",
                                        "value" =>  "register"
                        )
                    )
                );
                break;
            case "logout":

        }
        return $content;
    }
}

?>