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
           <div class="row" >
                <div class="col-lg-3">
                  <a href="nosotros.php">
                  <div class="panel panel-primary">
                    <div class="panel-heading" style="padding-bottom:4px;">
                      <center><font size="7"><i class="fa fa-user-circle-o"></i></font></center>
                        <h3 class="panel-title" align="center">
                          Editar información
                        </h3>
                    </div>
                  </div>
                  </a>
                </div>
                <div class="col-lg-2">
                  <a href="miembros.php">
                  <div class="panel panel-primary">
                    <div class="panel-heading">
                      <center><font size="6"><i class="fa fa-users"></i></font></center>
                        <h3 class="panel-title" align="center">
                          Administrar miembros
                        </h3>
                    </div>
                  </div>
                  </a>
                </div>
                <?php if($_SESSION['tipo'] == 0) { ?>
                 <div class="col-lg-2">
                  <a href="usuarios.php">
                  <div class="panel panel-primary">
                    <div class="panel-heading">
                      <center><font size="6"><i class="fa fa-user"></i></font></center>
                        <h3 class="panel-title" align="center">
                          Administrar usuarios
                        </h3>
                    </div>
                  </div>
                  </a>
                </div>
                <?php } else { ?>
                 <div class="col-lg-2">
                  <a href="redessociales.php">
                  <div class="panel panel-primary">
                    <div class="panel-heading">
                      <center><font size="6"><i class="fa fa-facebook"></i></font></center>
                        <h3 class="panel-title" align="center">
                          Administrar redes sociales
                        </h3>
                    </div>
                  </div>
                  </a>
                </div>
                <?php } ?>
                <div class="col-lg-2">
                  <a href="categorias.php">
                  <div class="panel panel-primary">
                    <div class="panel-heading">
                      <center><font size="6"><i class="fa fa-archive"></i></font></center>
                        <h3 class="panel-title" align="center">
                          Administrar categorías
                        </h3>
                    </div>
                  </div>
                  </a>
                </div>
                <div class="col-lg-3">
                  <a href="proyectos.php">
                  <div class="panel panel-primary">
                    <div class="panel-heading" style="padding-bottom:5px;">
                      <center><font size="7"><i class="fa fa-briefcase"></i></font></center>
                        <h3 class="panel-title" align="center">
                          Administrar proyectos
                        </h3>
                    </div>
                  </div>
                  </a>
                </div>
           </div>
           <hr>
           <div class="row">
            <div class="col-lg-8">
              <div class="panel panel-default">
                <div class="panel-heading">
                  <h3 class="panel-title">Nosotros</h3>
                </div>
                <div class="panel-body">
                 <?php 
                      include_once '../../model/conexion.php';
                      $ObjectArquitectura->mostrarNosotros();
                  ?>
                </div>
              </div>
            </div>
            <div class="col-lg-4">
              <div class="panel panel-default">
                <div class="panel-heading">
                  <h3 class="panel-title">
                    <div align="left" style="float:left;">Proyectos destacados</div>
                    <div align="right"><a data-toggle="collapse" href="#ProyectosDestacados"><i>Abrir/Cerrar</i></a></div>
                  </h3>
                </div>
                <div class="panel-body">
                  <div id="ProyectosDestacados" class="panel-collapse collapse">
                    <?php 
                      include_once '../../model/conexion.php';
                      $ObjectArquitectura->mostrarProyectosDestacados();
                    ?>
                  </div>
                </div>
              </div>
            </div>             
           </div>
           <hr>

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
                  $ObjectArquitectura->getMiembrosResumen();
                ?>        
              </div>
            </div> 
          </div>

          <hr>
          
           
        </div>
        <!-- Page wrapper -->
    </div>
    <!-- /#wrapper -->
</body>
</html>
