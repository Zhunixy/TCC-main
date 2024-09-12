<?php
include('server/conexao.php');

//Usa a pesquisa de sessão
if (isset($_POST['search'])) {
    $category = $_POST['category'];
    $price = $_POST['price'];
    $stmt = $conn->prepare("SELECT * FROM products WHERE product_category =? AND product_price<=?");
    $stmt->bind_param("si", $category, $price);
    $stmt->execute();
    $products = $stmt->get_result();

    //Retorna os produtos
} else {
    $stmt = $conn->prepare("SELECT * FROM products");
    $stmt->execute();
    $products = $stmt->get_result();
}

?>

<?php include 'layouts/header.php'; ?>
<link rel="stylesheet" href="assets/css/loja.css">

<div class="container pt-5">
    <div class="row">
        <aside class="col-lg-3 col-md-4 col-sm-12" id="search">
            <div class="container py-5">
                <p class="h5">Procurar Produto</p>
                <hr>
            </div>

            <form action="loja.php" method="POST">
                <div class="mb-4">
                    <p class="h6">Categorias</p>
                    <div class="form-check">
                        <input type="radio" name="category" value="videogames" id="category_one"
                            class="form-check-input custom-radio">
                        <label for="category_one" class="form-check-label">Video-Games</label>
                    </div>
                    <div class="form-check">
                        <input type="radio" name="category" value="perifericos" id="category_two"
                            class="form-check-input custom-radio">
                        <label for="category_two" class="form-check-label">Periféricos</label>
                    </div>
                    <div class="form-check">
                        <input type="radio" name="category" value="pecas" id="category_three"
                            class="form-check-input custom-radio">
                        <label for="category_three" class="form-check-label">Peças</label>
                    </div>
                </div>

                <div class="mb-4">
                    <p class="h6">Preço</p>
                    <input type="range" class="form-range btn-range" name="price" value="100" min="100" max="2000"
                        step="100" id="customRange2">
                    <div class="d-flex justify-content-between scroll mt-2">
                        <span id="rangeValue">100</span> $ <!-- Elemento para mostrar o valor do intervalo -->
                    </div>
                </div>

                <div class="d-flex justify-content-center my-3">
                    <input type="submit" name="search" value="Procurar" class="btn">
                    <style>
                        .btn {
                            background-color: #fb774b !important;
                            color: white;
                        }

                        /* Customização dos rádio buttons */
                        .custom-radio:checked {
                            accent-color: #fb774b !important;
                            /* Cor ao selecionar */
                        }

                        .custom-radio {
                            accent-color: #fb774b !important;
                            /* Cor padrão do rádio button */
                        }

                        /* Opção para a alteração de cor dos rádio buttons */
                        .custom-radio:checked+.form-check-label {
                            color: #fb774b;
                            /* Cor da label quando o rádio button está selecionado */
                        }

                        /* Adicionar um estilo adicional se necessário */
                        .custom-radio+.form-check-label {
                            cursor: pointer;

                        }

                        #rangeValue {
                            font-weight: 500;
                            color: black;
                            text-align: center !important;
                            justify-content: center;
                            align-items: center;
                        }
                    </style>

                    <script>
                        document.addEventListener('DOMContentLoaded', function () {
                            const radios = document.querySelectorAll('.custom-radio');
                            radios.forEach(radio => {
                                radio.addEventListener('change', function () {
                                    radios.forEach(r => {
                                        r.parentElement.querySelector('.form-check-label').style.color = '#000000'; // Cor padrão
                                    });
                                    this.parentElement.querySelector('.form-check-label').style.color = '#fb774b'; // Cor ao selecionar
                                });
                            });
                        });

                        document.addEventListener('DOMContentLoaded', function () {
                            const rangeInput = document.getElementById('customRange2');
                            const rangeValue = document.getElementById('rangeValue');

                            // Atualiza o valor inicial
                            rangeValue.textContent = rangeInput.value;

                            // Adiciona um ouvinte de evento para atualizar o valor quando o intervalo mudar
                            rangeInput.addEventListener('input', function () {
                                rangeValue.textContent = this.value;
                            });
                        });
                    </script>
                </div>
            </form>
        </aside>
        <section id="featured" class="col-lg-9 col-md-8 col-sm-12 my-5 py-5">
            <div class="container mt-5 py-5">
                <h3>Nossos Produtos</h3>
                <hr>
                <p>Lorem ipsum dolor sit amet consectetur.</p>
            </div>
            <div class="row mx-auto container">
                <?php
                while ($row = $products->fetch_assoc()) {

                    ?>
                    <!--Produto 1-->
                    <div onclick="window.location.href='produto_unico.html';"
                        class="product text-center col-lg-3 col-md-4 col-sm-12">
                        <img src="assets/img/<?php echo $row['product_image']; ?>" class="img-fluid mb-3"
                            style="object-fit:contain; width: 200px; height: 200px;">
                        <div class="star">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                        <h5 class="p-name"><?php echo $row['product_name']; ?></h5>
                        <h4 class="p-price"><?php echo $row['product_price']; ?></h4>
                        <a href="<?php echo "produto_unico.php?product_id=" . $row['product_id']; ?>"><button
                                class="buy-btn"><i class="fas fa-plus"></i></button></a>
                    </div>
                <?php } ?>
                <!--Produto 2-->

                <!--Produto 3-->

                <!--Produto 4-->

                <!--Produto 5-->

                <!--Produto 6-->

                <!--Produto 7-->

                <!--Produto 8-->

                <!--Produto 9-->

                <!--Produto 10-->

                <!--Produto 11-->

                <!--Produto 12-->

                <!-- Paginação -->
                <nav aria-label="Page navigation example" class="mx-auto">
                    <ul class="pagination mt-5">
                        <li class="page-item"><a class="page-link" href="#">Anterior</a></li>
                        <li class="page-item"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item"><a class="page-link" href="#">Próximo</a></li>
                    </ul>
                </nav>
        </section>
    </div>
</div>


<?php include('layouts/footer.php'); ?>