<?php

class ShopManager
{
    public function __construct()
    {
        $this->crud = new Crud;
    }

    public function getProducts()
    {
        $sql = "SELECT * FROM products";
        $params = array();
        return $this->crud->selectAll($sql, $params);
    }
    
}

?>