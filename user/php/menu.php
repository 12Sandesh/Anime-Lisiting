<?php
include "../includes/session-update.inc.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/PHP_Submission/Anime_Listing/user/css/menu.css">
</head>

<body>

    <nav class="menu">
        <div class="menu-left">
            <ul>
                <li><a href="/PHP_Submission/Anime_Listing/user/php/index.php">Home</a></li>
                <li><a href="/PHP_Submission/Anime_Listing/user/php/anime-ranking.php?page=1">Anime</a></li>
                <li><a href="/PHP_Submission/Anime_Listing/user/php/manga-ranking.php?page=1">Manga</a></li>
                <li><a href="/PHP_Submission/Anime_Listing/user/php/about.php">About</a></li>
            </ul>
        </div>

        <div class="menu-search" id="search">
            <form class="menu-search-bar" action="/PHP_Submission/Anime_Listing/user/php/search.php" method="get" id="search-form">
                <input type="text" name="s" class="menu-search-txt" id="search-autocomplete" placeholder="Search for anime, manga, and more..." autocomplete="off">
                <input type="submit" name="search-submit" class="menu-search-button" value="OK">
            </form>
        </div>

        <div class="menu-right">
            <?php
            if (isset($_SESSION["username"])) {
                echo '
            <div class="menu-right-profile" id="profile">
                <a href="#" class="username-text">' . htmlspecialchars($_SESSION['username']) . '</a> 
                <div class="menu-right-profile-links" id="profile-links">
                    <ul>
                        <li><a href="/PHP_Submission/Anime_Listing/user/php/profile.php?userid=' . $_SESSION["userID"] . '">Profile</a></li>
                        <li><a href="/PHP_Submission/Anime_Listing/user/php/settings.php?edit=profile">Settings</a></li>';
                if ($_SESSION["userPermissions"] > 0) {
                    echo '<li><a href="/PHP_Submission/Anime_Listing/admin/php/admin.php?view=anime&page=1">Admin Panel</a></li>';
                }
                echo '<li>
                            <form action="/PHP_Submission/Anime_Listing/user/includes/logout.inc.php" method="post">
                                <button type="submit" name="logout-submit" class="menu-right-logout">Logout</button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
            <div id="avatar-load">';
                if (isset($_SESSION['userAvatar']) && $_SESSION['userAvatar'] != null) {
                    echo '<a href="/PHP_Submission/Anime_Listing/user/php/profile.php?userid=' . $_SESSION['userID'] . '" class="menu-avatar" style="background-image:url(/PHP_Submission/Anime_Listing/user/media/users/avatar/' . $_SESSION['userAvatar'] . ')"></a>';
                } else {
                    echo '<a href="/PHP_Submission/Anime_Listing/user/php/profile.php?userid=' . $_SESSION['userID'] . '" class="menu-avatar" style="background-image:url(/PHP_Submission/Anime_Listing/user/media/users/avatar/avatarDefault.png)"></a>';
                }
                echo '</div>';
            } else {
                echo '<div class="menu-right-buttons">
                <a href="/PHP_Submission/Anime_Listing/user/php/signup.php" class="menu-right-signup">Sign Up</a>
                <a href="/PHP_Submission/Anime_Listing/user/php/login.php" class="menu-right-login">Login</a>
            </div>';
            }
            ?>
        </div>

        <div class="menu-responsive">
            <div class="links-activator" id="links-activator">
                <i class="fa fa-bars"></i>
            </div>
            <a href="/PHP_Submission/Anime_Listing/user/php/index.php">
                <div class="menu-responsive-home">
                    <i class="fa fa-home"></i>
                </div>
            </a>
            <div class="menu-responsive-search" id="searchResponsive">
                <i class="fa fa-search"></i>
            </div>
            <div class="menu-responsive-links" id="links">
                <ul>
                    <?php
                    if (isset($_SESSION['userID'])) {
                        echo '
                    <a href="/PHP_Submission/Anime_Listing/user/php/profile.php?userid=' . $_SESSION['userID'] . '"><li>My Profile</li></a>
                    <a href="/PHP_Submission/Anime_Listing/user/php/anime-ranking.php?page=1"><li>Anime Ranking</li></a>
                    <a href="/PHP_Submission/Anime_Listing/user/php/manga-ranking.php?page=1"><li>Manga Ranking</li></a>
                    <a href="/PHP_Submission/Anime_Listing/user/php/about.php"><li>About</li></a>
                     <a href="/PHP_Submission/Anime_Listing/user/php/settings.php?edit=profile"><li>Settings</li></a>';
                        if ($_SESSION['userPermissions'] > 0) {
                            echo '<a href="/PHP_Submission/Anime_Listing/admin/php/admin.php?view=anime&page=1"><li>Admin Panel</li></a>';
                        }
                        echo '
                    <form action="/PHP_Submission/Anime_Listing/user/includes/logout.inc.php" method="post" class="logout-clear">
                        <button type="submit" name="logout-submit" class="menu-responsive-logout"><li>Logout</li></button>
                    </form>';
                    } else {
                        echo '
                    <a href="/PHP_Submission/Anime_Listing/user/php/login.php"><li>Login</li></a>
                    <a href="/PHP_Submission/Anime_Listing/user/php/signup.php"><li>Sign Up</li></a>
                    <a href="/PHP_Submission/Anime_Listing/user/php/anime-ranking.php?page=1"><li>Anime Ranking</li></a>
                    <a href="/PHP_Submission/Anime_Listing/user/php/manga-ranking.php?page=1"><li>Manga Ranking</li></a>
                    <a href="/PHP_Submission/Anime_Listing/user/php/about.php"><li>About</li></a>';
                    }
                    ?>
                </ul>
            </div>
        </div>
    </nav>

    <script src="/PHP_Submission/Anime_Listing/user/js/script-main.js"></script>
    <script src="/PHP_Submission/Anime_Listing/user/js/script-forms.js"></script>
    <script src="/PHP_Submission/Anime_Listing/user/js/script-forms-errors.js"></script>

</body>

</html>