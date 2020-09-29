<?php
session_start();
ob_start();
?>
<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <title>Consulta de entregador</title>
    <meta charset="utf-8">


     <script type="text/javascript" src="js/jquery-3.2.1.min.js"></script>
     <script type="text/javascript" src="js/bootstrap.min.js"></script>
     <link href="css/bootstrap.min.css" rel="stylesheet">
     <link href="css/estilo.css" rel="stylesheet">
  </head>

  <body>
    <div class="container">
      <h1 class="jumbotron bg-info">Consulta de entregador</h1>
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
      include 'modelo/entregador.class.php';
      include 'dao/entregadordao.class.php';

      $entregadorDAO = new EntregadorDAO();
      $array = $entregadorDAO->buscarEntregador();

      //var_dump($array);

      //echo "<p>";
      //foreach($array as $liv){
        //echo "<hr>";
        //echo "<br>".$liv;
      //}
        //echo "</p>";*//

       ?>
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
              <th>Moto</th>
          </tr>
         </thead>
         <tfoot>

         </tfoot>

         <tbody>
           <?php
           foreach($array as $entregador){
             echo "<tr>";
               echo"<td>".$entregador->idEntregador."</td>";
               echo "<td><a href='alterar-entregador.php?id=$entregador->idEntregador'><img src='imagens/edit.png' alt='Editar'></a></td>";
               echo"<td>".$entregador->nome."</td>";
               echo"<td>".$entregador->idade."</td>";
               echo"<td>".$entregador->telefone."</td>";
               echo"<td>".$entregador->cidade."</td>";
               echo"<td>".$entregador->moto."</td>";

             echo"</tr>";
           }//fecha foreach
           ?>
         </tbody>
       </table>
     </div>
    </div>
  </body>
</html>
