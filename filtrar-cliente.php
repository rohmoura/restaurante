<?php
session_start();
ob_start();
?>
<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <title>Pesquisa de cliente</title>
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

      <h1 class="jumbotron bg-info">Pesquisa de cliente</h1>

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

      <form name="filtcliente" method="post" action="" enctype="multipart/form-data">

            <div class="form-group">
              <input type="text" name="txtpesq" placeholder="Pesquisa" class="form-control">
            </div>

            <div class="radio">
              <label>
                <input type="radio" name="rdfiltro" value="idcliente">Código do cliente</label>
            </div>

            <div class="radio">
              <label>
                <input type="radio" name="rdfiltro" value="nome">Nome</label>
            </div>

            <div class="radio">
              <label>
                <input type="radio" name="rdfiltro" value="idade">Idade</label>
            </div>

            <div class="radio">
              <label>
                <input type="radio" name="rdfiltro" value="telefone">Telefone</label>
            </div>

            <div class="radio">
              <label>
              <input type="radio" name="rdfiltro" value="cidade">Cidade</label>
            </div>

            <div class="radio">
              <label>
              <input type="radio" name="rdfiltro" value="cep">CEP</label>
            </div>

            <div class="form-group">
              <input type="submit" name="filtrar" value="Filtrar" class="btn btn-primary">
            </div>
      </form>

      <?php
      if(isset($_SESSION['cliente'])){
          include_once 'modelo/cliente.class.php';
          $cliente = unserialize($_SESSION['cliente']);
          if(count($cliente) == 0){
            echo "<h1>Sua consulta não retornou nenhum cliente!</h1>";
          } else {
       ?>
       <!-- TABELA HTML5-->
       <div class="table-responsive">
       <table class="table table-striped table-bordered table-hover table-condensed">
         <thead>
           <tr>
              <th>Código</th>
              <th>Editar</th>
              <th>Nome</th>
              <th>Idade</th>
              <th>Telefone</th>
              <th>Cidade</th>
              <th>CEP</th>
          </tr>
         </thead>
         <tfoot>

         </tfoot>

         <tbody>
           <?php
           foreach($cliente as $cliente){
             echo "<tr>";
               echo "<td>".$cliente->idcliente."</td>";
               echo"<td>".$cliente->nome."</td>";
               echo"<td>".$cliente->idade."</td>";
               echo"<td>".$cliente->telefone."</td>";
               echo"<td>".$cliente->cidade."</td>";
               echo"<td>".$cliente->cep."</td>";

             echo"</tr>";
           }//fecha foreach
           ?>
         </tbody>
       </table>
       </div>
       <?php
       }//fecha else
       ?>
       </div>
       <?php
       unset($_SESSION['cliente']);
      }//fecha isset
      ?>

      <?php
      if(isset($_POST['filtrar'])){
        include_once 'modelo/cliente.class.php';
        $pesq = $_POST['txtpesq']; //Text
        $filtro = $_POST['rdfiltro']; //RadioButton
        //só para teste.
        //var_dump($_POST);

        $query = "";
        if($filtro == "idcliente"){
          $query = "where idcliente = ".$pesq;
        }else if($filtro == "nome"){
          $query = "where nome like '%".$pesq."%'";
        }else if($filtro == "idade"){
          $query = "where idade like '%".$pesq."%'";
        }else if($filtro == "telefone"){
          $query = "where telefone like '%".$pesq."%'";
        }else if($filtro == "cidade"){
          $query = "where cidade like '%".$pesq."%'";
        }else if($filtro == "cep"){
          $query = "where cep like '%".$pesq."%'";
        }

        include 'dao/clientedao.class.php';
        $clienteDAO = new ClienteDAO();
        $array = $clienteDAO->filtrar($query);
        //var_dump($array); //testando retorno da consulta
        $_SESSION['cliente'] = serialize($array);
        header("location:filtrar-cliente.php");
      }
      ?>
    </div>
  </body>
</html>
