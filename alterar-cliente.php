<?php
session_start();
ob_start();
?>
<!DOCTYPE html>
<html>
  <head lang="pt-br">
    <meta charset="utf-8">
    <title>Alterar cliente</title>

    <script type="text/javascript" src="js/jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/estilo.css" rel="stylesheet">
  </head>
  <body>
    <div class="container">
    <h1 class="jumbotron bg-info">Alterar Cliente</h1>
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
    if(isset($_GET['id'])){
      include_once 'modelo/cliente.class.php';
      include_once 'dao/clientedao.class.php';
      $query = "where idcliente = ".$_GET['id'];
      $clienteDAO = new ClienteDAO();
      $array = $clienteDAO->filtrar($query);
    }

    ?>
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
    <form name="altcliente" method="post" action="">

      <div class="form-group">
        <input type="text" name="txtidcliente"
        placeholder="Código do cliente"
        readonly
        class="form-control" value="<?php
                                    if(isset($array)){
                                      echo $array[0]->idCliente;
                                    }
                                    ?>">
      </div>

      <div class="form-group">
        <input type="text" name="txtnome" placeholder="Nome" value="<?php
                                    if(isset($array)){
                                      echo $array[0]->nome;
                                    }
                                    ?>">
      </div>

      <div class="form-group">
        <input type="number" name="txtidade" placeholder="Idade" value="<?php
                                    if(isset($array)){
                                      echo $array[0]->idade;
                                    }
                                    ?>">
      </div>

      <div class="form-group">
        <input type="number" name="txttelefone" placeholder="Telefone" value="<?php
                                    if(isset($array)){
                                      echo $array[0]->telefone;
                                    }
                                    ?>">
      </div>

      <div class="form-group">
        <select name="selcidade" class="form-control">

          <option value="Alvorada" <?php
                                 if(isset($array)){
                                   if($array[0]->cidade == "Alvorada"){
                                      echo "selected='selected'";
                                   }
                                 }?>>Alvorada</option>

          <option value="Viamão" <?php
                                 if(isset($array)){
                                   if($array[0]->cidade == "Viamão"){
                                      echo "selected='selected'";
                                   }
                                 }?>>Viamão</option>
          <option value="Porto Alegre" <?php
                                 if(isset($array)){
                                   if($array[0]->cidade == "Porto Alegre"){
                                      echo "selected='selected'";
                                   }
                                 }?>>Porto Alegre</option>

        </select>

      </div>

        <div class="form-group">
          <input type="number" name="txtcep" placeholder="Cep" value="<?php
                                      if(isset($array)){
                                        echo $array[0]->cep;
                                      }
                                      ?>">
        </div>

        <div>
          <input type="submit" name="alterar" value="Alterar" class="form-control">
        </div>



    </form>

    <?php
    if(isset($_POST['alterar'])){
      include_once 'modelo/cliente.class.php';
      include_once 'dao/clientedao.class.php';
      include_once 'util/padronizacao.class.php';
      include_once 'util/validacao.class.php';

      $erros=array();

      $idCliente=$_POST['txtidcliente'];
      $nome = Padronizacao::padronizarPrimeiraMai($_POST['txtnome']);
      $idade = $_POST['txtidade'];
      $telefone = $_POST['txttelefone'];
      $cidade = $_POST['selcidade'];
      $cep = $_POST['txtcep'];

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
        $clienteDAO->alterarCliente($cliente);

        //$_SESSION['pessoa'] = serialize($pess);
        //$_SESSION['msg'] = "Pessoa cadastrado!";
        //header("location:consulta-cliente.php");

        $cliente->__destruct();
      }else{
        $_SESSION['erros'] = serialize($erros);
        header("location:cadastro-cliente.php");
      }

    }
    ?>
  </div>
  </body>
</html>
