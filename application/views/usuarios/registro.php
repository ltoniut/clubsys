<!DOCTYPE html>
<html lang="es">
<head>
	<title>Registro</title>
	<meta charset="utf-8">
	<?php $this->load->view('templates/head'); ?>
</head>
<body>
	<?php $this->load->view('templates/nav'); ?>
	<div class="container">
		<h3>Iniciar sesión</h3>
		<?php $this->load->view('templates/messages'); ?>
		<?php echo validation_errors(); ?>
		<?php echo form_open('usuarios/registro','class="form-horizontal"'); ?>
		<div class="form-group">
			<input type="text" class="form-control" id="inputNombre" name="nombre" placeholder='Nombre'>
		</div>
		<div class="form-group">
			<input type="text" class="form-control" id="inputApellido" name="apellido" placeholder='Apellido'>
		</div>
		<div class="form-group">
			<input type="password" class="form-control" id="inputPassword" name="password" placeholder='Contraseña'>
		</div>
		<div class="form-group">
			<input type="password" class="form-control" id="inputPasswordConfirm" name="passconf" placeholder='Confirmar contraseña'>
		</div>
		<div class="form-group">
			<input type="text" class="form-control" id="inputDireccion" name="direccion" placeholder='Dirección'>
		</div>
		<div class="form-group">
			<input type="date" class="form-control" id="inputFechaNacimiento" name="fechaNacimiento">
		</div>
		<div class="form-group">
			<button type="submit" class="btn btn-default">Ingresar</button>
		</div>
		<?php echo form_close(); ?>
	</div>
	<?php $this->load->view('templates/footer'); ?>
	<?php $this->load->view('templates/scripts'); ?>
</body>
</html>