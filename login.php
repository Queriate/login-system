<?php
   include('conexao.php');

   // Verificar se os campos 'usuario' e 'senha' foram enviados através do método POST
   if(empty($_POST['usuario']) || empty($_POST['senha'])) {
       header('Location: tela_inicial_login.php');
       exit();
   }
?>
