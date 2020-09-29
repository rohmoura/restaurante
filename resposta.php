<?php
session_start();
ob_start();
?>
<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <title>Resposta</title>
    <meta charset="utf-8">

    <!-- Bootstrap +
     JQuery (necessário para os plugins de Javascript do Bootstrap) -->
     <script type="text/javascript" src="js/jquery-3.2.1.min.js"></script>
     <script type="text/javascript" src="js/bootstrap.min.js"></script>
     <link href="css/bootstrap.min.css" rel="stylesheet">

     <!-- CSS padrão da página -->
     <link href="css/estilo.css" rel="stylesheet">
  </head>

  <body>
    <div class="container">
    <h1 class="jumbotron bg-info">Resposta</h1>
    <div class="row">
      <nav style="margin-bottom: 30px" class="navbar navbar-inverse">
        <ul class="nav navbar-nav">
          <li><a href="index.php">Página Inicial</a></li>
          <?php
          if(isset($_SESSION['privateUser'])){
            include_once 'modelo/usuario.class.php';
            $u = unserialize($_SESSION['privateUser']);
          ?>
          <?php
          if($u->tipo == 'adm'){
          ?>
            <li><a href="cadastro-xis.php">Cadastro de xis</a></li>
            <li><a href="excluir-xis.php">Excluir de xis</a></li>
            <li><a href="consulta-xis.php">Consulta de xis</a></li>
          <?php
            }
          }
          ?>
            <li><a href="filtrar-xis.php">Filtro de xis</a></li>
            <li><a href="login.php">Login</a></li>

        </ul>
      </nav>
    </div>
    <?php
    if(isset($_SESSION['xis'])){
      include 'modelo/xis.class.php';
      echo "<h1>".$_SESSION['msg']."</h1>";
      $xis = unserialize($_SESSION['xis']);
      echo $xis;
    }
    ?>
    </div>
  </body>
</html>
