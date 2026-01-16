<?php

class Ecommerce
{
    private $pdo;
    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }
    public function getProducts()
    {
        $sql = "SELECT * FROM products";
        $stmt = $this->pdo->query($sql);
        $stmt->execute();
        $products = $stmt->fetchAll();
        return $products;
    }
    public function addToCart($data)
    {
        $sql = "INSERT INTO carts(`product-id`,`user-id`) VALUES (`:product-id`, `:user-id`)";
        $stmt = $this->pdo->query($sql);
        $stmt->bindParam(":product-id",$data["product-id"]);
        $stmt->bindParam(":user-id",$data["user-id"]);
        if($stmt->execute()){
            return true;
        }
    }
}
