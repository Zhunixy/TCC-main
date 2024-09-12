<?php
// Inicia a sessão para manter o usuário logado e armazenar informações importantes
session_start();

// Define o fuso horário para garantir que todas as funções relacionadas a data e hora estejam corretas
date_default_timezone_set('America/Sao_Paulo');

// Inclui a conexão com o banco de dados
include('server/conexao.php');

// Verifica se o usuário está logado. Caso contrário, redireciona para a página de login
if(!isset($_SESSION['logged_in'])){
    header('Location: login.php');
    exit;
}

// Verifica se o usuário clicou no botão de logout
if(isset($_GET['logout'])){
    // Se o usuário estiver logado, encerra a sessão e redireciona para a página de login
    if(isset($_SESSION['logged_in'])){
        unset($_SESSION['logged_in']);
        unset($_SESSION['user_email']);
        unset($_SESSION['user_name']);
        header('Location: login.php');
        exit; 
    }
}

// Verifica se o usuário enviou o formulário para alterar a senha
if(isset($_POST['change_password'])){
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirmPassword'];
    $user_email = $_SESSION['user_email'];

    // Valida se as senhas coincidem
    if($password !== $confirmPassword){
        header('Location: conta.php?error=Senhas não coincidem');
        exit;
    // Verifica se a senha tem pelo menos 6 caracteres
    } else if(strlen($password) < 6) {
        header('Location: conta.php?error=Senha deve ter no mínimo 6 caracteres');
        exit;
    } else {
        // Se as validações forem bem-sucedidas, criptografa a nova senha
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        // Prepara a consulta SQL para atualizar a senha no banco de dados
        $stmt = $conn->prepare("UPDATE users SET user_password=? WHERE user_email=?");
        $stmt->bind_param('ss', $hashedPassword, $user_email);

        // Executa a consulta e redireciona com uma mensagem de sucesso ou erro
        if($stmt->execute()){
            header('Location: conta.php?success=Senha alterada com sucesso');
            exit;
        } else {
            header('Location: conta.php?error=Erro ao alterar senha');
            exit;
        }
    }
}

// Verifica se o usuário está logado para exibir os pedidos
if(isset($_SESSION['logged_in'])){
    // Obtém o ID do usuário da sessão
    $user_id = $_SESSION['user_id'];

    // Prepara uma consulta SQL para buscar os pedidos do usuário
    $stmt = $conn->prepare("SELECT * FROM orders WHERE user_id=?");
    $stmt->bind_param('i', $user_id);

    // Executa a consulta e armazena os resultados
    $stmt->execute();
    $orders = $stmt->get_result();
}

?>

<?php include('layouts/header.php');  ?>

<link rel="stylesheet" href="assets/css/conta.css">

<!-- SEÇÃO DA CONTA -->
<section class="my-5 py-5">
    <div class="row container mx-auto">
        <div class="text-center mt-3 pt-5 col-lg col-md-12 col-sm-12">
            <!-- Mensagens de sucesso na página de conta -->
            <p class="text-center" style="color: green;"><?php if(isset($_GET['register_success'])){ echo $_GET['register_success']; } ?></p>
            <p class="text-center" style="color: green;"><?php if(isset($_GET['login_success'])){ echo $_GET['login_success']; } ?></p>  
            
            <!-- Informações da conta do usuário -->
            <h3 class="font-weight-bold">Informações Da Conta</h3>
            <hr class="mx-auto">
            <div class="account-info">
                <p>Nome: <span><?php if(isset($_SESSION['user_name'])){ echo $_SESSION['user_name']; } ?></span></p>
                <p>Email: <span><?php if(isset($_SESSION['user_email'])){ echo $_SESSION['user_email']; } ?></span></p>
                <p><a id="orders-btn" href="#orders">Seus Pedidos</a></p>
                <p><a id="logout-btn" href="conta.php?logout=1">Sair</a></p>
            </div>
        </div>

        <!-- Formulário para mudar a senha -->
        <div class="col-lg-6 col-md-12 col-sm-12">
            <form action="conta.php" method="POST" id="account-form">
                <!-- Mensagens de erro e sucesso -->
                <p class="text-center" style="color: red;"><?php if(isset($_GET['error'])){ echo $_GET['error']; } ?></p>
                <p class="text-center" style="color: green;"><?php if(isset($_GET['success'])){ echo $_GET['success']; } ?></p>
                
                <!-- Título e formulário de alteração de senha -->
                <h3>Mudar Senha</h3>
                <hr class="mx-auto">
                <div class="form-group">
                    <label>Senha</label>
                    <input type="password" class="form-control" id="account-password" name="password" placeholder="Senha" required>
                </div>
                <div class="form-group">
                    <label>Confirme sua Senha</label>
                    <input type="password" class="form-control" id="account-password-confirm" name="confirmPassword" placeholder="Confirmar Senha" required>
                </div>
                <div class="form-group">
                    <input type="submit" value="Mudar Senha" name="change_password" class="btn" id="change-pass-btn">
                </div>
            </form>
        </div>
    </div>
</section>

<!-- SEÇÃO DOS PEDIDOS -->
<section id="orders" class="orders container my-5 py-3">
    <div class="container mt-2">
        <h2 class="font-weight-bold text-center">Seus Pedidos</h2>
        <hr class="mx-auto">
    </div>

    <div class="orders">
        <!-- Tabela que exibe os pedidos do usuário -->
        <table class="mt-5 pt-5">
            <tr>
                <th>Id do pedido</th>
                <th>Custo do pedido</th>
                <th>Status do pedido</th>
                <th>Data do pedido</th>
                <th>Detalhes do pedido</th>
            </tr>

            <!-- Loop pelos pedidos e exibição das informações -->
            <?php while($row = $orders->fetch_assoc()){  ?>
                <tr>
                    <td>
                        <div class="product-info">
                            <!-- Pode-se adicionar outras informações do produto aqui -->
                        </div>
                        <span><?php echo $row['order_id']; ?> </span>
                    </td>
                    <td>
                        <span><?php echo $row['order_cost']; ?> </span>
                    </td>
                    <td>
                        <span><?php echo $row['order_status']; ?> </span>
                    </td>
                    <td>
                        <span><?php echo $row['order_date']; ?> </span>
                    </td>

                    <td>
                        <!-- Formulário para visualizar os detalhes do pedido -->
                        <form method="POST" action="detalhes_pedidos.php">
                            <input type="hidden" value="<?php echo $row['order_status']; ?>" name="order_status"/>
                            <input type="hidden" value="<?php echo $row['order_id'];?>" name="order_id">    
                            <input type="submit" name="order_details_btn" style="background-color: #fb774b; color: #fff;" class="btn order-details-btn" value="Detalhes">
                        </form>
                    </td>
                </tr>
            <?php } ?>
        </table>
    </div>
</section>

<?php include('layouts/footer.php');  ?>
