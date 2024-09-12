<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Produto</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- FontAwesome CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>
<body>
    <div class="container py-4">
        <button type="button" class="btn btn-primary mb-4" data-bs-toggle="modal" data-bs-target="#exampleModal">Cadastrar Novo Produto</button>
        <a href="index.php"><button type="button" class="btn btn-success mb-4">Voltar</button></a>
        <!-- Modal de Cadastro de Produto -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Cadastrar Novo Produto</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="?action=create" method="post" enctype="multipart/form-data">
                            <!-- Campos de entrada -->
                            <label for="product_name">Nome do Produto:</label>
                            <input type="text" name="product_name" class="form-control" required><br>

                            <label for="product_category">Categoria:</label>
                            <select name="product_category" class="form-select" required>
                                <option value="videogames">Videogames</option>
                                <option value="perifericos">Periféricos</option>
                                <option value="pecas">Peças</option>
                            </select><br>

                            <label for="product_description">Descrição:</label>
                            <textarea name="product_description" class="form-control" required></textarea><br>

                            <label for="product_price">Preço:</label>
                            <input type="number" step="0.01" name="product_price" class="form-control" required><br>

                            <label for="product_special_offer">Oferta Especial:</label>
                            <input type="number" name="product_special_offer" class="form-control"><br>

                            <label for="product_color">Cor:</label>
                            <input type="text" name="product_color" class="form-control"><br>

                            <label for="product_image">Imagem Principal:</label>
                            <input type="file" name="product_image" class="form-control"><br>

                            <label for="product_image2">Imagem Secundária 1:</label>
                            <input type="file" name="product_image2" class="form-control"><br>

                            <label for="product_image3">Imagem Secundária 2:</label>
                            <input type="file" name="product_image3" class="form-control"><br>

                            <label for="product_image4">Imagem Secundária 3:</label>
                            <input type="file" name="product_image4" class="form-control"><br>

                            <input type="submit" value="Cadastrar Produto" class="btn btn-primary">
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tabela de Produtos -->
        <?php 
        include('./server/conexao.php');
        mostrarProdutos($conn); ?>
    </div>

    <!-- Bootstrap JS e Scripts Necessários -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
</body>
</html>

<?php
include('./server/conexao.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_GET['action'])) {
    if ($_GET['action'] == 'create') {
        // Código para criar produto (igual ao seu código anterior)
    } elseif ($_GET['action'] == 'delete') {
        $productId = $_POST['product_id'];
        $sql = "DELETE FROM products WHERE product_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('i', $productId);

        if ($stmt->execute()) {
            echo '<div class="alert alert-success">Produto excluído com sucesso!</div>';
        } else {
            echo '<div class="alert alert-danger">Erro ao excluir o produto: ' . $stmt->error . '</div>';
        }

        $stmt->close();
    }
    // Código para atualizar produto (será necessário criar um modal de edição)
}

