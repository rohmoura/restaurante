<?php
session_start();
ob_start();
?>
<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <title>Pesquisa de xis</title>
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

      <h1 class="jumbotron bg-info">Pesquisa de xis</h1>

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

      <form name="filtxis" method="post" action="" enctype="multipart/form-data">

            <div class="form-group">
              <input type="text" name="txtpesq" placeholder="Pesquisa" class="form-control">
            </div>

            <div class="radio">
              <label>
                <input type="radio" name="rdfiltro" value="idxis">Código do Xis</label>
            </div>

            <div class="radio">
              <label>
                <input type="radio" name="rdfiltro" value="sabor">Sabor</label>
            </div>

            <div class="radio">
              <label>
                <input type="radio" name="rdfiltro" value="valor">Valor</label>
            </div>

            <div class="radio">
              <label>
                <input type="radio" name="rdfiltro" value="tamanho">Tamanho</label>
            </div>

            <div class="radio">
              <label>
              <input type="radio" name="rdfiltro" value="adicional">Adicional</label>
            </div>

            <div class="radio">
              <label>
              <input type="radio" name="rdfiltro" value="salada">Salada</label>
            </div>

            <div class="form-group">
              <input type="submit" name="filtrar" value="Filtrar" class="btn btn-primary">
            </div>
      </form>

      <?php
      if(isset($_SESSION['xis'])){
          include_once 'modelo/xis.class.php';
          $xis = unserialize($_SESSION['xis']);
          if(count($xis) == 0){
            echo "<h1>Sua consulta não retornou nenhum xis!</h1>";
          } else {
       ?>
       <!-- TABELA HTML5-->
       <div class="table-responsive">
       <table class="table table-striped table-bordered table-hover table-condensed">
         <thead>
           <tr>
             <th>Código</th>
             <th>Sabor</th>
             <th>Valor</th>
             <th>Tamanho</th>
             <th>Adicional</th>
             <th>Salada</th>
           </tr>
         </thead>

         <tfoot>
           <tr>

           </tr>
         </tfoot>

         <tbody>
           <?php
           foreach($xis as $xis){
            echo "<tr>";
              echo "<td>".$xis->idXis."</td>";
              echo "<td>".$xis->sabor."</td>";
              echo "<td>".$xis->valor."</td>";
              echo "<td>".$xis->tamanho."</td>";
              echo "<td>".$xis->adicional."</td>";
              echo "<td>".$xis->salada."</td>";
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
       unset($_SESSION['xis']);
      }//fecha isset
      ?>

      <?php
      if(isset($_POST['filtrar'])){
        include_once 'modelo/xis.class.php';
        $pesq = $_POST['txtpesq']; //Text
        $filtro = $_POST['rdfiltro']; //RadioButton
        //só para teste.
        //var_dump($_POST);

        $query = "";
        if($filtro == "idxis"){
          $query = "where idxis = ".$pesq;
        }else if($filtro == "sabor"){
          $query = "where sabor like '%".$pesq."%'";
        }else if($filtro == "valor"){
          $query = "where valor like '%".$pesq."%'";
        }else if($filtro == "tamanho"){
          $query = "where tamanho like '%".$pesq."%'";
        }else if($filtro == "adicional"){
          $query = "where adicional like '%".$pesq."%'";
        }else if($filtro == "salada"){
          $query = "where salada like '%".$pesq."%'";
        }

        include 'dao/xisdao.class.php';
        $xisDAO = new XisDAO();
        $array = $xisDAO->filtrar($query);
        //var_dump($array); //testando retorno da consulta
        $_SESSION['xis'] = serialize($array);
        header("location:filtrar-xis.php");
      }
      ?>
    </div>
  </body>
</html>
