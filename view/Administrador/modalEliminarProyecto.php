<div class="modal fade" tabindex="-1" role="dialog" id="Modal" data-backdrop="static">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h3 class="modal-title"><center>Eliminar proyecto</center></h3>
			</div>
			<div class="modal-body">
				<h4 align="center" id="nombreProyecto"></h4>
			</div>
			<div class="modal-footer">
				<form method="post">
					<input type="hidden" name="id" id="id">
					<input type="hidden" name="idCategoria" id="idCategoria">
					<input type="hidden" name="nombreProyectoEliminar" id="nombreProyectoEliminar">
					<button type="submit" name="eliminarProyecto" class="btn btn-primary">Eliminar</button>
					<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
				</form>
			</div>
		</div><!-- modal-content -->
	</div><!-- modal-dialog -->
</div><!-- modal -->