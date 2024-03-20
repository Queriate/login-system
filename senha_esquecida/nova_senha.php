<?php
session_start();
include('../conexao.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nova_senha = htmlspecialchars($_POST['nova_senha']);
    $conf_nova_senha = htmlspecialchars($_POST['conf_nova_senha']);

    // Verificar se as senhas coincidem
    if ($nova_senha === $conf_nova_senha) {
        // Hash da nova senha
        $hashnova_senha = password_hash($nova_senha, PASSWORD_DEFAULT);
        
        // Atualizar a senha no banco de dados para o usuário logado
        $email = $_SESSION['email'];
        $sql_update = "UPDATE usuario SET senha = '$hashnova_senha' WHERE email = '$email'";
        $retorno_update = $con->query($sql_update);

        if ($retorno_update) {
            // Redirecionar para a página de login
            header('Location: ../login.php');
            exit;
        } else {
            $erro = "Erro ao atualizar a senha. Por favor, tente novamente.";
        }
    } else {
        $erro = "As senhas não coincidem.";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nova Senha</title>
    <link rel="stylesheet" href="../assets/css/pages/index/index.css">
</head>

<body>
    <main class="main-login">
        <div class="box-nova-senha">
            <h1>Nova Senha</h1>

            <?php if (isset($erro)) echo "<p style='color: red;'>$erro</p>"; ?>

            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                <div class="input-box">
                    <input class="box-input-login" type="password" name="nova_senha" placeholder="Nova Senha" required>
                </div>

                <div class="input-box">
                    <input class="box-input-login" type="password" name="conf_nova_senha" placeholder="Confirmar Nova Senha" required>
                </div>

                <button class="btn-login" type="submit">definir nova senha</button>
            </form>
        </div>
    </main>
</body>

</html>
