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
            // REGISTRO DE CATEGORIA
            if(isset($_POST) && isset($_POST['guardarCategoria'])){
                include_once('../../model/conexion.php');
                $ObjectArquitectura->insertCategoria($_POST,$_FILES);
            }
            // ACTUALIZACION DE CATEGORIA
            if(isset($_POST) && isset($_POST['actualizarCategoria'])){
              include_once('../../model/conexion.php');
              $ObjectArquitectura->updateCategorias($_POST, $_FILES);
            }
            // ELIMINACION DE CATEGORIA
            if(isset($_POST) && isset($_POST['eliminarCategoria'])){
              include_once('../../model/conexion.php');
              $ObjectArquitectura->deleteCategoria($_POST);
            }
          ?> 
           <form method="post" class="form-horizontal" enctype="multipart/form-data">
              <div class="panel panel-default" style="margin:0% 20% 0% 20%;">
                <div class="panel-heading" style="background-color:white;">
                  <h4 class="panel-title" style="color:black;"><center>Registro de nueva categoría</center></h4>
                </div>
                <div class="panel-body">
                  <div class="form-group">
                    <label for="nombreCategoria" class="control-label col-md-4 col-lg-4">Nombre:</label>
                    <div class="col-md-8 col-lg-8">
                      <input type="text" class="form-control" name="nombreCategoria" style="color:black;" placeholder="Nombre de la categoría" required>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="descripcionCategoria" class="control-label col-md-4 col-lg-4">Descripción:</label>
                    <div class="col-md-8 col-lg-8">
                      <textarea name="descripcionCategoria" rows="3" class="form-control" style="color:black;" placeholder="Descripción de la categoría" required></textarea>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="imagenCategoria" class="control-label col-md-4 col-lg-4">Portada de categoría:</label>
                    <div class="col-md-8 col-lg-8">
                      <input type="file" name="imagenCategoria" required>
                      <p class="help-block">Elija una imagen para mostrar como perfil de categoría.</p>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6" align="right">
                      <button type="submit" name="guardarCategoria" class="btn btn-primary">Registrar</button>
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
                  <div align="left" style="float:left;">Categorías registradas</div>
                  <div align="right"> <a data-toggle="collapse" href="#miembros"><i>Abrir/Cerrar</i></a></div>
                </h4>
              </div>
              <div class="panel-body">
                <div id="miembros" class="panel-collapse collapse">
                <!-- Muestra las categorias registradas -->
                <?php 
                  include_once '../../model/conexion.php';
                  $ObjectArquitectura->getCategorias();
                ?>        
                </div>
              </div> 
            </div>
        </div>
        <!-- Page wrapper -->
    </div>
    <!-- /#wrapper -->
</body>
</html>
