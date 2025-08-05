<?php
session_start();
include "../includes/index.inc.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Home - AnimeKoji</title>
    <meta charset="UTF-8">
    <link rel="shortcut icon" href="../img/logo_init.png">
    <link rel="stylesheet" type="text/css" href="../css/index.css">
    <link rel="stylesheet" type="text/css" href="../css/menu.css">
    <link rel="stylesheet" type="text/css" href="../css/footer.css">
    <link rel="stylesheet" type="text/css" href="../css/fontawesome.min.css">
</head>

<body>
    <?php
    include "menu.php";
    ?>

    <div class="page-wrap">
        <div class="logo">
            <img src="../img/logo11.png">
        </div>

        <div class="text-changing">
            <p id="text-changing"></p>
        </div>


        <?php
        if (isset($_SESSION["userID"])) {
            echo
            '<div class="text-welcome"> Welcome 
                        <a href="profile.php?userid=' . $_SESSION["userID"] . '">' . $_SESSION["username"] . '.</a>
                    </div>';
        } else {
            echo
            '<div class="links"> 
                        <a href="signup.php" class="link-signup">Register</a>
                        <a href="login.php" class="link-login">Login</a>  
                    </div>';
        }
        ?>

        <div class="video-header">
            <video autoplay="autoplay" loop="loop" muted="muted" class="video-bg">
                <source type="video/mp4" src="../videos/bg2.mp4">
            </video>
        </div>

        <div class="shows">
            <div class="text-header">DISCOVER NEW ANIME AND MANGA!</div>
            <div class="grid">
                <?php
                // Show anime/manga
                for ($i = 0; $i < count($animeID), $i < count($animeTitle), $i < count($animeAvatar); $i++) {
                    echo '
                            <div class="shows-not-responsive">
                                <a href="anime.php?animeid=' . $animeID[$i] . '" class="avatar" title="' . $animeTitle[$i] . '" style="background-image:url(../media/anime/avatar/' . $animeAvatar[$i] . ')"></a>
                            </div>';
                }

                for ($i = 0; $i < count($mangaID), $i < count($mangaTitle), $i < count($mangaAvatar); $i++) {
                    echo '
                            <div class="shows-not-responsive">
                                <a href="manga.php?mangaid=' . $mangaID[$i] . '" class="avatar" title="' . $mangaTitle[$i] . '" style="background-image:url(../media/manga/avatar/' . $mangaAvatar[$i] . ')"></a>
                            </div>';
                }

                // For when the site is responsive
                for ($i = 0; $i < 3; $i++) {
                    echo '
                            <div class="shows-responsive">
                                <a href="anime.php?animeid=' . $animeID[$i] . '" class="avatar" title="' . $animeTitle[$i] . '" style="background-image:url(../media/anime/avatar/' . $animeAvatar[$i] . ')"></a>
                            </div>';
                }

                for ($i = 0; $i < 3; $i++) {
                    echo '
                            <div class="shows-responsive">
                                <a href="manga.php?mangaid=' . $mangaID[$i] . '" class="avatar" title="' . $mangaTitle[$i] . '" style="background-image:url(../media/manga/avatar/' . $mangaAvatar[$i] . ')"></a>
                            </div>';
                }
                ?>
            </div>
        </div>
    </div>

    <?php
    include "footer.php"
    ?>
</body>

</html>