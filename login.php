<?php
session_start();

// Inclui o arquivo de conexão com o banco de dados
include('conexao.php');

// Verifica se o formulário foi submetido
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    // Busca o usuário no banco de dados pelo e-mail
    $sql = "SELECT * FROM usuario WHERE email = ?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $resultado = $stmt->get_result();

    // Verifica se o usuário foi encontrado
    if ($resultado->num_rows > 0) {
        $usuario = $resultado->fetch_assoc();

        // Verifica se a senha está correta
        if (password_verify($senha, $usuario['senha'])) {
            // Senha correta, inicia a sessão e redireciona para o painel logado
            $_SESSION['usuario'] = $usuario['nome'];
            header('Location: painel_logado.php');
            exit;
        } else {
            // Senha incorreta, exibe uma mensagem de erro
            $erro = "senha incorreta. tente novamente.";
        }
    } else {
        // Usuário não encontrado, exibe uma mensagem de erro
        $erro = "usuário não encontrado. <br><br> cadastre-se";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="assets/css/pages/index/index.css">
</head>

<body>

    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <main class="main-login">

            <div class="box-login">
                <h1>Login</h1>

                <?php if (isset($erro)) echo "<p style='color: red;'>$erro</p>"; ?>

                <input class="box-input-login" name="email" id="email" type="text" placeholder="E-mail" required>

                <input class="box-input-login" name="senha" id="senha" type="password" placeholder="Senha" required>

                <button class="btn-login" type="submit">Entrar</button><br>

                <div style="display: flex; justify-content: space-between; font-size: 1.09rem;">

                    <a style="text-decoration: none; color: var(--primary-3);" href="senha_esquecida/recuperar_senha.php">Esqueceu a senha</a>

                    <a style="text-decoration: none; color: var(--primary-3);" href="cadastro.php">Cadastrar-se</a>

                </div>
            </div>

        </main>
    </form>

</body>

</html>