function mostrarProdutos($conn) {
    $sql = "SELECT product_id, product_name, product_category, product_description, product_price, product_image, product_image2, product_image3, product_image4 FROM products";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        echo '<table class="table">';
        echo '<thead><tr><th>ID</th><th>Nome</th><th>Categoria</th><th>Descrição</th><th>Preço</th><th>Ações</th></tr></thead><tbody>';
        while ($row = $result->fetch_assoc()) {
            echo '<tr>';
            echo '<td>' . $row['product_id'] . '</td>';
            echo '<td>' . $row['product_name'] . '</td>';
            echo '<td>' . $row['product_category'] . '</td>';
            echo '<td>' . $row['product_description'] . '</td>';
            echo '<td>' . $row['product_price'] . '</td>';
            echo '<td>';
            echo '<button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#viewModal' . $row['product_id'] . '"><i class="fas fa-eye"></i></button> ';
            echo '<button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editModal' . $row['product_id'] . '"><i class="fas fa-edit"></i></button> ';
            echo '<form action="?action=delete" method="post" style="display:inline-block;">';
            echo '<input type="hidden" name="product_id" value="' . $row['product_id'] . '">';
            echo '<button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></button>';
            echo '</form>';
            echo '</td>';
            echo '</tr>';
            // Modal de Visualização (para cada produto)
            echo '<div class="modal fade" id="viewModal' . $row['product_id'] . '" tabindex="-1" aria-labelledby="viewModalLabel' . $row['product_id'] . '" aria-hidden="true">';
            echo '<div class="modal-dialog modal-lg">';
            echo '<div class="modal-content">';
            echo '<div class="modal-header">';
            echo '<h5 class="modal-title" id="viewModalLabel' . $row['product_id'] . '">Visualizar Produto</h5>';
            echo '<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>';
            echo '</div>';
            echo '<div class="modal-body">';
            echo '<h5>Nome: ' . $row['product_name'] . '</h5>';
            echo '<p>Categoria: ' . $row['product_category'] . '</p>';
            echo '<p>Descrição: ' . $row['product_description'] . '</p>';
            echo '<p>Preço: R$ ' . $row['product_price'] . '</p>';
            echo '<div class="row">';
            if (!empty($row['product_image'])) {
                echo '<div class="col-md-3"><img src="./assets/img/' . $row['product_image'] . '" class="img-fluid" alt="Imagem Principal"></div>';
            }
            if (!empty($row['product_image2'])) {
                echo '<div class="col-md-3"><img src="./assets/img/' . $row['product_image2'] . '" class="img-fluid" alt="Imagem Secundária 1"></div>';
            }
            if (!empty($row['product_image3'])) {
                echo '<div class="col-md-3"><img src="./assets/img/' . $row['product_image3'] . '" class="img-fluid" alt="Imagem Secundária 2"></div>';
            }
            if (!empty($row['product_image4'])) {
                echo '<div class="col-md-3"><img src="./assets/img/' . $row['product_image4'] . '" class="img-fluid" alt="Imagem Secundária 3"></div>';
            }
            echo '</div>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
            // Modal de Edição (para cada produto)
            echo '<div class="modal fade" id="editModal' . $row['product_id'] . '" tabindex="-1" aria-labelledby="editModalLabel' . $row['product_id'] . '" aria-hidden="true">';
            echo '<div class="modal-dialog">';
            echo '<div class="modal-content">';
            echo '<div class="modal-header">';
            echo '<h5 class="modal-title" id="editModalLabel' . $row['product_id'] . '">Editar Produto</h5>';
            echo '<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>';
            echo '</div>';
            echo '<div class="modal-body">';
            echo '<form action="?action=edit" method="post" enctype="multipart/form-data">';
            echo '<input type="hidden" name="product_id" value="' . $row['product_id'] . '">';
            echo '<label for="edit_product_name">Nome do Produto:</label>';
            echo '<input type="text" name="product_name" class="form-control" value="' . $row['product_name'] . '" required><br>';
            echo '<label for="edit_product_category">Categoria:</label>';
            echo '<select name="product_category" class="form-select" required>';
            echo '<option value="videogames"' . ($row['product_category'] == 'videogames' ? ' selected' : '') . '>Videogames</option>';
            echo '<option value="perifericos"' . ($row['product_category'] == 'perifericos' ? ' selected' : '') . '>Periféricos</option>';
            echo '<option value="pecas"' . ($row['product_category'] == 'pecas' ? ' selected' : '') . '>Peças</option>';
            echo '</select><br>';
            echo '<label for="edit_product_description">Descrição:</label>';
            echo '<textarea name="product_description" class="form-control" required>' . $row['product_description'] . '</textarea><br>';
            echo '<label for="edit_product_price">Preço:</label>';
            echo '<input type="number" step="0.01" name="product_price" class="form-control" value="' . $row['product_price'] . '" required><br>';
            echo '<input type="submit" value="Salvar Alterações" class="btn btn-primary">';
            echo '</form>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
        }
        echo '</tbody></table>';
    } else {
        echo '<div class="alert alert-info">Nenhum produto cadastrado.</div>';
    }
}
?>