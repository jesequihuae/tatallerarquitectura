<?php 
class tallerarquitectura
{
	private $Conexion;
	public function __construct($BD)
	{
		$this->Conexion = $BD;
	}

	/*LOGIN*/
	public function login($Usuario,$Contrasena)
	{
		try {
			$SQLStatement = $this->Conexion->prepare("SELECT * FROM usuario WHERE nombre = :nombre AND password = :password AND tipo != '2' ");
			$SQLStatement->bindParam(":nombre",$Usuario);
			$SQLStatement->bindParam(":password",$Contrasena);
			$SQLStatement->execute(); 
			if($SQLStatement->rowCount() > 0){
				 $tipoUsuario = $SQLStatement->fetch(PDO::FETCH_ASSOC);
				 @session_start();
				 $_SESSION['id'] = $tipoUsuario['id'];
				 $_SESSION['tipo'] = $tipoUsuario['tipo'];
				 $_SESSION['nombre'] = $tipoUsuario['nombre'];
 				 header('Location: home.php');
			}else{
				echo '<div class="alert alert-dismissable alert-danger">Lo sentimos, usuario y/o contraseña no coinciden!
						<button type="button" class="close" data-dismiss="alert">x</button>
				  	 </div>';
			}

		} catch (PDOException $e) {
			echo $e->getMessage();
		}
	}

	/*LOGOUT*/
	public function logout()
	{
		@session_start();
		session_unset($_SESSION['id']);
		session_unset($_SESSION['tipo']);
		session_unset($_SESSION['nombre']);
		session_destroy();
		header('Location: ../view/administrador/index.php');
	}

	/*Modificar usuario*/
	public function modificarUsuario($id,$usuario)
	{
		try {
			$SQLStatement = $this->Conexion->prepare("SELECT * FROM usuario WHERE nombre = :nombre");
			$SQLStatement->bindParam(":nombre",$usuario);
			$SQLStatement->execute();

			if($SQLStatement->rowCount() > 0){
				echo '<div class="alert alert-dismissable alert-warning">El nombre de usuario seleccionado ya existe.
						<button type="button" class="close" data-dismiss="alert">x</button>
					  </div>';
			} else {
				try {
					$SQLStatement2 = $this->Conexion->prepare("UPDATE usuario SET nombre = :usuario WHERE id = :id");
					$SQLStatement2->bindParam(":usuario",$usuario);
					$SQLStatement2->bindParam(":id",$id);
					$SQLStatement2->execute();
					echo '<div class="alert alert-dismissable alert-success">Modificación exitosa. El nombre de usuario mostrado cambiará cuando inicies sesión nuevamente.
							<button type="button" class="close" data-dismiss="alert">x</button>
						  </div>';
				} catch (PDOException $e) {
					echo '<div class="alert alert-dismissable alert-danger">Ocurrió un error, intentelo nuevamente.
							<button type="button" class="close" data-dismiss="alert">x</button>
						  </div>';
				}				
			}
		} catch (PDOException $e) {

			echo '<div class="alert alert-dismissable alert-danger">Ocurrió un error, intentelo nuevamente.
					<button type="button" class="close" data-dismiss="alert">x</button>
				  </div>';
		}
	}

	/*Modificar contraseña*/
	public function modificarPassword($idUsuario,$nueva,$nueva2)
	{
		if($nueva2 != $nueva){
			echo '<div class="alert alert-dismissable alert-warning">Contraseñas no coinciden
					<button type="button" class="close" data-dismiss="alert">x</button>
				  </div>';
		}
		else
		{
			try {
				$SQLStatement = $this->Conexion->prepare("UPDATE usuario SET password = :nueva WHERE id = :id");
				$SQLStatement->bindParam(":nueva",$nueva);
				$SQLStatement->bindParam(":id",$idUsuario);
				$SQLStatement->execute();
				echo '<div class="alert alert-dismissable alert-success">Contraseña modificada con éxito!
						<button type="button" class="close" data-dismiss="alert">x</button>
					  </div>';
			} catch (PDOException $e) {
				// echo $e->getMessage();
				echo '<div class="alert alert-dismissable alert-danger">Ocurrió un error, intentelo nuevamente.
					<button type="button" class="close" data-dismiss="alert">x</button>
				  </div>';
			}
		}
	}

	/*Obtiene toda la información de la empresa*/
	public function getInformacionEmpresa()
	{
		$SQLStatement = $this->Conexion->query("SELECT * FROM empresa WHERE id=1");
		$Empresa = $SQLStatement->fetch(PDO::FETCH_ASSOC);
		return $Empresa;
	} 

	/*PERMITE ACTUALIZAR LA INFORMACIÓN DE LA EMPRESA*/
	public function updateInformacionEmpresa($Datos)
	{
		try {
			$SQLStatement = $this->Conexion->prepare("UPDATE empresa SET mision = :Nmision, vision = :Nvision, valuacion = :Nvaluacion, objetivo = :Nobjetivo, correo_electronico = :Ncorreo, ubicacion = :ubicacion WHERE id = 1");
			$SQLStatement->bindParam(":Nmision",$Datos['mision']);
			$SQLStatement->bindParam(":Nvision",$Datos['vision']);
			$SQLStatement->bindParam(":Nvaluacion",$Datos['valuacion']);
			$SQLStatement->bindParam(":Nobjetivo",$Datos['objetivo']);
			$SQLStatement->bindParam(":Ncorreo",$Datos['correo']);
			$SQLStatement->bindParam(":ubicacion",$Datos['ubicacion']);
			$SQLStatement->execute();
			echo '<div class="alert alert-dismissable alert-success">Datos actualizados correctamente!
					<button type="button" class="close" data-dismiss="alert">x</button>
				  </div>';
		} catch (PDOException $e) {
			// echo $e->getMessage();
			echo '<div class="alert alert-dismissable alert-danger">Upss! Ocurrió un problema, intentelo más tarde!
					<button type="button" class="close" data-dismiss="alert">x</button>
				  </div>';
		}
	}

	/*PERMITE AGREGAR NUEVOS MIEMBROS*/
	public function insertMiembro($Informacion, $Imagen)
	{	
		$nombreImagen = uniqid().$Imagen['imagenPerfil']['name'];
		$rutaImagen = '../../img/miembros/'.$nombreImagen;
		try {
			$SQLStatement = $this->Conexion->prepare("INSERT INTO miembros (nombreCompleto,foto,profesion,descripcion,empresa_id) VALUES (:nombre,:foto,:profesion,:descripcion,1)");
			$SQLStatement->bindParam(":nombre",$Informacion['nombre']);
			$SQLStatement->bindParam(":foto",$nombreImagen);
			$SQLStatement->bindParam(":profesion",$Informacion['profesion']);
			$SQLStatement->bindParam(":descripcion",$Informacion['descripcion']);
			$SQLStatement->execute();
			move_uploaded_file($Imagen['imagenPerfil']['tmp_name'], $rutaImagen);
			echo '<div class="alert alert-dismissable alert-success">Miembro registrado exitosamente!
					<button type="button" class="close" data-dismiss="alert">x</button>
				  </div>';
		} catch (PDOException $e) {
			// echo $e->getMessage();
			echo '<div class="alert alert-dismissable alert-danger">Ups! Ocurrió un error, intentelo más tarde.
					<button type="button" class="close" data-dismiss="alert">x</button>
				  </div>';
		}
	}

