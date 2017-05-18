<?php 

class tallerarquitecturaCliente
{
	private $Conexion;
	public function __construct($ConexionBD)
	{
		$this->Conexion = $ConexionBD;
	}

	/* OBTENER PROYECTOS DESTACADOS - SLIDER */
	public function obtenerDestacadosSlider()
	{
		$destacado = '1';
		try {
			$SQLStatement = $this->Conexion->prepare("SELECT subcategoria.id, subcategoria.nombre, subcategoria.descripcion, categoria.nombre as categoria
													FROM subcategoria INNER JOIN categoria ON categoria.id = subcategoria.categoria_id
													WHERE subcategoria.destacado = :destacado");
			$SQLStatement->bindParam(":destacado",$destacado);
			$SQLStatement->execute();
			while($Proyecto = $SQLStatement->fetch(PDO::FETCH_ASSOC))
			{
				try {
					$SQLStatement2 = $this->Conexion->prepare("SELECT imagen FROM imagen_subcategoria WHERE subcategoria_id = :idProyecto ORDER BY RAND() LIMIT 1");
					$SQLStatement2->bindParam(":idProyecto",$Proyecto['id']);
					$SQLStatement2->execute();
					$ImagenAleatoria = $SQLStatement2->fetch(PDO::FETCH_ASSOC);
					echo '<div class="item">
							<img src="../img/categorias/'.$Proyecto['categoria'].'/'.$Proyecto['nombre'].'/'.$ImagenAleatoria['imagen'].'" class="img-responsive" width="1400" style="height:600px;">
						  </div>';
				} catch (PDOException $e) {
					echo $e->getMessage();
				}
			}
		} catch (PDOException $e) {
			echo $e->getMessage();
		}
	}

	/*Obtener imagenes para thumbnail proyectos destacados*/
	public function proyectosDestacadosThumbnail()
	{
		$destacado = '1';
		try {
			$SQLStatement = $this->Conexion->prepare("SELECT subcategoria.id, subcategoria.nombre, subcategoria.descripcion, categoria.nombre as categoria
													FROM subcategoria INNER JOIN categoria ON categoria.id = subcategoria.categoria_id
													WHERE subcategoria.destacado = :destacado");
			$SQLStatement->bindParam(":destacado",$destacado);
			$SQLStatement->execute();
			while($Proyecto = $SQLStatement->fetch(PDO::FETCH_ASSOC))
			{
				try {
					$SQLStatement2 = $this->Conexion->prepare("SELECT imagen FROM imagen_subcategoria WHERE subcategoria_id = :idProyecto ORDER BY RAND() LIMIT 1");
					$SQLStatement2->bindParam(":idProyecto",$Proyecto['id']);
					$SQLStatement2->execute();
					$ImagenAleatoria = $SQLStatement2->fetch(PDO::FETCH_ASSOC);
					echo '<div class="col-lg-4 col-md-4 col-sm-4">
							<a href="proyecto.php?proyecto='.$Proyecto['id'].'" target="_blank" class="thumbnail">
						    	<img class="ProyectoThumbnail" src="../img/categorias/'.$Proyecto['categoria'].'/'.$Proyecto['nombre'].'/'.$ImagenAleatoria['imagen'].'" alt="">
							</a>
							<h3 align="center">'.$Proyecto['nombre'].'</h3>
						  </div>';
				} catch (PDOException $e) {
					echo $e->getMessage();
				}
			}

		} catch (PDOException $e) {
			echo $e->getMessage();
		}
	}

	/*Obtener categorias*/
	public function obtenerCategorias()
	{
		try {
			$SQLStatement = $this->Conexion->prepare("SELECT * FROM categoria");
			$SQLStatement->execute();

			while($Categoria = $SQLStatement->fetch(PDO::FETCH_ASSOC))
			{
				echo '<div class="col-lg-4 col-md-4 col-sm-4 animated rotateIn">
						<a href="categoria.php?categoria='.$Categoria['id'].'" target="_blank" class="thumbnail">
						 <img class="ProyectoThumbnail" src="../img/categorias/'.$Categoria['nombre'].'/'.$Categoria['imagen'].'" >
						</a>
						<h3 align="center">'.$Categoria['nombre'].'</h3>
					  </div>';
			}

		} catch (PDOException $e) {
			echo $e->getMessage();
		}
	}

	/*Obtener redes sociales footer*/
	public function obtenerRedesSociales()
	{
		$id = 1;
		try {
			$SQLStatement = $this->Conexion->prepare("SELECT nombre, url FROM redsocial WHERE empresa_id = :id");
			$SQLStatement->bindParam(":id",$id);
			$SQLStatement->execute();

			while($Red = $SQLStatement->fetch(PDO::FETCH_ASSOC))
			{
				echo '<a href="http://'.$Red['url'].'" target="_blank" style="text-decoration:none; color:white;"><font size="4">'.$Red['nombre'].'</font></a>&nbsp;&nbsp;';
			}

		} catch (PDOException $e) {
			echo $e->getMessage();
		}
	}

	/*Obtener datos de la empresa*/
	public function obtenerDatosEmpresa()
	{
		try {
			$SQLStatement = $this->Conexion->query("SELECT * FROM empresa WHERE id=1");
			$Empresa = $SQLStatement->fetch(PDO::FETCH_ASSOC);
			return $Empresa;
		} catch (PDOException $e) {
			echo $e->getMessage();
		}
	}

	/*Obtener miembros del equipo*/
	public function obtenerMiembros()
	{	
		$auxiliar = 0;
		try {
			$SQLStatement = $this->Conexion->prepare("SELECT * FROM miembros WHERE empresa_id = 1");
			$SQLStatement->execute();

			while($Miembro = $SQLStatement->fetch(PDO::FETCH_ASSOC))
			{
				if(($auxiliar%2==0)==1){
				echo '<div class="row animated rotateInDownLeft">
						<div class="col-lg-5">
							<img src="../img/miembros/'.$Miembro['foto'].'" width="100%">
						</div>
						<div class="col-lg-7">
							<font size="5">'.$Miembro['nombreCompleto'].'</font><br>
							<font size="3">'.$Miembro['profesion'].'</font><br><br><br><br>
							<p>'.$Miembro['descripcion'].'</p>
						</div>
					  </div><hr>';
				}
				else{
					echo '<div class="row animated rotateInDownRight">
							<div class="col-lg-7" align="right">
								<font size="5">'.$Miembro['nombreCompleto'].'</font><br>
								<font size="3">'.$Miembro['profesion'].'</font><br><br><br><br>
								<p>'.$Miembro['descripcion'].'</p>
							</div>
							<div class="col-lg-5">
								<img src="../img/miembros/'.$Miembro['foto'].'" width="100%">
							</div>
						  </div><hr>';
				}
				$auxiliar++;				
			}
		} catch (PDOException $e) {
			echo $e->getMessage();
		}
	}

	/*Contácto*/
	public function contacto($nombre, $apellidos, $correo, $mensaje)
	{
		try {
			$SQLStatement = $this->Conexion->prepare("SELECT correo_electronico FROM empresa WHERE id = 1");
			$SQLStatement->execute();
			$CorreoPara = $SQLStatement->fetch(PDO::FETCH_ASSOC);

			$to = $CorreoPara['correo_electronico'];
			$asunto = htmlentities($nombre.' '.$apellidos);
			$msj = htmlentities($mensaje);
			if(@mail($to,$asunto,$correo,$msj)){
				echo '<div class="alert alert-dismissable alert-success">Correo electrónico enviado correctamente.
						<button type="button" class="close" data-dismiss="alert">x</button>
				  	 </div>';
			} 
			else{
				echo '<div class="alert alert-dismissable alert-danger">Ocurrió un error, intentelo nuevamente.
						<button type="button" class="close" data-dismiss="alert">x</button>
				  	 </div>';
			}
		} catch (PDOException $e) {
			echo $e->getMessage();
		}		
	}

	/*Obtener proyecto mediante id*/
	public function obtenerProyectoById($id)
	{
		try {
			$SQLStatement = $this->Conexion->prepare("SELECT subcategoria.id, subcategoria.nombre, subcategoria.descripcion, categoria.nombre as categoria
													FROM subcategoria INNER JOIN categoria ON categoria.id = subcategoria.categoria_id
													WHERE subcategoria.id = :id ");
			$SQLStatement->bindParam(":id",$id);
			$SQLStatement->execute();
			$Proyecto = $SQLStatement->fetch(PDO::FETCH_ASSOC);
			return $Proyecto;

		} catch (PDOException $e) {
			echo $e->getMessage();
		}
	}

	/*Obtener Imagenes de proyecto*/
	public function obtenerImagenesProyecto($id,$categoria,$proyecto)
	{
		try {
			$SQLStatement = $this->Conexion->prepare("SELECT imagen FROM imagen_subcategoria WHERE subcategoria_id = :id");
			$SQLStatement->bindParam(":id",$id);
			$SQLStatement->execute();

			while($Imagen = $SQLStatement->fetch(PDO::FETCH_ASSOC))
			{
				echo '<div class="item">
						<img src="../img/categorias/'.$categoria.'/'.$proyecto.'/'.$Imagen['imagen'].'" class="img-responsive" width="1400" style="height:600px;">
					  </div>';
			}

		} catch (PDOException $e) {
			echo $e->getMessage();
		}
	}

	/*Obtener Categoria by id*/
	public function obtenerCategoriaById($id)
	{
		try {
			$SQLStatement = $this->Conexion->prepare("SELECT * FROM categoria WHERE id = :id");
			$SQLStatement->bindParam(":id",$id);
			$SQLStatement->execute();
			$Categoria = $SQLStatement->fetch(PDO::FETCH_ASSOC);
			return $Categoria;
		} catch (PDOException $e) {
			echo $e->getMessage();
		}
	}

	/*Obtener proyectos por categoria*/
	public function proyectosByCategoria($id,$categoria)
	{
		try {
			$SQLStatement = $this->Conexion->prepare("SELECT * FROM subcategoria WHERE categoria_id = :idCategoria");
			$SQLStatement->bindParam(":idCategoria",$id);
			$SQLStatement->execute();
			while($Proyecto = $SQLStatement->fetch(PDO::FETCH_ASSOC))
			{
				try {
					$SQLStatement2 = $this->Conexion->prepare("SELECT imagen FROM imagen_subcategoria WHERE subcategoria_id = :idProyecto ORDER BY RAND() LIMIT 1");
					$SQLStatement2->bindParam(":idProyecto",$Proyecto['id']);
					$SQLStatement2->execute();
					$ImagenAleatoria = $SQLStatement2->fetch(PDO::FETCH_ASSOC);
					echo '<div class="col-lg-4 col-md-4 col-sm-4">
							<a href="proyecto.php?proyecto='.$Proyecto['id'].'" target="_blank" class="thumbnail">
						    	<img class="ProyectoThumbnail" src="../img/categorias/'.$categoria.'/'.$Proyecto['nombre'].'/'.$ImagenAleatoria['imagen'].'" alt="">
							</a>
							<h3 align="center">'.$Proyecto['nombre'].'</h3>
						  </div>';
				} catch (PDOException $e) {
					echo $e->getMessage();
				}
			}

		} catch (PDOException $e) {
			echo $e->getMessage();
		}
	}

	public function mostrarVideosProyecto($id)
	{
		try {
			$SQLStatement = $this->Conexion->prepare("SELECT * FROM video_subcategoria WHERE subcategoria_id = :id");
			$SQLStatement->bindParam(":id",$id);
			$SQLStatement->execute();

			while($video = $SQLStatement->fetch(PDO::FETCH_ASSOC))
			{
				echo '<div class="embed-responsive embed-responsive-16by9">
					  	<iframe class="embed-responsive-item" src="'.$video['video'].'"  frameborder="0" allowfullscreen></iframe>
					  </div><br>';
			}
		} catch (PDOException $e) {
			echo $e->getMessage();
		}
	}


}
?>