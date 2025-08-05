<?php
session_start();
// Include the required file
include "../includes/admin.inc.php";

// Define the $view variable
$view = isset($_GET['view']) ? $_GET['view'] : 'anime';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>
        <?php
        echo $view == "anime" ? 'Anime | ' : '';
        echo $view == "manga" ? 'Manga | ' : '';
        echo $view == "characters" ? 'Characters | ' : '';
        echo $view == "users" ? 'Users | ' : '';
        ?>
        Control Panel - AnimeKoji
    </title>
    <meta charset="UTF-8">
    <link rel="shortcut icon" href="../img/logo_init.png">
    <link rel="stylesheet" type="text/css" href="../css/admin.css">
    <link rel="stylesheet" type="text/css" href="../css/menu.css">
    <link rel="stylesheet" type="text/css" href="../css/footer.css">
    <link rel="stylesheet" type="text/css" href="../css/fontawesome.min.css">
</head>

<body>
    <div class="page-wrap">
        <div class="container-all">
            <!-- Logo  -->
            <div class="logo">
                <img src="../img/logo11.png">
            </div>
            <!--  -->

            <!-- Menu view -->
            <div class="view-menu">
                <a href="admin.php?view=anime&page=1" class="btn-view">Anime</a>
                <a href="admin.php?view=manga&page=1" class="btn-view">Manga</a>
                <a href="admin.php?view=characters&page=1" class="btn-view">Characters</a>
                <a href="admin.php?view=users&page=1" class="btn-view">Users</a>
            </div>
            <!--  -->

            <div class="container">
                <div class="page-buttons-top">
                    <?php
                    ?>
                </div>

                <?php
                // Anime
                if ($view == 'anime') {
                    echo '
                    <div class="anime-container">
                        <div class="grid-header">
                            <div class="content">ID</div>
                            <div class="content">Title</div>
                        </div>

                        <div class="grid-content">';
                    if (isset($animeDBID) && isset($animeDBTitle)) {
                        for ($i = 0; $i < count($animeDBID) && $i < count($animeDBTitle); $i++) {
                            echo '
                                <div class="grid-content-result">
                                    <div class="content">' . $animeDBID[$i] . '</div>
                                    <div class="title"><a href="../../user/php/anime.php?animeid=' . $animeDBID[$i] . '" class="clear">' . $animeDBTitle[$i] . '</a></div>
                                    <div class="edit">
                                        <a href="admin-edit.php?config=edit&animeid=' . $animeDBID[$i] . '" target="_blank" class="clear">Edit</a>
                                    </div>
                                </div>';
                        }
                    }
                    echo '
                        </div>

                        <div class="grid-bottom">
                            <span></span>
                            <span></span>
                            <span class="add">
                                <a href="admin-add.php?config=add-anime" target="_blank" class="clear">Add</a>
                            </span>
                        </div>
                    </div>'; // Anime
                }
                ?>

                <?php
                // Manga
                if ($view == 'manga') {
                    echo '
                    <div class="manga-container">
                        <div class="grid-header">
                            <div class="content">ID</div>
                            <div class="content">Title</div>
                        </div>

                        <div class="grid-content">';
                    if (isset($mangaDBID) && isset($mangaDBTitle)) {
                        for ($i = 0; $i < count($mangaDBID) && $i < count($mangaDBTitle); $i++) {
                            echo '
                                <div class="grid-content-result">
                                    <div class="content">' . $mangaDBID[$i] . '</div>
                                    <div class="title"><a href="../../user/php/manga.php?mangaid=' . $mangaDBID[$i] . '" class="clear">' . $mangaDBTitle[$i] . '</a></div>
                                    <div class="edit">
                                        <a href="admin-edit.php?config=edit&mangaid=' . $mangaDBID[$i] . '" target="_blank" class="clear">Edit</a>
                                    </div>
                                </div>';
                        }
                    }
                    echo '
                        </div>

                        <div class="grid-bottom">
                            <span></span>
                            <span></span>
                            <span class="add">
                                <a href="admin-add.php?config=add-manga" target="_blank" class="clear">Add</a>
                            </span>
                        </div>
                    </div>'; // Manga
                }
                ?>

                <?php
                // Characters
                if ($view == 'characters') {
                    echo '
                    <div class="characters-container">
                        <div class="grid-header">
                            <div class="content">ID</div>
                            <div class="content">Name</div>
                        </div>

                        <div class="grid-content">';
                    if (isset($characterDBID) && isset($characterDBName)) {
                        for ($i = 0; $i < count($characterDBID) && $i < count($characterDBName); $i++) {
                            echo '
                                <div class="grid-content-result">
                                    <div class="content">' . $characterDBID[$i] . '</div>
                                    <div class="title"><a href="../../user/php/characters.php?characterid=' . $characterDBID[$i] . '" class="clear">' . $characterDBName[$i] . '</a></div>
                                    <div class="edit">
                                        <a href="admin-edit.php?config=edit&characterid=' . $characterDBID[$i] . '" target="_blank" class="clear">Edit</a>
                                    </div>
                                </div>';
                        }
                    }
                    echo '
                        </div>

                        <div class="grid-bottom">
                            <span></span>
                            <span></span>
                            <span class="add">
                                <a href="admin-add.php?config=add-character" target="_blank" class="clear">Add</a>
                            </span>
                        </div>
                    </div>'; // Characters
                }
                ?>

                <?php
                // Users
                if ($view == 'users') {
                    echo '
                    <div class="users-container">
                        <div class="grid-header">
                            <div class="content">ID</div>
                            <div class="content">Name</div>
                        </div>

                        <div class="grid-content">';
                    if (isset($userDBID) && isset($userDBName)) {
                        for ($i = 0; $i < count($userDBID) && $i < count($userDBName); $i++) {
                            echo '
                                <div class="grid-content-result">
                                    <div class="content">' . $userDBID[$i] . '</div>
                                    <div class="title"><a href="admin-edit.php?config=edit&userid=' . $userDBID[$i] . '" class="clear">' . $userDBName[$i] . '</a></div>
                                    <div class="edit">
                                        <a href="admin-edit.php?config=edit&userid=' . $userDBID[$i] . '" target="_blank" class="clear">Edit</a>
                                    </div>
                                </div>';
                        }
                    }
                    echo '
                        </div>

                        <div class="grid-bottom users">
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>
                    </div>'; // Users
                }
                ?>
            </div> <!-- Container -->
        </div> <!-- Container all -->
    </div> <!-- Page-wrap -->

    <script type="text/javascript" src="../js/script-admin.js"></script>
</body>

</html>