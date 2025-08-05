<?php
include "../../includes/db.php";

if (isset($_GET['type']) && isset($_GET['id'])) {
    $type = $_GET['type'];
    $id = $_GET['id'];

    switch ($type) {
        case 'anime':
            $sql = "DELETE FROM anime WHERE animeID=?";
            break;
        case 'manga':
            $sql = "DELETE FROM manga WHERE mangaID=?";
            break;
        case 'character':
            $sql = "DELETE FROM characters WHERE characterID=?";
            break;
        case 'user':
            $sql = "DELETE FROM users WHERE userID=?";
            break;
        default:
            header("Location: ../php/admin.php");
            exit();
    }

    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        echo 'Error preparing statements';
    } else {
        mysqli_stmt_bind_param($stmt, "s", $id);
        mysqli_stmt_execute($stmt);
        header("Location: ../php/admin.php?view=$type&page=1");
        exit();
    }
} else {
    header("Location: ../php/admin.php");
    exit();
}
