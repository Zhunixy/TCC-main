<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Compulins - Início</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="shortcut icon" href="assets/img/logos/FAVICOM.png" sizes="16x16" type="image/x-icon">
    <link rel="stylesheet" href="assets/css/style.css">
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
              <li class="nav-item"><a class="nav-link" href="index.php">Início</a></li>
              <li class="nav-item"><a class="nav-link" href="loja.php">Produtos</a></li>
              <li class="nav-item"><a class="nav-link" href="#">Blog</a></li>
              <li class="nav-item"><a class="nav-link" href="contato.php">Contato</a></li>
              <li class="nav-item"><a href="carrinho.php"><i class="icones fa-solid ii fa-cart-shopping"></i></a></li>
              <li class="nav-item"><a href="conta.php"><i class="icones fa-solid ii fa-user"></i></a></li>
            </ul>
          </div>
        </div>
    </nav>
    
    <section id="home" style="background-image:url('https://img.freepik.com/fotos-gratis/carrinho-de-compras-e-laptop-com-espaco-de-copia_23-2148312995.jpg?w=1380&t=st=1725299579~exp=1725300179~hmac=79c10d527bacf680499361637e3ebfff2060d4424d9e71b0cbfdd74d49a86d0a');">
        <div class="container">
            <h5>Novos Produtos</h5>
            <h1><span>Melhores Preços</span> Desta Temporada</h1>
            <p>Compulins Oferece os melhores preços do mercado</p>
            <button>Compre Agora</button>
        </div>
    </section>

<style>
    .brand-img {
    max-width: 100px; /* Define a largura máxima para as imagens */
    max-height: 100px; /* Define a altura máxima para as imagens */
    object-fit: contain; /* Garante que a imagem se ajuste dentro do contêiner mantendo a proporção */
}

#brand .col-lg-3, #brand .col-md-6, #brand .col-sm-12 {
    height: 150px; /* Define a altura dos contêineres das imagens */
}

</style>
    <section id="brand" class="container mt-5">
    <div class="row ">
        <div class="col-lg-3 col-md-6 col-sm-12 d-flex justify-content-center align-items-center">
        <img class="brand-img img-fluid" src="assets/img/logos/AMD_Logo.png" alt="AMD Logo">
        </div>
        <div class="col-lg-3 col-md-6 col-sm-12 d-flex justify-content-center align-items-center">
            <img class="brand-img img-fluid" src="assets/img/logos/Intel_logo.png" alt="Intel Logo">
        </div>
        <div class="col-lg-3 col-md-6 col-sm-12 d-flex justify-content-center align-items-center">
            <img class="brand-img img-fluid" src="assets/img/logos/Nintendo-logo.png" alt="Nintendo Logo">
        </div>
        <div class="col-lg-3 col-md-6 col-sm-12 d-flex justify-content-center align-items-center">
            <img class="brand-img img-fluid" src="assets/img/logos/redragon-logo.png" alt="Redragon Logo">
        </div>
    </div>
</section>

      <!--CRIAÇÃO DOS NOVOS PRODUTOS-->
      <section id="new" class="mt-5 w-100">
        <div class="row p-0 m-0">
            <!--Produto 1-->
            <div class="one col-lg-4 col-md-12 col-sm-12 p-0">
                <img src="https://c.pxhere.com/photos/1f/06/video_games_xbox_one_pad_play_technology_video_joystick-663324.jpg!d" class="img-fluid" style="height:300px; object-fit:cover">
                <div class="details">
                    <h2>Video Games</h2>
                    <button>Comprar<i class="fa-solid fa-plus"></i></button>
                </div>
            </div>
            <!--Produto 2-->
            <div class="one col-lg-4 col-md-12 col-sm-12 p-0">
                <img src="https://c.pxhere.com/photos/38/28/computer_fan_wires_parts_inside_technology_design_electric-864834.jpg!d" class="img-fluid" style="height:300px; object-fit:cover">
                <div class="details">
                    <h2>Peças PC</h2>
                    <button>Comprar<i class="fa-solid fa-plus"></i></button>
                </div>
            </div>
            <!--Produto 3-->
            <div class="one col-lg-4 col-md-12 col-sm-12 p-0">
                <img src="assets/img/especial/3.png" class="img-fluid" style="height:300px; object-fit:cover">
                <div class="details">
                    <h2>Periféricos</h2>
                    <button>Comprar<i class="fa-solid fa-plus"></i></button>
                </div>
            </div>
        </div>
      </section>

