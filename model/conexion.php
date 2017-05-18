<?php 
	try
	 {
		$handler = new PDO('mysql:host=127.0.0.1;dbname=tallerarquitectura','root',''); //Localhost
		// $handler = new PDO('mysql:host=127.0.0.1;dbname=u466558094_tarq','u466558094_arqui','jesus_321'); //Servidor
		$handler->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	 }
	catch(PDOException $e)
	 {
		echo $e->getMessage();
	 }

	include_once 'tallerarquitectura.class.php';
	$ObjectArquitectura = new tallerarquitectura($handler);
?>