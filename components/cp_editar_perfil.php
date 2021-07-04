<?php
// We need the function!
require_once("connections/connection.php");


$link = new_db_connection();
$stmt = mysqli_stmt_init($link);

//posso concatenar, visto que o parametro não foi colocado pelo user
$query = "SELECT nome, apelido, data_nascimento,telemovel,nif, rua, codigo_postal, cidade, ref_id_paises
FROM `utilizadores`
LEFT JOIN moradas
ON utilizadores.ref_id_moradas = moradas.id_moradas
WHERE id_utilizadores = " . $_SESSION["id_user"];

if (mysqli_stmt_prepare($stmt, $query)) {

    /* execute the prepared statement */
    mysqli_stmt_execute($stmt);

    /* bind result variables */
    mysqli_stmt_bind_result($stmt, $nome, $apelido, $nascimento, $tel, $nif, $rua, $postal, $cidade, $refidpais);


    if (mysqli_stmt_fetch($stmt)) {
        ?>
        <section class="py-4 container-fluid px-3 menu_perfil">
            <section class="container pt-2">
                <div class="row justify-content-center align-items-center">
                    <div class="col-12">
                        <div>
                            <?php
                            if (isset($_GET["msg"])) {
                                $msg_show = true;
                                switch ($_GET["msg"]) {
                                    case 0:
                                        $message = "Password errada";
                                        $class = "alert-danger";
                                        break;
                                    case 1:
                                        $message = "Alterações efetuadas.";
                                        $class = "alert-success";
                                        break;
                                    case 2:
                                        $message = "Morada mal preenchida.";
                                        $class = "alert-danger";
                                        break;
                                    default:
                                        $msg_show = false;
                                }

                                echo "<div class=\"alert $class alert-dismissible fade show\" role=\"alert\">
" . $message . "
  <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
    <span aria-hidden=\"true\">&times;</span>
  </button>
</div>";
                                if ($msg_show) {
                                    echo '<script>window.onload=function (){$(\'.alert\').alert();}</script>';
                                }
                            }
                            ?>
                        </div>
                    </div>
                    <div class="col-auto justify-content-center">
                        <div class="col text-center">
                            <div class="form-group">
                                <div class="form-group">
                                    <div id="upfoto" class="uploadfotoperfil position-relative">
                                        <label for="avatar" id="maquina">
                                            <img src="img/supernova.jpg" class="fotoperfilinput" id="output"/>
                                        </label>
                                        <input type="file" id="avatar" name="foto" accept="image/*" onchange="loadFile(event)">
                                        <img class="fotoperfilinput d-none" id="output"/>
                                        <script>
                                            var loadFile = function (event) {
                                                var output = document.getElementById('output');
                                                output.src = URL.createObjectURL(event.target.files[0]);
                                                output.onload = function () {
                                                    URL.revokeObjectURL(output.src) // free memory
                                                }
                                                document.getElementById('maquina').classList.add("d-none");
                                                document.getElementById('output').classList.remove("d-none");
                                            };
                                        </script>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col text-center pt-2">
                            <label for="avatar" class="labelfotoperfil">Alterar foto de perfil</label>
                        </div>
                    </div>
                </div>
            </section>
        </section>


        <?php
    } else {
        header("Location: index.php");
    }

    /* close statement */
    mysqli_stmt_close($stmt);

    /* close connection */
    mysqli_close($link);
} else {
    echo "Error: " . mysqli_error($link);
}
?>























































































































