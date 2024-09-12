<?php
// Inicia a sessão para armazenar informações de login
session_start();

// Verifica se o usuário já está logado. Se estiver, redireciona para a página de conta
if(isset($_SESSION['logged_in'])){
    header('Location: conta.php');
    exit;
}

// Inclui o arquivo de conexão com o banco de dados
include('server/conexao.php');

// Verifica se o formulário de login foi enviado
if(isset($_POST['login_btn'])){
    $email = $_POST['email'];        // Obtém o email do formulário
    $password = $_POST['password'];  // Obtém a senha do formulário

    // Prepara a consulta SQL para verificar se o email existe no banco de dados
    $stmt = $conn->prepare("SELECT user_id, user_name, user_email, user_password FROM users WHERE user_email=? LIMIT 1");
    $stmt->bind_param('s', $email);  // Associa o email à consulta

    // Executa a consulta e armazena o resultado
    if($stmt->execute()){
        $stmt->bind_result($user_id, $user_name, $user_email, $user_password);  // Associa as colunas retornadas às variáveis
        $stmt->store_result();  // Armazena o resultado da consulta

        // Verifica se o email foi encontrado (num_rows deve ser 1)
        if($stmt->num_rows() == 1){
            $stmt->fetch();  // Obtém os dados da consulta

            // Verifica se a senha fornecida corresponde ao hash armazenado no banco de dados
            if(password_verify($password, $user_password)){
                // Se a senha estiver correta, armazena as informações do usuário na sessão
                $_SESSION['user_id'] = $user_id;
                $_SESSION['user_name'] = $user_name;
                $_SESSION['user_email'] = $user_email;
                $_SESSION['logged_in'] = true;

                // Redireciona para a página da conta com uma mensagem de sucesso
                header('Location: conta.php?login_success=logado com sucesso');
                exit;
            } else {
                // Se a senha estiver incorreta, redireciona com uma mensagem de erro
                header('Location: login.php?error=Credenciais incorretas');
                exit;
            }
        } else {
            // Se o email não for encontrado, redireciona com uma mensagem de erro
            header('Location: login.php?error=Credenciais incorretas');
            exit;
        }
    } else {
        // Se houver um erro na execução da consulta, redireciona com uma mensagem de erro genérica
        header('Location: login.php?error=Algo deu errado');
        exit;
    }
}
?>

<?php include 'layouts/header.php'; ?>

<link rel="stylesheet" href="assets/css/login.css">

<!-- SEÇÃO DE LOGIN -->
<section class="my-5 py-5">
    <div class="container text-center mt-3 pt-5">
        <h2 class="form-weight-bold">Login</h2>
        <hr class="mx-auto">
    </div>
    <div class="mx-auto container">
        <!-- Formulário de login -->
        <form method="POST" id="login-form" action="login.php">
            <!-- Mensagem de erro (se houver) -->
            <p style="color: red;" class="text-center"><?php if(isset($_GET['error'])){ echo $_GET['error']; } ?></p>

            <!-- Campo de email -->
            <div class="form-group">
                <label>Email</label>
                <input type="text" class="form-control" id="login-email" name="email" placeholder="Email" required>
            </div>

            <!-- Campo de senha -->
            <div class="form-group">
                <label>Senha</label>
                <input type="password" class="form-control" id="login-password" name="password" placeholder="Senha" required>
            </div>

            <!-- Botão de login -->
            <div class="form-group">
                <input type="submit" class="btn" id="login-btn" name="login_btn" value="Logar">
            </div>

            <!-- Link para a página de registro, caso o usuário não tenha uma conta -->
            <div class="form-group">
                <a href="cadastro.php" id="register-url" class="btn">Não possui uma conta? Registre-se</a>
            </div>
        </form>
    </div>
</section>

<?php include 'layouts/footer.php'; ?>
