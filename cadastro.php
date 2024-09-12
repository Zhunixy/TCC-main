<?php

session_start();

include('server/conexao.php');

// Redireciona para a conta se o usuário já estiver logado
if(isset($_SESSION['logged_in'])){
    header('Location: conta.php');
    exit;
}

// Verifica se o formulário de registro foi enviado
if(isset($_POST['register'])){

    // Obtém os dados do formulário
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirmPassword'];

    // Verifica se as senhas coincidem
    if($password !== $confirmPassword){
        header('Location: cadastro.php?error=As senhas não são iguais!');
        exit;
    }

    // Verifica se a senha tem pelo menos 6 caracteres
    else if(strlen($password) < 6){
        header('Location: cadastro.php?error=Senha deve ter no mínimo 6 caracteres!');
        exit;
    } else {
        // Prepara a consulta para verificar se o e-mail já está cadastrado
        $stmt1 = $conn->prepare("SELECT count(*) FROM users WHERE user_email = ?");
        $stmt1->bind_param('s', $email);
        $stmt1->execute();
        $stmt1->bind_result($num_rows);
        $stmt1->fetch();
        $stmt1->close();

        // Verifica se o e-mail já está cadastrado
        if($num_rows != 0){
            header('Location: cadastro.php?error=Email já cadastrado!');
            exit;
        } else {
            // Prepara a consulta para inserir o novo usuário
            $stmt = $conn->prepare("INSERT INTO users (user_name, user_email, user_password) VALUES (?, ?, ?)");
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT); // Usa hash seguro para a senha
            $stmt->bind_param("sss", $name, $email, $hashedPassword);

            // Executa a inserção e verifica se foi bem-sucedida
            if($stmt->execute()){
                $user_id = $stmt->insert_id;

                $_SESSION['user_id'] = $user_id;
                $_SESSION['user_email'] = $email;
                $_SESSION['user_name'] = $name;
                $_SESSION['logged_in'] = true;
                header('Location: conta.php?register_success=Você se registrou com sucesso!');
                exit;
            } else {
                header('Location: cadastro.php?error=Erro ao cadastrar!');
                exit;
            }
            
        }
    }
}
?>

<?php include 'layouts/header.php'; ?>

<link rel="stylesheet" href="assets/css/cadastro.css">

<!--Registro-->
<section class="my-5 py-5">
    <div class="container text-center mt-3 pt-5">
        <h2 class="form-weight-bold">Registro</h2>
        <hr class="mx-auto">
    </div>
    <div class="mx-auto container">
        <form id="register-form" method="POST" action="cadastro.php">
        <p style="color: red;"><?php if(isset($_GET['error'])){ echo $_GET['error']; } ?></p>   
        <div class="form-group">
                <label>Nome</label>
                <input type="text" class="form-control" id="register-name" name="name" placeholder="Nome" required>
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="email" class="form-control" id="register-email" name="email" placeholder="Email" required>
            </div>
            <div class="form-group">
                <label>Senha</label>
                <input type="password" class="form-control" id="register-password" name="password" placeholder="Senha" required>
            </div>
            <div class="form-group">
                <label>Confirme a Senha</label>
                <input type="password" class="form-control" id="register-confirm-password" name="confirmPassword" placeholder="Confirme a Senha" required>
            </div>
            
            <div class="form-group">
                <input type="submit" class="btn" id="register-btn" name="register" value="Registrar">
            </div>
            <div class="form-group">
                <a href="login.php" id="login-url" class="btn">Já possui uma conta? Faça Login</a>
            </div>
        </form>
    </div>
</section>

<?php include 'layouts/footer.php';   ?>