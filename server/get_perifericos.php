<?php
include('conexao.php');

$stmt = $conn->prepare("SELECT * FROM products WHERE product_category='perifericos' LIMIT 4");
$stmt->execute();
$perifericos = $stmt->get_result();

