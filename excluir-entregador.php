<?php
session_start();
ob_start();
?>
<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <title>Exclusão de entregador</title>
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
    <h1 class="jumbotron bg-info">Exclusão de entregador</h1>
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
            <li><a href="cadastro-entregador.php">Cadastro de entregador</a></li>
            <li><a href="excluir-entregador.php">Excluir de entregador</a></li>
            <li><a href="consulta-entregador.php">Consulta de entregador</a></li>
          <?php
            }
          }
          ?>
            <li><a href="filtrar-entregador.php">Filtro de entregador</a></li>
            <li><a href="indexCli.php">Cliente</a></li>
            <li><a href="indexXis.php">Xis</a></li>

          </ul>
        </nav>
      </div>
    </div>
    <form name="excxis" method="post" action="">
      <div class="form-group">
        <label>Digite o código do entregador que deseja excluir</label>
        <input type="number" name="txtcodigo" placeholder="Código" class="form-control">
      </div>
      <div class="form-group">
        <input type="submit" name="excluir" value="Excluir" class="form-control">
      </div>
    </form>
    <?php
      if(isset($_POST['excluir'])){
        include 'dao/entregadordao.class.php';
        $entregadorDAO= new EntregadorDAO();
        $entregadorDAO-> deletarEntregador($_POST['txtcodigo']);
        header("location:consulta-entregador.php");
      }
      ?>
  </body>
</html>
