<?php @session_start(); if(isset($_SESSION['nombre'])){ header('Location: home.php');}  ?>

<!DOCTYPE html>
<link rel="shorcut icon" href="img/brand.png" />
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../../lib/bootstrap/css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="../../lib/font-awesome/css/font-awesome.min.css" />
    <link rel="stylesheet" type="text/css" href="../../lib/css/local.css" />

    <script type="text/javascript" src="../../lib/js/jquery-1.10.2.min.js"></script>
    <script type="text/javascript" src="../../lib/bootstrap/js/bootstrap.min.js"></script>
    <style>
        body{
             background: url('../../img/background-login3.jpg') fixed;
             background-size: cover;
             padding: 0;
             margin: 0;
        }
    </style>
</head>
<body><br><br><br><br><br><br><br><br><br>
    <div class="container">
        <div class="row">  
            <?php 
                if(isset($_POST) && isset($_POST['login']))
                {
                  include_once '../../model/conexion.php';
                  $ObjectArquitectura->login($_POST['usuario'],$_POST['password']);
                }
            ?> 
            <div class="col-lg-4 col-lg-offset-4 col-md-4 col-md-offset-4 col-sm-12 col-xs-12">
                <h2><center>Log In</center></h2>
                
                <form class="form-horizontal" method="post">
                    <div class="form-group input-group">
                      <span class="input-group-addon"><i class="fa fa-user" aria-hidden="true"></i></span>
                      <input type="text" class="form-control" name="usuario" placeholder="Usuario">
                    </div>
                    <div class="form-group input-group">
                      <span class="input-group-addon"><i class="fa fa-lock" aria-hidden="true"></i></span>
                      <input type="password" class="form-control" name="password" placeholder="Contraseña">
                    </div>
                    <center>
                     <input type="submit" value="Iniciar Sesión" class="btn btn-primary" name="login" />
                    </center>
                </form>                  
            </div>                       
        </div>         
    </div>
</div>
</body>
</html>