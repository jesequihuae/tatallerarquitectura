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
    <style>
      /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
      #map {
        height: 300px;
      }
      /* Optional: Makes the sample page fill the window. */
      html, body {
        height: 100%;
        margin: 0;
        padding: 0;
      }
    </style>
</head>
<body>

    <div id="wrapper">
         <!-- Menu -->
         <?php include('../../mod/menuAdministrador.php'); ?>

        <?php 
          include_once '../../model/conexion.php';
          extract($ObjectArquitectura->getInformacionEmpresa());
        ?>
        <!-- Contenido -->
        <div id="page-wrapper"> 
            <br><br>   
            <?php 
              if(isset($_POST) && isset($_POST['guardar'])){ 
                $ObjectArquitectura->updateInformacionEmpresa($_POST); 
                extract($ObjectArquitectura->getInformacionEmpresa());
                // print_r($_POST); 
              }
            ?>            
            <h1 align="center">Edición de información de empresa</h1>
            <form method="post">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel-group">
                          <div class="panel panel-default">
                            <div class="panel-heading">
                              <h4 class="panel-title">
                                <div align="left" style="float:left;">Misión &nbsp;</div>
                                <div align="right"> <a data-toggle="collapse" href="#mision"><i>Abrir/Cerrar</i></a></div>
                              </h4>
                            </div>
                            <div id="mision" class="panel-collapse collapse">
                              <textarea class="form-control" rows="5" name="mision" style="color:black;" required><?php echo $mision; ?></textarea>
                            </div>
                          </div>
                        </div>
                    </div>
                </div>
                 <div class="row">
                    <div class="col-lg-12">
                        <div class="panel-group">
                          <div class="panel panel-default">
                            <div class="panel-heading">
                              <h4 class="panel-title">
                                <div align="left" style="float:left;">Visión &nbsp;</div>
                                <div align="right"><a data-toggle="collapse" href="#vision"><i>Abrir/Cerrar</i></a></div>
                              </h4>
                            </div>
                            <div id="vision" class="panel-collapse collapse">
                              <textarea class="form-control" rows="5" name="vision" style="color:black;" required><?php echo $vision; ?></textarea>
                            </div>
                          </div>
                        </div>
                    </div>
                </div>
                 <div class="row">
                    <div class="col-lg-12">
                        <div class="panel-group">
                          <div class="panel panel-default">
                            <div class="panel-heading">
                              <h4 class="panel-title">
                                <div align="left" style="float:left;">Valuación &nbsp;</div>
                                <div align="right"><a data-toggle="collapse" href="#valuacion"><i>Abrir/Cerrar</i></a></div>
                              </h4>
                            </div>
                            <div id="valuacion" class="panel-collapse collapse">
                              <textarea class="form-control" rows="5" name="valuacion" style="color:black;" required><?php echo $valuacion; ?></textarea>
                            </div>
                          </div>
                        </div>
                    </div>
                </div>
                 <div class="row">
                    <div class="col-lg-12">
                        <div class="panel-group">
                          <div class="panel panel-default">
                            <div class="panel-heading">
                              <h4 class="panel-title">
                                <div align="left" style="float:left;">Objetivo &nbsp;</div>
                                <div align="right"><a data-toggle="collapse" href="#objetivo"><i>Abrir/Cerrar</i></a></div>
                              </h4>
                            </div>
                            <div id="objetivo" class="panel-collapse collapse">
                              <textarea class="form-control" rows="5" name="objetivo" style="color:black;" required><?php echo $objetivo; ?></textarea>
                            </div>
                          </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                  <div class="col-lg-12">
                    <div class="panel-group">
                      <div class="panel panel-default">
                        <div class="panel-heading">
                          <h4 class="panel-title">
                               <div align="left" style="float:left;">Correo electrónico &nbsp;</div>  
                                <div align="right"><a data-toggle="collapse" href="#correoElectronico"><i>Abrir/Cerrar</i></a></div>
                          </h4>
                        </div>
                         <div id="correoElectronico" class="panel-collapse collapse">
                              <input type="text" class="form-control" value="<?php echo $correo_electronico; ?>" name="correo" style="color:black;" required/>
                         </div>
                      </div>
                   </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-lg-12">
                    <div class="panel-group">
                      <div class="panel panel-default">
                        <div class="panel-heading">
                          <h4 class="panel-title">
                              Ubicación - <font size="1">Arrastra el marcador </font>                             
                          </h4>
                        </div>
                        <input type="text" class="form-control" value="<?php echo $ubicacion; ?>" id="ubicacion" style="color:black;" disabled required/>
                        <input type="hidden" value="<?php echo $ubicacion; ?>" id="ubicacion2" name="ubicacion">
                      </div>
                   </div>
                  </div>
                  <div id="map" class="col-lg-12 col-md-12 col-sm-12 col-xs-12" ></div>
                </div>
                
                <br><br>
                <div class="row">
                    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6" align="right">
                        <button type="submit" class="btn btn-primary" name="guardar">&nbsp;&nbsp;Guardar&nbsp;&nbsp;</button>
                    </div>
                    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                        <a class="btn btn-default" href="home.php">&nbsp;&nbsp;Ir a inicio&nbsp;&nbsp;</a>
                    </div>
                </div>
            </form>
            
        </div>
        <!-- Page wrapper -->

    </div>
    <!-- /#wrapper -->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAtz9SW115grNslDMRoT2K8cLvdax2OUzU&callback=initMap"
    async defer></script>
</body>
<script>
      var ubicacion = document.getElementById("ubicacion").value.split(",");
      var ubicacionMarker = {lat: parseFloat(ubicacion[0]), lng: parseFloat(ubicacion[1])};
      var map;
      var marker;
      function initMap() {
        map = new google.maps.Map(document.getElementById('map'), {
          center: ubicacionMarker,
          zoom: 15
        });

        marker = new google.maps.Marker({
        map: map,
        draggable: true,
        animation: google.maps.Animation.DROP,
        position: ubicacionMarker,
        });

        marker.addListener('click', toggleBounce);
        marker.addListener( 'dragend', function (event)
        {
          //escribimos las coordenadas de la posicion actual del marcador dentro del input #coords
          document.getElementById("ubicacion").value = this.getPosition().lat()+","+ this.getPosition().lng();
          document.getElementById("ubicacion2").value = this.getPosition().lat()+","+ this.getPosition().lng();
        });
      }

      function toggleBounce() {
        if (marker.getAnimation() !== null) {
          marker.setAnimation(null);
        } else {
          marker.setAnimation(google.maps.Animation.BOUNCE);
        }
      }
</script>
</html>
