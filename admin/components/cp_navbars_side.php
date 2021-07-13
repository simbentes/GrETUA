<?php
// Verificação de credenciais de acesso à área de administração
session_start();
if (isset($_SESSION["cargo"]) && $_SESSION["cargo"] == 1):

    $directoryURI = $_SERVER['REQUEST_URI'];
    $path = parse_url($directoryURI, PHP_URL_PATH);
    $components = explode('/', $path);
    $first_part = $components[3];

    ?>

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

        <!-- Sidebar - Brand -->
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
            <div class="sidebar-brand-icon">
                <img src="../img/sh.svg" class="iconadmin" alt="" height="30">
            </div>
            <div class="sidebar-brand-text mx-3"><img src="../img/gretua.svg" height="28"></div>
        </a>

        <!-- Divider -->
        <hr class="sidebar-divider my-0">

        <!-- Nav Item - Dashboard -->
        <li class="nav-item <?php if ($first_part == "index.php"): echo "active"; endif; ?>">
            <a class="nav-link" href="index.php">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Dashboard</span></a>
        </li>


        <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Heading -->
        <div class="sidebar-heading">
            Publicar
        </div>


        <li class="nav-item <?php if ($first_part == "novo-evento.php"): echo "active"; endif; ?>">
            <a class="nav-link" href="novo-evento.php">
                <i class="fas fa-fw fa-plus-circle"></i>
                <span>Novo Evento</span></a>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Heading -->
        <div class="sidebar-heading">
            Gestão
        </div>

        <li class="nav-item <?php if ($first_part == "users.php"): echo "active"; endif; ?>">
            <a class="nav-link" href="users.php">
                <i class="fas fa-fw fa-users"></i>
                <span>Utilizadores</span></a>
        </li>

        <li class="nav-item <?php if ($first_part == "reservas.php"): echo "active"; endif; ?>">
            <a class="nav-link" href="reservas.php">
                <i class="fas fa-fw fa-book"></i>
                <span>Reservas</span></a>
        </li>



        <!-- Nav Item - Utilities Collapse Menu -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
               aria-expanded="true" aria-controls="collapseUtilities">
                <i class="fas fa-fw fa-wrench"></i>
                <span>Utilities</span>
            </a>
            <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
                 data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Custom Utilities:</h6>
                    <a class="collapse-item" href="utilities-color.php">Colors</a>
                    <a class="collapse-item" href="utilities-border.php">Borders</a>
                    <a class="collapse-item" href="utilities-animation.php">Animations</a>
                    <a class="collapse-item" href="utilities-other.php">Other</a>
                </div>
            </div>
        </li>


        <!-- Divider -->
        <hr class="sidebar-divider d-none d-md-block">

        <!-- Sidebar Toggler (Sidebar) -->
        <div class="text-center d-none d-md-inline">
            <button class="rounded-circle border-0" id="sidebarToggle"></button>
        </div>


    </ul>
    <!-- End of Sidebar -->

<?php
else:
    header("Location: ../index.php");
endif;
?>