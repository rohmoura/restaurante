<?php
session_start();
ob_start();
?>
<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <title>Página Inicial</title>
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

      <h1 class="jumbotron bg-info">Página Inicial</h1>

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
            <li><a href="indexCli.php">Cliente</a></li>
            <li><a href="indexEnt.php">Entregador</a></li>
            <li><a href="indexXis.php">Xis</a></li>
            <?php
              }
            }
            ?>
            <li><a href="login.php">Login</a></li>


          </ul>
        </nav>

      </div>
      <?php
        if(isset($_SESSION['privateUser'])){
          include_once 'modelo/usuario.class.php';
          $u=unserialize($_SESSION['privateUser']);
          echo "Ola ".$u->login.",voce esta logado!";
        }


       ?>

       <h2>Seja bem vindo</h2>

       <?php
       if(isset($_SESSION['privateUser'])){
       ?>
       <form name="deslogar" method="post" action=""
              enctype="multipart/form-data">
        <div class="form-group">
          <input type="submit" name="deslogar" value="Deslogar"
                  class="btn btn-primary">
         </div>
        </form>
        <?php

        }
        ?>
        <?php
        if(isset($_POST['deslogar'])&& isset($_SESSION['privateUser'])){
          unset($_SESSION['privateUser']);
          header("location:index.php");
        }

         ?>
    </div>
  </body>
</html>
