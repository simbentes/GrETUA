<?php
if (!isset($_SESSION["id_user"])):
    header("Location: index.php");
else:
    ?>
    <main class="py-5">
        <section class="container-fluid pb-2">
            <div id="feed" class="row">
            </div>
        </section>
    </main>
<?php
endif;