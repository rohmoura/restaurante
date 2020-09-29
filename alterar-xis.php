<?php
session_start();
ob_start();
?>
<!DOCTYPE html>
<html>
  <head lang="pt-br">
    <meta charset="utf-8">
    <title>Alterar xis</title>

    <script type="text/javascript" src="js/jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/estilo.css" rel="stylesheet">
  </head>
  <body>
    <div class="container">
    <h1 class="jumbotron bg-info">Alterar xis</h1>
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
    if(isset($_GET['id'])){
      include_once 'modelo/xis.class.php';
      include_once 'dao/xisdao.class.php';
      $query = "where idxis = ".$_GET['id'];
      $xisDAO = new XisDAO();
      $array = $xisDAO->filtrar($query);
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
    <form name="altxis" method="post" action="">

      <div class="form-group">
        <input type="text" name="txtidxis"
        placeholder="Código do xis"
        readonly
        class="form-control" value="<?php
                                    if(isset($array)){
                                      echo $array[0]->idXis;
                                    }
                                    ?>">
      </div>

      <div class="form-group">
        <input type="text" name="txtsabor"
        placeholder="Sabor" class="form-control"
                             value="<?php
                                    if(isset($array)){
                                      echo $array[0]->sabor;
                                    }
                                    ?>">
      </div>

      <div class="form-group">
        <input type="text" name="txtvalor"
        placeholder="Valor" class="form-control"
                            value="<?php
                                   if(isset($array)){
                                     echo $array[0]->valor;
                                   }
                                   ?>">
      </div>

      <div class="form-group">
        <select name="seltamanho" class="form-control">

          <option value="Grande" <?php
                                 if(isset($array)){
                                   if($array[0]->tamanho == "Grande"){
                                      echo "selected='selected'";
                                   }
                                 }?>>Grande</option>

          <option value="Médio" <?php
                                 if(isset($array)){
                                   if($array[0]->tamanho == "Médio"){
                                      echo "selected='selected'";
                                   }
                                 }?>>Médio</option>
          <option value="Pequeno" <?php
                                 if(isset($array)){
                                   if($array[0]->tamanho == "Pequeno"){
                                      echo "selected='selected'";
                                   }
                                 }?>>Pequeno</option>

        </select>

      </div>
        <div class="form-group">
          <select name="seladicional" class="form-control">

            <option value="Dobro de queijo" <?php
                                   if(isset($array)){
                                     if($array[0]->adicional == "Dobro de queijo"){
                                        echo "selected='selected'";
                                     }
                                   }?>>Dobro de queijo</option>

            <option value="Dobro de recheio" <?php
                                   if(isset($array)){
                                     if($array[0]->adicional == "Dobro de recheio"){
                                        echo "selected='selected'";
                                     }
                                   }?>>Dobro de recheio</option>
            <option value="Batata frita" <?php
                                   if(isset($array)){
                                     if($array[0]->adicional == "Batata frita"){
                                        echo "selected='selected'";
                                     }
                                   }?>>Batata frita</option>
            <option value="Maionese caseira" <?php
                                   if(isset($array)){
                                     if($array[0]->adicional == "Maionese caseira"){
                                        echo "selected='selected'";
                                     }
                                   }?>>Maionese caseira</option>

          </select>
        </div>

      <div class="form-group">
        <select name="selsalada" class="form-control">

          <option value="Tomate" <?php
                                 if(isset($array)){
                                   if($array[0]->salada == "Tomate"){
                                      echo "selected='selected'";
                                   }
                                 }?>>Tomate</option>

          <option value="Alface" <?php
                                 if(isset($array)){
                                   if($array[0]->salada == "Alface"){
                                      echo "selected='selected'";
                                   }
                                 }?>>Alface</option>
          <option value="Pepino" <?php
                                 if(isset($array)){
                                   if($array[0]->salada == "Pepino"){
                                      echo "selected='selected'";
                                   }
                                 }?>>Pepino</option>
          <option value="Azeitona" <?php
                                 if(isset($array)){
                                   if($array[0]->salada == "Azeitona"){
                                      echo "selected='selected'";
                                   }
                                 }?>>Azeitona</option>

        </select>
      </div>
        <div>
          <input type="submit" name="alterar" value="Alterar" class="form-control">
        </div>

    </form>

    <?php
    if(isset($_POST['alterar'])){
      include_once 'modelo/xis.class.php';
      include_once 'dao/xisdao.class.php';
      include_once 'util/padronizacao.class.php';
      include_once 'util/validacao.class.php';

      $erros=array();

      $idXis=$_POST['txtidxis'];
      $sabor = Padronizacao::padronizarPrimeiraMai($_POST['txtsabor']);
      $valor = $_POST['txtvalor'];
      $tamanho = $_POST['seltamanho'];
      $adicional = $_POST['seladicional'];
      $salada = $_POST['selsalada'];

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
        $erros[] = "Salada inválido!";
      }



      if(count($erros) == 0){

        $xis = new Xis();

        $xis->idXis=$idXis;
        $xis->sabor = $sabor;
        $xis->valor =$valor;
        $xis->tamanho =$tamanho;
        $xis->adicional =$adicional;
        $xis->salada =$salada;

        $xisDAO = new XisDAO();
        $xisDAO->alterarXis($xis);

        //$_SESSION['pessoa'] = serialize($pess);
        //$_SESSION['msg'] = "Pessoa cadastrado!";
        header("location:consulta-xis.php");

        $xis->__destruct();
      }else{
        $_SESSION['erros'] = serialize($erros);
        header("location:alterar-xis.php");
      }

    }
    ?>
  </div>
  </body>
</html>