	/* PERMITE VER LOS USUARIOS */
	public function getMiembros()
	{
		$SQLStatement = $this->Conexion->query("SELECT * FROM miembros");
		while($Miembro = $SQLStatement->fetch(PDO::FETCH_ASSOC))
		{
			echo '<div class="panel panel-primary">
		            <div class="panel-heading">
		              <h4 class="panel-title">
		                <div align="left" style="float:left;">'.$Miembro['nombreCompleto'].' &nbsp;</div>
		                <div align="right">
		                 <a data-toggle="collapse" href="#miembro'.$Miembro['id'].'"><i style="color:white;">Abrir/Cerrar</i></a>
						 | <a data-toggle="modal" href="#modal'.$Miembro['id'].'"><i style="color:white;">Editar</i></a>
		                 | <a data-toggle="modal" href="#eliminar'.$Miembro['id'].'"><i style="color:white;">Eliminar</i></a>
		                </div>
		              </h4>
		            </div>
		            <div class="panel-body">
		              <div id="miembro'.$Miembro['id'].'" class="panel-collapse collapse">
		                <div style="float:left; padding-right:10px;"><img width="250" height="250" src="../../img/miembros/'.$Miembro['foto'].'"></div>
		              	<div><strong>'.$Miembro['profesion'].'</strong></div><br>
		                '.$Miembro['descripcion'].'
		              </div>            
		            </div>
		          </div> ';

		     echo '<div class="modal fade" tabindex="-1" role="dialog" id="modal'.$Miembro['id'].'" data-backdrop="static">
					  <div class="modal-dialog" role="document">
					    <div class="modal-content">
					      <div class="modal-header">
					        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					        <h4 class="modal-title"><center>Editar información de <br>'.$Miembro['nombreCompleto'].'</center></h4>
					      </div>
					      <div class="modal-body">
					      	<form method="post" class="form-horizontal" enctype="multipart/form-data">
					      		<input type="hidden" name="id" value="'.$Miembro['id'].'">
					            <div class="form-group">
					              <label for="nombre" class="control-label col-md-4 col-lg-4">Nombre:</label>
					              <div class="col-md-8 col-lg-8">
					              <input type="text" class="form-control" name="nombre" placeholder="Nombre completo" style="color:black;" required value="'.$Miembro['nombreCompleto'].'">
					           	  </div>
					            </div>
					            <div class="form-group">
					              <label for="nombre" class="control-label col-md-4 col-lg-4">Profesión:</label>
					              <div class="col-md-8 col-lg-8">
					                 <input type="text" class="form-control" name="profesion" placeholder="Profesion" style="color:black;" required value="'.$Miembro['profesion'].'">
					              </div>
					            </div>
					            <div class="form-group">
					              <label for="nombre" class="control-label col-md-4 col-lg-4">Descripción:</label>
					              <div class="col-md-8 col-lg-8">
					                <textarea name="descripcion" rows="3" class="form-control" placeholder="Descripción" style="color:black;" required>'.$Miembro['descripcion'].'</textarea>
					              </div>
					            </div>
					            <div class="form-group">
					               <label for="imagenPerfil" class="control-label col-md-4 col-lg-4">Imagen de perfil:</label>
					               <div class="col-md-8 col-lg-8">
					               <input type="file" name="imagenPerfil">
					               <p class="help-block">Si no se elije una foto, se mostrará la que ya está registrada.</p>
					               </div>
					            </div>
						      </div>
						      <div class="modal-footer">
								<button type="submit" name="actualizarMiembro" class="btn btn-primary">Actualizar</button>
						        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
						      </div>
					      </form>
					    </div><!-- modal-content -->
					  </div><!-- modal-dialog -->
					</div><!-- modal -->';

			 echo '<div class="modal fade" tabindex="-1" role="dialog" id="eliminar'.$Miembro['id'].'" data-backdrop="static">
					  <div class="modal-dialog" role="document">
					    <div class="modal-content">
					      <div class="modal-header">
					        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					        <h3 class="modal-title"><center>Eliminar</center></h3>
					      </div>
					      <div class="modal-body">
					      	<h4 align="center">¿Está seguro de eliminar a '.$Miembro['nombreCompleto'].'?</h4>
					      </div>
					      <div class="modal-footer">
					      	<form method="post">
					      		<input type="hidden" name="id" value="'.$Miembro['id'].'">
								<button type="submit" name="eliminarMiembro" class="btn btn-primary">Eliminar</button>
						        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
					      	</form>
					      </div>
					    </div><!-- modal-content -->
					  </div><!-- modal-dialog -->
					</div><!-- modal -->';
		}
	}

	/*PERMITE ACTUALIZAR INFORMACIÓN DE UN MIEMBRO*/
	public function updateMiembro($Informacion, $Imagen)
	{
		$id = $Informacion['id'];
		$SelectFotografia = $this->Conexion->prepare("SELECT foto FROM miembros WHERE id = :id");
		$SelectFotografia->bindParam(":id",$id);
		$SelectFotografia->execute();
		$nombreImagen = $SelectFotografia->fetch(PDO::FETCH_ASSOC);

		if($Imagen['imagenPerfil']['name']!="")	
		{
			@unlink('../../img/miembros/'.$nombreImagen['foto']);
			$nuevaImagen = uniqid().$Imagen['imagenPerfil']['name'];
			$rutaImagen = '../../img/miembros/'.$nuevaImagen;
			move_uploaded_file($Imagen['imagenPerfil']['tmp_name'], $rutaImagen);
		}

		try {
			$SQLStatement = $this->Conexion->prepare("UPDATE miembros SET nombreCompleto = :nombre, foto = :foto, profesion = :profesion, descripcion = :descripcion WHERE id = :id");
			$SQLStatement->bindParam(":nombre",$Informacion['nombre']);
			if($Imagen['imagenPerfil']['name']==""){
				$SQLStatement->bindParam(":foto",$nombreImagen['foto']);
			}else {
				$SQLStatement->bindParam(":foto",$nuevaImagen);
			}
			$SQLStatement->bindParam(":profesion",$Informacion['profesion']);
			$SQLStatement->bindParam(":descripcion",$Informacion['descripcion']);
			$SQLStatement->bindParam(":id",$id);
			$SQLStatement->execute();
			echo '<div class="alert alert-dismissable alert-success">Miembro actualizado exitosamente!
					<button type="button" class="close" data-dismiss="alert">x</button>
				  </div>';
		} catch (PDOException $e) {
			// echo $e->getMessage();
			echo '<div class="alert alert-dismissable alert-danger">Ups! Ocurrió un error, intentelo más tarde.
					<button type="button" class="close" data-dismiss="alert">x</button>
				  </div>';
		}
		
	}

	/*PERMITE ELIMINAR UN MIEMBRO*/
	public function deleteMiembro($id)
	{
		try {
			$SQLStatement = $this->Conexion->prepare("DELETE FROM miembros WHERE id = :id");
			$SQLStatement->bindParam(":id",$id);
			$SQLStatement->execute();
			echo '<div class="alert alert-dismissable alert-success">Miembro eliminado exitosamente!
					<button type="button" class="close" data-dismiss="alert">x</button>
				  </div>';
		} catch (PDOException $e) {
			echo $e->getMessage();
			echo '<div class="alert alert-dismissable alert-danger">Ups! Ocurrió un error... Intentelo nuevamente.
					<button type="button" class="close" data-dismiss="alert">x</button>
				  </div>';
		}
	}

