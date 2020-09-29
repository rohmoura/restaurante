<?php
session_start();
ob_start();
?>
<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <title>Consulta de cliente</title>
    <meta charset="utf-8">


     <script type="text/javascript" src="js/jquery-3.2.1.min.js"></script>
     <script type="text/javascript" src="js/bootstrap.min.js"></script>
     <link href="css/bootstrap.min.css" rel="stylesheet">
     <link href="css/estilo.css" rel="stylesheet">
  </head>

  <body>
    <div class="container">
      <h1 class="jumbotron bg-info">Consulta de cliente</h1>
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
      include 'modelo/cliente.class.php';
      include 'dao/clientedao.class.php';

      $clienteDAO = new ClienteDAO();
      $array = $clienteDAO->buscarCliente();
      /*Só p teste
      var_dump($array);

      echo "<p>";
      foreach($array as $liv){
        echo "<hr>";
        echo "<br>".$liv;
      }
        echo "</p>";*/

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
              <th>CEP</th>
          </tr>
         </thead>
         <tfoot>

         </tfoot>

         <tbody>
           <?php
           foreach($array as $cliente){
             echo "<tr>";
             echo"<td>".$cliente->idCliente."</td>";
             echo "<td><a href='alterar-cliente.php?id=$cliente->idCliente'><img src='imagens/edit.png' alt='Editar'></a></td>";
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
    </div>
  </body>
</html>
