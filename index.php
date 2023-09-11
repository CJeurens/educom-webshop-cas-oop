<?php
    session_start();
    require_once "PageController.php";
    $page = new PageController;
    $page->handleRequest();
?>