	/*PERMITE AGREGAR UNA NUEVA RED SOCIAL*/
	public function insertRedSocial($Informacion)
	{
		try {
			$SQLStatement = $this->Conexion->prepare("INSERT INTO redsocial (nombre,url,empresa_id) VALUES (:nombre,:url,1)");
			$SQLStatement->bindParam(":nombre",$Informacion['nombreRedSocial']);
			$SQLStatement->bindParam(":url",$Informacion['urlRedSocial']);
			$SQLStatement->execute();
			echo '<div class="alert alert-dismissable alert-success">Red social agregada exitosamente!
					<button type="button" class="close" data-dismiss="alert">x</button>
				  </div>';
		} catch (PDOException $e) {
			// echo $e->getMessage();
			echo '<div class="alert alert-dismissable alert-danger">Ups! Ocurrió un error... Intentelo más tarde!
					<button type="button" class="close" data-dismiss="alert">x</button>
				  </div>';
		}
	}
	
	/*OBTIENE LAS REDES SOCIALES REGISTRADAS*/
	public function getRedSocial()
	{
		$SQLStatement = $this->Conexion->query("SELECT * FROM redsocial");
		while($redSocial = $SQLStatement->fetch(PDO::FETCH_ASSOC))
		{
			echo '<div class="panel panel-primary">
                    <div class="panel-heading">
                      <div align="left" style="float:left;"><strong>'.$redSocial['nombre'].':</strong>&nbsp;&nbsp;&nbsp;&nbsp;'.$redSocial['url'].'</div>
                      <div align="right" >
                        <a data-toggle="modal" href="#editarRedSocial'.$redSocial['id'].'" style="color:white;">Editar</a>
                        | <a data-toggle="modal" href="#eliminarRedSocial'.$redSocial['id'].'" style="color:white;">Eliminar</a>
                      </div>
                    </div>
                  </div>';

            echo '<div class="modal fade" tabindex="-1" role="dialog" id="editarRedSocial'.$redSocial['id'].'" data-backdrop="static">
				    <div class="modal-dialog" role="document">
				      <div class="modal-content">
				        <div class="modal-header">
				          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				          <h3 class="modal-title"><center>Editar red social</center></h3>
				        </div>
				        <form method="post" class="form-horizontal">
				        <input type="hidden" name="id" value="'.$redSocial['id'].'">
				        <div class="modal-body">
				          <div class="form-group">
				            <label for="nombreRedSocial" class="control-label col-lg-4">Nombre:</label>
				            <div class="col-lg-8">
				              <input type="text" name="nombreRedSocial" class="form-control" style="color:black;" placeholder="Ingrese nombre e.j. Facebook, Twitter" value="'.$redSocial['nombre'].'" required>
				            </div>
				          </div>
				          <div class="form-group">
				            <label for="urlRedSocial" class="control-label col-lg-4">Dirección:</label>
				            <div class="col-lg-8">
				              <input type="text" name="urlRedSocial" class="form-control" style="color:black;" placeholder="Ingrese URL e.j. www.facebook.com/tallerArquitectura" value="'.$redSocial['url'].'" required>
				            </div>
				          </div>
				        </div>
				        <div class="modal-footer">
				          <button type="submit" class="btn btn-primary" name="updateRedSocial">Editar</button>
				          <button type="button" class="btn btn-default" data-dismiss="modal" aria-label="Close">Cancelar</button>
				        </div>
				        </form>
				      </div><!-- modal-content -->
				    </div><!-- modal-dialog -->
				  </div><!-- modal -->';
		
			echo '<div class="modal fade" tabindex="-1" role="dialog" id="eliminarRedSocial'.$redSocial['id'].'" data-backdrop="static">
					  <div class="modal-dialog" role="document">
					    <div class="modal-content">
					      <div class="modal-header">
					        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					        <h3 class="modal-title"><center>Eliminar</center></h3>
					      </div>
					      <div class="modal-body">
					      	<h4 align="center">¿Está seguro de eliminar la red social '.$redSocial['nombre'].'?</h4>
					      </div>
					      <div class="modal-footer">
					      	<form method="post">
					      		<input type="hidden" name="id" value="'.$redSocial['id'].'">
								<button type="submit" name="eliminarRedSocial" class="btn btn-primary">Eliminar</button>
						        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
					      	</form>
					      </div>
					    </div><!-- modal-content -->
					  </div><!-- modal-dialog -->
					</div><!-- modal -->';
		}
		
	}

	/*ACTUALIZA INFORMACION DE UNA RED SOCIAL*/
	public function updateRedSocial($Informacion)
	{
		try {
			$SQLStatement = $this->Conexion->prepare("UPDATE redsocial SET nombre = :nombre, url = :url WHERE id = :id");
			$SQLStatement->bindParam(":nombre",$Informacion['nombreRedSocial']);
			$SQLStatement->bindParam(":url",$Informacion['urlRedSocial']);
			$SQLStatement->bindParam(":id",$Informacion['id']);
			$SQLStatement->execute();
			echo '<div class="alert alert-dismissable alert-success">Red social actualizada exitosamente!
					<button type="button" class="close" data-dismiss="alert">x</button>
				  </div>';
		} catch (PDOException $e) {
			// echo $e->getMessage();
			echo '<div class="alert alert-dismissable alert-danger">Ups! Ocurrió un error... Intentelo más tarde!
					<button type="button" class="close" data-dismiss="alert">x</button>
				  </div>';
		}
	}

	/*ELIMINAR RED SOCIAL*/
	public function eliminarRedSocial($id)
	{
		try {
			$SQLStatement = $this->Conexion->prepare("DELETE FROM redsocial WHERE id = :id");
			$SQLStatement->bindParam(":id",$id);
			$SQLStatement->execute();
			echo '<div class="alert alert-dismissable alert-success">Red social eliminada exitosamente!
					<button type="button" class="close" data-dismiss="alert">x</button>
				  </div>';
		} catch (PDOException $e) {
			// echo $e->getMessage();
			echo '<div class="alert alert-dismissable alert-danger">Ups! Ocurrió un error... Intentelo nuevamente.
					<button type="button" class="close" data-dismiss="alert">x</button>
				  </div>';
		}
	}

	/*REGISTRAR UN USUARIO*/
	public function insertUsuario($Informacion)
	{
		$tipo = 1;
		try {
			$SQLStatement = $this->Conexion->prepare("INSERT INTO usuario (nombre,password,tipo) VALUES (:nombre,:password,:tipo)");
			$SQLStatement->bindParam(":nombre",$Informacion['nombreUsuario']);
			$SQLStatement->bindParam(":password",$Informacion['passwordUsuario']);
			$SQLStatement->bindParam(":tipo",$tipo);
			$SQLStatement->execute();
			echo '<div class="alert alert-dismissable alert-success">Usuario registrado correctamente!
					<button type="button" class="close" data-dismiss="alert">x</button>
				  </div>';
		} catch (PDOException $e) {
			// echo $e->getMessage();
			echo '<div class="alert alert-dismissable alert-danger">Ups! Ocurrió un error... Intentelo nuevamente.
					<button type="button" class="close" data-dismiss="alert">x</button>
				  </div>';
		}
	}

