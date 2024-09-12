<?php
// Configurações de conexão
$servername = "localhost";
$username = "root";
$password = "";
$database = "tcc";

// Criar conexão
$conn = new mysqli($servername, $username, $password, $database);

// Verificar a conexão
if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

// Não fechar a conexão aqui
?>
