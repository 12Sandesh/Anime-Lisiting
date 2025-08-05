<?php
if (session_status() != PHP_SESSION_ACTIVE) {
    session_start();
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <title>Banned User - AnimeKoji</title>
    <meta charset="UTF-8">
    <link rel="shortcut icon" href="../img/logo_init.png">
    <link rel="stylesheet" type="text/css" href="../css/error-pages.css">
    <link rel="stylesheet" type="text/css" href="../css/menu.css">
    <link rel="stylesheet" type="text/css" href="../css/footer.css">
    <link rel="stylesheet" type="text/css" href="../css/fontawesome.min.css">
</head>

<body>
    <?php
    include "menu.php";
    ?>

    <div class="page-wrap">
        <div class="container">
            <img class="error-image-banned" src="../img/banned1.png">
            <div class="error"><a href="index.php">ERROR</a></div>
            <div class="message">This user has been banned.</div>
        </div>
    </div>

    <?php
    include "footer.php";
    ?>
</body>

</html>