	/*OBTENER USUARIOS REGISTRADOS*/
	public function getUsuarios()
	{
		try {
			$SQLStatement = $this->Conexion->prepare("SELECT * FROM usuario WHERE tipo != 0");
			$SQLStatement->execute();
			while($Usuario = $SQLStatement->fetch(PDO::FETCH_ASSOC))
			{
				if($Usuario['tipo']==1){ $Estado = 'Activo'; $Tipo = 'success'; $OnOff = 'on'; } else { $Estado = 'Inactivo'; $Tipo = 'danger'; $OnOff = 'off';}
				 echo '<tr> 
						<td>'.$Usuario['nombre'].'</td>
						<!--<td><center><a data-toggle="modal" href="#editarUsuarioModal'.$Usuario['id'].'" style="color:white;" title="Editar"><i class="fa fa-pencil"></i></a></center></td>-->
						<td><center><a href="?id='.$Usuario['id'].'&estado='.$Usuario['tipo'].'" title="Cambiar estado"><i class="fa fa-toggle-'.$OnOff.' "></i></a></center></td>
						<td><center><a data-toggle="modal" href="#eliminarUsuarioModal'.$Usuario['id'].'" title="Eliminar"><i class="fa fa-times-circle"></i></a></center></td>
						<td><center><span class="label label-'.$Tipo.'">'.$Estado.'</span></center></td>
					  </tr>';
			}
		} catch (PDOException $e) {
			echo $e->getMessage();
		}
	}

	/*PUBLICA MODALES CON LOS ID PARA MODIFICAR Y ELIMINAR*/
	public function showEditAndDeleteModal()
	{
		try {
			$SQLStatement = $this->Conexion->prepare("SELECT * FROM usuario WHERE tipo != 0");
			$SQLStatement->execute();
			while($Usuario = $SQLStatement->fetch(PDO::FETCH_ASSOC))
			{

				// MODAL PARA ELIMINAR UN USUARIO
				echo '<div id="eliminarUsuarioModal'.$Usuario['id'].'" class="modal fade">
					    <div class="modal-dialog">
					        <div class="modal-content">
					            <div class="modal-header">
					                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					                <h3 class="modal-title"><center>Confirmación</center></h3>
					            </div>
					            <div class="modal-body">
					                <h2><center>¿Está seguro de eliminar al usuario '.$Usuario['nombre'].'?</center></p>
					            </div>
					            <div class="modal-footer">
					          		<a type="button" class="btn btn-primary" href="?idDelete='.$Usuario['id'].'">Eliminar</a>
					                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
					            </div>
					        </div>
					    </div>
					</div>';
			}
		} catch (PDOException $e) {
			echo $e->getMessage();
		}
	}

	/*CAMBIAR ESTADO DE USUARIO*/
	public function setEstadoUsuario($id,$Tipo)
	{
		if($Tipo==1){$Tipo = 2;} else if($Tipo==2){ $Tipo = 1; }
		try {
			$SQLStatement = $this->Conexion->prepare("UPDATE usuario SET tipo = :tipo WHERE id = :id");
			$SQLStatement->bindParam(":tipo",$Tipo);
			$SQLStatement->bindParam(":id",$id);
			$SQLStatement->execute();
		} catch (PDOException $e) {
			echo $e->getMessage();
		}
	}

	/* ELIMINAR USUARIO */
	public function deleteUser($id)
	{
		try {
			$SQLStatement = $this->Conexion->prepare("DELETE FROM usuario WHERE id = :id");
			$SQLStatement->bindParam(":id",$id);
			$SQLStatement->execute();
			echo '<div class="alert alert-dismissable alert-success">Usuario Eliminado correctamente!
					<button type="button" class="close" data-dismiss="alert">x</button>
				  </div>';
		} catch (PDOException $e) {
			// echo $e->getMessage();
			echo '<div class="alert alert-dismissable alert-danger">Ups! Ocurrió un error... Intentelo nuevamente.
					<button type="button" class="close" data-dismiss="alert">x</button>
				  </div>';
		}
	}

	/*MODIFICAR USUARIO*/
	/*FALTA ESTO DEL USUARIO*/

	/*REGISTRO DE CATEGORIA*/
	public function insertCategoria($Informacion,$Imagen)
	{
		if(file_exists('../../img/categorias/'.$Informacion['nombreCategoria'])){
			echo '<div class="alert alert-dismissable alert-danger">Ups! La categoria '.$Informacion['nombreCategoria'].' ya existe.
					<button type="button" class="close" data-dismiss="alert">x</button>
				  </div>';
		}
		else 
		{
			$nombreImagen = uniqid().$Imagen['imagenCategoria']['name'];
			mkdir('../../img/categorias/'.$Informacion['nombreCategoria']);
			$rutaImagen = '../../img/categorias/'.$Informacion['nombreCategoria'].'/'.$nombreImagen;
			try {
				$SQLStatement = $this->Conexion->prepare("INSERT INTO categoria (nombre,descripcion,imagen) VALUES (:nombre, :descripcion, :foto)");
				$SQLStatement->bindParam(":nombre",$Informacion['nombreCategoria']);
				$SQLStatement->bindParam(":descripcion",$Informacion['descripcionCategoria']);
				$SQLStatement->bindParam(":foto",$nombreImagen);
				$SQLStatement->execute();
				move_uploaded_file($Imagen['imagenCategoria']['tmp_name'], $rutaImagen);
				echo '<div class="alert alert-dismissable alert-success">Categoría registrada exitosamente!
						<button type="button" class="close" data-dismiss="alert">x</button>
					  </div>';
			} catch (PDOException $e) {
				// echo $e->getMessage();
				echo '<div class="alert alert-dismissable alert-danger">Ups! Ocurrió un error, intentelo más tarde.
						<button type="button" class="close" data-dismiss="alert">x</button>
					  </div>';
			}
		}
	}
	
