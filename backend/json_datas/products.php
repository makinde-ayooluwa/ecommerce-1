<?php

include "../database/db.php";
include "../classes/ecommerce.php";
$ecommerce = new Ecommerce($pdo);

$products = $ecommerce->getProducts();

echo json_encode($products);


