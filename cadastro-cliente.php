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
    <title>Cadastro de cliente</title>

    <script type="text/javascript" src="js/jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/estilo.css" rel="stylesheet">
  </head>
  <body>
    <div class="container">
    <h1 class="jumbotron bg-info">Cadastro de cliente</h1>
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
          <li><a href="cadastro-cliente.php">Cadastro de cliente</a></li>
          <li><a href="excluir-cliente.php">Excluir de cliente</a></li>
          <li><a href="consulta-cliente.php">Consulta de cliente</a></li>
        <?php
          }
        }
        ?>
          <li><a href="filtrar-cliente.php">Filtro de cliente</a></li>
          <li><a href="indexEnt.php">Entregador</a></li>
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
    <form name="cadcliente" method="post" action="">
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
        <input type="text" name="txtcep" placeholder="Cep">
      </div>
        <div>
          <input type="submit" name="cadastrar" value="Cadastrar">
        </div>

    </form>
    <?php
    if(isset($_POST['cadastrar'])){
      include 'modelo/cliente.class.php';
      include 'dao/clientedao.class.php';
      include 'util/padronizacao.class.php';
      include 'util/validacao.class.php';

      $erros=array();


      $nome = Padronizacao::padronizarPrimeiraMai($_POST['txtnome']);
      $idade = $_POST['txtidade'];
      $telefone =$_POST['txttelefone'];
      $cidade = $_POST['selcidade'];
      $cep =$_POST['txtcep'];

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

      if(!Validacao::validarCep($cep)){
        $erros[] = "CEP inválido!";
      }



      if(count($erros) == 0){
        $cliente = new Cliente();

        $cliente->idCliente=$idCliente;
        $cliente->nome = $nome;
        $cliente->idade =$idade;
        $cliente->telefone =$telefone;
        $cliente->cidade =$cidade;
        $cliente->cep =$cep;

        $clienteDAO = new ClienteDAO();
        $clienteDAO->cadastrarCliente($cliente);

        $_SESSION['cliente'] = serialize($cliente);
        $_SESSION['msg'] = "Cliente cadastrado!";
        header("location:resposta.php");

        $xis->__destruct();
      }else{
        $_SESSION['erros'] = serialize($erros);
        header("location:cadastro-cliente.php");
      }

    }
    ?>
  </div>
  </body>
</html>
