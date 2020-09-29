<?php
session_start();
ob_start();
?>
<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <title>Pesquisa de entregador</title>
    <meta charset="utf-8">

    <!-- Bootstrap +
     JQuery (necessário para os plugins de Java do Bootstrap) -->
     <script type="text/java" src="js/jquery-3.2.1.min.js">
     </script>
     <script type="text/java" src="js/bootstrap.min.js">
     </script>
     <link href="css/bootstrap.min.css" rel="stylesheet">

     <!-- CSS padrão da página -->
     <link href="css/estilo.css" rel="stylesheet">
  </head>

  <body>
    <div class="container">

      <h1 class="jumbotron bg-info">Pesquisa de entregador</h1>

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

      <form name="filtentregador" method="post" action="" enctype="multipart/form-data">

            <div class="form-group">
              <input type="text" name="txtpesq" placeholder="Pesquisa" class="form-control">
            </div>

            <div class="radio">
              <label>
                <input type="radio" name="rdfiltro" value="identregador">Código do entregador</label>
            </div>

            <div class="radio">
              <label>
                <input type="radio" name="rdfiltro" value="Nome">Nome</label>
            </div>

            <div class="radio">
              <label>
                <input type="radio" name="rdfiltro" value="Idade">Idade</label>
            </div>

            <div class="radio">
              <label>
                <input type="radio" name="rdfiltro" value="Telefone">Telefone</label>
            </div>

            <div class="radio">
              <label>
              <input type="radio" name="rdfiltro" value="Cidade">Cidade</label>
            </div>

            <div class="radio">
              <label>
              <input type="radio" name="rdfiltro" value="Moto">Moto</label>
            </div>

            <div class="form-group">
              <input type="submit" name="filtrar" value="Filtrar" class="btn btn-primary">
            </div>
      </form>

      <?php
      if(isset($_SESSION['entregador'])){
          include_once 'modelo/entregador.class.php';
          $entregador = unserialize($_SESSION['entregador']);
          if(count($entregador) == 0){
            echo "<h1>Sua consulta não retornou nenhum entregador!</h1>";
          } else {
       ?>
       <!-- TABELA HTML5-->
       <div class="table-responsive">
       <table class="table table-striped table-bordered table-hover table-condensed">
         <thead>
           <tr>
             <th>Código</th>
             <th>Nome</th>
             <th>Idade</th>
             <th>Telefone</th>
             <th>Cidade</th>
             <th>Moto</th>
           </tr>
         </thead>

         <tfoot>
           <tr>

           </tr>
         </tfoot>

         <tbody>
           <?php
           foreach($entregador as $entregador){
            echo "<tr>";
              echo "<td>".$entregador->idEntregador."</td>";
              echo "<td>".$entregador->nome."</td>";
              echo "<td>".$entregador->idade."</td>";
              echo "<td>".$entregador->telefone."</td>";
              echo "<td>".$entregador->cidade."</td>";
              echo "<td>".$entregador->moto."</td>";
             echo "</tr>";
           }
           ?>
         </tbody>
       </table>
       </div>
       <?php
       }//fecha else
       ?>
       </div>
       <?php
       unset($_SESSION['entregador']);
      }//fecha isset
      ?>

      <?php
      if(isset($_POST['filtrar'])){
        include_once 'modelo/entregador.class.php';
        $pesq = $_POST['txtpesq']; //Text
        $filtro = $_POST['rdfiltro']; //RadioButton
        //só para teste.
        //var_dump($_POST);

        $query = "";
        if($filtro == "identregador"){
          $query = "where identregador = ".$pesq;
        }else if($filtro == "nome"){
          $query = "where nome like '%".$pesq."%'";
        }else if($filtro == "idade"){
          $query = "where idade like '%".$pesq."%'";
        }else if($filtro == "telefone"){
          $query = "where telefone like '%".$pesq."%'";
        }else if($filtro == "cidade"){
          $query = "where cidade like '%".$pesq."%'";
        }else if($filtro == "moto"){
          $query = "where moto like '%".$pesq."%'";
        }

        include 'dao/entregadordao.class.php';
        $entregadorDAO = new EntregadorDAO();
        $array = $entregadorDAO->filtrar($query);
        //var_dump($array); //testando retorno da consulta
        $_SESSION['entregador'] = serialize($array);
        header("location:filtrar-entregador.php");
      }
      ?>
    </div>
  </body>
</html>
