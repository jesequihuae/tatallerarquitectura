<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Contácto</title>
	<link rel="shortcut icon" href="../img/logo.ico">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<link rel="stylesheet" type="text/css" href="../lib/bootstrap/css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="../lib/font-awesome/css/font-awesome.min.css" />
	<link rel="stylesheet" href="../lib/css/bootstrap.min.css">
	<link rel="stylesheet" href="../lib/css/animate.css">
	<link rel="stylesheet" href="../lib/css/estilosCliente.css">
</head>
<body>
	<?php include_once '../model/conexionCliente.php'; ?>
	<?php include('../mod/menuCliente.php'); ?>
	<br><br><br><br><br><br><br><br><br>
	
	<div class="col-lg-6 col-lg-offset-3 col-md-6 col-md-offset-3 col-sm-6 col-sm-offset-3 col-xs-12 animated bounceInDown">
		<center><font size="5">Contáctanos</font></center>
		<?php 
			#Enviar correo
			if(isset($_POST) && isset($_POST['contacto'])){
				$ObjectArquitecturaCliente->contacto($_POST['nombre'],$_POST['apellidos'],$_POST['email'],$_POST['mensaje']);
			}
		?>
		<hr>
		<form class="form-horizontal" method="post">
			<div class="form-group">
				 <div class="input-group">
		      <div class="input-group-addon"><i class="fa fa-user" aria-hidden="true"></i></div>
		      <input type="text" class="form-control" name="nombre" placeholder="Nombre" required autofocus>
		    </div>
			</div>
			<div class="form-group">
				 <div class="input-group">
		      <div class="input-group-addon"><i class="fa fa-user" aria-hidden="true"></i></div>
		      <input type="text" class="form-control" name="apellidos" placeholder="Apellidos" required>
		    </div>
			</div>
			<div class="form-group">
				 <div class="input-group">
		      <div class="input-group-addon"><i class="fa fa-envelope" aria-hidden="true"></i></div>
		      <input type="email" class="form-control" name="email" placeholder="Correo electrónico" required>
		    </div>
			</div>
			<div class="form-group">
				 <div class="input-group">
		      <div class="input-group-addon"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></div>
		      <textarea type="text" class="form-control" name="mensaje" placeholder="Escribe tu mensaje" required></textarea>
		    </div>
			</div>
			<center>
				<input type="submit" class="btn btn-primary btn-lg" name="contacto" value="Enviar">
			</center><br><br><br><br><br><br><br><br><br>
		</form>
	</div>

	<?php include '../mod/footer.php'; ?>
	<script src="../lib/js/jquery-1.10.2.min.js"></script>
	<script src="../lib/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>