	/*OBTENER INFORMACION DE LAS CATEGORIAS*/
	public function getCategorias()
	{
		$SQLStatement = $this->Conexion->query("SELECT * FROM categoria");
		while($Categoria = $SQLStatement->fetch(PDO::FETCH_ASSOC))
		{
			echo '<div class="panel panel-primary">
		            <div class="panel-heading">
		              <h4 class="panel-title">
		                <div align="left" style="float:left;">'.$Categoria['nombre'].' &nbsp;</div>
		                <div align="right">
		                 <a data-toggle="collapse" href="#categoria'.$Categoria['id'].'"><i style="color:white;">Abrir/Cerrar</i></a>
						 | <a data-toggle="modal" href="#modal'.$Categoria['id'].'"><i style="color:white;">Editar</i></a>
		                 | <a data-toggle="modal" href="#eliminar'.$Categoria['id'].'"><i style="color:white;">Eliminar</i></a>
		                </div>
		              </h4>
		            </div>
		            <div class="panel-body">
		              <div id="categoria'.$Categoria['id'].'" class="panel-collapse collapse">
		                <div style="float:left; padding-right:10px;"><img width="250" height="100%" src="../../img/categorias/'.$Categoria['nombre'].'/'.$Categoria['imagen'].'"></div>
		              	<div><strong>'.$Categoria['nombre'].'</strong></div><br>
		                '.$Categoria['descripcion'].'
		              </div>            
		            </div>
		          </div> ';

		     // EDICION
		     echo '<div class="modal fade" tabindex="-1" role="dialog" id="modal'.$Categoria['id'].'" data-backdrop="static">
					  <div class="modal-dialog" role="document">
					    <div class="modal-content">
					      <div class="modal-header">
					        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					        <h4 class="modal-title"><center>Editar la categoria <br>'.$Categoria['nombre'].'</center></h4>
					      </div>
					      <div class="modal-body">
					      	<form method="post" class="form-horizontal" enctype="multipart/form-data">
					      		<input type="hidden" name="id" value="'.$Categoria['id'].'">
					            <div class="form-group">
					              <label for="nombre" class="control-label col-md-4 col-lg-4">Nombre:</label>
					              <div class="col-md-8 col-lg-8">
					              <input type="text" class="form-control" name="nombreCategoria" placeholder="Nombre categoria" style="color:black;" required value="'.$Categoria['nombre'].'">
					           	  </div>
					            </div>
					            <div class="form-group">
					              <label for="nombre" class="control-label col-md-4 col-lg-4">Descripción:</label>
					              <div class="col-md-8 col-lg-8">
					                <textarea name="descripcionCategoria" rows="3" class="form-control" style="color:black;" placeholder="Descripción" required>'.$Categoria['descripcion'].'</textarea>
					              </div>
					            </div>
					            <div class="form-group">
					               <label for="imagenCategoria" class="control-label col-md-4 col-lg-4">Imagen de perfil:</label>
					               <div class="col-md-8 col-lg-8">
					               <input type="file" name="imagenCategoria">
					               <p class="help-block">Si no se elije una foto, se mostrará la que ya está registrada.</p>
					               </div>
					            </div>
						      </div>
						      <div class="modal-footer">
								<button type="submit" name="actualizarCategoria" class="btn btn-primary">Actualizar</button>
						        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
						      </div>
					      </form>
					    </div><!-- modal-content -->
					  </div><!-- modal-dialog -->
					</div><!-- modal -->';

			 //ELIMINACION
			 echo '<div class="modal fade" tabindex="-1" role="dialog" id="eliminar'.$Categoria['id'].'" data-backdrop="static">
					  <div class="modal-dialog" role="document">
					    <div class="modal-content">
					      <div class="modal-header">
					        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					        <h3 class="modal-title"><center>Eliminar</center></h3>
					      </div>
					      <div class="modal-body">
					      	<h4 align="center">¿Está seguro de eliminar a '.$Categoria['nombre'].'?</h4>
					      </div>
					      <div class="modal-footer">
					      	<form method="post">
					      		<input type="hidden" name="nombreCategoria" value="'.$Categoria['nombre'].'">
					      		<input type="hidden" name="id" value="'.$Categoria['id'].'">
								<button type="submit" name="eliminarCategoria" class="btn btn-primary">Eliminar</button>
						        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
					      	</form>
					      </div>
					    </div><!-- modal-content -->
					  </div><!-- modal-dialog -->
					</div><!-- modal -->';
		}
	}

	/*ACTUALIZAR INFORMACION DE LA CATEGORIA*/
	public function updateCategorias($Informacion, $Imagen)
	{
		$id = $Informacion['id'];
		$SelectFotografia = $this->Conexion->prepare("SELECT imagen, nombre FROM categoria WHERE id = :id");
		$SelectFotografia->bindParam(":id",$id);
		$SelectFotografia->execute();
		$nombreImagen = $SelectFotografia->fetch(PDO::FETCH_ASSOC);

		// if(file_exists('../../img/categorias/'.$Informacion['nombreCategoria'])){
		// 	echo '<div class="alert alert-dismissable alert-danger">Ups! La categoria '.$Informacion['nombreCategoria'].' ya existe.
		// 			<button type="button" class="close" data-dismiss="alert">x</button>
		// 		  </div>';
		// } 
		// else
		// {
			// SI NO MANDA IMAGEN SE GUARDA LA MISMA QUE YA TENIA Y SI LA MANDA SE REGISTRAN LOS DATOS NUEVOS Y SE BORRA LA FOTO ANTERIOR
			if($Imagen['imagenCategoria']['name']!="")	
			{
				@unlink('../../img/categorias/'.$Informacion['nombreCategoria'].'/'.$nombreImagen['imagen']);
				$nuevaImagen = uniqid().$Imagen['imagenCategoria']['name'];
				$rutaImagen = '../../img/categorias/'.$Informacion['nombreCategoria'].'/'.$nuevaImagen;
				move_uploaded_file($Imagen['imagenCategoria']['tmp_name'], $rutaImagen);
			}

			// SI EL NOMBRE CAMBIA SE CAMBIA LA CARPETA
			if($nombreImagen['nombre']!=$Informacion['nombreCategoria']){
				rename('../../img/categorias/'.$nombreImagen['nombre'],'../../img/categorias/'.$Informacion['nombreCategoria']);
			}

			try {
				$SQLStatement = $this->Conexion->prepare("UPDATE categoria SET nombre = :nombre, descripcion = :descripcion, imagen = :foto  WHERE id = :id");
				$SQLStatement->bindParam(":nombre",$Informacion['nombreCategoria']);
				if($Imagen['imagenCategoria']['name']==""){
					$SQLStatement->bindParam(":foto",$nombreImagen['imagen']);
				}else {
					$SQLStatement->bindParam(":foto",$nuevaImagen);
				}
				$SQLStatement->bindParam(":descripcion",$Informacion['descripcionCategoria']);
				$SQLStatement->bindParam(":id",$id);
				$SQLStatement->execute();
				echo '<div class="alert alert-dismissable alert-success">Categoría actualizada exitosamente!
						<button type="button" class="close" data-dismiss="alert">x</button>
					  </div>';
			} catch (PDOException $e) {
				echo $e->getMessage();
				echo '<div class="alert alert-dismissable alert-danger">Ups! Ocurrió un error, intentelo más tarde.
						<button type="button" class="close" data-dismiss="alert">x</button>
					  </div>';
			}
		// }
	}

	/*ELIMINAR UNA CATEGORIA*/
	public function deleteCategoria($Informacion)
	{
		try {
			$SQLStatement = $this->Conexion->prepare("DELETE FROM categoria WHERE id = :id");
			$SQLStatement->bindParam(":id",$Informacion['id']);
			$SQLStatement->execute();
			$this->deleteDir('../../img/categorias/'.$Informacion['nombreCategoria']);
			echo '<div class="alert alert-dismissable alert-success">Categoría eliminada exitosamente!
					<button type="button" class="close" data-dismiss="alert">x</button>
				  </div>';
		} catch (PDOException $e) {
			echo $e->getMessage();
				echo '<div class="alert alert-dismissable alert-danger">Ups! Ocurrió un error, intentelo más tarde.
						<button type="button" class="close" data-dismiss="alert">x</button>
					  </div>';
		}
	}

	/*FUNCION AUXILIAR PARA ELIMINAR UNA CARPETA Y SU CONTENIDO*/
	private function deleteDir($carpeta)
    {
      foreach(glob($carpeta . "/*") as $archivos_carpeta){             
        if (is_dir($archivos_carpeta)){
          rmDir_rf($archivos_carpeta);
        } else {
        @unlink($archivos_carpeta);
        }
      }
      @rmdir($carpeta);
    }

    /*MUESTRA UN SELECT CON LAS CATEGORIAS REGISTRADAS*/
    public function getSelectCategorias()
    {
    	try {
    		$SQLStatement = $this->Conexion->prepare("SELECT id,nombre FROM categoria");
    		$SQLStatement->execute();
    		while($Categoria = $SQLStatement->fetch(PDO::FETCH_ASSOC))
    		{
    			echo '<option value="'.$Categoria['id'].'">'.$Categoria['nombre'].'</option>';
    		}
    	} catch (PDOException $e) {
    		echo $e->getMessage();
    	}
    }

