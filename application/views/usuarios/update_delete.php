<!DOCTYPE html>
<html lang="es">
<head>
	<title>Usuario</title>
	<meta charset="utf-8">
	<?php $this->load->view('templates/head'); ?>
</head>
<body>
	<?php $this->load->view('templates/nav'); ?>
	<div class="container">
		<h1 class="text-center">Producto</h1>
		<section class="row">
			<?php $this->load->view('templates/messages'); ?>
			<?php echo validation_errors(); ?>
			<?php echo form_open("productos/update/{$detalles['id']}",'class="form-horizontal"'); ?>
			<div class="form-contol">
				<div class="col-sm-offset-2 col-sm-10">
					<h3>Modificar/borrar usuario</h3>
				</div>
			</div>
			<div class="form-group">
				<input type="hidden" id="inputId" name="id" value="<?php echo $detalles['id']; ?>">
				<div class="col-sm-2">
					<label for="inputNombre">Nombre</label>
				</div>
				<div class="col-sm-10">
					<input type="text" class="form-control" id="inputNombre" name="nombre" value="<?php echo $detalles['nombre']?>">
				</div>
			</div>
			<div class="form-group">
				<div class="col-sm-2">
					<label for="inputAdministrador">Administrador</label>
				</div>
				<div class="col-sm-10">
					<input type="checkbox" class="form-control" id="inputAdministrador" name="adminSi"  value="Sí" checked>
					<input type="checkbox" class="form-control" id="inputAdministrador" name="adminNo"  value="No" >
				</div>
			</div>
			<div class="form-group">
				<div class="col-sm-offset-2 col-sm-10">
					<button type="submit" class="btn btn-default">Modificar usuario</button>
					<?php echo anchor("usuarios/delete/{$detalles['id']}", 'Borrar usuario', array('class' => "btn btn-default", 'onclick' => "return confirm('¿Está seguro que quiere borrar {$detalles['nombre']}?')")); ?>
					<?php echo anchor('admin/usuarios', 'Cancelar', 'class="btn btn-default"')?>
					
				</div>
			</div>
			<?php echo form_close(); ?>
		</section>
	</div>
	<?php $this->load->view('templates/scripts'); ?>
	<?php $this->load->view('templates/footer'); ?>
</body>
</html>