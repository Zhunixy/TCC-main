<?php
session_start();

if (!isset($_SESSION['total']) || !isset($_SESSION['order_id'])) {
    // Se as informações necessárias não estiverem disponíveis, redirecione para outra página
    header('location: carrinho.php');
    exit;
}

// Recuperando as informações da sessão
$total = $_SESSION['total'];
$order_id = $_SESSION['order_id'];

?>

<?php include('layouts/header.php'); ?>

      <!--PAGAR-->
      <section class="my-5 py-5">
    <div class="container text-center mt-3 pt-5">
        <h2 class="form-weight-bold">Pagamento</h2>
        <hr class="mx-auto">
    </div>
    <div class="mx-auto container text-center">
         <p><?php if(isset($_GET['order_status'])){ echo $_GET['order_status']; }?></p>
        <p>Total a Pagar: $<?php if(isset($_SESSION['total'])){ echo $_SESSION['total'];} ?></p>
        <?php if(isset( $_SESSION['total']) && $_SESSION['total'] != 0){  ?>

        <input type="submit"  class="btn btn-dark" value="Pagar Agora">

        <?php } else { ?>
            <p>Você não adicionou nenhum produto</p>

        <?php } ?>

        <?php if(isset( $_GET['order_status']) && $_GET['order_status'] == "Aguardando Pagamento"){  ?>

        <input type="submit"  class="btn btn-dark" value="Pagar Agora">

        <?php } ?>

    </div>
</section>

<?php include('layouts/footer.php');   ?>