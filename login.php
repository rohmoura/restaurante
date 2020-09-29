<?php
session_start();
ob_start();
?>
<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <title>Página de login</title>
    <meta charset="utf-8">

    <!-- Bootstrap +
     JQuery (necessário para os plugins de Java do Bootstrap) -->
     <type="text/java" src="js/jquery-3.2.1.min.js"></>
     <type="text/java" src="js/bootstrap.min.js"></>
     <link href="css/bootstrap.min.css" rel="stylesheet">

     <!-- CSS padrão da página -->
     <link href="css/estilo.css" rel="stylesheet">
  </head>

  <body>
    <div class="container">

      <h1 class="jumbotron bg-info">Página de login</h1>

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
            <li><a href="login.php">Login</a></li>
          </ul>
        </nav>
      </div>
      <h2>Login</h2>
      <?php
      if(isset($_SESSION['msg'])){
        echo "<h3>";
        echo $_SESSION['msg'];
        echo "</h3>";
        unset($_SESSION['msg']);
      }//fecha
      ?>
      <form name="login" method="post" action="">
            <div class="form-group">
              <input type="text" name="txtlogin" placeholder="Login"
                     class="form-control">
            </div>
            <div class="form-group">
              <input type="text" name="txtsenha" placeholder="Senha"
                     class="form-control">
            </div>
            <div class="form-group">
              <label>Tipo</label>
              <select name="seltipo" class="form-control">
                <option value="adm">Administrador</option>
                <option value="cliente">Cliente</option>
              </select>
            </div>
            <div class="form-group">
              <input type="submit" name="logar" value="Logar"
                     class="btn btn-primary form-control">
            </div>
      </form>
      <?php
      if(isset($_POST['logar'])){
        include_once 'modelo/usuario.class.php';
        include_once 'dao/usuariodao.class.php';
        include_once 'util/seguranca.class.php';

        $u=new Usuario();
        $u->login=$_POST['txtlogin'];
        $u->senha=Seguranca::criptografar($_POST['txtsenha']);
        $u->tipo=$_POST['seltipo'];
        //echo $u; TESTE

        $uDAO = new UsuarioDAO();
        $usuario = $uDAO->verificarUsuario($u);
        var_dump($usuario);

        if($usuario && !is_null($usuario)){
          $_SESSION['privateUser']=serialize($usuario);
          header("location:index.php");
        }else{
          $_SESSION['msg'] = 'Dado(s) incorretos';
          header("location:login.php");
        }//fecha else

      }
       ?>
    </div>
  </body>
</html>
