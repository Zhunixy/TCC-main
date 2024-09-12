<?php

session_start();

include('conexao.php');


if(!isset($_SESSION['logged_in'])){
    header('location: ../checkout.php?message=Porfavor Faça Login/Cadastro para fazer um pedido');
    exit;


}else{





if (isset($_POST['place_order'])) {
    // Verificar se todos os campos estão presentes no array $_POST
    $required_fields = ['name', 'email', 'phone', 'city', 'address'];
    $missing_fields = [];

    foreach ($required_fields as $field) {
        if (empty($_POST[$field])) {
            $missing_fields[] = $field;
        }
    }

    if (!empty($missing_fields)) {
        echo "Os seguintes campos estão faltando: " . implode(', ', $missing_fields);
    } else {
        // Pegar info do usuário e da loja no banco
        $name = $_POST['name'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $city = $_POST['city'];
        $address = $_POST['address'];
        $order_cost = isset($_SESSION['total']) ? $_SESSION['total'] : 0;
        $order_status = "Aguardando Pagamento";
        $user_id = $_SESSION['user_id']; // Isso deve ser dinâmico, dependendo do usuário logado
        $order_date = date('Y-m-d H:i:s');

        // Verificar a conexão com o banco de dados
        if ($conn->connect_error) {
            die("Erro na conexão com o banco de dados: " . $conn->connect_error);
        }

        // Preparar e executar a consulta para inserir o pedido
        $stmt = $conn->prepare("INSERT INTO orders (order_cost, order_status, user_id, user_phone, user_city, user_address, order_date)
                                VALUES (?, ?, ?, ?, ?, ?, ?);");

        if ($stmt === false) {
            die("Erro na preparação da consulta: " . $conn->error);
        }

        $stmt->bind_param('isissss', $order_cost, $order_status, $user_id, $phone, $city, $address, $order_date);

        if ($stmt->execute()) {
            $order_id = $stmt->insert_id;
            header('location: ../pagamento.php?order_status=Pedido feito com sucesso');

            // Inserir os itens do pedido na tabela order_items
            foreach ($_SESSION['cart'] as $item) {
                $product_id = $item['product_id'];
                $product_name = $item['product_name'];
                $product_image = $item['product_image'];
                $product_price = $item['product_price'];
                $product_quantity = $item['product_quantity'];

                $stmt_item = $conn->prepare("INSERT INTO order_items (order_id, product_id, product_name, product_image, product_price, product_quantity, user_id, order_date)
                                             VALUES (?, ?, ?, ?, ?, ?, ?, ?);");

                if ($stmt_item === false) {
                    die("Erro na preparação da consulta para itens do pedido: " . $conn->error);
                }

                $stmt_item->bind_param('issssdii', $order_id, $product_id, $product_name, $product_image, $product_price, $product_quantity, $user_id, $order_date);

                if (!$stmt_item->execute()) {
                    echo "Erro ao inserir item do pedido: " . $stmt_item->error;
                }

                $stmt_item->close();
            }

            // Limpar o carrinho após inserir os itens do pedido
            unset($_SESSION['cart']);

        } else {
            echo "Erro ao realizar o pedido: " . $stmt->error;
        }

        $stmt->close();
        $conn->close();
    }
}



}



?>
