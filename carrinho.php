<?php
// Inicia a sessão para armazenar os dados do carrinho e outras informações do usuário
session_start();

// Define o fuso horário para garantir que a data e a hora estejam corretas
date_default_timezone_set('America/Sao_Paulo');

// Verifica se o botão "adicionar ao carrinho" foi clicado
if (isset($_POST['add_to_cart'])) {
    // Verifica se já existe um carrinho na sessão
    if (isset($_SESSION['cart'])) {
        // Obtém todos os IDs dos produtos no carrinho
        $products_array_ids = array_column($_SESSION['cart'], "product_id");
        // Verifica se o produto já está no carrinho
        if (!in_array($_POST['product_id'], $products_array_ids)) {
            // Se o produto não estiver no carrinho, cria um array com os detalhes do produto
            $product_array = array(
                'product_id' => $_POST['product_id'],
                'product_name' => $_POST['product_name'],
                'product_price' => $_POST['product_price'],
                'product_image' => $_POST['product_image'],
                'product_quantity' => $_POST['product_quantity']
            );
            // Adiciona o novo produto ao carrinho
            $_SESSION['cart'][$_POST['product_id']] = $product_array;
        } else {
            // Exibe um alerta se o produto já estiver no carrinho
            echo '<script>alert("Produto já adicionado no carrinho");</script>';
        }
    } else {
        // Se o carrinho ainda não existir, cria o array do produto e inicializa o carrinho
        $product_array = array(
            'product_id' => $_POST['product_id'],
            'product_name' => $_POST['product_name'],
            'product_price' => $_POST['product_price'],
            'product_image' => $_POST['product_image'],
            'product_quantity' => $_POST['product_quantity']
        );
        // Armazena o produto no carrinho na sessão
        $_SESSION['cart'][$_POST['product_id']] = $product_array;
    }

    // Calcula o total do carrinho após a adição do produto
    calculateTotalCart();
}
// Verifica se o botão "remover produto" foi clicado
else if (isset($_POST['remove_product'])) {
    $product_id = $_POST['product_id'];
    // Percorre os produtos no carrinho e remove o produto correspondente
    foreach ($_SESSION['cart'] as $key => $product) {
        if ($product['product_id'] == $product_id) {
            unset($_SESSION['cart'][$key]); // Remove o produto do carrinho
            $_SESSION['cart'] = array_values($_SESSION['cart']); // Reindexa o array do carrinho
            break;
        }
    }

    // Calcula o total do carrinho após a remoção do produto
    calculateTotalCart();
}
// Verifica se o botão "editar quantidade" foi clicado
else if (isset($_POST['edit_quantity'])) {
    $product_id = $_POST['product_id'];
    $product_quantity = $_POST['product_quantity'];
    // Percorre os produtos no carrinho para atualizar a quantidade
    foreach ($_SESSION['cart'] as $key => &$product) {
        if ($product['product_id'] == $product_id) {
            $product['product_quantity'] = $product_quantity; // Atualiza a quantidade do produto
            break;
        }
    }

    // Calcula o total do carrinho após a atualização da quantidade
    calculateTotalCart();
}

// Função para calcular o valor total do carrinho
function calculateTotalCart() {
    $total = 0;

    // Verifica se o carrinho não está vazio e soma o total dos produtos
    if (!empty($_SESSION['cart'])) {
        foreach ($_SESSION['cart'] as $product) {
            $total += $product['product_price'] * $product['product_quantity'];
        }
    }

    // Armazena o total do carrinho na sessão
    $_SESSION['total'] = $total;
}
?>

<?php include 'layouts/header.php'; ?>
<link rel="stylesheet" href="assets/css/carrinho.css">

<!-- Seção do carrinho de compras -->
<section class="cart container my-5 py-5">
    <div class="container mt-5">
        <h2 class="font-weight-bolde">Seu Carrinho</h2>
        <hr>
    </div>

    <!-- Tabela que exibe os produtos no carrinho -->
    <table class="mt-5 pt-5">
        <tr>
            <th>Produto</th>
            <th>Quantidade</th>
            <th>Sub-Total</th>
            <th>Ação</th>
        </tr>
        <?php
        // Verifica se há produtos no carrinho e os exibe na tabela
        if(isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
            foreach($_SESSION['cart'] as $key => $value) {
        ?>
        <tr>
            <td>
                <div class="product-info">
                    <!-- Exibe a imagem, nome e preço do produto -->
                    <img src="assets/img/<?php echo $value['product_image']; ?>" alt="<?php echo $value['product_name']; ?>" style="object-fit:contain;">
                    <div>
                        <p><?php echo $value['product_name']; ?></p>
                        <small><span>$</span><?php echo $value['product_price']; ?></small>
                        <br>
                    </div>
                </div>
            </td>
            <td>
                <!-- Formulário para editar a quantidade de um produto -->
                <form method="POST" action="carrinho.php">
                    <input type="hidden" name="product_id" value="<?php echo $value['product_id']; ?>"/>
                    <input type="number" name="product_quantity" value="<?php echo $value['product_quantity']; ?>"/>
                    <input type="submit" class="edit-btn" name="edit_quantity" value="Editar">
                </form>
            </td>
            <td>
                <!-- Exibe o subtotal de cada produto -->
                <span>$</span>
                <span class="product-price"><?php echo $value['product_price'] * $value['product_quantity']; ?></span>
            </td>
            <td>
                <!-- Formulário para remover o produto do carrinho -->
                <form action="carrinho.php" method="POST">
                    <input type="hidden" name="product_id" value="<?php echo $value['product_id']; ?>">
                    <input type="submit" name="remove_product" class="remove-btn" value="Remover">
                </form>
            </td>
        </tr>
        <?php
            }
        }
        ?>
    </table>

    <!-- Exibe o total do carrinho -->
    <div class="cart-total">
        <table>
            <tr>
                <td>Total</td>
                <td>$ <?php echo isset($_SESSION['total']) ? $_SESSION['total'] : '0'; ?> </td>
            </tr>
        </table>
    </div>

    <!-- Botão para finalizar a compra -->
    <div class="checkout-container">
        <form action="checkout.php" method="POST">
            <input type="submit" class="btn checkout-btn mt-3" value="Finalizar Compra" name="checkout">
        </form>
    </div>
</section>

<?php include 'layouts/footer.php'; ?>
