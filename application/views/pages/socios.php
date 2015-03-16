<!DOCTYPE html>
<html lang="en">
    <head>
        <title>ClubSys - Socios</title>
        <?php $this->load->view('templates/head'); ?>
    </head>
    <body>
        <div id="wrapper">
            <?php $this->load->view('templates/nav_admin'); ?>
            <div id="page-wrapper">
                <div class="container-fluid">
                    <!-- Page Heading -->
                    <div class="row">
                        <div class="col-lg-12">
                            <h1 class="page-header">
                            Socios
                            <small>Los pibes del club</small>
                            </h1>
                            <ol class="breadcrumb">
                                <li>
                                    <i class="fa fa-dashboard"></i>  <?php echo anchor('dashboard', 'Dashboard');?>
                                </li>
                                <li class="active">
                                    <i class="fa fa-file"></i> Usuarios
                                </li>
                            </ol>
                        </div>
                        
                        <?php echo $this->session->flashdata('error'); ?>
                        <div class="col-sm-6">
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#socioModal">
                            <i class="glyphicon glyphicon-plus"></i> Agregar socio
                            </button>
                        </div>
                        <div class="col-sm-6 text-right">
                            <?php echo form_open('socios','class="form-inline role="search"'); ?>
                            <div class="input-group">
                                <input type="search" class="form-control" placeholder="Buscar...">
                                <span class="input-group-btn">
                                    <button type="input" class="btn btn-default">
                                        <i class="glyphicon glyphicon-search"></i>
                                    </button>
                                </span>
                                </div><!-- /input-group -->
                                <?php echo form_close(); ?>
                            </div>
                            <!-- Modal -->
                            <div class="modal fade" id="socioModal" tabindex="-1" role="dialog" aria-labelledby="socioModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            <h4 class="modal-title" id="socioModalLabel">Agregar socio</h4>
                                        </div>
                                        <?php echo form_open('socios/agregar','class="form-horizontal"'); ?>
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label for="inputNombres" class="col-sm-2 control-label">Nombres</label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control" id="inputNombres" name="nombres" placeholder="Nombres">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="inputApellidos" class="col-sm-2 control-label">Apellidos</label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control" id="inputApellidos" name="apellidos" placeholder="Apellidos">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="selectTipo" class="col-sm-2 control-label" name="tipo">Tipo</label>
                                                <div class="col-sm-10">
                                                    <select class="form-control" id="selectTipo">
                                                        <option>Socio</option>
                                                        <option>Instructor</option>
                                                        <option>Administrador</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="inputDireccion" class="col-sm-2 control-label">Dirección</label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control" id="inputDireccion" name="direccion" placeholder="Dirección">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="inputFechaNacimiento" class="col-sm-2 control-label">Fecha de nacimiento</label>
                                                <div class="col-sm-10">
                                                    <input type="date" class="form-control" id="inputFechaNacimiento" name="fechaNacimiento">
                                                </div>
                                            </div>
                                        </div>
                                        <!-- /.modal-body -->
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                                            <button type="submit" class="btn btn-primary">Agregar</button>
                                        </div>
                                        <?php echo form_close(); ?>
                                    </div>
                                    <!--- /.modal-content -->
                                </div>
                                <!--- /.modal-dialog -->
                            </div>
                            <div class="table-responsive col-sm-12">
                                <?php
                                $this->table->set_heading(array('#', 'Tipo', 'Apellidos y nombres', 'Dirección', 'Fecha de nacimiento', 'Fecha de inscripción', ""));
                                foreach ($socios as $socios_item) {
                                $this->table->add_row(array(
                                $socios_item['#'],
                                $socios_item['Tipo'],
                                $socios_item['Apellidos y nombres'],
                                $socios_item['Dirección'],
                                $socios_item['Fecha de nacimiento'],
                                $socios_item['Fecha de inscripción'],
                                anchor("clientes/modificar", '<i class="glyphicon glyphicon-pencil"><span class="hidden-xs"> Modificar</span></i>', array('class' => 'btn btn-info btn-sm', "role" => "button")) . " " .
                                anchor("clientes/eliminar", '<i class="glyphicon glyphicon-trash"><span class="hidden-xs"> Borrar</span></i>', array('onclick'=>"return confirm('¿Está seguro que desea eliminar X?')", 'class' => 'btn btn-danger btn-sm', "role" => "button"))
                                ));
                                }
                                echo $this->table->generate();
                                ?>
                            </div>
                            <!--- /.table-responsive -->
                            <div class="col-sm-12">
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#socioModal">
                                <i class="glyphicon glyphicon-plus"></i> Agregar socio
                                </button>
                            </div>
                        </div>
                        <!-- /.row -->
                    </div>
                    <!-- /.container-fluid -->
                </div>
                <!-- /#page-wrapper -->
            </div>
            <!-- /#wrapper -->
            <?php $this->load->view('templates/footer'); ?>
            <?php $this->load->view('templates/scripts'); ?>
        </body>
    </html>