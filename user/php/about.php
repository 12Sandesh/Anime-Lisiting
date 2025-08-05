<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>About - AnimeKoji</title>
    <meta charset="UTF-8">
    <link rel="shortcut icon" href="../img/logo_init.png">
    <link rel="stylesheet" type="text/css" href="../css/about.css">
    <link rel="stylesheet" type="text/css" href="../css/menu.css">
    <link rel="stylesheet" type="text/css" href="../css/footer.css">
    <link rel="stylesheet" type="text/css" href="../css/fontawesome.min.css">
</head>

<body>
    <?php
    include "menu.php";
    ?>

    <div class="page-wrap">
        <div class="container-all">
            <div class="container">
                <div class="bg-header" style="background-image: url(../img/bg_header1.jpg)">
                    <img src="../img/logo44.png" class="logo">
                </div>

                <h2>About AnimeKoji</h2>
                <div>
                    <p>Welcome to AnimeKoji, your ultimate destination for anime enthusiasts! AnimeKoji is a project designed to help you explore, track, and celebrate your love for anime. Whether you're a seasoned otaku or just starting your journey, AnimeKoji offers a platform to organize your anime experience and discover new favorites.</p>
                </div>

                <h3>What We Offer</h3>
                <ul class="features-list">
                    <li>
                        <strong>Comprehensive Anime Database</strong>: Dive into a vast collection of anime, complete with detailed information about titles, characters, genres, and more.
                    </li>
                    <li>
                        <strong>Personalized Anime Lists</strong>: Keep track of everything you’ve watched with your own customizable list. Organize your entries by status (e.g., Watching, Completed, On Hold, Dropped, Plan to Watch) and rate them to share your thoughts.
                    </li>
                    <li>
                        <strong>Top Picks</strong>: Explore the most popular and highest-rated anime, as voted by the AnimeKoji community.
                    </li>
                    <li>
                        <strong>Character Profiles</strong>: Learn more about your favorite characters, their roles, and the stories they belong to.
                    </li>
                </ul>

                <h3>Why Join AnimeKoji?</h3>
                <ul class="features-list">
                    <li>
                        <strong>Stay Organized</strong>: Never lose track of your anime journey. AnimeKoji helps you manage your progress and plan what to watch next.
                    </li>
                    <li>
                        <strong>Discover New Favorites</strong>: Find hidden gems and trending anime recommended by the community. Whether you’re into action, romance, fantasy, or slice-of-life, there’s something for everyone.
                    </li>
                    <li>
                        <strong>Express Yourself</strong>: Customize your profile and showcase your favorite anime to let your personality shine.
                    </li>
                </ul>

                <h3>Our Mission</h3>
                <div>
                    <p>At AnimeKoji, we believe that anime is more than just entertainment—it’s a way to connect, inspire, and tell stories that resonate with people around the world. Our mission is to create a space where fans can celebrate their love for anime, discover new favorites, and organize their anime journey in one place.</p>
                </div>

                <h1>Join AnimeKoji Today!</h1>
                <div id="button-container">
                    <a href="signup.php" class="button" style="text-align: center;">REGISTER NOW</a>
                </div>
            </div> <!-- Container -->
        </div> <!-- Container all -->
    </div> <!-- Page wrap -->

    <?php
    include "footer.php";
    ?>
</body>

</html>