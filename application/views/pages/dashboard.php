<!DOCTYPE html>
<html lang="en">

<head>
    <title>ClubSys - Dashboard</title>
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
                            Dashboard
                            <small>Subheading</small>
                        </h1>
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