    /*REGISTRA UN NUEVO PROYECTO DENTRO DE UNA CATEGORIA*/
    public function insertProyecto($Informacion)
    {
    	$NombreCategoriaStatement = $this->Conexion->prepare("SELECT nombre FROM categoria WHERE id = :id");
    	$NombreCategoriaStatement->bindParam(":id",$Informacion['idCategoria']);
    	$NombreCategoriaStatement->execute();
    	$NombreCategoria = $NombreCategoriaStatement->fetch(PDO::FETCH_ASSOC);

    	if(file_exists('../../img/categorias/'.$NombreCategoria['nombre'].'/'.$Informacion['nombreProyecto'])){
			echo '<div class="alert alert-dismissable alert-danger">Ups! El proyecto '.$Informacion['nombreProyecto'].' ya existe.
					<button type="button" class="close" data-dismiss="alert">x</button>
				  </div>';
		}
		else
		{
			try {	
				$SQLStatement = $this->Conexion->prepare("INSERT INTO subcategoria (nombre,descripcion,destacado,categoria_id) VALUES (:nombre, :descripcion, :destacado, :categoria_id)");
	    		$SQLStatement->bindParam(":nombre",$Informacion['nombreProyecto']);
	    		$SQLStatement->bindParam(":descripcion",$Informacion['descripcionProyecto']);
	    		$Destacado = '0';
	    		$SQLStatement->bindParam(":destacado",$Destacado);
	    		$SQLStatement->bindParam(":categoria_id",$Informacion['idCategoria']);
	    		$SQLStatement->execute();

	    		mkdir('../../img/categorias/'.$NombreCategoria['nombre'].'/'.$Informacion['nombreProyecto']);
	    		echo '<div class="alert alert-dismissable alert-success">Proyecto registrado exitosamente!
						<button type="button" class="close" data-dismiss="alert">x</button>
				 	  </div>';
    		} catch (PDOException $e) {
    			echo $e->getMessage();
    			echo '<div class="alert alert-dismissable alert-danger">Ups! Ocurrió un error, intentelo más tarde.
						<button type="button" class="close" data-dismiss="alert">x</button>
				 	 </div>';
    		}
		}
    }

    /*VER CATEGORIAS EN FORMA DE PANEL*/
    public function getPanelCategorias()
    {
    	try {
    		$SQLStatement = $this->Conexion->prepare("SELECT id,nombre FROM categoria");
    		$SQLStatement->execute();
    		while ($Categoria = $SQLStatement->fetch(PDO::FETCH_ASSOC))
    		{
    			echo '<div class="row">
	                	<div class="col-lg-12">
	                   	<div class="panel panel-default">
	                     	<div class="panel-heading">
	                       	<h3 class="panel-title">
		                       	<div align="left" style="float:left;">'.$Categoria['nombre'].'</div>
		                 		<div align="right">
		                 			<a data-toggle="collapse" href="#categoria'.$Categoria['id'].'" data-id="'.$Categoria['id'].'" class="categoria">
		                 				<i>Abrir/Cerrar</i>
		                 			</a>
		                 		</div>
	                      	</h3>
	                      </div>
	                      <div class="panel-body">
	                      	<div id="categoria'.$Categoria['id'].'" class="panel-collapse collapse">
	                      		<div id="resultado'.$Categoria['id'].'"></div>
	                      	</div>
	                      </div>
	                    </div>
	                	</div>
	           		  </div>';
    		}
    	} catch (PDOException $e) {
    		echo $e->getMessage();
    	}
    }

    /*OBTENER */
    public function getProyectoById($id)
    {
    	try {
    		$SQLStatement = $this->Conexion->prepare("SELECT * FROM subcategoria WHERE categoria_id = :id");
    		$SQLStatement->bindParam(":id",$id);
    		$SQLStatement->execute();
    		while($Proyecto = $SQLStatement->fetch(PDO::FETCH_ASSOC))
    		{
    			if($Proyecto['destacado']=='1'){ $Estrella = 'star'; } else {$Estrella='star-o';}

    			echo '<!--<div class="row">-->
	                	<div class="col-lg-6">
	                   	<div class="panel panel-primary">
	                     	<div class="panel-heading">
	                       	<h3 class="panel-title">
	                       	<div align="left" style="float:left;">'.$Proyecto['nombre'].'</div>
	                 			<div align="right">
		                 			<a data-toggle="collapse" href="#proyecto'.$Proyecto['id'].'">
		                 				<i style="color:white;">Abrir/Cerrar</i>
		                 			</a> |
		                 			<a data-toggle="modal" href="#Modal" data-id=" '.$Proyecto['id'].'/'.$Proyecto['nombre'].'/'.$Proyecto['categoria_id'].'" class="eliminarProyecto"><i class="fa fa-times" style="color:white;" title="Eliminar"></i></a>
	                 				<!--<a href="editProyecto.php?id='.$Proyecto['id'].'" target="_blank"></a>-->
	                 				| <a href="?idDestacado='.$Proyecto['id'].'&estado='.$Proyecto['destacado'].'"><i class="fa fa-'.$Estrella.'" style="color:white;" title="Cambiar destacado"></i></a>
	                 			</div>
	                      	</h3>
	                      </div>
	                      <div class="panel-body">
	                      	<div id="proyecto'.$Proyecto['id'].'" class="panel-collapse collapse">
	                      		'.$Proyecto['descripcion'].'<br><br>
	                      		<center><a class="btn btn-primary" href="editProyecto.php?idVisualizar='.$Proyecto['id'].'" target="_blank"><i class="fa fa-pencil"></i> Editar proyecto</a></center>
	                      	</div>
	                      </div>
	                    </div>
	                	</div>
	           		  <!--</div>-->';
    		}
    	} catch (PDOException $e) {
    		echo $e->getMessage();
    	}
    }

    /*ELIMINAR PROYECTO*/
    public function deleteProyecto($Datos)
    {
    	try {
    		$SQLStatement2 = $this->Conexion->prepare("SELECT nombre FROM categoria WHERE id = :id");
    		$SQLStatement2->bindParam(":id",$Datos['idCategoria']);
    		$SQLStatement2->execute();
    		$nombreCategoria = $SQLStatement2->fetch(PDO::FETCH_ASSOC);

    		$SQLStatement = $this->Conexion->prepare("DELETE FROM subcategoria WHERE id = :idProyecto");
    		$SQLStatement->bindParam(":idProyecto",$Datos['id']);
    		$SQLStatement->execute();

    		$this->deleteDir('../../img/categorias/'.$nombreCategoria['nombre'].'/'.$Datos['nombreProyectoEliminar']);
    		echo '<div class="alert alert-dismissable alert-success">Proyecto eliminado exitosamente!
					<button type="button" class="close" data-dismiss="alert">x</button>
				  </div>';
    	} catch (PDOException $e) {
    		echo $e->getMessage();
    		echo '<div class="alert alert-dismissable alert-danger">Ups! Ocurrió un error, intentelo más tarde.
					<button type="button" class="close" data-dismiss="alert">x</button>
				  </div>';
    	}
    }

    /*OBTENER INFORMACIÓN DE UN PROYECTO EN ESPECIFICO*/
    public function getProyectoData($id)
    {
    	try {
    		$SQLStatement = $this->Conexion->prepare("SELECT * FROM subcategoria WHERE id = :id");
    		$SQLStatement->bindParam(":id",$id);
    		$SQLStatement->execute();
    		return $SQLStatement->fetch(PDO::FETCH_ASSOC);
    	} catch (PDOException $e) {
    		echo $e->getMessage();
    	}
    }

