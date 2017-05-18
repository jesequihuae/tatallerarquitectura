<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Home</title>
	
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
	<br><br><br>
	<!-- <div class="container-fluid"> -->
			<div id="carousel" class="carousel slide" data-ride="carousel">
				<!-- Contenedor -->
				<div class="carousel-inner" role="listbox">
					<div class="item active">
						<img src="../img/logo.jpg" class="img-responsive" width="1400" style="height:600px;">
					</div>
					<?php $ObjectArquitecturaCliente->obtenerDestacadosSlider(); ?>
				</div>
				<!-- Controles -->
				<a href="#carousel" class="left carousel-control" role="button" data-slide="prev">
					<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
				</a>
				<a href="#carousel" class="right carousel-control" role="button" data-slide="next">
					<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
				</a>

			</div>
		<!-- </div> -->
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 animated fadeInDownBig" style="padding-bottom:20px;">
			<h1>Proyectos destacados</h1>
			<p>El amor a la arquitectura es el que nos ha llevado a grandes cosas como lo es nuestro amor por el diseño.</p>
		</div>

		<div id="proyectosDestacados" class="col-lg-12 col-md-12 col-sm-12 col-xs-12 animated lightSpeedIn" style="padding-top:30px; paddin-bottom:30px;">
			<?php $ObjectArquitecturaCliente->proyectosDestacadosThumbnail(); ?>
		</div>
		
		<?php include '../mod/footer.php'; ?>

		<script src="../lib/js/jquery-1.10.2.min.js"></script>
		<script src="../lib/bootstrap/js/bootstrap.min.js"></script>
</body>
<script>
	$('.carousel').carousel({
	  interval: 3000
	})
</script>

</html>