<?php
session_start();
include "../includes/mangalist.inc.php";

$userID = isset($_GET['userid']) ? intval($_GET['userid']) : 0;
$status = isset($_GET['status']) ? $_GET['status'] : '5';
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <title><?php echo htmlspecialchars($userName) . ' | Manga List - AnimeKoji'; ?></title>
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
                                <?php echo basename(__FILE__) == 'animelist.php' ? 'Anime List' : 'Manga List'; ?>
                            </span>
                            <span>of</span>
                            <a href="profile.php?userid=<?php echo $userID; ?>" title="Go to <?php echo htmlspecialchars($userName); ?>'s profile" class="menu-redirect">
                                <?php echo htmlspecialchars($userName); ?>
                            </a>
                        </div>

                        <div class="list-display-none" id="display">
                            <?php
                            if (basename(__FILE__) == 'animelist.php') {
                                echo '<a href="mangalist.php?userid=' . $userID . '&status=5">Manga List</a>';
                            } else {
                                echo '<a href="animelist.php?userid=' . $userID . '&status=5">Anime List</a>';
                            }

                            if (isset($_SESSION['userID'])) {
                                echo '<a href="profile.php?userid=' . $_SESSION['userID'] . '">My Profile</a>';
                            } else {
                                echo '<a href="signup.php">Sign Up</a>';
                                echo '<a href="login.php">Login</a>';
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>

            <div class="list-container">
                <div class="list-background" style="background-image: url('../media/users/bannerList/<?php echo htmlspecialchars($userBannerList); ?>');">
                    <div class="shadow"></div>
                </div>

                <div class="status-menu">
                    <a href="mangalist.php?userid=<?php echo $userID ?>&status=5" class="status-button">ALL MANGA</a>
                    <a href="mangalist.php?userid=<?php echo $userID ?>&status=1" class="status-button">CURRENTLY READING</a>
                    <a href="mangalist.php?userid=<?php echo $userID ?>&status=2" class="status-button">COMPLETED</a>
                    <a href="mangalist.php?userid=<?php echo $userID ?>&status=3" class="status-button">DROPPED</a>
                    <a href="mangalist.php?userid=<?php echo $userID ?>&status=4" class="status-button">PLAN TO READ</a>
                </div>

                <div class="list-status">
                    <?php
                    $statusNames = [
                        '1' => 'CURRENTLY READING',
                        '2' => 'COMPLETED',
                        '3' => 'DROPPED',
                        '4' => 'PLAN TO READ',
                        '5' => 'ALL MANGA'
                    ];
                    echo isset($statusNames[$status]) ? $statusNames[$status] : 'ALL MANGA';
                    ?>
                </div>

                <table class="list">
                    <tr class="list-table-header">
                        <td class="data-header status"></td>
                        <td class="data-header rank">#</td>
                        <td class="data-header image">Avatar</td>
                        <td class="data-header title">Manga</td>
                        <td class="data-header score">Score</td>
                        <td class="data-header type">Type</td>
                        <td class="data-header progress">Chapters</td>
                        <td class="data-header progress">Volumes</td>
                    </tr>
                    <?php
                    if ($resultCheck > 0) {
                        for ($i = 0, $ii = 1; $i < $resultCheck && $i < count($mangaID); $i++, $ii++) {
                            $statusMap = [
                                '1' => 'reading',
                                '2' => 'completed',
                                '3' => 'dropped',
                                '4' => 'plantoread'
                            ];
                            $userStatusFormatted = $statusMap[$userStatus[$i]] ?? 'unknown';

                            $userScoreFormatted = !empty($userScore[$i]) ? $userScore[$i] : '-';
                            $mangaChaptersFormatted = !empty($mangaChapters[$i]) ? $mangaChapters[$i] : '?';
                            $mangaVolumesFormatted = !empty($mangaVolumes[$i]) ? $mangaVolumes[$i] : '?';

                            echo '
                            <tr class="list-table-data">
                                <td class="data status ' . $userStatusFormatted . '"></td>
                                <td class="data rank">' . $ii . '</td>
                                <td class="data image">
                                    <a href="manga.php?mangaid=' . $mangaID[$i] . '" class="avatar" style="background-image: url(../media/manga/avatar/' . htmlspecialchars($mangaAvatar[$i]) . ')"></a>
                                </td>
                                <td class="data title">
                                    <a href="manga.php?mangaid=' . $mangaID[$i] . '">' . htmlspecialchars($mangaTitle[$i]) . '</a>
                                </td>
                                <td class="data score">' . $userScoreFormatted . '</td>
                                <td class="data type">' . htmlspecialchars($mangaType[$i]) . '</td>
                                <td class="data progress">' . $userChapters[$i] . ' / ' . $mangaChaptersFormatted . '</td>
                                <td class="data progress">' . $userVolumes[$i] . ' / ' . $mangaVolumesFormatted . '</td>
                            </tr>';
                        }
                    } else {
                        echo '<tr><td colspan="8" class="no-data">No manga found in this category.</td></tr>';
                    }
                    ?>
                </table>

                <div class="list-total"></div>
            </div>
        </div>
    </div>

    <?php include "footer.php"; ?>
</body>

</html>
