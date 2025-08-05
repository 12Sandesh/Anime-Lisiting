<?php
include "../../includes/db.php";

if (isset($_GET['userid'])) {
    // Show the last 5 comments
    $userIDProfile = $_GET['userid'];
    $sql = "SELECT uc.commentID, uc.userComment, uc.userID, uc.commentDate, u.userName, u.userAvatar FROM users_comments uc JOIN users u ON uc.userID=u.userID WHERE userIDProfile=? ORDER BY commentDate DESC LIMIT 5";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        echo 'Error preparing the statements';
    } else {
        mysqli_stmt_bind_param($stmt, "s", $userIDProfile);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $resultCheckComment = mysqli_num_rows($result);
        if ($resultCheckComment > 0) {
            $userComment = array();
            $userCommentDate = array();
            $userCommentName = array();
            $userCommentAvatar = array();
            while ($row = mysqli_fetch_assoc($result)) {
                $userCommentID[] = $row['commentID'];
                $userComment[] = $row['userComment'];
                $userIDComment[] = $row['userID'];
                $userCommentDate[] = $row['commentDate'];
                $userCommentName[] = $row['userName'];
                $userCommentAvatar[] = $row['userAvatar'];
            }
        }
    }

    // Count total comments
    $sql = "SELECT commentID FROM users_comments WHERE userIDProfile=?";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        echo 'Error preparing the statements';
    } else {
        mysqli_stmt_bind_param($stmt, "s", $userIDProfile);
        mysqli_stmt_execute($stmt);
        $resultAll = mysqli_stmt_get_result($stmt);
        $resultCheckAllComments = mysqli_num_rows($resultAll);
    }
}

// Add comment
if (isset($_POST['comment-submit'])) {
    session_start();
    $userID = $_SESSION['userID'];
    $userIDProfile = $_GET['userid'];
    $userComment = $_POST['comment-text'];
    if (strlen($userComment) > 0 && strlen($userComment) <= 20000) {
        $sql = "INSERT INTO users_comments (userID, userIDProfile, userComment) VALUES (?, ?, ?)";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            echo 'Error preparing the statements';
        } else {
            mysqli_stmt_bind_param($stmt, "sss", $userID, $userIDProfile, $userComment);
            mysqli_stmt_execute($stmt);
            header("Location: ../php/profile.php?userid=" . $userIDProfile);
        }
    } else {
        header("Location: ../php/profile.php?userid=" . $userIDProfile);
    }
}

// Delete comment
if (isset($_POST['comment-delete'])) {
    $profileURL = $_SERVER['HTTP_REFERER'];
    $commentID = $_POST['commentID'];
    $sql = "DELETE FROM users_comments WHERE commentID=?";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        echo 'Error preparing the statements';
    } else {
        mysqli_stmt_bind_param($stmt, "s", $commentID);
        mysqli_stmt_execute($stmt);
        header("Location: " . $profileURL);
    }
}