    /*CAMBIAR DESTACADO DE PROYECTO*/
    public function setDestacadoProyecto($Informacion)
    {
    	if($Informacion['estado']=='1'){$Estado = '0';} else {$Estado = '1';}

    	try {
    		$SQLStatement = $this->Conexion->prepare("UPDATE subcategoria SET destacado = :estado WHERE id = :id");
    		$SQLStatement->bindParam(":estado",$Estado);
    		$SQLStatement->bindParam(":id",$Informacion['idDestacado']);
    		$SQLStatement->execute();
    		echo '<div class="alert alert-dismissable alert-success">Destacado cambiado exitosamente!
					<button type="button" class="close" data-dismiss="alert">x</button>
				  </div>';
    	} catch (PDOException $e) {
    		echo $e->getMessage();
    		echo '<div class="alert alert-dismissable alert-danger">Ups! Ocurrió un error, intentelo más tarde.
					<button type="button" class="close" data-dismiss="alert">x</button>
				  </div>';
    	}
    }

    /*EDITAR INFORMACIÓN DEL PROYECTO*/
    public function updateInformacionProyecto($Informacion)
    {
    	try {
    		$SQLStatement = $this->Conexion->prepare("UPDATE subcategoria SET nombre = :nombre, descripcion = :descripcion WHERE id = :id");
    		$SQLStatement->bindParam(":nombre",$Informacion['nombre']);
    		$SQLStatement->bindParam(":descripcion",$Informacion['descripcion']);
    		$SQLStatement->bindParam(":id",$Informacion['id']);
    		$SQLStatement->execute();


    		$SQLStatement2 = $this->Conexion->prepare("SELECT nombre FROM categoria WHERE id = :idCategoria");
    		$SQLStatement2->bindParam(":idCategoria",$Informacion['idCategoria']);
    		$SQLStatement2->execute();
    		$nombreCategoria = $SQLStatement2->fetch(PDO::FETCH_ASSOC);

    		rename('../../img/categorias/'.$nombreCategoria['nombre'].'/'.$Informacion['nombreAnterior'],'../../img/categorias/'.$nombreCategoria['nombre'].'/'.$Informacion['nombre']);
    		echo '<div class="alert alert-dismissable alert-success">Información Actualizada exitosamente!
					<button type="button" class="close" data-dismiss="alert">x</button>
				  </div>';
    	} catch (PDOException $e) {
    		echo $e->getMessage();
    		echo '<div class="alert alert-dismissable alert-danger">Ups! Ocurrió un error, intentelo más tarde.
					<button type="button" class="close" data-dismiss="alert">x</button>
				  </div>';
    	}
    }

    /*SUBIR FOTOGRAFIAS AL PROYECTO*/
    public function subirFotografiasProyecto($Imagenes,$idProyecto,$idCategoria)
    {
    	try {
    		$SQLStatementCategoria = $this->Conexion->prepare("SELECT nombre FROM categoria WHERE id = :id");
    		$SQLStatementCategoria->bindParam(":id",$idCategoria);
    		$SQLStatementCategoria->execute();
    		$nombreCategoria = $SQLStatementCategoria->fetch(PDO::FETCH_ASSOC);

    		$SQLStatementProyecto = $this->Conexion->prepare("SELECT nombre FROM subcategoria WHERE id = :id");
    		$SQLStatementProyecto->bindParam(":id",$idProyecto);
    		$SQLStatementProyecto->execute();
    		$nombreProyecto = $SQLStatementProyecto->fetch(PDO::FETCH_ASSOC);

    	} catch (PDOException $e) {
    		echo $e->getMessage();	
    	}

    	// echo 'Categoría : '.$nombreCategoria['nombre']; echo '<br>';
    	// echo 'Proyecto : '.$nombreProyecto['nombre']; echo '<br>';

		$rutaImagen = '../../img/categorias/'.$nombreCategoria['nombre'].'/'.$nombreProyecto['nombre'];
		
    	for ($i=0; $i < sizeof($Imagenes['name']); $i++)
    	{ 
    		// echo $Imagenes['name'][$i].' '.$Imagenes['tmp_name'][$i].'<br>';
    		$nombreImagen = uniqid().$Imagenes['name'][$i];
    		try {
    			$SQLStatement = $this->Conexion->prepare("INSERT INTO imagen_subcategoria (imagen, subcategoria_id) VALUES (:imagen,:idSubcategoria)");
    			$SQLStatement->bindParam(":imagen",$nombreImagen);
    			$SQLStatement->bindParam(":idSubcategoria",$idProyecto);
    			$SQLStatement->execute();
    			move_uploaded_file($Imagenes['tmp_name'][$i], $rutaImagen.'/'.$nombreImagen);
    		} catch (PDOException $e) {
    			echo $e->getMessage();
    		}    		
    	}

    	echo '<div class="alert alert-dismissable alert-success">Imagenes subidas exitosamente!
				<button type="button" class="close" data-dismiss="alert">x</button>
			  </div>';
    }

    /*Obtener imagenes guardadas por proyecto*/
	public function obtenerImagenesByProyecto($idProyecto,$idCategoria,$Proyecto)
	{
		try {
			$SQLStatement2 = $this->Conexion->prepare("SELECT * FROM categoria WHERE id = :idCat");
			$SQLStatement2->bindParam(":idCat",$idCategoria);
			$SQLStatement2->execute();
			$nombreCategoria = $SQLStatement2->fetch(PDO::FETCH_ASSOC);

			$SQLStatement = $this->Conexion->prepare("SELECT * FROM imagen_subcategoria WHERE subcategoria_id = :id");
			$SQLStatement->bindParam(":id",$idProyecto);
			$SQLStatement->execute();

			while($Imagen = $SQLStatement->fetch(PDO::FETCH_ASSOC))
			{
				echo '<tr>
						<td><center><img src="../../img/categorias/'.$nombreCategoria['nombre'].'/'.$Proyecto.'/'.$Imagen['imagen'].'" width="100" height="100"></center></td>
					  	<td>
					  	<form method="post">
					  		<input type="hidden" name="idImagen" value="'.$Imagen['id'].'"/>
					  		<!--<a href="?idVisualizar='.$idProyecto.'" title="Eliminar">
					  			<center><font size="7"><i class="fa fa-trash" aria-hidden="true"></i></font></center>
					  		</a>-->
					  		<center><button type="submit" style="background-color: transparent" name="deleteImagen"><font size="7"><i class="fa fa-trash" aria-hidden="true"></i></font></button></center>
					  	</form>
					  	</td>
					  </tr>';
			}

		} catch (PDOException $e) {
			echo $e->getMessage();
		}
	}

