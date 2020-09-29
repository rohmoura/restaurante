<?php
session_start();
ob_start();
?>
<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <title>Consulta de xis</title>
    <meta charset="utf-8">


     <script type="text/javascript" src="js/jquery-3.2.1.min.js"></script>
     <script type="text/javascript" src="js/bootstrap.min.js"></script>
     <link href="css/bootstrap.min.css" rel="stylesheet">
     <link href="css/estilo.css" rel="stylesheet">
  </head>

  <body>
    <div class="container">
      <h1 class="jumbotron bg-info">Consulta de xis</h1>
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
      include 'modelo/xis.class.php';
      include 'dao/xisdao.class.php';

      $xisDAO = new XisDAO();
      $array = $xisDAO->buscarXis();

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
              <th>Sabor</th>
              <th>Valor</th>
              <th>Tamanho</th>
              <th>Adicional</th>
              <th>Salada</th>
          </tr>
         </thead>
         <tfoot>

         </tfoot>

         <tbody>
           <?php
           foreach($array as $xis){
             echo "<tr>";
               echo"<td>".$xis->idXis."</td>";
               echo "<td><a href='alterar-xis.php?id=$xis->idXis'><img src='imagens/edit.png' alt='Editar'></a></td>";
               echo"<td>".$xis->sabor."</td>";
               echo"<td>".$xis->valor."</td>";
               echo"<td>".$xis->tamanho."</td>";
               echo"<td>".$xis->adicional."</td>";
               echo"<td>".$xis->salada."</td>";

             echo"</tr>";
           }//fecha foreach
           ?>
         </tbody>
       </table>
     </div>
    </div>
  </body>
</html>
