<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel</title>
    <link rel="stylesheet" href="assets/css/pages/index/index.css">
</head>

<body class="body-form">

<?php 
session_start();

// Verifica se a sessão do usuário está definida
if(isset($_SESSION['usuario'])) {
    // Extrai o nome do usuário da sessão
    $nome_usuario = $_SESSION['usuario'];
    
    // Determina a saudação com base no gênero (se disponível)
    $genero = isset($_SESSION['genero']) ? $_SESSION['genero'] : '';
    switch($genero) {
        case 'feminino':
            $saudacao = 'Bem-vinda';
            break;
        case 'masculino':
            $saudacao = 'Bem-vindo';
            break;
        default:
            $saudacao = 'Bem-vindo(a)';
    }
} else {
    // Se a sessão do usuário não estiver definida, redireciona para a página de login
    header("Location: login.php");
    exit();
}
?>

<main class="box">
    <div class="dashboard">
        <h1><?php echo "$saudacao, $nome_usuario"; ?>, ao seu Painel</h1>
        <p>Você está logado!</p>
        <a href="logout.php" class="logout-btn">Sair</a>
    </div>
</main>

</body>

</html>
