<!DOCTYPE html>
<?php  @session_start(); if(!isset($_SESSION['tipo']) || $_SESSION['tipo']!=0){ echo '<script language = javascript> self.location = "javascript:history.back(-1);" </script>'; exit;  } ?>
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
    <?php  include_once('../../model/conexion.php'); ?>
    <div id="wrapper">
        <!-- Menu -->
        <?php include('../../mod/menuAdministrador.php'); ?>
        
        <!-- Contenido -->
        <div id="page-wrapper">    
          <?php 
            // REGISTRAR UN NUEVO USUARIO
            if(isset($_POST) && isset($_POST['insertUsuario'])){
                // include_once('../../model/conexion.php');
                $ObjectArquitectura->insertUsuario($_POST);
              }
            // CAMBIA ESTADO DE USUARIO
            if(isset($_GET) && isset($_GET['id']) && isset($_GET['estado'])){
               // include_once('../../model/conexion.php');
               $ObjectArquitectura->setEstadoUsuario($_GET['id'],$_GET['estado']);
            }
            //ELIMINA UN USUARIO
            if(isset($_GET) && isset($_GET['idDelete'])){
              // include_once('../../model/conexion.php');
              $ObjectArquitectura->deleteUser($_GET['idDelete']);
            }
          ?>
          <div class="panel panel-primary" >
            <div class="panel-heading">
              <h3 class="panel-title" style="float:left;">Usuarios registrados</h3>
              <div align="right">
                 <a data-toggle="modal" href="#agregarUsuarioModal" style="color:white;">Agregar nuevo</a>
              </div>
            </div>
            <div class="panel-body">
              <!-- Tabla de usuarios registrados -->
             <!--  <center> -->
              <div class="table-responsive">
                <table class="table">
                  
                   <thead>
                      <tr>
                        <th><center>Nombre de usuario</center></th>
                        <th colspan="2"><center>Operación</center></th>
                        <th><center>Estado</center></th>
                      </tr>
                   </thead>
                   <!-- MUESTRA USUARIOS REGISTRADOS -->
                   <tbody>
                     <?php include_once('../../model/conexion.php'); $ObjectArquitectura->getUsuarios(); ?>
                   </tbody>
                   <!-- **************************** -->
                </table>              
              </div>
              <!-- </center>  -->
              <!--   -->
            </div>
          </div>
          <!-- MOSTRAR MODALES DE EDICION Y ELIMINACION -->
          <?php $ObjectArquitectura->showEditAndDeleteModal(); ?>
        </div>
        <!-- Page wrapper -->
        
         <!-- MODAL PARA AGREGAR UNA NUEVA RED SOCIAL -->
          <div class="modal fade" tabindex="-1" role="dialog" id="agregarUsuarioModal" data-backdrop="static">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <h3 class="modal-title"><center>Agregar nuevo usuario</center></h3>
                </div>
                <form method="post" class="form-horizontal">
                  <div class="modal-body">
                    <div class="form-group">
                      <label for="nombreUsuario" class="control-label col-lg-4">Nombre de usuario:</label>
                      <div class="col-lg-8">
                        <input type="text" name="nombreUsuario" class="form-control" style="color:black;" placeholder="Ingrese nombre de usuario" autofocus required>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="passwordUsuario" class="control-label col-lg-4">Contraseña:</label>
                      <div class="col-lg-8">
                        <input type="password" name="passwordUsuario" class="form-control" style="color:black;" placeholder="Ingrese contraseña"  required>
                      </div>
                    </div>
                  </div>
                <div class="modal-footer">
                  <button type="submit" class="btn btn-primary" name="insertUsuario">Agregar</button>
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
