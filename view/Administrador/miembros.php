<!DOCTYPE html>
<?php  @session_start(); if(!isset($_SESSION['tipo'])){ echo '<script language = javascript> self.location = "javascript:history.back(-1);" </script>'; exit;  } ?>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nosotros</title>

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
          // REGISTRA UN MIEMBRO NUEVO
          if(isset($_POST) && isset($_POST['guardar'])){
            include_once('../../model/conexion.php');
            $ObjectArquitectura->insertMiembro($_POST,$_FILES);
          }
          // ACTUALIZA INFORMACIÓN DE UN MIEMBRO REGISTRADO
          if(isset($_POST) && isset($_POST['actualizarMiembro'])){
            include_once('../../model/conexion.php');
            $ObjectArquitectura->updateMiembro($_POST,$_FILES);
          }
          // ELIMINA UN MIEMBRO POR ID
          if(isset($_POST) && isset($_POST['eliminarMiembro'])){
            include_once('../../model/conexion.php');
            $ObjectArquitectura->deleteMiembro($_POST['id']);
          }

        ?>
          <form method="post" class="form-horizontal" enctype="multipart/form-data">
            <div class="panel panel-default" style="margin:0% 20% 0% 20%;">
              <div class="panel-heading" style="background-color:white;">
                <h4 class="panel-title" style="color:black;"><center>Registro de nuevo miembro</center></h4>
              </div>
              <div class="panel-body">
                <div class="form-group">
                  <label for="nombre" class="control-label col-md-4 col-lg-4">Nombre:</label>
                  <div class="col-md-8 col-lg-8">
                    <input type="text" class="form-control" name="nombre" placeholder="Nombre completo" style="color:black;" required>
                  </div>
                </div>
                <div class="form-group">
                  <label for="nombre" class="control-label col-md-4 col-lg-4">Profesión:</label>
                  <div class="col-md-8 col-lg-8">
                    <input type="text" class="form-control" name="profesion" placeholder="Profesion" style="color:black;" required>
                  </div>
                </div>
                <div class="form-group">
                  <label for="nombre" class="control-label col-md-4 col-lg-4">Descripción:</label>
                  <div class="col-md-8 col-lg-8">
                    <textarea name="descripcion" rows="3" class="form-control" placeholder="Descripción" style="color:black;" required></textarea>
                  </div>
                </div>
                <div class="form-group">
                  <label for="imagenPerfil" class="control-label col-md-4 col-lg-4">Imagen de perfil:</label>
                  <div class="col-md-8 col-lg-8">
                    <input type="file" name="imagenPerfil" required>
                    <p class="help-block">Elija una imagen para mostrar como perfil.</p>
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
          <br><br>

          <div class="panel panel-default">
            <div class="panel-heading">
              <h4 class="panel-title">
                <div align="left" style="float:left;">Miembros registrados</div>
                <div align="right"> <a data-toggle="collapse" href="#miembros"><i>Abrir/Cerrar</i></a></div>
              </h4>
            </div>
            <div class="panel-body">
              <div id="miembros" class="panel-collapse collapse">
              <!-- Muestra los miembros registrados -->
              <?php 
                include_once '../../model/conexion.php';
                $ObjectArquitectura->getMiembros();
              ?>        
            </div>
          </div> 
        </div>
        <!-- Page wrapper -->
    </div>
    <!-- /#wrapper -->
</body>
</html>
