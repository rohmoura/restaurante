<?php
session_start();
ob_start();
?>
<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <title>Exclusão de xis</title>
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
    <h1 class="jumbotron bg-info">Exclusão de xis</h1>
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
            <li><a href="indexCli.php">Cliente</a></li>
            <li><a href="indexEnt.php">Entregador</a></li>

          </ul>
        </nav>
      </div>
    </div>
    <form name="excxis" method="post" action="">
      <div class="form-group">
        <label>Digite o código do xis que deseja excluir</label>
        <input type="number" name="txtcodigo" placeholder="Código" class="form-control">
      </div>
      <div class="form-group">
        <input type="submit" name="excluir" value="Excluir" class="form-control">
      </div>
    </form>
    <?php
      if(isset($_POST['excluir'])){
        include 'dao/xisdao.class.php';
        $xisDAO= new XisDAO();
        $xisDAO-> deletarXis($_POST['txtcodigo']);
        header("location:consulta-xis.php");
      }
      ?>
  </body>
</html>
