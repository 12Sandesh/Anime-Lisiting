<?php
session_start();
include "../includes/manga.inc.php";
include "../includes/characters.inc.php";
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <title><?php echo $mangaTitle . ' - AnimeKoji'; ?></title>
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
        <div class="banner" style=background-image:url(../media/manga/banner/<?php echo $mangaBanner . ')'; ?>>
            <div class="banner-shadow">
            </div>
        </div>

        <div class="container">
            <div class="container-left">
                <div class="avatar">
                    <?php
                    echo '<div class="avatar-shows" style="background-image:url(../media/manga/avatar/' . $mangaAvatar . ')"></div>';

                    if (isset($_SESSION['userID'])) {
                        if (isset($userAddFavorite)) {
                            echo '<form action="../includes/manga-submit.inc.php?mangaid=' . $mangaID . '" method="post">
                                        <input type="submit" name="favorite-delete" value="* Remove from favorites" class="favorite-add remove">
                                    </form>';
                        } else {
                            echo '<form action="../includes/manga-submit.inc.php?mangaid=' . $mangaID . '" method="post">
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
                            <span><?php echo $mangaType; ?></span>
                        </li>
                        <li class="clear">
                            <span class="info-span">Chapters:</span>
                            <span>
                                <?php
                                if ($mangaChapters == null) {
                                    echo 'Unknown';
                                } else {
                                    echo $mangaChapters;
                                };
                                ?>
                            </span>
                        </li>
                        <li class="clear">
                            <span class="info-span">Volumes:</span>
                            <span>
                                <?php
                                if ($mangaVolumes == null) {
                                    echo 'Unknown';
                                } else {
                                    echo ($mangaVolumes);
                                }
                                ?>
                            </span>
                        </li>
                        <li class="clear">
                            <span class="info-span">Status:</span>
                            <span>
                                <?php
                                echo $mangaStatus;
                                ?>
                            </span>
                        </li>
                        <li class="clear">
                            <span class="info-span">Published:</span>
                            <span>
                                <?php
                                setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'portuguese');
                                date_default_timezone_set('America/Sao_Paulo');
                                $yearStart = substr($mangaStart, -10, 4); // year
                                $monthStart = substr($mangaStart, -5, 2); // month
                                $dayStart = substr($mangaStart, -2, 2);  // day

                                $yearEnd = substr($mangaEnd, -10, 4); // year
                                $monthEnd = substr($mangaEnd, -5, 2); // month
                                $dayEnd = substr($mangaEnd, -2, 2); // day

                                // Start date
                                if ($mangaStart != null) {
                                    // If the start date is not null
                                    if ($yearStart > 0 && $monthStart > 0 && $dayStart > 0) {
                                        echo strftime('%d de %b, %Y', strtotime($mangaStart)) . ' to ';
                                    }
                                    // If only the day is null
                                    else if ($yearStart > 0 && $monthStart > 0 && $dayStart <= 0) {
                                        $mangaStart = $yearStart . '-' . $monthStart . '-' . '01';
                                        echo ucfirst(strftime('%b, %Y', strtotime($mangaStart))) . ' to ';
                                    }
                                    // If the day and month are null
                                    else if ($yearStart > 0 && $monthStart <= 0 && $dayStart <= 0) {
                                        $mangaStart = $yearStart . '-' . '01' . '-' . '01';
                                        echo strftime('%Y', strtotime($mangaStart)) . ' to ';
                                    } else {
                                        echo '? to ';
                                    }
                                } else if ($mangaStart == null && $mangaEnd == null) {
                                    echo 'Unknown';
                                } else {
                                    echo '? to ';
                                }

                                if ($mangaEnd != null) {
                                    // If the end date is not null
                                    if ($yearEnd > 0 && $monthEnd > 0 && $dayEnd > 0) {
                                        echo strftime('%d de %b, %Y', strtotime($mangaEnd));
                                    }
                                    // If only the day is null
                                    else if ($yearEnd > 0 && $monthEnd > 0 && $dayEnd <= 0) {
                                        $mangaEnd = $yearEnd . '-' . $monthEnd . '-' . '01';
                                        echo ucfirst(strftime('%b, %Y', strtotime($mangaEnd)));
                                    }
                                    // If the day and month are null
                                    else if ($yearEnd > 0 && $monthEnd <= 0 && $dayEnd <= 0) {
                                        $mangaEnd = $yearEnd . '-' . '01' . '-' . '01';
                                        echo strftime('%Y', strtotime($mangaEnd));
                                    } else {
                                        echo '?';
                                    }
                                } else if ($mangaStart == null && $mangaEnd == null) {
                                    echo '';
                                } else {
                                    echo '?';
                                }
                                ?>
                            </span>
                        </li>
                        <li class="clear">
                            <span class="info-span">Genres:</span>
                            <span>
                                <?php
                                if ($mangaGenres == null) {
                                    echo 'Unknown';
                                } else {
                                    echo ($mangaGenres);
                                }
                                ?>
                            </span>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="container-right">
                <div class="title">
                    <h1 class="title-clear"><?php echo $mangaTitle ?></h1>
                    <?php
                    if (isset($_SESSION['userID'])) {
                        if ($_SESSION['userPermissions'] > 0) {
                            echo '<a href="../../admin/includes/admin-edit.php?config=edit&mangaid=' . $mangaID . '" class="edit">(Edit)</a>';
                        }
                    }
                    ?>
                </div>

                <div class="ranked">
                    <div class="score">
                        <?php
                        if ($mangaScore > 0) {
                            echo number_format($mangaScore, 2);
                        } else {
                            echo 'N/A';
                        }
                        ?>
                        <hr>
                    </div>
                    <div class="members">
                        <?php
                        if ($mangaUsers > 0) {
                            echo $mangaUsers;
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
                        echo '
                                    <div class="status-score">
                                        <form>
                                            <select class="select" id="mangaStatus" name="status-submit">
                                                <option value="1"';
                        if (isset($statusSelect1)) {
                            echo $statusSelect1;
                        }
                        echo '>Reading</option>
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
                        echo '>Plan to Read</option>
                                            </select>
                                        </form>

                                        <form>
                                            <select class="select" id="mangaScore" name="score-submit">
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
                                    </div>

                                    <div class="user-chapters">
                                        <span>Chapters:</span>
                                        <form id="mangaChapters">
                                            <input type="text" size="3" value="' . $userChapters . '" name="chapters">
                                        </form>
                                        <span>/</span>
                                        <span>';
                        if ($mangaChapters == null) {
                            echo '?';
                        } else {
                            echo $mangaChapters;
                        }
                        echo '</span>
                                    </div>

                                    <div class="user-volumes">
                                        <span>Volumes:</span>
                                        <form id="mangaVolumes">
                                            <input type="text" size="3" value="' . $userVolumes . '" name="volumes">
                                        </form>
                                        <span>/</span>
                                        <span>';
                        if ($mangaVolumes == null) {
                            echo '?';
                        } else {
                            echo $mangaVolumes;
                        }
                        echo '</span>
                                    </div>
                                    
                                    <div class="user-delete">
                                        <form action="../includes/manga-submit.inc.php?mangaid=' . $mangaID . '" method="post">
                                            <input type="submit" value="* Remove from list" id="delete" name="delete">
                                        </form>
                                    </div>';
                    } else {
                        echo '<form action="../includes/manga-submit.inc.php?mangaid=' . $mangaID . '" method="post">
                                        <input type="submit" class="button-submit" value="Add" name="add-submit">
                                    </form>';
                    }
                } else {
                    echo '<div class="not-login">Want to add this manga to your list or favorites? <a href="login.php">Login</a> or <a href="register.php">Sign Up</a> first!</div>';
                }
                echo '</div>';
                ?>
                <div class="sinopse">
                    <h3>Synopsis</h3>
                    <span>
                        <?php
                        if ($mangaSinopse == null) {
                            echo 'No synopsis added for this title.';
                        } else {
                            echo $mangaSinopse;
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