<!DOCTYPE html>
<html lang="es">
<head>
	<title>Iniciar sesión</title>
	<meta charset="utf-8">
	<?php $this->load->view('templates/head'); ?>
</head>
<body>
	<?php $this->load->view('templates/nav'); ?>
	<div class="container">
		<h3>Iniciar sesión</h3>
		<?php $this->load->view('templates/messages'); ?>
		<?php echo validation_errors(); ?>
		<?php echo form_open('usuarios/login','class="form-inline"'); ?>
		<div class="form-group">
			<input type="text" class="form-control" id="inputUsuario" name="numeroSocio" placeholder='Número de socio'>
		</div>
		<div class="form-group">
			<input type="password" class="form-control" id="inputPassword" name="password" placeholder='contraseña'>
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