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
    <!-- <link href="../../lib/fileinput.css" media="all" rel="stylesheet" type="text/css" /> -->
    <script type="text/javascript" src="../../lib/js/jquery-1.10.2.min.js"></script>
    <script type="text/javascript" src="../../lib/bootstrap/js/bootstrap.min.js"></script>
    <!--<script src="../../lib/fileinput.min.js" type="text/javascript"></script>-->
</head>
<body>

    <div id="wrapper">
        <!-- Menu -->
        <?php include('../../mod/menuAdministrador.php'); ?>

        <!-- Contenido -->
        <div id="page-wrapper">    
           <?php 
           // Obtener informacion de un proyecto en especifico
            if(isset($_GET) && isset($_GET['idVisualizar'])){
              include_once '../../model/conexion.php';
              extract($ObjectArquitectura->getProyectoData($_GET['idVisualizar']));
            }         
           //Actualizar información del proyecto
            if(isset($_POST) && isset($_POST['editarProyecto'])){
              include_once '../../model/conexion.php';
              $ObjectArquitectura->updateInformacionProyecto($_POST);
              extract($ObjectArquitectura->getProyectoData($_GET['idVisualizar']));
            } 
            // Subir fotografias a proyecto
            if(isset($_FILES) && isset($_POST['subirFotos'])){

              if(sizeof($_FILES['imagenesProyecto']['name'])>10){
                echo '<div class="alert alert-dismissable alert-warning">Por favor seleccione máximo 10 imagenes a la vez.
                        <button type="button" class="close" data-dismiss="alert">x</button>
                      </div>';
              }else{
                include_once '../../model/conexion.php';
                $ObjectArquitectura->subirFotografiasProyecto($_FILES['imagenesProyecto'], $_POST['idProyecto'], $_POST['idCategoria']);
              }
            }
            if(isset($_POST) && isset($_POST['video'])){
              include_once '../../model/conexion.php';
              $ObjectArquitectura->subirVideo($_POST['videoUrl'], $_POST['idProyecto']);
            }
            //Eliminar Imagen
            if(isset($_POST) && isset($_POST['deleteImagen'])){
              include_once '../../model/conexion.php';
              $ObjectArquitectura->deleteImagen($_POST['idImagen'],$nombre,$categoria_id);
            }
            //Eliminar video
            if(isset($_POST) && isset($_POST['deleteVideo'])){
              include_once '../../model/conexion.php';
              $ObjectArquitectura->deleteVideo($_POST['idVideo']);
            }
           ?>
           <h1 align="center">Edición del proyecto <?php echo $nombre; ?> &nbsp; <?php if($destacado == 1){ echo '<i class="fa fa-star" aria-hidden="true"></i>'; } ?></h1>
           <br>
           <form method="post">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <input type="hidden" name="nombreAnterior" value="<?php echo $nombre; ?>">
            <input type="hidden" name="idCategoria" value="<?php echo $categoria_id; ?>">
            <div class="row">
              <div class="col-lg-12">
                <div class="panel-group">
                  <div class="panel panel-default">
                    <div class="panel-heading">
                      <h4 class="panel-title">
                        <div align="left" style="float:left;">Editar información &nbsp;</div>
                        <div align="right"> <a data-toggle="collapse" href="#edicionInformacion"><i>Abrir/Cerrar</i></a></div>
                      </h4>
                    </div>
                    <div id="edicionInformacion" class="panel-collapse collapse">
                      <!-- Mostrar información de edicion -->
                      <br>
                        <div class="col-lg-6">
                          <div class="panel-group">
                            <div class="panel panel-primary">
                              <div class="panel-heading">
                                <h4 class="panel-title">
                                  <div align="left" style="float:left;">Nombre del proyecto &nbsp;</div>
                                <div align="right"> <a data-toggle="collapse" href="#nombre"><i style="color:white;">Abrir/Cerrar</i></a></div>
                                </h4>
                              </div>
                              <div id="nombre" class="panel-collapse collapse">
                                <textarea class="form-control" rows="1" name="nombre" required style="color:black;"><?php echo $nombre; ?></textarea>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="col-lg-6">
                          <div class="panel-group">
                            <div class="panel panel-primary">
                              <div class="panel-heading">
                                <h4 class="panel-title">
                                  <div align="left" style="float:left;">Descripción &nbsp;</div>
                                <div align="right"> <a data-toggle="collapse" href="#descripcion"><i style="color:white;">Abrir/Cerrar</i></a></div>
                                </h4>
                              </div>
                              <div id="descripcion" class="panel-collapse collapse">
                                <textarea class="form-control" rows="5" name="descripcion" required style="color:black;"><?php echo $descripcion; ?></textarea>
                              </div>
                            </div>
                          </div>
                        </div>
                      <div class="col-lg-12">
                        <center><button type="submit" class="btn btn-primary" name="editarProyecto">Actualizar información</button></center>
                      </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
           
           <hr>
          <!-- Subir Imagenes -->
           <div class="row">
              <div class="col-lg-12">
                <div class="panel-group">
                  <div class="panel panel-default">
                    <div class="panel-heading">
                      <h4 class="panel-title">
                        <div align="left" style="float:left;">Subir Fotografias&nbsp;</div>
                         <div align="right"> <a data-toggle="collapse" href="#subirFotos"><i>Abrir/Cerrar</i></a>
                          </div>
                      </h4>
                    </div>
                    <div id="subirFotos" class="panel-collapse collapse" align="center">
                      <form method="post" enctype="multipart/form-data" class="col-lg-12">
                        <input type="hidden" name="idProyecto" value="<?php echo $id; ?>">
                        <input type="hidden" name="idCategoria" value="<?php echo $categoria_id; ?>">
                        <div class="form-group">
                          <label for="imagenesProyecto" class="control-label">Seleccionar imagenes</label>
                          <input type="file" id="imagenesProyecto" name="imagenesProyecto[]" multiple required>
                          <p class="help-block">Seleccione las imagenes para este proyecto. <br>Seleccionar máximo 10 imagenes a la vez.</p>
                        </div>
                        <div class="col-lg-12"><center><input type="submit" class="btn btn-primary" name="subirFotos"></center></div>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
           </div>
          <hr>
          <!-- Subir Videos -->

          <!-- Ver Imagenes guardadas -->
           <div class="row">
                <div class="col-lg-12">
                  <div class="panel-group">
                    <div class="panel panel-default">
                      <div class="panel-heading">
                        <h4 class="panel-title">
                          <div align="left" style="float:left;">Ver fotografías registradas&nbsp;</div>
                           <div align="right"> <a data-toggle="collapse" href="#verFotos"><i>Abrir/Cerrar</i></a>
                            </div>
                        </h4>
                      </div>
                      <div id="verFotos" class="panel-collapse collapse" align="center">
                          <table class="table table-responsive" style="width:70%;">
                            <tr>
                              <th><center>Imagen</center></th>
                              <th><center>Operacion</center></th>
                            </tr>
                            <?php $ObjectArquitectura->obtenerImagenesByProyecto($_GET['idVisualizar'],$categoria_id,$nombre); ?>
                          </table>
                      </div>
                    </div>
                  </div>
                </div>
             </div>
             <hr>

             <!-- Subir Videos -->
             <div class="row">
                <div class="col-lg-12">
                  <div class="panel-group">
                    <div class="panel panel-default">
                      <div class="panel-heading">
                        <h4 class="panel-title">
                          <div align="left" style="float:left;">Subir Videos&nbsp;</div>
                           <div align="right"> <a data-toggle="collapse" href="#subirVideos"><i>Abrir/Cerrar</i></a>
                            </div>
                        </h4>
                      </div>
                      <div id="subirVideos" class="panel-collapse collapse" align="center">
                        <form action="" method="post">
                          <input type="hidden" name="idProyecto" value="<?php echo $id; ?>">
                          <input type="text" name="videoUrl" style="color:black;" class="form-control" placeholder="URL ej. http://www.youtube.com/watch?v=GMC2mxaU1os">
                           <center><button type="submit" class="btn btn-primary" name="video">Subir video</button></center>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
             </div>
             <hr>

              <!-- Ver videos registrados -->
             <div class="row">
                <div class="col-lg-12">
                  <div class="panel-group">
                    <div class="panel panel-default">
                      <div class="panel-heading">
                        <h4 class="panel-title">
                          <div align="left" style="float:left;">Ver videos registrados&nbsp;</div>
                           <div align="right"> <a data-toggle="collapse" href="#verVideos"><i>Abrir/Cerrar</i></a>
                            </div>
                        </h4>
                      </div>
                      <div id="verVideos" class="panel-collapse collapse" align="center">
                       <table class="table table-responsive" style="width:70%;">
                            <tr>
                              <th><center>Video</center></th>
                              <th><center>Operacion</center></th>
                            </tr>
                            <?php $ObjectArquitectura->obtenerVideosByProyecto($_GET['idVisualizar'],$categoria_id,$nombre); ?>
                          </table>
                      </div>
                    </div>
                  </div>
                </div>
             </div>

        </div>
        <!-- Page wrapper -->
    </div>
    <!-- /#wrapper -->
</body>
</html>
