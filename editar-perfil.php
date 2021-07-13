<?php
session_start();
?>
<!DOCTYPE html>
<html lang="pt">
<head>
    <?php include_once "helpers/help_meta.php" ?>
    <?php include_once "helpers/help_link.php" ?>
    <title>GrETUA</title>
</head>
<body>
<main>


    <?php include_once "components/cp_editar_conta.php" ?>

</main>
<?php include_once "components/cp_tab_bar.php" ?>

<!-- Javascript -->
<?php include_once "helpers/help_js.php" ?>
</body>
</html>

<script type="text/javascript">
   /* if ('ontouchstart' in window) {
        $(document).on('focus', 'textarea,input,select', function () {
            $('.menubottom.fixed-bottom').removeClass('fixed-bottom').css('position', 'static');
            $('.msg-login').css('position', 'absolute');
        }).on('blur', 'textarea,input,select', function () {
            $('.menubottom').addClass('fixed-bottom').css('position', '');
            $('.msg-login').css('position', 'fixed');
        });
    }*/
</script>