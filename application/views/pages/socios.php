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
                                <i class="fa fa-users"></i> Socios
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalSocio">
                  Agregar socio
                </button>
                <!-- Modal -->
                <div class="modal fade" id="modalSocio" tabindex="-1" role="dialog" aria-labelledby="modalSocioLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="modalSocioLabel">Modal title</h4>
                      </div>
                      <div class="modal-body">
                        ...
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Save changes</button>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="table-responsive">
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
                            anchor("clientes/modificar", '<i class="glyphicon glyphicon-pencil"><span class="hidden-xs"> Modificar</span></i>', array('class' => 'btn btn-info')) ." ".
                            anchor("clientes/eliminar", '<i class="glyphicon glyphicon-trash"><span class="hidden-xs"> Borrar</span></i>', array('onclick'=>"return confirm('¿Está seguro que desea eliminar X?')", 'class' => 'btn btn-danger'))
                            ));
                    }
                    echo $this->table->generate(); 
                    ?>
                </div>
                <!--- /.table-responsive -->
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