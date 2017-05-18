<!DOCTYPE html>
<?php  @session_start(); if(!isset($_SESSION['tipo'])){ echo '<script language = javascript> self.location = "javascript:history.back(-1);" </script>'; exit;  } ?>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrador</title>

    <link rel="stylesheet" type="text/css" href="../../lib/bootstrap/css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="../../lib/font-awesome/css/font-awesome.min.css" />
    <link rel="stylesheet" type="text/css" href="../../lib/css/local.css" />

    <script type="text/javascript" src="../../lib/js/jquery-1.10.2.min.js"></script>
    <script type="text/javascript" src="../../lib/bootstrap/js/bootstrap.min.js"></script>
</head>
<body>

    <div id="wrapper">
        <!-- Menu -->
        <?php include('../../mod/menuAdministrador.php'); ?>

        <!-- Contenido -->
        <div id="page-wrapper">    
          <?php 
            if(isset($_POST) && isset($_POST['guardar'])){
              include_once('../../model/conexion.php');
              $ObjectArquitectura->modificarUsuario($_POST['id'],$_POST['usuario']);
            }
          ?>
          <form method="post" class="form-horizontal">
            <input type="hidden" name="id" value="<?php echo $_SESSION['id']; ?>">
            <div class="panel panel-default" style="margin:0% 20% 0% 20%;">
              <div class="panel-heading" style="background-color:white;">
                <h4 class="panel-title" style="color:black;"><center>Modificar nombre de usuario</center></h4>
              </div>
              <div class="panel-body">
                <div class="form-group">
                  <label for="nombre" class="control-label col-md-4 col-lg-4">Nuevo nombre de usuario :</label>
                  <div class="col-md-8 col-lg-8">
                    <input type="text" class="form-control" name="usuario" placeholder="Nuevo nombre de usuario" style="color:black;" required>
                  </div>
                </div>  
                <div class="row">
                  <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6" align="right">
                    <button type="submit" name="guardar" class="btn btn-primary">Registrar</button>
                  </div>
                  <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6" align="left">
                    <a href="home.php" class="btn btn-default">Ir a inicio</a>
                  </div>
                </div>
              </div>
            </div>
          </form>
           
        </div>
        <!-- Page wrapper -->
    </div>
    <!-- /#wrapper -->
</body>
</html>
