<?php if(!isset($_GET['categoria'])){ echo '<script language = javascript> self.location = javascript:history.back(-1);" </script>'; exit;} ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Categoría</title>
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
	<?php @extract($ObjectArquitecturaCliente->obtenerCategoriaById($_GET['categoria'])); ?>
	<?php if(!isset($nombre)){ echo '<script language = javascript> self.location = javascript:history.back(-1);" </script>'; exit;} ?>
	<?php include('../mod/menuCliente.php'); ?>
	<br><br><br><br>
	
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 animated bounceInLeft">
		<h1><?php echo $nombre; ?></h1>
		<p><?php echo $descripcion; ?></p>
		<hr>
	</div>

	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<img src="../img/categorias/<?php echo $nombre; ?>/<?php echo $imagen; ?>" width="300" height="3000">
	</div>

	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 animated fadeInDownBig" style="padding-bottom:20px;">
		<h1>Dentro de esta categoría</h1>
		<p>Se encuentran los siguientes proyectos</p>
	</div>

	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 animated lightSpeedIn" style="padding-top:30px; paddin-bottom:30px;">
			<?php $ObjectArquitecturaCliente->proyectosByCategoria($_GET['categoria'],$nombre); ?>
	</div>

	<?php include '../mod/footer.php'; ?>
	<script src="../lib/js/jquery-1.10.2.min.js"></script>
	<script src="../lib/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>