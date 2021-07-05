<div class="container-fluid navbar-light menubottom justify-content-center fixed-bottom">
    <div class="row h-100 align-items-center text-center">
        <a class="col px-1" href="gretua.php">
            <img src="img/sh.svg" class="iconsh iconshativo" alt="">
            <div class="w-100 item-menu">GrETUA</div>
        </a>
        <a class="col px-1" href="eventos.php">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                 class="bi bi-calendar2" viewBox="0 0 16 16">
                <path
                        d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM2 2a1 1 0 0 0-1 1v11a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V3a1 1 0 0 0-1-1H2z"/>
                <path d="M2.5 4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5H3a.5.5 0 0 1-.5-.5V4z"/>
            </svg>
            <div class="w-100 item-menu">Eventos</div>
        </a>
        <a class="col px-1" href="memorias.php">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-book"
                 viewBox="0 0 16 16">
                <path
                        d="M1 2.828c.885-.37 2.154-.769 3.388-.893 1.33-.134 2.458.063 3.112.752v9.746c-.935-.53-2.12-.603-3.213-.493-1.18.12-2.37.461-3.287.811V2.828zm7.5-.141c.654-.689 1.782-.886 3.112-.752 1.234.124 2.503.523 3.388.893v9.923c-.918-.35-2.107-.692-3.287-.81-1.094-.111-2.278-.039-3.213.492V2.687zM8 1.783C7.015.936 5.587.81 4.287.94c-1.514.153-3.042.672-3.994 1.105A.5.5 0 0 0 0 2.5v11a.5.5 0 0 0 .707.455c.882-.4 2.303-.881 3.68-1.02 1.409-.142 2.59.087 3.223.877a.5.5 0 0 0 .78 0c.633-.79 1.814-1.019 3.222-.877 1.378.139 2.8.62 3.681 1.02A.5.5 0 0 0 16 13.5v-11a.5.5 0 0 0-.293-.455c-.952-.433-2.48-.952-3.994-1.105C10.413.809 8.985.936 8 1.783z"/>
            </svg>
            <div class="w-100 item-menu">Memórias</div>
        </a>
        <a class="col px-1" href="conta.php">
            <img class="rounded-circle fotoperfilnav " src="img/users/<?= $_SESSION["fperfil"] ?>" alt="">
            <div class="w-100 item-menu"><?= $_SESSION["nomeproprio"] ?></div>
        </a>
    </div>
</div>
