<!DOCTYPE html>
<html lang="en">

<head>

    <?php
    include_once "helpers/help_meta.php";
    ?>

    <title>GrETUA Admin - Dashboard</title>

    <?php
    include_once "helpers/help_link.php";
    ?>


</head>

<body id="page-top">

<!-- Page Wrapper -->
<div id="wrapper">

    <!-- Sidebar -->
    <?php
    include_once "components/cp_navbars_side.php";
    ?>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">

            <!-- Topbar -->
            <?php
            include_once "../components/cp_navbars_top.php";
            ?>
            <!-- End of Topbar -->

            <!-- Begin Page Content -->
            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 text-gray-800">Gestão de utilizadores</h1>
                    <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                                class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
                </div>

                <!-- Content Row -->
                <div class="row">

                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Edição de utilizador
                            </div>
                            <!-- /.panel-heading -->
                            <div class="panel-body">
                                <form role="form" method="post" action="scripts/sc_users_update.php">
                                    <input type="hidden" name="id_users" value="{$id_users}">
                                    <div class="form-group">
                                        <label>ID do utilizador</label>
                                        <p class="form-control-static">{id_users}</p>
                                    </div>
                                    <div class="form-group">
                                        <label>Data de criação</label>
                                        <p class="form-control-static">{date_creation}</p>
                                    </div>
                                    <div class="form-group">
                                        <label>Username</label>
                                        <input class="form-control" name="username"
                                               value="{$username}">
                                    </div>
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input class="form-control" name="email" value="{$email}">
                                    </div>
                                    <div class="form-group">
                                        <label>Estado</label>
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" name="active">Activo
                                            </label>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label>Perfil</label>
                                        <select class="form-control" name="id_roles">
                                            <option value='{id_roles}'>{roles_decription}</option>
                                        </select>
                                    </div>
                                    <button type="submit" class="btn btn-info">Submeter alterações
                                    </button>
                                </form>
                                <!-- /.table-responsive -->
                            </div>
                            <!-- /.panel-body -->
                        </div>
                        <!-- /.panel -->
                    </div>

                </div>


            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- End of Main Content -->

        <!-- Footer -->
        <?php include_once "components/cp_footer.php"; ?>
        <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<?php
include_once "helpers/help_js.php";
?>

</body>

</html>