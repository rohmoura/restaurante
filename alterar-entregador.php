<?php
session_start();
ob_start();
?>
<!DOCTYPE html>
<html>
  <head lang="pt-br">
    <meta charset="utf-8">
    <title>Alterar entregador</title>

    <script type="text/javascript" src="js/jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/estilo.css" rel="stylesheet">
  </head>
  <body>
    <div class="container">
    <h1 class="jumbotron bg-info">Alterar entregador</h1>
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
    if(isset($_GET['id'])){
      include_once 'modelo/entregador.class.php';
      include_once 'dao/entregadordao.class.php';
      $query = "where idEntregador = ".$_GET['id'];
      $entregadorDAO = new EntregadorDAO();
      $array = $entregadorDAO->filtrar($query);
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
    <form name="altentregador" method="post" action="">

      <div class="form-group">
        <input type="text" name="txtidentregador"
        placeholder="Código do entregador"
        readonly
        class="form-control" value="<?php
                                    if(isset($array)){
                                      echo $array[0]->idEntregador;
                                    }
                                    ?>">
      </div>

      <div class="form-group">
        <input type="text" name="txtnome"
        placeholder="Nome" class="form-control"
                             value="<?php
                                    if(isset($array)){
                                      echo $array[0]->nome;
                                    }
                                    ?>">
      </div>

      <div class="form-group">
        <input type="text" name="txtidade"
        placeholder="Idade" class="form-control"
                            value="<?php
                                   if(isset($array)){
                                     echo $array[0]->idade;
                                   }
                                   ?>">
      </div>

      <div class="form-group">
        <input type="text" name="txttelefone"
        placeholder="Telefone" class="form-control"
                            value="<?php
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

          <option value="Porto alegre" <?php
                                 if(isset($array)){
                                   if($array[0]->cidade == "Porto alegre"){
                                      echo "selected='selected'";
                                   }
                                 }?>>Porto alegre</option>
          <option value="Viamão" <?php
                                 if(isset($array)){
                                   if($array[0]->cidade == "Viamão"){
                                      echo "selected='selected'";
                                   }
                                 }?>>Viamão</option>

        </select>

      </div>

      <div class="form-group">
        <select name="selmoto" class="form-control">

          <option value="Hornet" <?php
                                 if(isset($array)){
                                   if($array[0]->moto == "Hornet"){
                                      echo "selected='selected'";
                                   }
                                 }?>>Hornet</option>

          <option value="CG 160" <?php
                                 if(isset($array)){
                                   if($array[0]->moto == "CG 160"){
                                      echo "selected='selected'";
                                   }
                                 }?>>CG 160</option>
          <option value="Shineray" <?php
                                 if(isset($array)){
                                   if($array[0]->moto == "Shineray"){
                                      echo "selected='selected'";
                                   }
                                 }?>>Shineray</option>

        </select>

      </div>
        <div>
          <input type="submit" name="alterar" value="alterar" class="form-control">
        </div>

    </form>

    <?php
    if(isset($_POST['alterar'])){
      include_once 'modelo/entregador.class.php';
      include_once 'dao/entregadordao.class.php';
      include_once 'util/padronizacao.class.php';
      include_once 'util/validacao.class.php';

      $erros=array();

      $idEntregador=$_POST['txtidentregador'];
      $nome = Padronizacao::padronizarPrimeiraMai($_POST['txtnome']);
      $idade = $_POST['txtidade'];
      $telefone = $_POST['txttelefone'];
      $cidade = $_POST['selcidade'];
      $moto = $_POST['selmoto'];

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

        $entregador->idEntregador=$idEntregador;
        $entregador->nome = $nome;
        $entregador->idade =$idade;
        $entregador->telefone =$telefone;
        $entregador->cidade =$cidade;
        $entregador->moto =$moto;

        $entregadorDAO = new EntregadorDAO();
        $entregadorDAO->alterarEntregador($entregador);

        //$_SESSION['pessoa'] = serialize($pess);
        //$_SESSION['msg'] = "Pessoa cadastrado!";
        header("location:consulta-entregador.php");

        $entregador->__destruct();
      }else{
        $_SESSION['erros'] = serialize($erros);
        header("location:alterar-entregador.php");
      }

    }
    ?>
  </div>
  </body>
</html>
