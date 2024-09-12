<?php
include('conexao.php');

$stmt = $conn->prepare("SELECT * FROM products WHERE product_category='videogames' LIMIT 7");
$stmt->execute();
$videogames = $stmt->get_result();

