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
    <title>Cadastro de entregador</title>

    <script type="text/javascript" src="js/jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/estilo.css" rel="stylesheet">
  </head>
  <body>
    <div class="container">
    <h1 class="jumbotron bg-info">Cadastro de entregador</h1>
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
    <form name="cadentregador" method="post" action="">
      <div class="form-group">
        <input type="text" name="txtnome" placeholder="Nome">
      </div>

      <div class="form-group">
        <input type="number" name="txtidade" placeholder="Idade">
      </div>

      <div class="form-group">
        <input type="text" name="txttelefone" placeholder="Telefone">
      </div>

      <div class="form-group">
        <select name="selcidade" class="form-control">
          <option value="Alvorada">Alvorada</option>
          <option value="Porto Alegre">Porto Alegre</option>
          <option value="Viamão">Viamão</option>
        </select>
      </div>

      <div class="form-group">
        <select name="selmoto" class="form-control">
          <option value="Hornet">Hornet</option>
          <option value="CJ 160">CJ 160</option>
          <option value="Shineray">Shineray</option>
        </select>
      </div>

        <div>
          <input type="submit" name="cadastrar" value="Cadastrar">
        </div>

    </form>
    <?php
    if(isset($_POST['cadastrar'])){
      include 'modelo/entregador.class.php';
      include 'dao/entregadordao.class.php';
      include 'util/padronizacao.class.php';
      include 'util/validacao.class.php';

      $erros=array();


      $nome = Padronizacao::padronizarPrimeiraMai($_POST['txtnome']);
      $idade = $_POST['txtidade'];
      $telefone =$_POST['txttelefone'];
      $cidade = $_POST['selcidade'];
      $moto =$_POST['selmoto'];

      if(!Validacao::validarNome($nome)){
        $erros[] = "Nome inválido";
      }

      if(!Validacao::validarIdade($idade)){
        $erros[] = "Idade inválida!";
      }

      if(!Validacao::validarTelefone($telefone)){
        $erros[] = "Telefone inválido!";
      }

      if(!Validacao::validarCidade($cidade)){
        $erros[] = "Cidade inválida!";
      }

      if(!Validacao::validarMoto($moto)){
        $erros[] = "Moto inválida!";
      }



      if(count($erros) == 0){
        $entregador = new Entregador();
        $entregador->nome = Padronizacao::padronizarPrimeiraMai($_POST['txtnome']);
        $entregador->idade = $_POST['txtidade'];
        $entregador->telefone =$_POST['txttelefone'];
        $entregador->cidade = $_POST['selcidade'];
        $entregador->moto =$_POST['selmoto'];

        $entregadorDAO = new EntregadorDAO();
        $entregadorDAO->cadastrarEntregador($entregador);

        $_SESSION['entregador'] = serialize($entregador);
        $_SESSION['msg'] = "Entregador cadastrado!";
        header("location:resposta.php");

        $entregador->__destruct();
      }else{
        $_SESSION['erros'] = serialize($erros);
        header("location:cadastro-entregador.php");
      }

    }
    ?>
  </div>
  </body>
</html>
