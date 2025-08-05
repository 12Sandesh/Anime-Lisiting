<?php
session_start();
include "../includes/animelist.inc.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title><?php echo $userName . ' | Anime List - AnimeKoji' ?></title>
    <meta charset="UTF-8">
    <link rel="shortcut icon" href="../img/logo_init.png">
    <link rel="stylesheet" type="text/css" href="../css/list.css">
    <link rel="stylesheet" type="text/css" href="../css/footer.css">
    <link rel="stylesheet" type="text/css" href="../css/fontawesome.min.css">
</head>

<body>
    <div class="page-wrap">

        <div class="bg-color"></div>

        <div class="container">
            <div class="header">
                <div class="menu">
                    <a href="index.php">
                        <div class="menu-logo" style="background-image: url(../img/logo11.png)"></div>
                    </a>

                    <div class="menu-buttons">
                        <div class="menu-content">
                            <span>Viewing the</span>

                            <span class="menu-redirect" id="dropdown2">
                                <?php
                                $list = basename(__FILE__);
                                if ($list == 'animelist.php') {
                                    echo 'Anime List';
                                } else {
                                    echo 'Manga List';
                                }
                                ?>
                            </span>

                            <span>of</span>

                            <a href="profile.php?userid=<?php echo $userID; ?>" title="Go to <?php echo $userName; ?>'s profile" class="menu-redirect"><?php echo $userName; ?></a>

                            <i class="fa fa-angle-down" id="dropdown"></i>
                        </div>

                        <div class="list-display-none" id="display">
                            <?php
                            if ($list == 'animelist.php') {
                                echo '<a href="mangalist.php?userid=' . $userID . '&status=5">Manga List</a>';
                            } else {
                                echo '<a href="animelist.php?userid=' . $userID . '&status=5">Anime List</a>';
                            }

                            if (isset($_SESSION['userID'])) {
                                echo '<a href="profile.php?userid=' . $_SESSION['userID'] . '">My Profile</a>';
                            } else {
                                echo '<a href="signup.php">Register</a>';
                                echo '<a href="login.php">Login</a>';
                            }
                            ?>
                        </div>
                    </div>

                </div>
            </div>

            <div class="list-container">
                <div class="list-background" style=background-image:url(../media/users/bannerList/<?php echo $userBannerList . ')'; ?>>
                    <div class="shadow"></div>
                </div>

                <div class="status-menu">
                    <a href="animelist.php?userid=<?php echo $userID ?>&status=5" class="status-button">ALL ANIME</a>
                    <a href="animelist.php?userid=<?php echo $userID ?>&status=1" class="status-button">CURRENTLY WATCHING</a>
                    <a href="animelist.php?userid=<?php echo $userID ?>&status=2" class="status-button">COMPLETED</a>
                    <a href="animelist.php?userid=<?php echo $userID ?>&status=3" class="status-button">DROPPED</a>
                    <a href="animelist.php?userid=<?php echo $userID ?>&status=4" class="status-button">PLAN TO WATCH</a>
                </div>

                <div class="list-status">
                    <?php
                    $status = $_GET['status'];
                    switch ($status) {
                        case '1':
                            $status = 'CURRENTLY WATCHING';
                            break;
                        case '2':
                            $status = 'COMPLETED';
                            break;
                        case '3':
                            $status = 'DROPPED';
                            break;
                        case '4':
                            $status = 'PLAN TO WATCH';
                            break;
                        case '5':
                            $status = 'ALL ANIME';
                            break;
                    }
                    echo $status;
                    ?>
                </div>

                <table class="list">
                    <tr class="list-table-header">
                        <td class="data-header status"></td>
                        <td class="data-header rank">#</td>
                        <td class="data-header image">Avatar</td>
                        <td class="data-header title">Anime</td>
                        <td class="data-header score">Score</td>
                        <td class="data-header type">Type</td>
                        <td class="data-header progress">Progress</td>
                    </tr>
                    <?php
                    for ($i = 0, $ii = 1; $i < $resultCheck, $i < count($animeID), $i < count($animeTitle), $i < count($animeAvatar), $i < count($animeType), $i < count($animeEpisodes), $i < count($userStatus), $i < count($userScore), $i < count($userEpisodes); $i++, $ii++) {

                        if ($userStatus[$i] == '1') {
                            $userStatus[$i] = 'watching';
                        }
                        if ($userStatus[$i] == '2') {
                            $userStatus[$i] = 'completed';
                        }
                        if ($userStatus[$i] == '3') {
                            $userStatus[$i] = 'dropped';
                        }
                        if ($userStatus[$i] == '4') {
                            $userStatus[$i] = 'plantowatch';
                        }

                        if (empty($userScore[$i])) {
                            $userScore[$i] = '-';
                        }

                        if (empty($animeEpisodes[$i])) {
                            $animeEpisodes[$i] = '?';
                        }

                        echo '
                                <tr class="list-table-data">
                                    <td class="data status ' . $userStatus[$i] . '"></td>
                                    <td class="data rank">' . $ii . '</td>
                                    <td class="data image">
                                        <a href="anime.php?animeid=' . $animeID[$i] . '" class="avatar" style="background-image: url(../media/anime/avatar/' . $animeAvatar[$i] . ')"></a>
                                    </td>
                                    <td class="data title">
                                        <a href="anime.php?animeid=' . $animeID[$i] . '">' . $animeTitle[$i] . '</a>
                                    </td>
                                    <td class="data score">' . $userScore[$i] . '</td>
                                    <td class="data type">' . $animeType[$i] . '</td>
                                    <td class="data progress">' . $userEpisodes[$i] . ' / ' . $animeEpisodes[$i] . '</td>
                                </tr>';
                    }
                    ?>
                </table>
                <?php
                if ($resultCheck < 1) {
                    echo '<div class="block"></div>';
                }
                ?>
                <div class="list-total"></div>
            </div>
        </div>
    </div>
    <?php
    include "footer.php";
    ?>
</body>
</html>