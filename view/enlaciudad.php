<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Ubicación</title>
	<link rel="shortcut icon" href="../img/logo.ico">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<link rel="stylesheet" type="text/css" href="../lib/bootstrap/css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="../lib/font-awesome/css/font-awesome.min.css" />
	<!-- <link rel="stylesheet" href="../lib/css/bootstrap.min.css"> -->
	<link rel="stylesheet" href="../lib/css/animate.css">
	<link rel="stylesheet" href="../lib/css/estilosCliente.css">
	<style>
      #map {
        height: 80%;
      }
      html, body {
        height: 100%;
        margin: 0;
        padding: 0;
      }
    </style>
</head>
<body>
	<?php include_once '../model/conexionCliente.php'; ?>
	<?php include('../mod/menuCliente.php'); ?>
	<?php extract($ObjectArquitecturaCliente->obtenerDatosEmpresa());?>
	<br><br><br><br>

	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 animated rubberBand" style="padding-bottom:20px; background-color:white; color:black;">
		<h1>Encuentranos en la ciudad</h1>
		<p>Encuentranos en la dirección indicada por el marcador, navega por el mapa.</p>
	</div>
	<div id="map" class="col-lg-12 col-md-12 col-sm-12 col-xs-12" ></div>
    
	<input type="hidden" value="<?php echo $ubicacion; ?>" id="ubicacion">
	<?php include '../mod/footer.php'; ?>
	<script src="../lib/js/jquery-1.10.2.min.js"></script>
	<script src="../lib/bootstrap/js/bootstrap.min.js"></script>
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAtz9SW115grNslDMRoT2K8cLvdax2OUzU&callback=initMap"
    async defer></script>
</body>
<script>
	  var ubicacion = document.getElementById("ubicacion").value.split(",");
	  // console.log(ubicacion[0]);
	  var ubicacionMarker = {lat: parseFloat(ubicacion[0]), lng: parseFloat(ubicacion[1])};
	  // console.log(ubicacionMarker);
      var map;
      function initMap() {
        map = new google.maps.Map(document.getElementById('map'), {
          center: ubicacionMarker,
          zoom: 15
        });

        var marker = new google.maps.Marker({
		  position: ubicacionMarker,
		  animation: google.maps.Animation.BOUNCE,
		  map: map,
		  title:"!Aquí Estamos!",
		});
      }
</script>
</html>