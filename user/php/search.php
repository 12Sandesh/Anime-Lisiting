<?php
session_start();
include "../includes/search.inc.php";

// Ensure variables are defined
$resultCheckAnime = $resultCheckAnime ?? 0;
$resultCheckManga = $resultCheckManga ?? 0;
$resultCheckCharacter = $resultCheckCharacter ?? 0;
$resultCheckUsers = $resultCheckUsers ?? 0;
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <title>Search Results - AnimeKoji</title>
    <meta charset="UTF-8">
    <link rel="shortcut icon" href="../img/logo_init.png">
    <link rel="stylesheet" type="text/css" href="../css/menu.css">
    <link rel="stylesheet" type="text/css" href="../css/footer.css">
    <link rel="stylesheet" type="text/css" href="../css/search.css">
    <link rel="stylesheet" type="text/css" href="../css/fontawesome.min.css">
</head>

<body>
    <?php include "menu.php"; ?>

    <div class="page-wrap">
        <div class="container">
            <div class="results">
                <!-- Anime -->
                <h3>Anime</h3>
                <?php
                if ($resultCheckAnime > 0) {
                    for ($i = 0; $i < count($animeID); $i++) {
                        if (empty($animeEpisodes[$i])) {
                            $animeEpisodes[$i] = '?';
                        }
                        if (empty($animeGenres[$i])) {
                            $animeGenres[$i] = 'Unknown genres';
                        }
                        echo
                        '<div class="result">
                                    <a href="anime.php?animeid=' . $animeID[$i] . '">
                                        <div class="avatar" style="background-image:url(../media/anime/avatar/' . $animeAvatar[$i] . ')"></div>
                                        <div class="content">
                                            <div class="name">' . $animeTitle[$i] . '</div>
                                            <div class="info">' . $animeType[$i] . ' (' . $animeEpisodes[$i] . ' eps) </div>
                                            <div class="info">' . $animeStatus[$i] . '</div>
                                            <div class="info genres">' . $animeGenres[$i] . '</div>
                                        </div>
                                    </a>
                                </div>';
                    }
                } else {
                    echo '<h4>No anime found with this name.</h4>';
                }
                ?>
            </div>

            <!-- Manga -->
            <div class="results">
                <h3>Manga</h3>
                <?php
                if ($resultCheckManga > 0) {
                    for ($i = 0; $i < count($mangaID); $i++) {
                        if (empty($mangaVolumes[$i])) {
                            $mangaVolumes[$i] = '?';
                        }
                        if (empty($mangaGenres[$i])) {
                            $mangaGenres[$i] = 'Unknown genres';
                        }
                        echo
                        '<div class="result">
                                    <a href="manga.php?mangaid=' . $mangaID[$i] . '">
                                        <div class="avatar" style="background-image:url(../media/manga/avatar/' . $mangaAvatar[$i] . ')"></div>
                                        <div class="content">
                                            <div class="name">' . $mangaTitle[$i] . '</div>
                                            <div class="info">' . $mangaType[$i] . ' (' . $mangaVolumes[$i] . ' vols) </div>
                                            <div class="info">' . $mangaStatus[$i] . '</div>
                                            <div class="info genres">' . $mangaGenres[$i] . '</div>
                                        </div>
                                    </a>
                                </div>';
                    }
                } else {
                    echo '<h4>No manga found with this name.</h4>';
                }
                ?>
            </div>

            <!-- Characters -->
            <div class="results">
                <h3>Characters</h3>
                <?php
                if ($resultCheckCharacter > 0) {
                    for ($i = 0; $i < count($characterID); $i++) {
                        echo
                        '<div class="result">
                                    <a href="characters.php?characterid=' . $characterID[$i] . '">
                                        <div class="avatar" style="background-image:url(../media/characters/avatar/' . $characterAvatar[$i] . ')"></div>
                                        <div class="content">
                                            <div class="name">' . $characterName[$i] . '</div>
                                        </div>
                                    </a>
                                </div>';
                    }
                } else {
                    echo '<h4>No character found with this name.</h4>';
                }
                ?>
            </div>

            <!-- Users -->
            <div class="results">
                <h3>Users</h3>
                <?php
                if ($resultCheckUsers > 0) {
                    setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'portuguese');
                    date_default_timezone_set('America/Sao_Paulo');
                    for ($i = 0; $i < count($userID); $i++) {
                        switch ($userGender[$i]) {
                            case "0":
                                $userGender[$i] = 'Not specified';
                                break;
                            case "1":
                                $userGender[$i] = 'Male';
                                break;
                            case "2":
                                $userGender[$i] = 'Female';
                                break;
                        }
                        echo
                        '<div class="result">
                                    <a href="profile.php?userid=' . $userID[$i] . '">';
                        if (empty($userAvatar[$i])) {
                            echo '<div class="avatar" style="background-image:url(../media/users/avatar/avatarDefault)"></div>';
                        } else {
                            echo '<div class="avatar" style="background-image:url(../media/users/avatar/' . $userAvatar[$i] . ')"></div>';
                        }
                        echo
                        '<div class="content">
                                            <div class="name">' . $userName[$i] . '</div>
                                            <div class="info">' . strftime('%d de %b, %Y', strtotime($userDate[$i])) . '</div>
                                            <div class="info">' . $userGender[$i] . '</div>
                                        </div>
                                    </a>
                                </div>';
                    }
                } else {
                    echo '<h4>No user found with this name.</h4>';
                }
                ?>
            </div> <!-- Results -->
        </div> <!-- Container -->
    </div> <!-- Page wrap -->

    <?php include "footer.php"; ?>
</body>

</html>