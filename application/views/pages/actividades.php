<!DOCTYPE html>
<html>
<head>
	<title>Actividades</title>
	<?php $this->load->view('templates/head'); ?>
</head>
<body>

	<div id="wrapper">
		<?php $this->load->view('templates/nav_admin'); ?>
		<div id="page-wrapper">

			<div class="container-fluid">

				<div class="row">
					<div class="col-lg-12">
						<h1 class="page-header">
							Actividades
							<small>del club</small>
						</h1>
						<ol class="breadcrumb">
							<li>
								<i class="fa fa-dashboard"></i>  <?php echo anchor('dashboard', 'Dashboard');?>
							</li>
							<li class="active">
								<i class="fa fa-file"></i> Actividades
							</li>
						</ol>
					</div>
					<div class="col-sm-6">
						<!-- Button trigger modal -->
						<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
							Agregar Actividad
						</button>
					</div>
					<h1> <?php if(isset($mensaje)){echo $mensaje; echo validation_errors();} ?></h1>
					<!-- Modal -->
					<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
						<div class="modal-dialog">
							<div class="modal-content">


								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
									<h4 class="modal-title" id="myModalLabel">Agregar Actividad</h4>
								</div>


								<div class="modal-body">
									<form role="form" method="POST" action="<?php echo base_url('index.php/actividades/agregar')?>">
										<div class="form-group">
											<label for="Actividad">Nombre de Actividad</label>
											<input type="text" class="form-control" id="nombre" name="nombre" placeholder="Ingrese actividad">
										</div>
										<div class="form-group">
											<label for="Instructor">Instructor</label>
											<select class="form-control" id="instructor" name="instructor">
												<option value='0'>---</option>
												<?php
												if(isset($instructores)){
													foreach ($instructores as $datos ) {?>
													<option value="<?= $datos['#']?>"><?=$datos['Apellidos y nombres']?></option> 
													<?php }}  
													?>
												</select>
											</div>
											<div class="form-group">
												<label for="descripcion">Descripcion</label>
												<textarea style="min-width:200px; max-width:200px; max-height:200px;min-height:200px;" id="descripcion" name="descripcion"></textarea>

											</div>
											<div class="form-group">
												<label for="Fecha">Fecha Inicio</label>
												<input type="date" class="form-control" id="fecha" name ="fecha" placeholder="Seleccione fecha">

											</div>
											<button type="submit" class="btn btn-default">Guardar</button>
										</form>
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
										<button type="button" class="btn btn-primary">Guardar</button>
									</div>
								</div>
							</div>
						</div>

						<div class="table-responsive col-sm-12">
							<?php
							if(isset($actividades)){
								$this->table->set_heading(array('Actividad', 'Descripcion', 'Instructor', ""));
								foreach ($actividades as $act_item) {
									$this->table->add_row(array(
										$act_item['nombre'],
										$act_item['descripcion'],
										$act_item['instructor'],
										'<button type="button" class="btn btn-info btn-block btnModificarActividad" data-toggle="modal" data-target="#modificarModal">
										<i class="glyphicon glyphicon-pencil"><span class="hidden-xs"> Modificar</span></i>
									</button>'." ".
									anchor("clientes/eliminar", '<i class="glyphicon glyphicon-trash"><span class="hidden-xs"> Borrar</span></i>', array('onclick'=>"return confirm('¿Está seguro que desea eliminar X?')", 'class' => 'btn btn-danger btn-block', 'role' => 'button'))
									));
								}
								echo $this->table->generate();
							} 
							?>
						</div>
						<!-- /.table-responsive -->
						<div class="col-sm-6">
							<!-- Button trigger modal -->
							<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
								Agregar Actividad
							</button>
						</div>
						<!-- Modal -->
						<div class="modal fade" id="modificarModal" tabindex="-1" role="dialog" aria-labelledby="modificarModalLabel" aria-hidden="true">
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
										<h4 class="modal-title" id="modificarModalLabel">Modificar Actividad</h4>
									</div>


									<div class="modal-body">
										<form role="form" method="POST" action="<?php echo base_url('index.php/actividades/agregar')?>">
											<div class="form-group">
												<label for="Actividad">Nombre de Actividad</label>
												<input type="text" class="form-control" id="nombreMod" name="nombreMod" placeholder="Ingrese actividad">
											</div>
											<div class="form-group">
												<label for="Instructor">Instructor</label>
												<select class="form-control" id="instructorMod" name="instructorMod">
													<option value='0'>---</option>
													<?php
													if(isset($instructores)){
														foreach ($instructores as $datos ) {?>
														<option value="<?= $datos['#']?>"><?=$datos['Apellidos y nombres']?></option> 
														<?php }}  
														?>
													</select>
												</div>
												<div class="form-group">
													<label for="descripcion">Descripcion</label>
													<textarea  class="form-control" rows="5" id="descripcionMod" name="descripcionMod"></textarea>

												</div>
												<button type="submit" class="btn btn-default">Guardar</button>
											</form>
										</div>
										<div class="modal-footer">
											<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
											<button type="button" class="btn btn-primary">Guardar</button>
										</div>
									</div>
								</div>
							</div>
							<!-- /.modal -->
						</div>
						<!-- /.row -->
					</div>
					<!-- /.container-fluid -->
				</div>
			</div>
		</div>





	</body>

	<?php $this->load->view('templates/scripts');?>
	<script>
		$(document).ready(function() {
			$(".btnModificarActividad").click(function() {
				var tableData = $(this).closest("tr").children("td").map(function() {
					return $(this).text();
				}).get();

				$("#nombreMod").val($.trim(tableData[0]));
				$("#descripcionMod").val($.trim(tableData[1]));
				$("#instructorMod option").filter(function() {
					return($(this).text() == $.trim(tableData[2]))
				}).prop('selected', true);
			})
		});	
	</script>
	</html>
