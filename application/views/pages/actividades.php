<!DOCTYPE html>
<html>
<head>
	<title>Actividades</title>
	<?php $this->load->view('templates/head'); ?>
</head>
<body>
	<?php $this->load->view('templates/nav');?>

<div class="row">
<div class="col-md-10 col-md-offset-1">
<h1>Zona Actividades</h1>
<!-- Button trigger modal -->
<button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal">
  Agregar Actividad
</button>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Agregar Actividad</h4>
      </div>
      <div class="modal-body">
        <form>
		  <div class="form-group">
		    <label for="Actividad">Nombre de Actividad</label>
		    <input type="text" class="form-control" id="nonmbre" placeholder="Ingrese actividad">
		  </div>
		  <div class="form-group">
		    <label for="Instructor">Instructor</label>
		    <select class="form-control" id="unidad" >
		    	<?php
		    	if(isset($instructores)){
		    		foreach ($instructores->result() as $datos ) {?>
		    		<option value="<?= $datos->id?>"><?=$datos->apellido?></option>	
		    	<?php	}}	
		    	 ?>
		    </select>
		  </div>
		  <div class="form-group">
		    <label for="descripcion">Descripcion</label>
		    <textarea style="min-width:200px; max-width:200px; max-height:200px;min-height:200px;"></textarea>
		   
		  </div>
		  <div class="form-group">
		    <label for="Fecha">Fecha Inicio</label>
		    <div class='input-group date' id='datetimepicker1'>
				<input type='text' class="form-control" />
				<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
				</span>
				<script type="text/javascript">
					$(function () {
					$('#datetimepicker1').datetimepicker();
					});
				</script>
			</div>
		  </div>
		  <button type="submit" class="btn btn-default">Submit</button>
		</form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Guardar</button>
      </div>
    </div>
  </div>
</div>
 <div class="container">
<div class="row">
<div class='col-sm-6'>
<div class="form-group">
<div class='input-group date' id='datetimepicker1'>
<input type='text' class="form-control" />
<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
</span>
</div>
</div>
</div>
<script type="text/javascript">
$(function () {
$('#datetimepicker1').datetimepicker();
});
</script>
</div>
</div>

    <div class="control-group">
        <label for="date-picker-2" class="control-label">B</label>
        <div class="controls">
            <div class="input-group">
                <input id="date-picker-2" type="text" class="date-picker form-control" />
                <label for="date-picker-2" class="input-group-addon btn"><span class="glyphicon glyphicon-calendar"></span>

                </label>
            </div>
        </div>
    </div>
    <script type="text/javascript">    $(".date-picker").datepicker();

$(".date-picker").on("change", function () {
    var id = $(this).attr("id");
    var val = $("label[for='" + id + "']").text();
    $("#msg").text(val + " changed");
});</script>



 <form>
		  <div class="form-group">
		    <label for="Actividad">Nombre de Actividad</label>
		    <input type="text" class="form-control" id="nonmbre" placeholder="Ingrese actividad">
		  </div>
		  <div class="form-group">
		    <label for="Instructor">Instructor</label>
		    <select class="form-control" id="unidad" >
		    	<?php
		    	if(isset($instructores)){
		    		foreach ($instructores->result() as $datos ) {?>
		    		<option value="<?= $datos->id?>"><?=$datos->apellido?></option>	
		    	<?php	}}	
		    	 ?>
		    </select>
		  </div>
		  <div class="form-group">
		    <label for="descripcion">Descripcion</label>
		    <textarea style="min-width:200px; max-width:200px; max-height:200px;min-height:200px;"></textarea>
		   
		  </div>
		  <div class="form-group">
		    <label for="Fecha">Fecha Inicio</label>
		    <div class='input-group date' id='datetimepicker1'>
				<input type='text' class="form-control" />
				<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
				</span>
				<script type="text/javascript">
					$(function () {
					$('#datetimepicker1').datetimepicker();
					});
				</script>
			</div>
		  </div>
		  <button type="submit" class="btn btn-default">Submit</button>
		</form>
<div class="container" style="visibility:<?php if(isset($actividades)){echo 'visible';}else{echo 'hidden';} ?>;">
  
  <div class="table-responsive div1">
  <table class="table table-hover" >
  <div class="alert alert-success" style="visibility:<?php if(isset($exito)){echo 'visible';}else{echo 'hidden';} ?>;"role="alert" ><?php if(isset($exito)){echo $exito;}?></div>
  <thead>
  <tr>
  <th>Actividad</th>
  <th>Instructor</th>
  <th>Descripción</th>
  <th>Fecha Inicio</th>
  <th></th>
  <th></th>

  </tr>
  </thead>
  <tbody>

  

   <?php if(isset($actividades)):?>

   <?php foreach ($actividades->result() as $datos):?>
    
    <tr>
    <td style="vertical-align:middle"><?= $datos->nombre?></td>
    <td style="vertical-align:middle"><?= $datos->apellido?></td>
    <td style="vertical-align:middle"><?= $datos->descripcion?></td>
    <td style="vertical-align:middle"><?= $datos->fecha_implementacion?></td>
    <td> <a href="buscar?id=<?= $datos->id?>" class="btn btn-warning "><i class="glyphicon glyphicon-pencil"></i></a>'."".'</td>';
    <td> <a href="eliminar?id=<?= $datos->producto_id?>" class="btn btn-danger"'." onclick='return confirm()'" .  '><i class="glyphicon glyphicon-trash"></i></a> '."".'</td>';
   	<td>
    anchor("actividades/eliminar/?id={$datos->id}", '<i class="glyphicon glyphicon-trash"></i>', array('onclick'=>"return confirm('¿Está seguro que desea eliminar {$datos->nombre}?')", 'class' => 'btn btn-danger'));
    </td>
    </tr>
	<?php endforeach; ?>
    <?php endif; ?>


  ?>
  </tbody>  
</table>
</div>
</div>





</div>
</div>
</body>

	<?php $this->load->view('templates/scripts');?>
</html>