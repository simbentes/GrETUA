<?php

if (!isset($_SESSION["id_user"])){
    header("Location: index.php");
}
else{
    require_once("connections/connection.php");
    $link = new_db_connection();
    $stmt = mysqli_stmt_init($link);
    $id_user=$_SESSION["id_user"];
?>

<section class="container-fluid pt-3 pb-2 px-3 topindexmenu">
<div class="row align-content-center justify-content-between">
                    <div class="col-auto">
                        <div class="row gx-0 align-items-center">
                            <div class="col-auto">
                                <a href="editar-perfil.php" class="text-white"><i
                                            class="bi bi-chevron-left p-1 mb-0 h5"></i></a>
                            </div>
                            <div class="col-auto ps-3">
                                <h3 class="mb-0">Cargos</h3>
                            </div>
                        </div>
                    </div>
                </div>
</section>



<section class="container-fluid pt-3 pb-2 px-3">
<div class="row align-content-center justify-content-between">
                    <div class="col-auto">
                        <div class="row gx-0 align-items-center">
                            <div class="col-auto ps-3">
                                <h4 class="mb-0">Selecione um cargo</h3>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-auto pt-5">
                <?php 
                    $query = "SELECT id_cargo, cargo.nome, color, utilizadores.ref_id_cargo FROM cargo INNER JOIN utilizadores ON id_utilizadores = $id_user WHERE id_cargo != utilizadores.ref_id_cargo AND id_cargo != 2";
                    if (mysqli_stmt_prepare($stmt, $query)) {

                        mysqli_stmt_execute($stmt);
    
                        mysqli_stmt_bind_result($stmt, $id_cargo, $nome_cargo, $cor_cargo, $antigo_cargo);
    
                        mysqli_stmt_store_result($stmt);

                        while (mysqli_stmt_fetch($stmt)){
                            ?>      
                            <a href="editar-perfil.php?<?=$id_cargo?>"><span class="badge bg-<?=$cor_cargo?>"><?=$nome_cargo?></span></a>
                           
                        </div>
                        <?php
                            }}}
                            ?>
</section>

<?php 
    mysqli_stmt_close($stmt);
    mysqli_close($link);
?>