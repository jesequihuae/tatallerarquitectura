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
            // REGISTRA UN NUEVO PROYECTO
            if (isset($_POST) && isset($_POST['guardarProyecto'])){
              include_once '../../model/conexion.php';
              $ObjectArquitectura->insertProyecto($_POST);
            }
            // ELIMINA UN PROYECTO
            if(isset($_POST) && isset($_POST['eliminarProyecto'])){
              // print_r($_POST);
              include_once '../../model/conexion.php';
              $ObjectArquitectura->deleteProyecto($_POST);
            }
            //CAMBIAR idDestacado
            if(isset($_GET) && isset($_GET['idDestacado']) && isset($_GET['estado'])){
              // print_r($_GET);
              include_once '../../model/conexion.php';
              $ObjectArquitectura->setDestacadoProyecto($_GET);
            }            
                 
          ?>
          <form method="post" class="form-horizontal" >
              <div class="panel panel-default" style="margin:0% 20% 0% 20%;">
                <div class="panel-heading" style="background-color:white;">
                  <h4 class="panel-title" style="color:black;"><center>Registro de nuevo proyecto</center></h4>
                </div>
                <div class="panel-body">
                  <div class="form-group">
                    <label for="nombreProyecto" class="control-label col-md-4 col-lg-4">Nombre:</label>
                    <div class="col-md-8 col-lg-8">
                      <input type="text" class="form-control" name="nombreProyecto" style="color:black;" placeholder="Nombre del proyecto" required>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="idcategoria" class="control-label col-md-4 col-lg-4">Categoría:</label>
                    <div class="col-md-8 col-lg-8">
                      <select name="idCategoria" class="form-control" style="color:black;" >
                        <!--  OBTENER LAS CATEGORIAS REGISTRADAS-->
                        <?php
                           include_once '../../model/conexion.php';
                           $ObjectArquitectura->getSelectCategorias();
                        ?>
                      </select>
                    </div>                    
                  </div>
                  <div class="form-group">
                    <label for="descripcionProyecto" class="control-label col-md-4 col-lg-4">Descripción:</label>
                    <div class="col-md-8 col-lg-8">
                      <textarea name="descripcionProyecto" rows="3" class="form-control" style="color:black;" placeholder="Descripción del proyecto" required></textarea>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" align="center">
                      <button type="submit" name="guardarProyecto" class="btn btn-default">Registrar</button>
                      <a href="home.php" class="btn btn-primary">Ir a inicio</a>
                    </div>
                  </div>
                </div>
              </div>
            </form>
            <br><br>
            <h3><center>Categorías registradas</center></h3>
            <!-- VER CATEGORIAS -->
            <?php  
              include_once '../../model/conexion.php';
              $ObjectArquitectura->getPanelCategorias();
            ?>
           <!-- ............... -->
        </div>
        <!-- Page wrapper -->
    </div>
    <!-- /#wrapper -->
</body>
<script type="text/javascript"> 
  $(document).on('click','.categoria',function(){
    var id = $(this).data('id');
    $.ajax({
      type: 'post',
      url: '../../model/auxiliarProyectoByCategoria.php',
      data: {id: id},
      success: function(data){
        $('#resultado'+id).html(data);
        // console.log(data);
      }
    });

  });

  $(document).on('click','.eliminarProyecto',function(){
    var id = $(this).data('id').split("/");
    $("#id").val(id[0]);
    $("#nombreProyecto").html('¿Está seguro de eliminar a '+id[1]+'?');
    $("#idCategoria").val(id[2]);
    $("#nombreProyectoEliminar").val(id[1]);
  });
</script>
</html>
<!-- MODAL ELIMINAR PROYECTO -->
<?php require 'modalEliminarProyecto.php'; ?>
