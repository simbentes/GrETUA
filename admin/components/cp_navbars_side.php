<?php
// Verificação de credenciais de acesso à área de administração
require_once "scripts/sc_check_admin.php";

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

    <li class="nav-item <?php if ($first_part == "eventos.php"): echo "active"; endif; ?>">
        <a class="nav-link" href="eventos.php">
            <i class="fas fa-fw fa-calendar"></i>
            <span>Eventos/Memórias</span></a>
    </li>

    <li class="nav-item <?php if ($first_part == "artistas.php"): echo "active"; endif; ?>">
        <a class="nav-link" href="artistas.php">
            <i class="fas fa-fw fa-star"></i>
            <span>Artistas</span></a>
    </li>

    <li class="nav-item <?php if ($first_part == "reservas.php"): echo "active"; endif; ?>">
        <a class="nav-link" href="reservas.php">
            <i class="fas fa-fw fa-book"></i>
            <span>Reservas</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>


</ul>
<!-- End of Sidebar -->