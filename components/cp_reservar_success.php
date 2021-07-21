<?php
if (!isset($_SESSION["id_user"]) || !isset($_GET["dataevento"])):
    header("Location: index.php");
else:
    //vamos verificar se a reserva está mesmo feita
    //se estiver, o user pode guardar o evento no google calendar
    require_once("connections/connection.php");
    $link = new_db_connection();
    $stmt = mysqli_stmt_init($link);

    $query = "SELECT eventos.nome, DATE_FORMAT(data, '%Y%m%dT%H%i%sZ'),  DATE_FORMAT(ADDTIME(data, eventos.duracao * 100), '%Y%m%dT%H%i%sZ'), eventos.descricao_curta
FROM data_eventos
INNER JOIN eventos
ON eventos.id_eventos = data_eventos.ref_id_eventos
INNER JOIN reservas
ON reservas.ref_id_data_eventos = id_data_eventos
WHERE data_eventos.id_data_eventos = ? AND reservas.ref_id_utilizadores = " . $_SESSION["id_user"];

    if (mysqli_stmt_prepare($stmt, $query)) {
        mysqli_stmt_bind_param($stmt, "i", $_GET["dataevento"]);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $nome_evento, $data_qs, $data_fim_qs, $descricao_qs);
        mysqli_stmt_store_result($stmt);

        if (mysqli_stmt_num_rows($stmt) == 0) {
            header("Location: gretua.php");
        } else {
            mysqli_stmt_fetch($stmt);
            ?>
            <main>
                <section class="success-container">
                    <div>
                        <h3>Reserva efetuada!</h3>
                        <a href="https://www.google.com/calendar/render?action=TEMPLATE&text=<?= htmlspecialchars($nome_evento) ?>&dates=<?= htmlspecialchars($data_qs) ?>/<?= htmlspecialchars($data_qs) ?>&details=<?= htmlspecialchars($descricao_qs) ?>&location=GrETUA,+3810-502+Aveiro,+Portugal&sf=true&output=xml"
                           class="btn btn-grande btn-google w-75"><img
                                    src="img/g_calendar.svg" class="logo">Adicionar ao Google Calendar
                        </a>
                    </div>
                    <div class="pt-6">
                        <a href="reservas.php" class="fw-bolder">Ver as minhas reservas<i
                                    class="bi bi-chevron-right ps-1"></i></a>
                    </div>
                </section>

            </main>
            <?php

        }
    } else {
        echo "Error: " . mysqli_error($link);
    }

    mysqli_stmt_close($stmt);
    mysqli_close($link);

endif;
?>
