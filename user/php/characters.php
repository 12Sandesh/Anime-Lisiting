<?php
session_start();
include "includes/characters.inc.php";

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title><?php echo $characterName . ' - MyList'; ?></title>
    <meta charset="UTF-8">
    <link rel="shortcut icon" href="img/logo_init.png">
    <link rel="stylesheet" type="text/css" href="css/characters.css">
    <link rel="stylesheet" type="text/css" href="css/menu.css">
    <link rel="stylesheet" type="text/css" href="css/footer.css">
    <link rel="stylesheet" type="text/css" href="css/fontawesome.min.css">
</head>

<body>
    <?php
    include "menu.php";
    ?>

    <div class="page-wrap">
        <div class="container">
            <div class="character-container">
                <div class="character-grid">
                    <div class="character-avatar-favorite">
                        <a class="character-avatar" style="background-image:url(../media/characters/avatar/<?php echo $characterAvatar; ?>"></a>
                        <?php
                        if (isset($_SESSION['userID'])) {
                            if ($resultCharacterFavorite > 0) {
                                echo '<form action="includes/characters.inc.php?characterid=' . $characterID . '" method="post">
                                            <input type="submit" name="favorite-delete" value="* Remove from favorites" class="favorite-add remove">
                                        </form>
                                        ' . $characterFavoritesTotal . ' favorites.';
                            } else {
                                echo '
                                        <form action="includes/characters.inc.php?characterid=' . $characterID . '" method="post">
                                            <input type="submit" name="favorite-submit" value="* Add to favorites" class="favorite-add">
                                        </form> 
                                        ' . $characterFavoritesTotal . ' favorites.';
                            }
                        } else {
                            echo '<div class="not-login">Would you like to add this character to your favorites? <a href="login.php">Login</a> or <a href="register.php">Register</a> first!</div>';
                        }
                        ?>
                    </div>
                    <div class="character-content">
                        <div class="character-name">
                            <?php
                            echo $characterName . ' ';
                            if (isset($_SESSION['userID'])) {
                                if ($_SESSION['userPermissions'] > 0) {
                                    echo '<a href="admin-edit.php?config=edit&characterid=' . $characterID . '" class="edit">(Edit)</a>';
                                }
                            }
                            ?>
                        </div>
                        <div class="character-info">
                            <?php
                            if (empty($characterInfo)) {
                                echo "No information about this character has been added.";
                            } else {
                                echo $characterInfo;
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php
    include "footer.php";
    ?>
</body>

</html>