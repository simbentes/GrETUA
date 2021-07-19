<?php
ob_start();
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <?php
    include_once "helpers/help_meta.php";
    ?>

    <title>GrETUA Admin - Artistas</title>

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
            include_once "components/cp_navbars_top.php";
            ?>
            <!-- End of Topbar -->

            <!-- Begin Page Content -->
            <div class="container">
                <form action="scripts/teste.php" method="post" enctype="multipart/form-data" class="mb-4" autocomplete="off">
                    <label for="files">Fotos do Evento: </label>
                    <input id="files" name="fotos[]" type="file" multiple/>
                    <button type="submit"></button>
                </form>
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