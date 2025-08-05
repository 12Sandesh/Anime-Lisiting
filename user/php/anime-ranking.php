<?php
session_start();
include "../includes/anime-ranking.inc.php";
$page = $_GET['page'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Anime - AnimeKoji</title>
    <meta charset="UTF-8">
    <link rel="shortcut icon" href="../img/logo_init.png">
    <link rel="stylesheet" type="text/css" href="../css/ranking.css">
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
            <div class="ranking-container">

                <div class="grid-header">
                    <div class="rank">Rank</div>
                    <div class="title">Title</div>
                    <div class="score">Score</div>
                    <div class="your-score">Your Score</div>
                    <div class="status">Status</div>
                </div>
                <div class="grid">
                    <?php
                    setlocale(LC_TIME, 'en_US', 'en_US.utf-8', 'english');
                    date_default_timezone_set('America/Sao_Paulo');

                    for ($i = 0, $ii = 0; $i < count($animeID), $i < count($animeTitle), $i < count($animeAvatar), $i < count($animeType), $i < count($animeEpisodes), $i < count($animeStart), $i < count($animeEnd), $i < count($animeUsers), $i < count($animeScore); $i++, $ii++) {

                        $dayStart[$i] = substr($animeStart[$i], -2, 2); // Start day
                        $monthStart[$i] = substr($animeStart[$i], -5, 2);  // Start month
                        $yearStart[$i] = substr($animeStart[$i], -10, 4);  // Start year

                        $dayEnd[$i] = substr($animeEnd[$i], -2, 2);  // End day 
                        $monthEnd[$i] = substr($animeEnd[$i], -5, 2); // End month
                        $yearEnd[$i] = substr($animeEnd[$i], -10, 4); // End year 

                        // Start date
                        if ($animeStart[$i] != null) {
                            // Display month and year
                            if ($yearStart[$i] > 0 && $monthStart[$i] > 0 && $dayStart[$i] >= 0) {
                                $animeStart[$i] = $yearStart[$i] . '-' . $monthStart[$i] . '-' . '01';
                                $animeStart[$i] = strftime('%b, %Y', strtotime($animeStart[$i])) . ' to ';
                            }
                            // If month is null, display only the year
                            else if ($yearStart[$i] > 0 && $monthStart[$i] <= 0 && $dayStart[$i] <= 0) {
                                $animeStart[$i] = $yearStart[$i] . '-' . '01' . '-' . '01';
                                $animeStart[$i] = strftime('%Y', strtotime($animeStart[$i])) . ' to ';
                            } else {
                                $animeStart[$i] = '? to ';
                            }
                        } else if ($animeStart[$i] == null && $animeEnd[$i] == null) {
                            $animeStart[$i] = 'Unknown';
                        } else {
                            $animeStart[$i] = '? to ';
                        }

                        // End date 
                        if ($animeEnd[$i] != null) {
                            // Display month and year
                            if ($yearEnd[$i] > 0 && $monthEnd[$i] > 0 && $dayEnd[$i] >= 0) {
                                $animeEnd[$i] = $yearEnd[$i] . '-' . $monthEnd[$i] . '-' . '01';
                                $animeEnd[$i] = strftime('%b, %Y', strtotime($animeEnd[$i]));
                            }
                            // If month is null, display only the year
                            else if ($yearEnd[$i] > 0 && $monthEnd[$i] <= 0 && $dayEnd[$i] <= 0) {
                                $animeEnd[$i] = $yearEnd[$i] . '-' . '01' . '-' . '01';
                                $animeEnd[$i] = strftime('%Y', strtotime($animeEnd[$i]));
                            } else {
                                $animeEnd[$i] = '?';
                            }
                        } else if ($animeStart[$i] == "Unknown" && $animeEnd[$i] == null) {
                            $animeEnd[$i] = '';
                        } else {
                            $animeEnd[$i] = '?';
                        }

                        $animeAired[$i] = ucfirst($animeStart[$i]) . ucfirst($animeEnd[$i]);

                        if (empty($animeEpisodes[$i])) {
                            $animeEpisodes[$i] = '?';
                        }

                        if (empty($animeUsers[$i])) {
                            $animeUsers[$i] = '?';
                        }

                        if ($animeScore[$i] == 0.00) {
                            $animeScore[$i] = 'N/A';
                        } else {
                            $animeScore[$i] = number_format($animeScore[$i], 2);
                        }

                        // User score and status 
                        if (isset($animeIDCheck[$i]) && $animeIDCheck[$i] == $animeID[$i]) {
                            if (empty($userScore[$i])) {
                                $userScore[$i] = "N/A";
                            } else {
                                $userScore[$i] = number_format($userScore[$i], 2);
                            }

                            if (empty($userStatus[$i])) {
                                $userStatus[$i] = "Add to list";
                                $statusColor = "not-add";
                            } else if ($userStatus[$i] == 1) {
                                $userStatus[$i] = 'Watching';
                                $statusColor = "watching";
                            } else if ($userStatus[$i] == 2) {
                                $userStatus[$i] = 'Completed';
                                $statusColor = "completed";
                            } else if ($userStatus[$i] == 3) {
                                $userStatus[$i] = 'Dropped';
                                $statusColor = "dropped";
                            } else if ($userStatus[$i] == 4) {
                                $userStatus[$i] = 'Plan to watch';
                                $statusColor = "plan";
                            }
                        } else {
                            $userStatus[$i] = "Add to list";
                            $userScore[$i] = "N/A";
                            $statusColor = "not-add";
                        }

                        if ($page == 1) {
                            $page_itens = $ii + $page;
                        } else {
                            $page_itens = (($page * 5) - 4 + $ii);
                        }

                        echo '
                            <div class="rank">
                                <span class="rank-number">'
                            . $page_itens . '
                                </span>
                            </div>
                            
                            <div class="title info">
                                <a href="anime.php?animeid=' . $animeID[$i] . '"><div class="avatar" style="background-image:url(../media/anime/avatar/' . $animeAvatar[$i] . ')"></div></a>
                                <div class="content">
                                    <div class="anime-title"><a href="anime.php?animeid=' . $animeID[$i] . '">' . $animeTitle[$i] . '</a></div>
                                    <div>' . $animeType[$i] . ' (' . $animeEpisodes[$i] . ' eps)</div>
                                    <div>' . $animeAired[$i] . '</div>
                                    <div>' . $animeUsers[$i] . ' users</div>
                                </div>
                            </div>
                                    
                            <div class="score grid3">
                                <div class="star-icon" style="background-image:url(../img/star.png)"> </div> 
                                <div class="score-total">' . $animeScore[$i] . '</div>
                            </div>       

                            <div class="your-score grid3">
                                <div class="star-icon" style="background-image:url(../img/star.png)"> </div> 
                                <div class="score-total">
                                    <a href="anime.php?animeid=' . $animeID[$i] . '">' . $userScore[$i] . '</a>
                                </div>
                            </div>
                            
                            <div class="status">
                                <a href="anime.php?animeid=' . $animeID[$i] . '" class="your-status ' . $statusColor . '">' . $userStatus[$i] . '</a>
                            </div>
                            ';
                    }
                    ?>
                </div>
            </div>

            <div class="page-buttons-bottom">
                <?php
                $pageSum = 1;
                $pageNext = $page + $pageSum;
                $pagePrevious = $page - $pageSum;
                if ($page <= $total_pages && $page != 1) {
                    echo '<a href="anime-ranking.php?page=' . $pagePrevious . '" class="page-button">Previous</a>';
                }
                if ($page < $total_pages) {
                    echo '<a href="anime-ranking.php?page=' . $pageNext . '" class="page-button">Next</a>';
                }
                ?>
            </div>
        </div>
    </div>
    <?php
    include "footer.php";
    ?>
</body>

</html>