<?php
session_start();
date_default_timezone_set('America/Sao_Paulo'); // Definindo o fuso horário para Brasília

function calculateTotalOrderPrice($order_details) {
    $total = 0;
    
    if (!empty($order_details)) {
        foreach ($order_details as $product) {
            $total += $product['product_price'] * $product['product_quantity'];
        }
    }
    
    return $total;
}

include('server/conexao.php');

if (isset($_POST['order_details_btn']) && isset($_POST['order_id'])) {
    $order_id = $_POST['order_id'];
    $order_status = $_POST['order_status'];

    $stmt = $conn->prepare("SELECT * FROM order_items WHERE order_id = ?");
    $stmt->bind_param('i', $order_id);
    $stmt->execute();

    $order_details = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

    $total_order_price = calculateTotalOrderPrice($order_details);

    // Definindo variáveis de sessão para uso em pagamento.php
    $_SESSION['total'] = $total_order_price;
    $_SESSION['order_id'] = $order_id;
} else {
    header('location: conta.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Compulins - Início</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="shortcut icon" href="https://static.vecteezy.com/ti/vecteur-libre/p1/5251191-shopping-bag-with-pin-maps-locations-logo-vector-icon-design-illustration-vectoriel.jpg" type="image/x-icon">
    <link rel="stylesheet" href="assets/css/login.css">
    <link rel="stylesheet" href="assets/css/conta.css">
    <link rel="stylesheet" href="assets/css/carrinho.css">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light py-3 bg-light fixed-top">
    <div class="container">
        <img class="logo" src="assets/img/logos/COMPULINS.png" alt="">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse nav-buttons" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="index.php">Início</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="loja.html">Produtos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Blog</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="contato.html">Contato</a>
                </li>
                <li class="nav-item">
                    <a href="carrinho.php"><i class="fa-solid ii fa-cart-shopping"></i></a>
                </li>
                <li class="nav-item">
                    <a href="conta.php"><i class="fa-solid ii fa-user"></i></a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- DETALHES -->
<br>
<br>
<section id="orders" class="orders container my-5 py-3">
    <div class="container mt-5">
        <h2 class="font-weight-bold text-center">Detalhes Do Pedido</h2>
        <hr class="mx-auto">
    </div>

    <div class="orders">
        <table class="mt-5 pt-5 mx-auto">
            <tr>
                <th>Nome do produto</th>
                <th>Preço</th>
                <th>Quantidade</th>
            </tr>
            <?php foreach ($order_details as $row) { ?>
                <tr>
                    <td>
                        <div class="product-info">
                            <img src="assets/img/<?php echo $row['product_image']; ?>" style="object-fit:contain;"/>
                            <div>
                                <p class="mt-3"><?php echo $row['product_name']; ?></p>
                            </div>
                        </div>
                    </td>
                    <td>
                        <span>$<?php echo $row['product_price']; ?></span>
                    </td>
                    <td>
                        <span><?php echo $row['product_quantity']; ?></span>
                    </td>
                </tr>
            <?php } ?>
        </table>

        <div class="cart-total mt-3">
            <table class="">
                <tr>
                    <td>Total</td>
                    <td>$<?php echo $total_order_price; ?></td>
                </tr>
                <tr>
                    <td>Data e Hora Atual em Brasília</td>
                    <td><?php echo date('Y-m-d H:i:s'); ?></td>
                </tr>
            </table>
        </div>

        <?php if ($order_status == "Aguardando Pagamento") { ?>
            <form style="float: right;" method="POST" action="pagamento.php">
        <input type="hidden" name="order_id" value="<?php echo $order_id; ?>">
        <input type="submit" class="btn" value="Pagar Agora" style="background-color:#fb774b; color: white;">
    </form>
        <?php } ?>
    </div>
</section>

<footer class="mt-5 py-5">
    <div class="row container mx-auto pt-5">
        <div class="footer-one col-lg-3 col-md-6 col-sm-12">
            <img src="assets/img/logos/COMPULINS-BRANCA.png" alt="" class="logo">
            <p class="pt-3">Lorem, ipsum dolor sit amet consectetur adipisicing elit.</p>
        </div>
        <div class="footer-one col-lg-3 col-md-6 col-sm-12">
            <h5 class="pb-2">Produtos</h5>
            <ul class="text-uppercase">
                <li><a href="#">Peças</a></li>
                <li><a href="#">Cartuchos</a></li>
                <li><a href="#">Periféricos</a></li>
                <li><a href="#">Video-Games</a></li>
                <li><a href="#">Ferramentas</a></li>
                <li><a href="#">Promoções</a></li>
            </ul>
        </div>

        <div class="footer-one col-lg-3 col-md-6 col-sm-12">
            <h5 class="pb-2">Contate-nos</h5>
            <div>
                <h6 class="text-uppercase">Endereço:</h6>
                <p>Rua Floriano Peixoto, 335, Lins, SP, Brasil</p>
            </div>
            <div>
                <h6 class="text-uppercase">Telefone:</h6>
                <p>(14) 99839-7967</p>
            </div>
            <div>
                <h6 class="text-uppercase">Email:</h6>
                <p>compulins.loja01@hotmail.com</p>
            </div>
        </div>
        <div class="footer-one col-lg-3 col-md-6 col-sm-12">
                <h5 class="pb-2">Colaboradores</h5>
                <div class="row">
                    <style>
                        .colab{
                            width: 60px !important;
                            height: 50px !important;
                            object-fit: contain;
                            background-color: white;
                            border-radius: 0.5rem;
                           
                        }
                    </style>
                    <img src="https://ggscore.com/media/logo/t98849.png?29" alt="" class="img-fluid w-25 h-100 m-2 colab">
                    <img src="https://1000logos.net/wp-content/uploads/2021/05/Intel-logo.png" alt="" class="img-fluid w-25 h-100 m-2 colab">
                    <img src="https://files.tecnoblog.net/wp-content/uploads/2021/10/logotipo_da_empresa_amd.png" alt="" class="img-fluid w-25 h-100 m-2 colab">
                    <img src="https://download.logo.wine/logo/Nvidia/Nvidia-Logo.wine.png" alt="" class="img-fluid w-25 h-100 m-2 colab">
                    <img src="https://turbologo.com/articles/wp-content/uploads/2019/11/Nintendo-logo.png" alt="" class="img-fluid w-25 h-100 m-2 colab">
                </div>
            </div>
        </div>

    <div class="copyright mt-5">
        <div class="row container mx-auto">
            <div class="col-lg-3 col-md-5 col-sm-12 mb-4">
                <img src="assets/img/payment.jpg" alt="">
            </div>
            <div class="col-lg-3 col-md-5 col-sm-12 mb-4 text-nowrap mb-2">
                <a href="#"><i class="fab fa-facebook"></i></a>
                <a href="#"><i class="fab fa-instagram"></i></a>
                <a href="#"><i class="fab fa-twitter"></i></a>
            </div>
        </div>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<script src="https://kit.fontawesome.com/951dd3b656.js" crossorigin="anonymous"></script>
</body>
</html>
