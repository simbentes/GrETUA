<?php
ob_start();
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <?php include_once "helpers/help_meta.php"; ?>

    <title>GrETUA Admin - Novo Evento</title>

    <?php include_once "helpers/help_link.php"; ?>


</head>

<body id="page-top">

<!-- Page Wrapper -->
<div id="wrapper">

    <!-- Sidebar -->
    <?php include_once "components/cp_navbars_side.php"; ?>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">

            <!-- Topbar -->
            <?php include_once "components/cp_navbars_top.php"; ?>
            <!-- End of Topbar -->

            <?php include_once "components/cp_novo_evento.php"; ?>


        </div>
        <!-- End of Content Wrapper -->

        <!-- Footer -->
        <?php include_once "components/cp_footer.php"; ?>
        <!-- End of Footer -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <?php include_once "helpers/help_js.php"; ?>
    <script src="js/novo_evento.js"></script>
</body>

</html>
