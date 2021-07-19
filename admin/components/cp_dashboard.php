<?php
require_once "connections/connection.php";

$link = new_db_connection();
$stmt = mysqli_stmt_init($link);
?>


<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                    class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
    </div>

    <!-- Content Row -->
    <div class="row">

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                Utilizadores Registados
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                <?php
                                $query = "SELECT COUNT(*) FROM `utilizadores` WHERE ativo = 1;";

                                if (mysqli_stmt_prepare($stmt, $query)) {

                                    mysqli_stmt_execute($stmt);

                                    mysqli_stmt_bind_result($stmt, $countusers);

                                    if (mysqli_stmt_fetch($stmt)) {
                                        /* fetch values */
                                        echo $countusers;
                                    }
                                } else {
                                    echo "Error: " . mysqli_error($link);
                                }
                                ?>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-users fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Publicações</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                <?php
                                $query = "SELECT COUNT(*) FROM `publicacoes`;";

                                if (mysqli_stmt_prepare($stmt, $query)) {

                                    mysqli_stmt_execute($stmt);

                                    mysqli_stmt_bind_result($stmt, $countpubs);

                                    if (mysqli_stmt_fetch($stmt)) {
                                        /* fetch values */
                                        echo $countpubs;
                                    }
                                } else {
                                    echo "Error: " . mysqli_error($link);
                                }
                                ?>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="far fa-newspaper fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Reservas Ativas</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                <?php
                                $query = "SELECT COUNT(*) FROM `reservas`
INNER JOIN data_eventos
on id_data_eventos = reservas.ref_id_data_eventos
INNER JOIN eventos
ON eventos.id_eventos = data_eventos.ref_id_eventos
WHERE data_eventos.data > NOW();";

                                if (mysqli_stmt_prepare($stmt, $query)) {
                                    mysqli_stmt_execute($stmt);
                                    mysqli_stmt_bind_result($stmt, $countreservas);

                                    if (mysqli_stmt_fetch($stmt)) {
                                        /* fetch values */
                                        echo $countreservas;
                                    }
                                } else {
                                    echo "Error: " . mysqli_error($link);
                                }
                                ?>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-book fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Datas eventos (este
                                mês)
                            </div>
                            <div class="row no-gutters align-items-center">
                                <div class="col-auto">
                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">
                                        <?php
                                        $query = "SELECT COUNT(*) FROM `data_eventos` WHERE MONTH(data) = MONTH(NOW()) AND YEAR(data) = YEAR(NOW());";

                                        if (mysqli_stmt_prepare($stmt, $query)) {
                                            mysqli_stmt_execute($stmt);
                                            mysqli_stmt_bind_result($stmt, $counteventos);

                                            if (mysqli_stmt_fetch($stmt)) {
                                                echo $counteventos;
                                            } else {
                                                echo "Error: " . mysqli_stmt_error($stmt);
                                            }
                                        } else {
                                            echo "Error: " . mysqli_error($link);
                                        }

                                        $query = "SELECT COUNT(*) FROM `data_eventos` WHERE MONTH(data) = MONTH(NOW()) AND YEAR(data) = YEAR(NOW()) AND data < NOW();";

                                        if (mysqli_stmt_prepare($stmt, $query)) {
                                            mysqli_stmt_execute($stmt);
                                            mysqli_stmt_bind_result($stmt, $counteventospassados);

                                            if (!mysqli_stmt_fetch($stmt)) {
                                                echo "Error: " . mysqli_stmt_error($stmt);
                                            }
                                        } else {
                                            echo "Error: " . mysqli_error($link);
                                        }
                                        $eventopassadospercentagem = $counteventospassados / $counteventos * 100
                                        ?>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="small text-right mt-1 mr-1 pr-1"><?= $counteventospassados . " terminados (" . round($eventopassadospercentagem); ?>
                                        %)
                                    </div>
                                    <div class="progress progress-sm mr-2">
                                        <div class="progress-bar bg-info" role="progressbar"
                                             style="width: <?= $eventopassadospercentagem ?>%"
                                             aria-valuenow="<?= $eventopassadospercentagem ?>"
                                             aria-valuemin="0"
                                             aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Content Row -->

    <div class="row">

        <!-- Area Chart -->
        <div class="col-xl-8 col-lg-7">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Novos utilizadores nos últimos 7 dias</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="chart-area">
                        <canvas id="myAreaChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pie Chart -->
        <div class="col-xl-4 col-lg-5">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Interações (este mês)</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="chart-pie pt-4 pb-2">
                        <canvas id="myPieChart"></canvas>
                    </div>
                    <div class="mt-4 text-center small">
                    <span class="mr-2">
                      <i class="fas fa-circle text-primary"></i> Publicações
                    </span>
                        <span class="mr-2">
                      <i class="fas fa-circle text-success"></i> Likes
                    </span>
                        <span class="mr-2">
                      <i class="fas fa-circle text-info"></i> Comentários
                    </span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Content Row -->
    <div class="row">

        <!-- Content Column -->
        <div class="col-lg-6 mb-4">

            <!-- Color System -->
            <div class="row">
                <div class="col-lg-6 mb-4">
                    <div class="card text-white shadow" style="background-color: #007AFF">
                        <div class="card-body">
                            Tema
                            <div class="text-white-50 small">#007AFF</div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 mb-4">
                    <div class="card bg-secondary text-white shadow">
                        <div class="card-body">
                            Secundária
                            <div class="text-white-50 small">#858796</div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 mb-4">
                    <div class="card bg-success text-white shadow">
                        <div class="card-body">
                            Sucesso
                            <div class="text-white-50 small">#F6C23E</div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 mb-4">
                    <div class="card text-white shadow" style="background-color: #2d2d2f">
                        <div class="card-body">
                            Cards
                            <div class="text-white-50 small">#2D2D2F</div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 mb-4">
                    <div class="card bg-danger text-white shadow">
                        <div class="card-body">
                            Cancelar/Eliminar
                            <div class="text-white-50 small">#E74A3B</div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 mb-4">
                    <div class="card text-white shadow" style="background-color: #1c1c1e">
                        <div class="card-body">
                            Menu
                            <div class="text-white-50 small">#1C1C1E</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-6 mb-4">

            <!-- Illustrations -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Próximos eventos</h6>
                </div>
                <div class="card-body">
                    <?php
                    $query = "SELECT id_eventos, DATE_FORMAT(data, '%d-%m-%Y %Hh%i'), nome FROM `data_eventos`
INNER JOIN eventos
ON data_eventos.ref_id_eventos = id_eventos
WHERE data > NOW()
ORDER BY `data_eventos`.`data`
LIMIT 3;";

                    if (mysqli_stmt_prepare($stmt, $query)) {
                        mysqli_stmt_execute($stmt);
                        mysqli_stmt_bind_result($stmt, $id_eventos, $data, $nome);

                        while (mysqli_stmt_fetch($stmt)) {
                            ?>
                            <div class="row align-items-center">
                                <div class="col-sm">
                                    <h5 class="font-weight-bold mb-0"><?= $data ?></h5>
                                    <h3><?= $nome ?></h3>
                                </div>
                                <div class="col-sm-auto">
                                    <a href="../evento.php?evento=<?= $id_eventos ?>" class="font-weight-bold">Ver na
                                        app<i class="fas fa-chevron-right pl-1"></i></a>
                                </div>
                            </div>
                            <hr>
                            <?php
                        }
                    } else {
                        echo "Error: " . mysqli_error($link);
                    }
                    ?>
                </div>
            </div>

        </div>
    </div>

</div>

<?php

mysqli_stmt_close($stmt);
mysqli_close($link);
?>
