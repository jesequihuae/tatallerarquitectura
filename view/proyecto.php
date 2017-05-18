<?php if(!isset($_GET['proyecto'])){ echo '<script language = javascript> self.location = javascript:history.back(-1);" </script>'; exit;} ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Proyecto</title>
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
	<?php @extract($ObjectArquitecturaCliente->obtenerProyectoById($_GET['proyecto'])); ?>
	<?php if(!isset($nombre)){ echo '<script language = javascript> self.location = javascript:history.back(-1);" </script>'; exit;} ?>
	<?php include('../mod/menuCliente.php'); ?>
	<br><br><br><br>
	
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 animated bounceInLeft">
		<h1><?php echo $nombre; ?></h1>
		<p><?php echo $descripcion; ?></p>
		<hr>
		<h2>Imagenes del proyecto:</h2>
	</div>
	
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 animated bounceInRight">
		<div id="carousel" class="carousel slide" data-ride="carousel">
		<!-- Contenedor -->
			<div class="carousel-inner" role="listbox">
				<div class="item active">
					<img src="../img/logo.jpg" class="img-responsive" width="1400" style="height:600px;">
				</div>
			<?php @$ObjectArquitecturaCliente->obtenerImagenesProyecto($id,$categoria,$nombre); ?>
			</div>
			<!-- Controles -->
			<a href="#carousel" class="left carousel-control" role="button" data-slide="prev">
			<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
			</a>
			<a href="#carousel" class="right carousel-control" role="button" data-slide="next">
			<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
			</a>
		</div>
	</div>

	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 animated bounceInLeft">
		<h2>Videos del proyecto:</h2>
		<?php $ObjectArquitecturaCliente->mostrarVideosProyecto($_GET['proyecto'])?>
	</div>

	<?php include '../mod/footer.php'; ?>
	<script src="../lib/js/jquery-1.10.2.min.js"></script>
	<script src="../lib/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>