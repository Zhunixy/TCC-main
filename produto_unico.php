<?php

    include('server/conexao.php');

    if(isset($_GET['product_id'])){
        
        $product_id = $_GET['product_id'];

        $stmt = $conn->prepare("SELECT * FROM products WHERE product_id = ?");
        $stmt->bind_param("i", $product_id);
        $stmt->execute();

        $product = $stmt->get_result();

        //Sem uma id de produto
    }else{
        header('location: index.php');
    }

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Compulins - Produtos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="shortcut icon" href="https://static.vecteezy.com/ti/vecteur-libre/p1/5251191-shopping-bag-with-pin-maps-locations-logo-vector-icon-design-illustration-vectoriel.jpg" type="image/x-icon">
    <link rel="stylesheet" href="assets/css/produto_unico.css">
</head>
<body>

    <!--CRIAÇÃO DA BARRA DE NAVEGAÇÃO-->
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
                <a class="nav-link" href="loja.php">Produtos</a>
              </li>

              <li class="nav-item">
                <a class="nav-link" href="#">Blog</a>
              </li>

              <li class="nav-item">
                <a class="nav-link" href="contato.php">Contato</a>
              </li>

              <li class="nav-item">
                <a href="carrinho.php"><i class="fa-solid ii fa-cart-shopping"></i></a>
            </li>
            <li class="nav-item">
                <a href="conta.php"><i class="fa-solid ii fa-user"></i></a>
            </li>
          </div>
        </div>
      </nav>
<!--Produto isolado-->
<section class="container single-product my-5 pt-5">
    <div class="row mt-5">
        <?php while($row = $product->fetch_assoc()){ ?>
            <div class="col-lg-5 col-md-6 col-sm-12">
                <img src="assets/img/<?php echo $row['product_image']; ?>" id="mainImg" class="img-fluid w-100 pb-1">
                <div class="small-img-group">
                    <div class="small-img-col">
                        <img src="assets/img/<?php echo $row['product_image2']; ?>" class="small-img" style="object-fit: contain;">
                    </div>
                    <div class="small-img-col">
                        <img src="assets/img/<?php echo $row['product_image3']; ?>" class="small-img" style="object-fit: contain;">
                    </div>
                    <div class="small-img-col">
                        <img src="assets/img/<?php echo $row['product_image4']; ?>" class="small-img" style="object-fit: contain;">
                    </div>
                </div>
            </div>
                <style>
                    
                                
                    #mainImg {
                        width: 100%; 
                        height: 450px; 
                        object-fit: contain; 
                        
                    }


                    .small-img-group {
                        display: flex;
                        gap: 5px; 
                    }

                    .small-img {
                        width: 150px; 
                        height: 150px; 
                        object-fit: contain; 
                        cursor: pointer; 
                        
                    }

                </style>

                <div class="col-lg-6 col-md-12 col-12 mt-5 mr-5">
                    <h6><?php echo $row['product_category']; ?></h6>
                    <h3 class="py-4"><?php echo $row['product_name']; ?></h3>
                    <h2>$<?php echo $row['product_price']; ?></h2>
                    <form method="POST" action="carrinho.php">
                    <input type="hidden" name="product_id" value="<?php echo $row['product_id']; ?>"/>
                    <input type="hidden" name="product_image" value="<?php echo $row['product_image']; ?>"/>
                    <input type="hidden" name="product_name" value="<?php echo $row['product_name']; ?>"/>
                    <input type="hidden" name="product_price" value="<?php echo $row['product_price']; ?>"/>
                    <input type="number" name="product_quantity" value="1">
                    <button class="buy-btn" type="submit" name="add_to_cart">Adicionar ao Carrinho</button>
                </form>

                    <h4 class="mt-5 mb-5">Detalhes Do Produto</h4>
                    <span><?php echo $row['product_description']; ?>
                    </span>
                </div>
                <?php } ?>
            </div>     
      </section>

         <!--Relacionados-->
         <section id="related-products" class="my-5 pb-5">
            <div class="container text-center mt-5 py-5">
                <h3>Produtos Relacionados</h3>
                <hr class="hr">
            </div>
            <div class="row mx-auto container-fluid">
                <!--Produto 1-->
                <div class="product text-center col-lg-3 col-md-4 col-sm-12">
                    <img src="assets/img/teste.jpg" class="img-fluid mb-3">
                    <div class="star">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                    <h5 class="p-name">Computadores Lorem1</h5>
                    <h4 class="p-price">$199.9</h4>
                    <button class="buy-btn"><i class="fa-solid fa-plus"></i></button>
                </div>
                <!--Produto 2-->
                <div class="product text-center col-lg-3 col-md-4 col-sm-12">
                    <img src="assets/img/teste.jpg" class="img-fluid mb-3">
                    <div class="star">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                    <h5 class="p-name">Computadores Lorem1</h5>
                    <h4 class="p-price">$199.9</h4>
                    <button class="buy-btn"><i class="fa-solid fa-plus"></i></button>
                </div>
                <!--Produto 3-->
                <div class="product text-center col-lg-3 col-md-4 col-sm-12">
                    <img src="assets/img/teste.jpg" class="img-fluid mb-3">
                    <div class="star">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                    <h5 class="p-name">Computadores Lorem1</h5>
                    <h4 class="p-price">$199.9</h4>
                    <button class="buy-btn"><i class="fa-solid fa-plus"></i></button>
                </div>
                <!--Produto 4-->
                <div class="product text-center col-lg-3 col-md-4 col-sm-12">
                    <img src="assets/img/teste.jpg" class="img-fluid mb-3">
                    <div class="star">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                    <h5 class="p-name">Computadores Lorem1</h5>
                    <h4 class="p-price">$199.9</h4>
                    <button class="buy-btn"><i class="fa-solid fa-plus"></i></button>
                </div>
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
                <img src="assets/img/visa.png"/>
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
        <script src="assets/js/produto_unico.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
        <script src="https://kit.fontawesome.com/951dd3b656.js" crossorigin="anonymous"></script>
    </body>
    </html>