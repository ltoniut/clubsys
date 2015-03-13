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
                </div>
                <!-- /.row -->
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
                            anchor("clientes/modificar", '<i class="glyphicon glyphicon-pencil"><span class="hidden-xs"> Modificar</span></i>', array('onclick'=>"return confirm('¿Está seguro que desea eliminar X?')", 'class' => 'btn btn-info')) ." ".
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