<!--Video-Games-->
<section id="video" class="my-5 pb-5">
    <div class="container text-center mt-5 py-5">
        <h3>Nossos Video-Games</h3>
        <hr class="hr">
        <p>Confira nossos novos lançamentos</p>
    </div>
    <div class="row mx-auto container-fluid">
        <?php include('server/get_videogames.php'); ?>
        <?php while($row = $videogames->fetch_assoc()){ ?>
            <!--Produto 1-->
            <div class="product text-center col-lg-3 col-md-4 col-sm-12 mb-4">
                <img src="assets/img/<?php echo $row['product_image']; ?>" class="img-fluid produto-imagem-videogame mb-3" style="width: 500px; height: 200px; object-fit: contain">
                <div class="star">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                </div>
                <h5 class="p-name"><?php echo $row['product_name']; ?></h5>
                <h4 class="p-price">$ <?php echo $row['product_price']; ?></h4>
                <a href="<?php echo "produto_unico.php?product_id=" . $row['product_id']; ?>"><button class="buy-btn"><i class="fa-solid fa-plus"></i></button></a>
            </div>
        <?php } ?>
    </div>
</section>
<!--Banner-->
<section id="banner" class="img-fluid img">
    <div class="container my-5 py-5">
        <h4>Novidades Lorem</h4>
        <h1>Mouse Teclado <br> Para 30% Desconto</h1>
        <button class="text-uppercase">Compre Agora</button>
    </div>
</section>
<!--Periféricos-->
<section id="perifericos" class="my-5">
    <div class="container text-center mt-5 py-5">
        <h3>Periféricos Gamers</h3>
        <hr class="hr">
        <p>Confira nossos novos periféricos</p>
    </div>
    <div class="row mx-auto container-fluid">
        <?php include('server/get_perifericos.php'); ?>
        <?php while($row = $perifericos->fetch_assoc()){ ?>
            <!--Produto 1-->
            <div class="product text-center col-lg-3 col-md-4 col-sm-12">
                <img src="assets/img/<?php echo $row['product_image']; ?>" class="produto-imagem-periferico img-fluid mb-3" style="width: 100px; height: 200px; object-fit: contain ">
                <div class="star">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                </div>
                <h5 class="p-name"><?php echo $row['product_name']; ?></h5>
                <h4 class="p-price">$ <?php echo $row['product_price']; ?></h4>
                <a href="<?php echo "produto_unico.php?product_id=" . $row['product_id']; ?>"><button class="buy-btn"><i class="fa-solid fa-plus"></i></button></a>
            </div>
        <?php } ?>
    </div>
</section>
<!--Peças PC-->
<section id="pecas" class="my-5">
    <div class="container text-center mt-5 py-5">
        <h3>Peças para Computadores</h3>
        <hr class="hr">
        <p>Confira nossas peças</p>
    </div>
    <div class="row mx-auto container-fluid">
        <?php include('server/get_pecas.php'); ?>
        <?php while($row = $pecas->fetch_assoc()){ ?>
            <!--Produto 1-->
            <div class="product text-center col-lg-3 col-md-4 col-sm-12">
                <img src="assets/img/<?php echo $row['product_image']; ?>" class="produto-imagem-pecas img-fluid mb-3" style="width: 500px; height: 200px; object-fit: contain">
                <div class="star">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                </div>
                <h5 class="p-name"><?php echo $row['product_name']; ?></h5>
                <h4 class="p-price">$ <?php echo $row['product_price']; ?></h4>
                <a href="<?php echo "produto_unico.php?product_id=" . $row['product_id']; ?>"><button class="buy-btn"><i class="fa-solid fa-plus"></i></button></a>
            </div>
        <?php } ?>
    </div>
</section>

       <!--Rodapé-->
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
                <img src="https://cdn-icons-png.flaticon.com/512/59/59043.png" style="width: 40px; height: 40px; background-color: white; padding:10px; border-radius:0.5rem; cursor:pointer;"/>
            </div>
            <div class="col-lg-3 col-md-5 col-sm-12 mb-4"> 
                <p>Compulins & 3-DS @ 2024 Todos Os Direitos Reservados</p>
            </div>
            <div class="col-lg-3 col-md-5 col-sm-12 mb-4 text-nowrap mb-2">
                <a href="#"><i class="fab fa-facebook"></i></a>
                <a href="#"><i class="fab fa-instagram"></i></a>
                <a href="#"><i class="fab fa-twitter"></i></a> </div>
            </div>
            </div>
        </div>
      </footer>

      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>    <script src="https://kit.fontawesome.com/951dd3b656.js" crossorigin="anonymous"></script>
</body>
</html>