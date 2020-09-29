<?php
session_start();
ob_start();

if(!isset($_SESSION['privateUser'])){
  $_SESSION['msg']="Pagina privada!Faça o login.";
  header("location:resposta.php");
  die();
}
?>
<!DOCTYPE html>
<html>
  <head lang="pt-br">
    <meta charset="utf-8">
    <title>Cadastro de xis</title>

    <script type="text/javascript" src="js/jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/estilo.css" rel="stylesheet">
  </head>
  <body>
    <div class="container">
    <h1 class="jumbotron bg-info">Cadastro de xis</h1>
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
    <?php
    if(isset($_SESSION['erros'])){
      $erros = unserialize($_SESSION['erros']);
      echo "<p>";
      foreach($erros as $e){
        echo "<br>".$e;
      }
      echo "</p>";
      unset($_SESSION['erros']);
    }
    ?>
    <form name="cadxis" method="post" action="">
      <div class="form-group">
        <input type="text" name="txtsabor" placeholder="Sabor">
      </div>

      <div class="form-group">
        <input type="number" name="txtvalor" placeholder="Valor">
      </div>

      <div class="form-group">
        <select name="seltamanho" class="form-control">
          <option value="Grande">Grande</option>
          <option value="Médio">Médio</option>
          <option value="Pequeno">Pequeno</option>
        </select>
      </div>

      <div class="form-group">
        <select name="seladicional" class="form-control">
          <option value="Dobro de queijo">Dobro de queijo</option>
          <option value="Dobro de recheio">Dobro de recheio</option>
          <option value="Batata frita">Batata frita</option>
          <option value="Maionese caseiro">Maionese caseiro</option>
        </select>
      </div>

      <div class="form-group">
        <select name="selsalada" class="form-control">
          <option value="Tomate">Tomate</option>
          <option value="Alface">Alface</option>
          <option value="Pepino">Pepino</option>
          <option value="Azeitona">Azeitona</option>
        </select>
      </div>
        <div>
          <input type="submit" name="cadastrar" value="Cadastrar">
        </div>

    </form>
    <?php
    if(isset($_POST['cadastrar'])){
      include 'modelo/xis.class.php';
      include 'dao/xisdao.class.php';
      include 'util/padronizacao.class.php';
      include 'util/validacao.class.php';

      $erros=array();


      $sabor = Padronizacao::padronizarPrimeiraMai($_POST['txtsabor']);
      $valor = $_POST['txtvalor'];
      $tamanho =$_POST['seltamanho'];
      $adicional = $_POST['seladicional'];
      $salada =$_POST['selsalada'];

      if(!Validacao::validarSabor($sabor)){
        $erros[] = "Sabor inválido";
      }

      if(!Validacao::validarValor($valor)){
        $erros[] = "Valor inválido!";
      }

      if(!Validacao::validarTamanho($tamanho)){
        $erros[] = "Tamanho inválido!";
      }

      if(!Validacao::validarAdicional($adicional)){
        $erros[] = "Adicional inválido!";
      }

      if(!Validacao::validarSalada($salada)){
        $erros[] = "Salada inválida!";
      }



      if(count($erros) == 0){
        $xis = new Xis();
        $xis->sabor = Padronizacao::padronizarPrimeiraMai($_POST['txtsabor']);
        $xis->valor = $_POST['txtvalor'];
        $xis->tamanho =$_POST['seltamanho'];
        $xis->adicional = $_POST['seladicional'];
        $xis->salada =$_POST['selsalada'];

        $xisDAO = new XisDAO();
        $xisDAO->cadastrarXis($xis);

        $_SESSION['xis'] = serialize($xis);
        $_SESSION['msg'] = "Xis cadastrado!";
        header("location:resposta.php");

        $xis->__destruct();
      }else{
        $_SESSION['erros'] = serialize($erros);
        header("location:cadastro-xis.php");
      }

    }
    ?>
  </div>
  </body>
</html>
