<?php
    session_start();

    require_once "config/Settings.php";

    include "_src/tools/debug.php";
    global $debug_data;
    $debug_data = array();

    require_once "_src/dal/crud.php";
    $crud = new Crud;

    require_once "_src/controllers/PageController.php";
    $page = new PageController;
    $page->handleRequest();

    debug($debug_data);
?>
