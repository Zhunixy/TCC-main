<?php
include('conexao.php');

$stmt = $conn->prepare("SELECT * FROM products WHERE product_category='pecas' LIMIT 4");
$stmt->execute();
$pecas = $stmt->get_result();

