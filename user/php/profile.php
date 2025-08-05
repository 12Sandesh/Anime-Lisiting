<?php
session_start();
include "../includes/profile.inc.php";
include "../includes/comments.inc.php";
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <title><?php echo 'Profile of ' . $userName . ' - MinhaLista'; ?></title>
    <meta charset="UTF-8">
    <link rel="shortcut icon" href="../img/logo_init.png">
    <link rel="stylesheet" type="text/css" href="../css/profile.css">
    <link rel="stylesheet" type="text/css" href="../css/menu.css">
    <link rel="stylesheet" type="text/css" href="../css/footer.css">
    <link rel="stylesheet" type="text/css" href="../css/fontawesome.min.css">
</head>

<body>
    <?php
    include "menu.php";
    ?>

    <div class="page-wrap">
        <div class="banner" style=background-image:url(../media/users/banner/<?php echo $userBanner . ')'; ?>>
            <div class="banner-shadow">
            </div>
        </div>
        <div class="container">
            <div class="container-left">

                <div class="avatar">
                    <?php
                    if ($userAvatar == null) {
                        echo '<div class="avatar-profile" style="background-image:url(../media/users/avatar/avatarDefault.png)"></div>';
                    } else {
                        echo '<div class="avatar-profile" style="background-image:url(../media/users/avatar/' . $userAvatar . ')"></div>';
                    }

                    if ($userPermissions > 0) {
                        echo '<h5 class="usertype admin">Administrator</h5>';
                    } else {
                        echo '<h5 class="usertype member">Member</h5>';
                    }
                    ?>
                </div>

                <div class="user-info">
                    <ul>
                        <li class="clearfix">
                            <span class="info left">Status</span>
                            <?php
                            $now = time();
                            $userOnlineStatus = strtotime($userOnlineStatus);
                            $status = $now - $userOnlineStatus;

                            if ($status > 300) {
                                echo '<span class="info right offline">Offline</span>';
                            } else {
                                echo '<span class="info right online">Online</span>';
                            }
                            ?>
                        </li>
                        <li class="info-bg">
                            <span class="info left">Gender</span>
                            <span class="info right"><?php echo $userGender; ?></span>
                        </li>
                        <li>
                            <span class="info left">Birthday</span>
                            <span class="info right">
                                <?php
                                if ($userBirthday == NULL) {
                                    echo 'Not specified';
                                } else {
                                    echo strftime('%d %b, %Y', strtotime($userBirthday));
                                }
                                ?>
                            </span>
                        </li>
                        <li class="info-bg">
                            <span class="info left">Location</span>
                            <span class="info right">
                                <?php
                                if ($userLocalization == null) {
                                    echo 'Not specified';
                                } else {
                                    echo $userLocalization;
                                }
                                ?>
                            </span>
                        </li>
                        <li>
                            <span class="info left">Registered</span>
                            <span class="info right">
                                <?php
                                echo strftime('%d %b, %Y', strtotime($userDate));
                                ?>
                            </span>
                        </li>
                    </ul>
                    <div class="buttons-list">
                        <a href="animelist.php?userid=<?php echo $userID ?>&status=5">Anime List</a>
                        <a href="mangalist.php?userid=<?php echo $userID ?>&status=5">Manga List</a>
                    </div>
                </div>
            </div> <!-- Container left -->

            <div class="container-right">
                <div class="username">
                    <h1 class="username-clear"><?php echo $userName; ?></h1>
                    <?php
                    if (isset($_SESSION['userID'])) {
                        if ($_SESSION['userPermissions'] > 0 && $userID != $_SESSION['userID']) {
                            echo '<a href="../../admin/php/admin-edit.php?config=edit&userid=' . $userID . '" class="edit">(Edit)</a>';
                        }
                    }
                    ?>
                </div>

                <div class="aboutme">
                    <h3>About Me</h3>
                    <?php
                    if (empty($userAbout)) {
                        echo '<h4>No information added</h4>';
                    } else {
                        echo '<div class="aboutme-content">' . $userAbout . '</div>';
                    }
                    ?>
                </div>

                <div class="stats">
                    <h3>Statistics</h3>
                    <div class="stats-grid">
                        <!-- Anime statistics -->
                        <div class="stats-anime">
                            <h4>Anime</h4>
                            <div class="stats-graph">
                                <?php
                                if (empty($animeWatching)) {
                                    $animeWatching = 0;
                                }
                                if (empty($animeCompleted)) {
                                    $animeCompleted = 0;
                                }
                                if (empty($animeDropped)) {
                                    $animeDropped = 0;
                                }
                                if (empty($animePlanToWatch)) {
                                    $animePlanToWatch = 0;
                                }

                                if ($animeStatusTotal > 0) {
                                    $animeTotalWidth = 400 / $animeStatusTotal;
                                    $animeWatchingTW = $animeTotalWidth * $animeWatching;
                                    $animeCompletedTW = $animeTotalWidth * $animeCompleted;
                                    $animeDroppedTW = $animeTotalWidth * $animeDropped;
                                    $animePlanTW = $animeTotalWidth * $animePlanToWatch;
                                } else {
                                    $animeWatchingTW = 0;
                                    $animeCompletedTW = 0;
                                    $animeDroppedTW = 0;
                                    $animePlanTW = 0;
                                }
                                ?>
                                <span class="stats-graph-watching" style="width: <?php echo $animeWatchingTW; ?>px;height: 20px;"></span>
                                <span class="stats-graph-completed" style="width: <?php echo $animeCompletedTW; ?>px;height: 20px;"></span>
                                <span class="stats-graph-dropped" style="width: <?php echo $animeDroppedTW; ?>px;height: 20px;"></span>
                                <span class="stats-graph-plan" style="width: <?php echo $animePlanTW; ?>px;height: 20px;"></span>
                            </div>

                            <div class="stats-status">
                                <ul>
                                    <li>
                                        <a href="animelist.php?userid=<?php echo $userID ?>&status=1" class="circle-status watching">
                                            Watching
                                        </a>
                                        <span class="right">
                                            <?php
                                            if (isset($animeWatching)) {
                                                echo $animeWatching;
                                            } else {
                                                echo '0';
                                            }
                                            ?>
                                        </span>
                                    </li>
                                    <li>
                                        <a href="animelist.php?userid=<?php echo $userID ?>&status=2" class="circle-status completed">
                                            Completed
                                        </a>
                                        <span class="right">
                                            <?php
                                            if (isset($animeCompleted)) {
                                                echo $animeCompleted;
                                            } else {
                                                echo '0';
                                            }
                                            ?>
                                        </span>
                                    </li>
                                    <li>
                                        <a href="animelist.php?userid=<?php echo $userID ?>&status=3" class="circle-status dropped">
                                            Dropped
                                        </a>
                                        <span class="right">
                                            <?php
                                            if (isset($animeDropped)) {
                                                echo $animeDropped;
                                            } else {
                                                echo '0';
                                            }
                                            ?>
                                        </span>
                                    </li>
                                    <li>
                                        <a href="animelist.php?userid=<?php echo $userID ?>&status=4" class="circle-status plan">
                                            Plan to Watch
                                        </a>
                                        <span class="right">

                                            <?php
                                            if (isset($animePlanToWatch)) {
                                                echo $animePlanToWatch;
                                            } else {
                                                echo '0';
                                            }
                                            ?>
                                        </span>
                                    </li>
                                </ul>
                            </div>
                            <div class="stats-status-total">
                                <ul>
                                    <li>
                                        <span>Total</span>
                                        <span class="right"><?php echo $animeStatusTotal; ?></span>
                                    </li>
                                    <li>
                                        <span>Episodes</span>
                                        <span class="right">
                                            <?php
                                            if (isset($animeEpisodesTotal)) {
                                                echo $animeEpisodesTotal;
                                            } else {
                                                echo '0';
                                            }
                                            ?>
                                        </span>
                                    </li>
                                </ul>
                            </div> <!-- Status-status-total -->
                        </div> <!-- Stats anime -->

                        <!-- Manga statistics -->
                        <div class="stats-manga">
                            <h4>Manga</h4>
                            <div class="stats-graph">
                                <?php
                                if (empty($mangaReading)) {
                                    $mangaReading = 0;
                                }
                                if (empty($mangaCompleted)) {
                                    $mangaCompleted = 0;
                                }
                                if (empty($mangaDropped)) {
                                    $mangaDropped = 0;
                                }
                                if (empty($mangaPlanToReading)) {
                                    $mangaPlanToReading = 0;
                                }

                                if ($mangaStatusTotal > 0) {
                                    $mangaTotalWidth = 400 / $mangaStatusTotal;
                                    $mangaReadingTW = $mangaTotalWidth * $mangaReading;
                                    $mangaCompletedTW = $mangaTotalWidth * $mangaCompleted;
                                    $mangaDroppedTW = $mangaTotalWidth * $mangaDropped;
                                    $mangaPlanTW = $mangaTotalWidth * $mangaPlanToReading;
                                } else {
                                    $mangaReadingTW = 0;
                                    $mangaCompletedTW = 0;
                                    $mangaDroppedTW = 0;
                                    $mangaPlanTW = 0;
                                }

                                ?>
                                <span class="stats-graph-watching" style="width: <?php echo $mangaReadingTW; ?>px;height: 20px;"></span>
                                <span class="stats-graph-completed" style="width: <?php echo $mangaCompletedTW; ?>px;height: 20px;"></span>
                                <span class="stats-graph-dropped" style="width: <?php echo $mangaDroppedTW; ?>px;height: 20px;"></span>
                                <span class="stats-graph-plan" style="width: <?php echo $mangaPlanTW; ?>px;height: 20px;"></span>
                            </div>
                            <div class="stats-status">
                                <ul>
                                    <li>
                                        <a href="mangalist.php?status=1&userid=<?php echo $userID; ?>" class="circle-status watching">
                                            Reading
                                        </a>
                                        <span class="right">
                                            <?php
                                            if (isset($mangaReading)) {
                                                echo $mangaReading;
                                            } else {
                                                echo '0';
                                            }
                                            ?>
                                        </span>
                                    </li>
                                    <li>
                                        <a href="mangalist.php?status=2&userid=<?php echo $userID; ?>" class="circle-status completed">
                                            Completed
                                        </a>
                                        <span class="right">
                                            <?php
                                            if (isset($mangaCompleted)) {
                                                echo $mangaCompleted;
                                            } else {
                                                echo '0';
                                            }
                                            ?>
                                        </span>
                                    </li>
                                    <li>
                                        <a href="mangalist.php?status=3&userid=<?php echo $userID; ?>" class="circle-status dropped">
                                            Dropped
                                        </a>
                                        <span class="right">
                                            <?php
                                            if (isset($mangaDropped)) {
                                                echo $mangaDropped;
                                            } else {
                                                echo '0';
                                            }
                                            ?>
                                        </span>
                                    </li>
                                    <li>
                                        <a href="mangalist.php?status=4&userid=<?php echo $userID; ?>" class="circle-status plan">
                                            Plan to Read
                                        </a>
                                        <span class="right">
                                            <?php
                                            if (isset($mangaPlanToReading)) {
                                                echo $mangaPlanToReading;
                                            } else {
                                                echo '0';
                                            }
                                            ?>
                                        </span>
                                    </li>
                                </ul>
                            </div>
                            <div class="stats-status-total">
                                <ul>
                                    <li>
                                        <span>Total</span>
                                        <span class="right"><?php echo $mangaStatusTotal; ?></span>
                                    </li>
                                    <li>
                                        <span>Chapters</span>
                                        <span class="right">
                                            <?php
                                            if (isset($mangaChaptersTotal)) {
                                                echo $mangaChaptersTotal;
                                            } else {
                                                echo '0';
                                            }
                                            ?>
                                        </span>
                                    </li>
                                    <li>
                                        <span>Volumes</span>
                                        <span class="right">
                                            <?php
                                            if (isset($mangaVolumesTotal)) {
                                                echo $mangaVolumesTotal;
                                            } else {
                                                echo '0';
                                            }
                                            ?>
                                        </span>
                                    </li>
                                </ul>
                            </div> <!-- Stats-status-total -->
                        </div> <!-- Stats-manga -->
                    </div> <!-- Stats-grid -->
                </div> <!-- Stats -->

                <div class="user-favorites">
                    <h3>Favorites</h3>
                    <!-- Anime -->
                    <div class="anime-favorites">
                        <h4>Anime</h4>
                        <?php
                        if (isset($animeFavorites)) {
                            echo '<div class="favorites-grid">';
                            for ($i = 0; $i < count($animeFavorites), $i < count($animeID), $i < count($animeTitle); $i++) {
                                echo ' <a href="anime.php?animeid=' . $animeID[$i] . '" class="favorites-avatar" style="background-image:url(../media/anime/avatar/' . $animeFavorites[$i] . ')" title="' . $animeTitle[$i] . '"></a>';
                            }
                            echo '</div>';
                        } else {
                            echo '<h4>No anime added.</h4>';
                        }
                        ?>
                    </div>
                    <div class="manga-favorites">
                        <!-- Manga -->
                        <h4>Manga</h4>
                        <?php
                        if (isset($mangaFavorites)) {
                            echo ' <div class="favorites-grid">';
                            for ($i = 0; $i < count($mangaFavorites), $i < count($mangaID), $i < count($mangaTitle); $i++) {
                                echo ' <a href="manga.php?mangaid=' . $mangaID[$i] . '" class="favorites-avatar" style="background-image:url(../media/manga/avatar/' . $mangaFavorites[$i] . ')" title="' . $mangaTitle[$i] . '"></a>';
                            }
                            echo '</div>';
                        } else {
                            echo '<h4>No manga added.<h4>';
                        }
                        ?>
                    </div>

                    <div class="manga-favorites">
                        <!-- Characters -->
                        <h4>Characters</h4>
                        <?php
                        if (isset($charactersFavorites)) {
                            echo ' <div class="favorites-grid">';
                            for ($i = 0; $i < count($charactersFavorites), $i < count($characterID), $i < count($characterName); $i++) {
                                echo ' <a href="characters.php?characterid=' . $characterID[$i] . '" class="favorites-avatar" style="background-image:url(../media/characters/avatar/' . $charactersFavorites[$i] . ')" title="' . $characterName[$i] . '"></a>';
                            }
                            echo '</div>';
                        } else {
                            echo '<h4>No characters added.<h4>';
                        }
                        ?>
                    </div> <!-- Characters favorites -->
                </div> <!-- User-favorites -->
                <div class="comments">
                    <h3 class="h3-comments">Comments</h3>
                    <?php
                    echo '<a href="all-comments.php?userid=' . $userID . '&page=1" class="all-comments">All comments (' . $resultCheckAllComments . ')</a>';
                    if (isset($_SESSION['userID'])) {
                        echo '
                                <form action="../includes/comments.inc.php?userid=' . $userID . '" method="post" class="comments-form" id="comments">
                                    <textarea placeholder="Write a comment..." name="comment-text" class="comment-input" id="comment"></textarea>
                                    <input type="submit" name="comment-submit" value="Send Comment" class="comment-submit">

                                    <p class="error-comment"></p>
                                </form>';
                    } else {
                        echo '
                                <div class="comment-not-session">
                                    Want to leave a comment? <a href="login.php">Login</a> or <a href="register.php">Register</a> first!
                                </div>
                                ';
                    }
                    ?>
                    <?php
                    if ($resultCheckComment > 0) {
                        echo '<div class="comments-grid">';
                        for ($i = 0; $i < count($userCommentID), $i < count($userComment), $i < count($userIDComment), $i < count($userCommentDate), $i < count($userCommentName), $i < count($userCommentAvatar); $i++) {

                            if (empty($userCommentAvatar[$i])) {
                                $userCommentAvatar[$i] = "avatarDefault.png";
                            }

                            echo '
                                    <div class="comment-grid">
                                        <div class="user-comment-avatar">
                                            <a href="profile.php?userid=' . $userIDComment[$i] . '" style="background-image:url(../media/users/avatar/' . $userCommentAvatar[$i] . ')" class="user-comment-avatar"></a>
                                        </div>
                                        <div class="comment-content">
                                            <div class="comment-username">
                                                <a href="profile.php?userid=' . $userIDComment[$i] . '">' . $userCommentName[$i] . '</a>
                                            </div>
                                            <div class="comment-date">' .  date("d/m/Y H:i A", strtotime($userCommentDate[$i])) . '</div>
                                            <div class="comment-text">' . $userComment[$i] . '</div>';

                            if (isset($_SESSION['userID']) && $userID == $_SESSION['userID'] || isset($_SESSION['userID']) && $userIDComment[$i] == $_SESSION['userID']) {
                                echo '
                                            <div class="comment-delete">
                                                <form action="../includes/comments.inc.php" method="post">
                                                    <input type="hidden" name="commentID" value="' . $userCommentID[$i] . '">
                                                    <input type="submit" name="comment-delete" value="Delete" class="comment-delete-btn">
                                                </form>
                                            </div>';
                            }

                            echo ' 
                                        </div>
                                    </div>';
                        }
                        echo '</div>';
                    }
                    ?>
                </div> <!-- Comments -->
            </div> <!-- Container-right -->
        </div> <!-- Container -->
    </div> <!-- Page-wrap -->

    <?php
    include "footer.php";
    ?>
</body>

</html>