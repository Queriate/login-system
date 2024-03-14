<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <link rel="stylesheet" href="assets/css/pages/index/index.css">
  <title>QS Formulário</title>
</head>

<body class="body-form">

<?php 
include('conexao.php');

if($_SERVER['REQUEST_METHOD']=='POST'){

  $nome = htmlspecialchars($_POST['nome']);
  $email = htmlspecialchars($_POST['email']);
  $phone = htmlspecialchars($_POST['phone']);
  $data_nascimento = htmlspecialchars($_POST['data_nascimento']);
  $data_nasc_sql = date('Y-m-d', strtotime($data_nascimento));
  $senha = htmlspecialchars($_POST['senha']);
  $conf_senha = htmlspecialchars($_POST['conf_senha']);
  $genero = htmlspecialchars($_POST['genero']); // Novo: obter o gênero
  
  if( $senha === $conf_senha){

    // Verifica se o usuário já existe pelo e-mail
    $sql = "SELECT * FROM usuario WHERE email = '$email'";
    $retorno = $con->query($sql);
    $registro = $retorno->num_rows;
    if($registro){
      echo "<h4 style='color: var(--primary-3); text-align:center; font-size: 1.5rem; padding: .8rem;  background-color: rgba(0, 0, 0, 0.6); box-shadow: .5rem .5rem 1rem #000000e1; width: 20%; margin: 1rem ; '>Este usuário já existe, tente outro e-mail!</h4>";
    }else{

      $hashsenha = password_hash($senha, PASSWORD_DEFAULT);
      // Inserindo o gênero na tabela usuario
      $sql = "INSERT INTO usuario(nome,email,phone,data_nascimento,senha,genero) VALUES ('$nome','$email','$phone','$data_nasc_sql','$hashsenha','$genero')";

      $retorno=$con->query($sql);

      if($retorno==true){
        echo "<h5 style='color: var(--primary-3); text-align:center; font-size: 1.5rem; padding: .8rem;  background-color: rgba(0, 0, 0, 0.6); box-shadow: .5rem .5rem 1rem #000000e1; width: 20%; margin: 1rem ; '>Cadastro realizado com sucesso!</h5>";
      }else{
        echo "<h4 style='color: var(--primary-3); text-align:center; font-size: 1.5rem; padding: .8rem;  background-color: rgba(0, 0, 0, 0.6); box-shadow: .5rem .5rem 1rem #000000e1; width: 20%; margin: 1rem ; '>Usuário não cadastrado no banco de dados</h4>";
      }
    }

  }else{
    echo "<h4 style='color: var(--primary-3); text-align:center; font-size: 1.5rem; padding: .8rem;  background-color: rgba(0, 0, 0, 0.6); box-shadow: .5rem .5rem 1rem #000000e1; width: 20%; margin: 1rem ; '>As senhas não são iguais!</h4>";
  }
}
?>

<main class="box">
  <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
    <fieldset>
      <legend><b>Formulário cliente</b></legend>

      <div class="input-box">
        <input type="text" name="nome" id="nome" class="input-user" required>
        <label class="input-label" for="nome">Nome completo</label>
      </div>
      <br><br>

      <div class="input-box">
        <input type="text" name="email" id="email" class="input-user" required>
        <label class="input-label" for="email">E-mail</label>
      </div>
      <br><br>

      <div class="input-box">
        <input type="tel" name="phone" id="phone" class="input-user" required>
        <label class="input-label" for="phone">Telefone</label>
      </div>
      <br>

      <p><b>Gênero:</b></p>
      <br>

      <input type="radio" id="feminino" name="genero" value="feminino" required>
      <label for="feminino">Feminino</label>
      <br>
      <input type="radio" id="masculino" name="genero" value="masculino" required>
      <label for="masculino">Masculino</label>
      <br>
      <input type="radio" id="outro" name="genero" value="outro" required>
      <label for="outro">Outro</label>
      <br><br>

      <div>
        <label for="data_nascimento"><b>Data de nascimento:</b></label>
        <input type="date" name="data_nascimento" id="data_nascimento" required>
      </div>
      <br><br>

      <div class="input-box">
        <input type="password" name="senha" id="senha" class="input-user" required>
        <label class="input-label" for="senha">Senha:</label>
      </div>
      <br><br>

      <div class="input-box">
        <input type="password" name="conf_senha" id="conf_senha" class="input-user" required>
        <label class="input-label" for="conf_senha">Confirme sua senha:</label>
      </div>

      <br><br>

      <input style="margin: 0 0 1rem 0;"  type="submit" name="submit" id="submit" value="Cadastrar">

      <a class="link_login" href="login.php" style="margin: 0 0 1rem ">Voltar</a>

    </fieldset>
  </form>
</main>

</body>

</html>