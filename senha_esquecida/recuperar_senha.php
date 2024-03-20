<?php
session_start();
include('../conexao.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = htmlspecialchars($_POST['email']);
    $data_nascimento = htmlspecialchars($_POST['data_nascimento']);
    $phone = htmlspecialchars($_POST['phone']);

    // Consulta para verificar se os dados fornecidos correspondem a um usuário
    $sql = "SELECT * FROM usuario WHERE email = '$email' AND data_nascimento = '$data_nascimento' AND phone = '$phone'";
    $resultado = $con->query($sql);

    if ($resultado->num_rows > 0) {
        // Definir email na sessão para usar em nova_senha.php
        $_SESSION['email'] = $email;
        // Redirecionar para a página para definir uma nova senha
        header('Location: nova_senha.php');
        exit;
    } else {
        $erro = "Os dados fornecidos não correspondem a nenhum usuário.";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperação de Senha</title>
    <link rel="stylesheet" href="../assets/css/pages/index/index.css">
</head>

<body>
    <main class="main-login">
        <div class="box-recuperacao">
            <h1>Recuperação de Senha</h1>

            <?php if (isset($erro)) echo "<p style='color: red;'>$erro</p>"; ?>

            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                <div class="input-box">
                    <input class="box-input-login" type="text" name="email" placeholder="E-mail" required>
                </div>

                <div class="input-box">
                    <input class="box-input-login" type="date" name="data_nascimento" placeholder="Data de Nascimento" required>
                </div>

                <div class="input-box">
                    <input class="box-input-login" type="tel" name="phone" placeholder="Telefone" required>
                </div>

                <button class="btn-login" type="submit">recuperar senha</button>
            </form>
        </div>
    </main>
</body>

</html>
