<?php
if (!isset($_SESSION["id_user"])):
    header("Location: index.php");
else:
    if (isset($_GET["msg"])) {
        $msg_show = true;
        switch ($_GET["msg"]) {
            case 0:
                $message = "Publicação eliminada.";
                $class = "alert-danger";
                break;
            case 1:
                $message = "Ainda não segues ninguém.";
                $class = "alert-secondary";
                break;
            default:
                $msg_show = false;
        }

        if ($msg_show) {
            echo '<div class="container-fluid caixaalert"><div class="row justify-content-center"><div class="col-auto"><div id="aviso" class="alert ' . $class . ' alert-dismissible fade show" role="alert">' . $message . '</div></div></div></div>';
            echo "<script>
            setTimeout(function () {
                var myAlert = document.getElementById('aviso')
                var bsAlert = new bootstrap.Alert(myAlert)
                bsAlert.close()
            }, 3000)
        </script>";
        }
    }
    ?>
    <main class="py-5">
        <section id="tipofeed" class="container px-3 tipofeed">
            <div class="botaomultiplo">
                <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
                    <input type="radio" class="btn-check d-none" name="btnradio" id="btnradio0" autocomplete="off"
                           checked>
                    <label class="btn btn-multiplo-primary" for="btnradio0">Todas</label>

                    <input type="radio" class="btn-check d-none" name="btnradio" id="btnradio1" autocomplete="off">
                    <label class="btn btn-multiplo-primary" for="btnradio1">A seguir</label>
                </div>
            </div>
        </section>
        <section class="container-fluid pb-2 mt-5">
            <div id="feed" class="row">
            </div>
        </section>
    </main>
<?php
endif;