	/*Eliminar fotografia*/
	public function deleteImagen($id,$nombreProyecto,$idCategoria)
	{
		$SQLStatement2 = $this->Conexion->prepare("SELECT nombre FROM categoria WHERE id = :idCat");
		$SQLStatement2->bindParam(":idCat",$idCategoria);
		$SQLStatement2->execute();

		$nombreCategoria = $SQLStatement2->fetch(PDO::FETCH_ASSOC);

		$SQLStatement3 = $this->Conexion->prepare("SELECT imagen FROM imagen_subcategoria WHERE id = :idImagen");
		$SQLStatement3->bindParam(":idImagen",$id);
		$SQLStatement3->execute();

		$imagen  = $SQLStatement3->fetch(PDO::FETCH_ASSOC);

		try {
			$SQLStatement = $this->Conexion->prepare("DELETE FROM imagen_subcategoria WHERE id = :id");
			$SQLStatement->bindParam(":id",$id);
			$SQLStatement->execute();
			@unlink('../../img/categorias/'.$nombreCategoria['nombre'].'/'.$nombreProyecto.'/'.$imagen['imagen']);

			echo '<div class="alert alert-dismissable alert-success">Imagen eliminada exitosamente!
					<button type="button" class="close" data-dismiss="alert">x</button>
				  </div>';
		} catch (PDOException $e) {
			// echo $e->getMessage();
			echo '<div class="alert alert-dismissable alert-danger">Ocurrió un error eliminando la imagen, intentelo de nuevo.
					<button type="button" class="close" data-dismiss="alert">x</button>
				  </div>';
		}
	}

	/*Subir Video a proyecto*/
	public function subirVideo($video,$idProyecto)
	{
		//https://www.youtube.com/embed/MRhrQ3f7-dw
		//https://www.youtube.com/watch?v=cehYqMXavhk
		$video = str_replace('watch?v=','embed/', $video);

		if(strpos($video, 'https://') === 0 || strpos($video, 'http://') === 0){}
		else { $video = 'https://'.$video;	}

		try {
    		$SQLStatement = $this->Conexion->prepare("INSERT INTO video_subcategoria(video,subcategoria_id) VALUES (:video,:proyecto)");
    		$SQLStatement->bindParam(":video",$video);
    		$SQLStatement->bindParam(":proyecto",$idProyecto);
    		$SQLStatement->execute();

    		echo '<div class="alert alert-dismissable alert-success">Video subido exitosamente!
					<button type="button" class="close" data-dismiss="alert">x</button>
				  </div>';

    	} catch (PDOException $e) {
    		// echo $e->getMessage();	
    		echo '<div class="alert alert-dismissable alert-danger">Ocurrió un error intentelo de nuevo.
					<button type="button" class="close" data-dismiss="alert">x</button>
				  </div>';
    	}
	}

	/*Eliminar video*/
	public function deleteVideo($id)
	{
		try {
			$SQLStatement = $this->Conexion->prepare("DELETE FROM video_subcategoria WHERE id = :id");
			$SQLStatement->bindParam(":id",$id);
			$SQLStatement->execute();
			echo '<div class="alert alert-dismissable alert-success">video eliminado exitosamente!
					<button type="button" class="close" data-dismiss="alert">x</button>
				  </div>';
		} catch (PDOException $e) {
			// echo $e->getMessage();
			echo '<div class="alert alert-dismissable alert-danger">Ocurrió un error eliminando el video, intentelo de nuevo.
					<button type="button" class="close" data-dismiss="alert">x</button>
				  </div>';
		}
	}


	public function obtenerVideosByProyecto($id)
	{
		$SQLStatement = $this->Conexion->prepare("SELECT * FROM video_subcategoria WHERE subcategoria_id = :id");
		$SQLStatement->bindParam(":id",$id);
		$SQLStatement->execute();

		while($video = $SQLStatement->fetch(PDO::FETCH_ASSOC))
		{
			echo '<tr>
					<td>
						<center>
						  	 <iframe class="embed-responsive-item" src="'.$video['video'].'"  frameborder="0" allowfullscreen></iframe>
						</center>
				  	<td>
				  	<form method="post">
				  		<input type="hidden" name="idVideo" value="'.$video['id'].'"/>
				  		<center><button type="submit" style="background-color: transparent" name="deleteVideo"><font size="7"><i class="fa fa-trash" aria-hidden="true"></i></font></button></center>
				  	</form>
				  	</td>
				  </tr>';
		}
	}

    /**************INFORMACION DE LA PESTAÑA RESUMEN****************/

    public function mostrarProyectosDestacados()
    {
    	$numeroDestacado = '1';
    	// $auxiliarRow = 0;
    	// $limite = 2;
    	try {
		  $SQLStatement = $this->Conexion->prepare("SELECT * FROM subcategoria WHERE destacado = :numero");
		  $SQLStatement->bindParam(":numero",$numeroDestacado);
		  $SQLStatement->execute();
		  while($Proyecto = $SQLStatement->fetch(PDO::FETCH_ASSOC))
		  {
		  	// if ($auxiliarRow % $limite == 0){ echo '<div class="row">'; 	}
		  	// echo '<div class="row">';
		  	echo '<div class="panel panel-primary">
					<div class="panel-heading">
						<h4 class="panel-title">
							<div align="left" style="float:left;">'.$Proyecto['nombre'].'</div>
							<div align="right">
							 <a data-toggle="collapse" href="#Proyecto'.$Proyecto['id'].'"><i style="color:white;">Abrir/Cerrar</i></a>
							</div>
						</h4>
					</div>
					<div class="panel-body panel-collapse collapse" id="Proyecto'.$Proyecto['id'].'">
					'.$Proyecto['descripcion'].'
					</div>
				</div>';
		  	// echo '</div>';
		    // if ($auxiliarRow % $limite == 0){ echo '</div>'; }
		    // $auxiliarRow++;
		  }

    	} catch (PDOException $e) {
    		echo $e->getMessage();
    	}
    }

    /* MOSTRAR NOSOTROS */
    public function mostrarNosotros()
    {
    	$id = 1;
    	try {
    		$SQLStatement = $this->Conexion->prepare("SELECT * FROM empresa WHERE id = :id");
    		$SQLStatement->bindParam(":id",$id);
    		$SQLStatement->execute();
    		while($Informacion = $SQLStatement->fetch(PDO::FETCH_ASSOC))
    		{
    			echo '<h4>Misión</h4>
    				  '.$Informacion['mision'].'
    				  <hr>
    				  <h4>Visión</h4>
    				  '.$Informacion['vision'].'
    				  <hr>
    				  <h4>Valuación</h4>
    				  '.$Informacion['valuacion'].'
    				  <hr>
    				  <h4>Objetivo</h4>
    				  '.$Informacion['objetivo'].'
    				  <hr>
    				  <h4>Correo Electrónico</h4>
    				  '.$Informacion['correo_electronico'].'';
    		}

    	} catch (PDOException $e) {
    		echo $e->getMessage();
    	}
    }

    /* OBTENER MIEMBROS*/
    public function getMiembrosResumen()
	{
		$SQLStatement = $this->Conexion->query("SELECT * FROM miembros");
		while($Miembro = $SQLStatement->fetch(PDO::FETCH_ASSOC))
		{
			echo '<div class="panel panel-primary">
		            <div class="panel-heading">
		              <h4 class="panel-title">
		                <div align="left" style="float:left;">'.$Miembro['nombreCompleto'].' &nbsp;</div>
		                <div align="right">
		                 <a data-toggle="collapse" href="#miembro'.$Miembro['id'].'"><i style="color:white;">Abrir/Cerrar</i></a>
		                </div>
		              </h4>
		            </div>
		            <div class="panel-body">
		              <div id="miembro'.$Miembro['id'].'" class="panel-collapse collapse">
		                <div style="float:left; padding-right:10px;"><img width="250" height="250" src="../../img/miembros/'.$Miembro['foto'].'"></div>
		              	<div><strong>'.$Miembro['profesion'].'</strong></div><br>
		                '.$Miembro['descripcion'].'
		              </div>            
		            </div>
		          </div> ';
		}
	}

}
?>