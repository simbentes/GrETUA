<div>
    <div class="memoria-container">
        <div dir="rtl" class="swiper-container mySwiper">
            <div class="swiper-wrapper position-relative">

            </div>
            <div class="linha-memorias">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 483.12 27.37">
                    <defs>
                        <style>.cls-1 {
                                fill: none;
                                stroke-width: 4px;
                            }

                            .cls-1 {
                                stroke: #fff;
                                stroke-miterlimit: 10;
                            }

                            .cls-2 {
                                fill: #fff;
                            }</style>
                    </defs>
                    <g id="Layer_2" data-name="Layer 2">
                        <g id="Layer_1-2" data-name="Layer 1">
                            <line class="cls-1" y1="13.69" x2="483.12" y2="13.69"/>
                            <line class="cls-2" y1="13.69" x2="483.12" y2="13.69"/>
                        </g>
                    </g>
                </svg>
            </div>
        </div>

    </div>
</div>
<section id="maquinabottom" class="maquina container pt-4 pb-3">
    <h4 class="pt-2 text-center pb-3 mb-4">Máquina do tempo</h4>
    <?php

    require_once("connections/connection.php");

    $link = new_db_connection();
    $stmt = mysqli_stmt_init($link);

    $query = "SELECT UNIX_TIMESTAMP(MIN(data)), DATE_FORMAT(MIN(DATE(data)), '%Y'), UNIX_TIMESTAMP(MAX(data)), DATE_FORMAT(MAX(DATE(data)), '%Y')  FROM `data_eventos` WHERE (data_eventos.data) IN (SELECT MIN(data_eventos.data) FROM data_eventos WHERE data_eventos.data < NOW() GROUP BY data_eventos.ref_id_eventos);";

    if (mysqli_stmt_prepare($stmt, $query)) {

        /* execute the prepared statement */
        mysqli_stmt_execute($stmt);

        /* bind result variables */
        mysqli_stmt_bind_result($stmt, $min_data, $min_ano, $max_data, $max_ano);

        mysqli_stmt_store_result($stmt);

        if (!mysqli_stmt_fetch($stmt)) {
            echo "Error: " . mysqli_stmt_error($stmt);
        }
    } else {
        echo "Error: " . mysqli_error($link);
    }
    mysqli_stmt_close($stmt);
    mysqli_close($link);
    ?>
    <form>
        <div class="row g-0 justify-content-center align-items-center g-2">
            <div class="col-auto">
                <h4 class="mb-1"><?= $min_ano ?></h4>
            </div>
            <div class="col-7">
                <input type="range" class="form-range" id="temporange" value="100" step="0.1">
            </div>
            <div class="col-auto">
                <h4 class="mb-1"><?= $max_ano ?></h4>
            </div>
        </div>
        <input id="min-data" type="hidden" value="<?= $min_data ?>">
        <input id="max-data" type="hidden" value="<?= $max_data ?>">
    </form>
</section>
