<?php
session_start();
if (isset($_SESSION["userID"])) {
    header("Location: index.php");
} else {
    if (isset($_GET['error'])) {
        $error = $_GET['error'];
        if ($error == "useremailtaken") {
            $errorUserEmail = "* This username or email is already taken";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <title>Sign Up - AnimeKoji</title>
    <meta charset="UTF-8">
    <link rel="shortcut icon" href="img/logo_init.png">
    <link rel="stylesheet" type="text/css" href="../css/signup-login.css">
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
            <div class="form-container-all-reg">

                <div class="logo">
                    <img src="../img/logo11.png">
                </div>

                <div class="form-container">
                    <form action="../includes/signup.inc.php" method="post" id="signup">
                        <input type="text" placeholder="Username" name="username" class="form-input" id="username">
                        <p class="form-error">
                            <?php
                            if (isset($errorUserEmail)) {
                                echo $errorUserEmail;
                            }
                            ?>
                        </p>

                        <input type="text" placeholder="Email" name="email" class="form-input" id="email">
                        <p class="form-error">
                            <?php
                            if (isset($errorUserEmail)) {
                                echo $errorUserEmail;
                            }
                            ?>
                        </p>

                        <input type="password" placeholder="Password" name="password" class="form-input" id="password">
                        <p class="form-error"></p>

                        <input type="password" placeholder="Confirm Password" name="password_confirm" class="form-input" id="password_confirm">
                        <p class="form-error"></p>

                        <input type="checkbox" name="terms_accept" class="form-checkbox" id="terms_accept">
                        <label for="terms_accept">I have read and agree to the terms of use.</label>
                        <p class="form-error"></p>

                        <div class="form-submit">
                            <input type="submit" value="Sign Up" name="signup-submit" class="form-submit-button">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <?php
    include "footer.php"
    ?>
</body>

</html>