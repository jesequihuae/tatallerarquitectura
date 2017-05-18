<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Arquitectura</title>
	<link rel="shortcut icon" href="../img/logo.ico">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<link rel="stylesheet" type="text/css" href="../lib/bootstrap/css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="../lib/font-awesome/css/font-awesome.min.css" />
	<!-- <link rel="stylesheet" href="../lib/css/bootstrap.min.css"> -->
	<link rel="stylesheet" href="../lib/css/animate.css">
	<link rel="stylesheet" href="../lib/css/estilosCliente.css">
</head>
<body>
	<?php include_once '../model/conexionCliente.php'; ?>
	<?php include('../mod/menuCliente.php'); ?>
	<br><br><br><br>
	
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 animated bounceInLeft">
		<h1>Categorías</h1>
		<p>Dentro de las categorías se pueden encontrar proyectos, los cuales pueden estar concluidos o en proceso.</p>
		<hr>
	</div>
	
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="paddin-bottom:30px;">
		<?php $ObjectArquitecturaCliente->obtenerCategorias(); ?>
		<hr>
	</div>

	<?php include '../mod/footer.php'; ?>
	<script src="../lib/js/jquery-1.10.2.min.js"></script>
	<script src="../lib/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>