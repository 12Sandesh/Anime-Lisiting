<?php
session_start();
include "../includes/anime.inc.php";
include "../includes/characters.inc.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title><?php echo $animeTitle . ' - AnimeKoji'; ?></title>
    <meta charset="UTF-8">
    <link rel="shortcut icon" href="img/logo_init.png">
    <link rel="stylesheet" type="text/css" href="../css/shows.css">
    <link rel="stylesheet" type="text/css" href="../css/menu.css">
    <link rel="stylesheet" type="text/css" href="../css/footer.css">
    <link rel="stylesheet" type="text/css" href="../css/fontawesome.min.css">
</head>

<body>
    <?php
    include "menu.php";
    ?>

    <div class="page-wrap">
        <div class="banner" style=background-image:url(../media/anime/banner/<?php echo $animeBanner . ')'; ?>>
            <div class="banner-shadow">
            </div>
        </div>

        <div class="container">
            <div class="container-left">
                <div class="avatar">
                    <?php
                    echo '<div class="avatar-shows" style="background-image:url(../media/anime/avatar/' . $animeAvatar . ')"></div>';

                    if (isset($_SESSION['userID'])) {
                        if (isset($userAddFavorite)) {
                            echo '<form action="../includes/anime-submit.inc.php?animeid=' . $animeID . '" method="post">
                                        <input type="submit" name="favorite-delete" value="* Remove from favorites" class="favorite-add remove">
                                    </form>';
                        } else {
                            echo '<form action="../includes/anime-submit.inc.php?animeid=' . $animeID . '" method="post">
                                            <input type="submit" name="favorite-submit" value="* Add to favorites" class="favorite-add">
                                        </form>';
                        }
                    }
                    ?>
                </div>

                <div class="info">
                    <h3>Information</h3>
                    <ul>
                        <li class="clear">
                            <span class="info-span">Type:</span>
                            <span><?php echo $animeType; ?></span>
                        </li>
                        <li class="clear">
                            <span class="info-span">Episodes:</span>
                            <span>
                                <?php
                                if ($animeEpisodes == null) {
                                    echo 'Unknown';
                                } else {
                                    echo $animeEpisodes;
                                };
                                ?>
                            </span>
                        </li>
                        <li class="clear">
                            <span class="info-span">Status:</span>
                            <span>
                                <?php
                                echo $animeStatus;
                                ?>
                            </span>
                        </li>
                        <li class="clear">
                            <span class="info-span">Aired:</span>
                            <span>
                                <?php
                                setlocale(LC_TIME, 'en_US', 'en_US.utf-8', 'english');
                                date_default_timezone_set('America/Sao_Paulo');
                                $yearStart = substr($animeStart, -10, 4); // Year
                                $monthStart = substr($animeStart, -5, 2); // Month
                                $dayStart = substr($animeStart, -2, 2); // Day 

                                $yearEnd = substr($animeEnd, -10, 4); // Year
                                $monthEnd = substr($animeEnd, -5, 2); // Month
                                $dayEnd = substr($animeEnd, -2, 2); // Day

                                // Start date
                                if ($animeStart != null) {
                                    // If start date is not null
                                    if ($yearStart > 0 && $monthStart > 0 && $dayStart > 0) {
                                        echo strftime('%d %b, %Y', strtotime($animeStart)) . ' to ';
                                    }
                                    // If only the day is null
                                    else if ($yearStart > 0 && $monthStart > 0 && $dayStart <= 0) {
                                        $animeStart = $yearStart . '-' . $monthStart . '-' . '01';
                                        echo ucfirst(strftime('%b, %Y', strtotime($animeStart))) . ' to ';
                                    }
                                    // If day and month are null
                                    else if ($yearStart > 0 && $monthStart <= 0 && $dayStart <= 0) {
                                        $animeStart = $yearStart . '-' . '01' . '-' . '01';
                                        echo strftime('%Y', strtotime($animeStart)) . ' to ';
                                    } else {
                                        echo '? to ';
                                    }
                                } else if ($animeStart == null && $animeEnd == null) {
                                    echo 'Unknown';
                                } else {
                                    echo '? to ';
                                }

                                if ($animeEnd != null) {
                                    // If end date is not null
                                    if ($yearEnd > 0 && $monthEnd > 0 && $dayEnd > 0) {
                                        echo strftime('%d %b, %Y', strtotime($animeEnd));
                                    }
                                    // If only the day is null
                                    else if ($yearEnd > 0 && $monthEnd > 0 && $dayEnd <= 0) {
                                        $animeEnd = $yearEnd . '-' . $monthEnd . '-' . '01';
                                        echo ucfirst(strftime('%b, %Y', strtotime($animeEnd)));
                                    }
                                    // If day and month are null
                                    else if ($yearEnd > 0 && $monthEnd <= 0 && $dayEnd <= 0) {
                                        $animeEnd = $yearEnd . '-' . '01' . '-' . '01';
                                        echo strftime('%Y', strtotime($animeEnd));
                                    } else {
                                        echo '?';
                                    }
                                } else if ($animeStart == null && $animeEnd == null) {
                                    echo '';
                                } else {
                                    echo '?';
                                }
                                ?>
                            </span>
                        </li>
                        <li class="clear">
                            <span class="info-span">Source:</span>
                            <span>
                                <?php
                                if ($animeSource == null) {
                                    echo 'Unknown';
                                } else {
                                    echo ($animeSource);
                                }
                                ?>
                            </span>
                        </li>
                        <li class="clear">
                            <span class="info-span">Genres:</span>
                            <span>
                                <?php
                                if ($animeGenres == null) {
                                    echo 'Unknown';
                                } else {
                                    echo ($animeGenres);
                                }
                                ?>
                            </span>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="container-right">
                <div class="title">
                    <h1 class="title-clear"><?php echo $animeTitle ?></h1>
                    <?php
                    if (isset($_SESSION['userID'])) {
                        if ($_SESSION['userPermissions'] > 0) {
                            echo '<a href="../../admin/php/admin-edit.php?config=edit&animeid=' . $animeID . '" class="edit">(Edit)</a>';
                        }
                    }
                    ?>
                </div>

                <div class="ranked">
                    <div class="score">
                        <?php
                        if ($animeScore > 0) {
                            echo number_format($animeScore, 2);
                        } else {
                            echo 'N/A';
                        }
                        ?>
                        <hr>
                    </div>
                    <div class="members">
                        <?php
                        if ($animeUsers > 0) {
                            echo $animeUsers;
                        } else {
                            echo 'N/A';
                        }
                        ?>
                        <hr>
                    </div>

                </div>
                <?php
                echo '<div class="user-add">';
                if (isset($_SESSION['userID'])) {
                    if (isset($userAdd)) {
                        echo '<form>
                                        <select class="select" id="animeStatus" name="status-submit">
                                            <option value="1"';
                        if (isset($statusSelect1)) {
                            echo $statusSelect1;
                        }
                        echo '>Watching</option>
                                            <option value="2"';
                        if (isset($statusSelect2)) {
                            echo $statusSelect2;
                        }
                        echo '>Completed</option>
                                            <option value="3"';
                        if (isset($statusSelect3)) {
                            echo $statusSelect3;
                        }
                        echo '>Dropped</option>
                                            <option value="4"';
                        if (isset($statusSelect4)) {
                            echo $statusSelect4;
                        }
                        echo '>Plan to Watch</option>
                                        </select>
                                    </form>

                                    <form>
                                        <select class="select" id="animeScore" name="score-submit">
                                            <option value="0">Select</option>
                                            <option value="10"';
                        if (isset($scoreSelect10)) {
                            echo $scoreSelect10;
                        }
                        echo '>(10) Masterpiece</option>
                                            <option value="9"';
                        if (isset($scoreSelect9)) {
                            echo $scoreSelect9;
                        }
                        echo '>(9) Great</option>
                                            <option value="8"';
                        if (isset($scoreSelect8)) {
                            echo $scoreSelect8;
                        }
                        echo '>(8) Very Good</option>
                                            <option value="7"';
                        if (isset($scoreSelect7)) {
                            echo $scoreSelect7;
                        }
                        echo '>(7) Good</option>
                                            <option value="6"';
                        if (isset($scoreSelect6)) {
                            echo $scoreSelect6;
                        }
                        echo '>(6) Fine</option>
                                            <option value="5"';
                        if (isset($scoreSelect5)) {
                            echo $scoreSelect5;
                        }
                        echo '>(5) Average</option>
                                            <option value="4"';
                        if (isset($scoreSelect4)) {
                            echo $scoreSelect4;
                        }
                        echo '>(4) Bad</option>
                                            <option value="3"';
                        if (isset($scoreSelect3)) {
                            echo $scoreSelect3;
                        }
                        echo '>(3) Very Bad</option>
                                            <option value="2"';
                        if (isset($scoreSelect2)) {
                            echo $scoreSelect2;
                        }
                        echo '>(2) Horrible</option>
                                            <option value="1"';
                        if (isset($scoreSelect1)) {
                            echo $scoreSelect1;
                        }
                        echo '>(1) Terrible</option>
                                        </select>
                                    </form>

                                    <div class="user-episodes">
                                        <span>Episodes:</span>
                                        <form id="animeEpisodes">
                                            <input type="text" size="3" value="' . $userEpisodes . '" name="episodes-submit">
                                        </form>
                                        <span>/</span>
                                        <span>';
                        if ($animeEpisodes == null) {
                            echo '?';
                        } else {
                            echo $animeEpisodes;
                        }
                        echo '</span>
                                    </div>
                                    
                                    <div class="user-delete">
                                        <form action="../includes/anime-submit.inc.php?animeid=' . $animeID . '" method="post">
                                            <input type="submit" value="* Remove from list" id="delete" name="delete">
                                        </form>
                                    </div>';
                    } else {
                        echo '<form action="../includes/anime-submit.inc.php?animeid=' . $animeID . '" method="post">
                                        <input type="submit" class="button-submit" value="Add" name="add-submit">
                                    </form>';
                    }
                } else {
                    echo '<div class="not-login">Would you like to add this anime to your list or favorites? <a href="login.php">Login</a> or <a href="register.php">Register</a> first!</div>';
                }
                echo '</div>';
                ?>
                <div class="sinopse">
                    <h3>Synopsis</h3>
                    <span>
                        <?php
                        if ($animeSinopse == null) {
                            echo 'No synopsis added for this title.';
                        } else {
                            echo $animeSinopse;
                        }
                        ?>
                    </span>
                </div>

                <div class="characters">
                    <h3>Characters</h3>
                    <div class="characters-grid">
                        <?php
                        if ($resultCharacters > 0) {
                            for ($i = 0; $i < count($characterID), $i < count($characterName), $i < count($characterAvatar), $i < count($characterRole); $i++) {
                                echo '
                                        <div class="character">
                                            <a href="characters.php?characterid=' . $characterID[$i] . '" class="avatar-character" style="background-image:url(../media/characters/avatar/' . $characterAvatar[$i] . ')"></a>
                                            <div class="content">
                                                <div class="name">
                                                    <a href="characters.php?characterid=' . $characterID[$i] . '">' . $characterName[$i] . '</a>
                                                </div>
                                                <div class="role">' . $characterRole[$i] . '</div>
                                            </div>
                                        </div>';
                            }
                        }

                        ?>
                    </div> <!-- Characters grid -->
                    <?php
                    if ($resultCharacters <= 0) {
                        echo 'No characters added';
                    }
                    ?>
                </div> <!-- Characters -->
            </div> <!-- Container right -->
        </div> <!-- Container -->
    </div> <!-- Page wrap -->
    <?php
    include "footer.php";
    ?>
</body>

</html>