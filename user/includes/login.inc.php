<?php
if (isset($_POST["login-submit"])) {

    include "../../includes/db.php";

    $userNameEmail = $_POST["userNameEmail"];
    $password = $_POST["password"];

    if (empty($userNameEmail) || empty($password)) {
        header("Location: ../php/login.php?error");
        exit();
    } else {
        $sql = "SELECT * FROM users WHERE userName=? OR userEmail=?";
        $stmt = mysqli_stmt_init($conn);

        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: ../php/login.php?error=sqlerror");
            exit();
        } else {
            mysqli_stmt_bind_param($stmt, "ss", $userNameEmail, $userNameEmail);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            if ($row = mysqli_fetch_assoc($result)) {
                $passwordCheck = password_verify($password, $row["userPassword"]);
                if ($passwordCheck == false) {
                    header("Location: ../php/login.php?error=nouser");
                    exit();
                } else if ($passwordCheck == true) {
                    if ($row['userBanStatus'] < 1) {
                        session_start();
                        $_SESSION["userID"] = $row["userID"];
                        $_SESSION["username"] = $row["userName"];
                        $_SESSION["userEmail"] = $row["userEmail"];
                        $_SESSION["userPassword"] = $row["userPassword"];
                        $_SESSION["userPermissions"] = $row["userPermissions"];
                        $_SESSION["userAvatar"] = $row["userAvatar"];
                        $_SESSION["userBanner"] = $row["userBanner"];
                        $_SESSION["userBannerList"] = $row["userBannerList"];
                        $_SESSION["userAbout"] = $row["userAbout"];
                        $_SESSION["userGender"] = $row["userGender"];
                        $_SESSION["userBirthday"] = $row["userBirthday"];
                        $_SESSION["userLocalization"] = $row["userLocalization"];
                        $_SESSION["userDate"] = $row["userDate"];
                        $_SESSION["userOnlineStatus"] = $row["userOnlineStatus"];
                        $_SESSION["userBanStatus"] = $row["userBanStatus"];
                        header("Location: ../php/index.php?login=success");
                        exit();
                    } else {
                        header("Location: ../php/login.php?error=userbanned");
                        exit();
                    }
                } else {
                    header("Location: ../php/login.php?error=nouser");
                    exit();
                }
            } else {
                header("Location: ../php/login.php?error=nouser");
            }
        }
    }
} else {
    header("Location: ../php/login.php");
    exit();
}
