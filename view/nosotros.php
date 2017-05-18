<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Nosotros</title>
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
	<?php extract($ObjectArquitecturaCliente->obtenerDatosEmpresa());?>
	<br><br><br><br>
	
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="padding-bottom:20px; background-color:white; color:black;">
		<h1>Nosotros</h1>
		<p>Somos un equipo que trabaja arduamente para ti, para ofrecerte solo lo mejor en arquitectura.</p>
	</div>

	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 animated bounceInLeft" style="padding-bottom:0px; background-color:white; color:black;">
		<font size="6">Misión</font>
		<p><?php echo $mision; ?></p>
	</div>
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 animated bounceInRight" style="padding-bottom:0px; background-color:white; color:black;">
		<font size="6">Visión</font>
		<p><?php echo $vision; ?></p>
	</div>
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 animated bounceInLeft" style="padding-bottom:0px; background-color:white; color:black;">
		<font size="6">Objetivo</font>
		<p><?php echo $objetivo; ?></p>
	</div>
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 animated bounceInRight" style="padding-bottom:0px; background-color:white; color:black;">
		<font size="6">Valuación</font>
		<p><?php echo $valuacion; ?></p>
	</div>

	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="padding:0px;">
		<img src="../img/building.jpg" width="100%" height="500" style="filter: grayscale(100%);">
	</div>

	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="padding-bottom:20px;">
		<hr>
		<h1>Conoce nuestro equipo</h1>
		<p>Nosotros somos:</p>
		<hr>
	</div>
	
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="padding-bottom:0px; background-color:white; color:black;">
		<?php $ObjectArquitecturaCliente->obtenerMiembros(); ?>
	</div>
	
	<?php include '../mod/footer.php'; ?>
	<script src="../lib/js/jquery-1.10.2.min.js"></script>
	<script src="../lib/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>