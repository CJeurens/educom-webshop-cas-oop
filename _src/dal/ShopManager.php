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
    
    public function getProduct($id)
    {
        $sql = "SELECT * FROM products WHERE id=:id";
        $params = ["id" => $id];
        return $this->crud->selectAll($sql, $params);
    }
}

?>