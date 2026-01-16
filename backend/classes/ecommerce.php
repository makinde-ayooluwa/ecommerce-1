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
}
