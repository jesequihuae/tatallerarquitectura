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
        <?php
         if(isset($_POST) && isset($_POST['insertRedSocial'])){
            include_once('../../model/conexion.php');
            $ObjectArquitectura->insertRedSocial($_POST);
          }
         if(isset($_POST) && isset($_POST['updateRedSocial'])){
            include_once('../../model/conexion.php');
            $ObjectArquitectura->updateRedSocial($_POST);
          }
         if(isset($_POST) && isset($_POST['eliminarRedSocial'])){
            include_once('../../model/conexion.php');
            $ObjectArquitectura->eliminarRedSocial($_POST['id']);
          }
        ?>
        <!-- Contenido -->
        <div id="page-wrapper">    
           <div class="row">
            <div class="col-lg-12">
               <div class="panel panel-default">
                 <div class="panel-heading">
                   <h4 class="panel-title">
                    <div align="left" style="float:left;">Redes Sociales registradas</div>
                    <div align="right" >
                      <a data-toggle="modal" href="#redSocialModal" style="color:white;">Agregar nueva</a>
                    </div>
                   </h4>
                   <div class="align"></div>
                 </div>
                 <div class="panel-body">
                  <!-- Mostrar redes sociales agregadas -->
                  <?php 
                  include_once('../../model/conexion.php');
                  $ObjectArquitectura->getRedSocial();
                  ?>
                 </div>
               </div>
            </div>
           </div>
        </div>
        <!-- Page wrapper -->
    <!-- MODAL PARA AGREGAR UNA NUEVA RED SOCIAL -->
      <div class="modal fade" tabindex="-1" role="dialog" id="redSocialModal" data-backdrop="static">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h3 class="modal-title"><center>Agregar red social</center></h3>
            </div>
            <form method="post" class="form-horizontal">
            <div class="modal-body">
              <div class="form-group">
                <label for="nombreRedSocial" class="control-label col-lg-4">Nombre:</label>
                <div class="col-lg-8">
                  <input type="text" name="nombreRedSocial" class="form-control" style="color:black;" placeholder="Ingrese nombre e.j. Facebook, Twitter" autofocus required>
                </div>
              </div>
              <div class="form-group">
                <label for="urlRedSocial" class="control-label col-lg-4">Dirección:</label>
                <div class="col-lg-8">
                  <input type="text" name="urlRedSocial" class="form-control" style="color:black;" placeholder="Ingrese URL e.j. www.facebook.com/tallerArquitectura" autofocus required>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-primary" name="insertRedSocial">Agregar</button>
              <button type="button" class="btn btn-default" data-dismiss="modal" aria-label="Close">Cancelar</button>
            </div>
            </form>
          </div><!-- modal-content -->
        </div><!-- modal-dialog -->
      </div><!-- modal -->
  <!-- TERMINA MODAL -->
    </div>
    <!-- /#wrapper -->

 
</body>
</html>
