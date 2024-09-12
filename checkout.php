<?php
session_start();

if(!empty($_SESSION['cart'])) {
    // Carrinho não está vazio, prosseguir com o checkout
} else {
    header('Location: index.php');
    exit;
}
?>

<?php include 'layouts/header.php'; ?>

<link rel="stylesheet" href="assets/css/checkout.css">
  <!--Checkout-->
<section class="my-5 py-5">
    <div class="container text-center mt-3 pt-5">
        <h2 class="form-weight-bold">Finalizar Compra</h2>
        <hr class="mx-auto">
    </div>
    <div class="mx-auto container">
        <form id="checkout-form" method="POST" action="server/pedidos.php">
            <p class="text-center" style="color: red;">
                <?php if(isset($_GET['message'])){ echo $_GET['message']; } ?>
            </p>
            <?php if(isset($_GET['message'])) { ?>
                <div class="text-center">
                    <a class="btn btn-primary" href="login.php">Logar</a>
                </div>
            <?php } else { ?>
                <div class="form-group checkout-small-element">
                    <label>Name</label>
                    <input type="text" class="form-control" id="chekout-name" name="name" placeholder="Nome" required>
                </div>
                <div class="form-group checkout-small-element">
                    <label>Email</label>
                    <input type="text" class="form-control" id="chekout-email" name="email" placeholder="Email" required>
                </div>
                <div class="form-group checkout-small-element">
                    <label>Telefone</label>
                    <input type="tel" class="form-control" id="checkout-phone" name="phone" placeholder="Telefone" required>
                </div>
                <div class="form-group checkout-small-element">
                    <label>Cidade</label>
                    <input type="text" class="form-control" id="checkout-city" name="city" placeholder="Cidade" required>
                </div>
                <div class="form-group checkout-large-element">
                    <label>Endereço</label>
                    <input type="text" class="form-control" id="checkout-address" name="address" placeholder="Endereço" required>
                </div>
                <div class="form-group checkout-btn-container">
                    <p>Quantidade Total: $ <?php echo $_SESSION['total']; ?></p>
                    <input type="submit" class="btn" id="checkout-btn" name="place_order" value="Finalizar Compra">
                </div>
            <?php } ?>
        </form>
    </div>
</section>
            <!--Rodapé-->
            <?php include 'layouts/footer.php';   ?>