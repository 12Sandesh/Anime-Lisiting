<?php
include "../../includes/db.php";

// Initialize page variable
$page = isset($_GET['page']) ? $_GET['page'] : 1; // Default to 1 if not set

// Anime
if (isset($page) && $page > 0 && isset($_GET['view']) && $_GET['view'] == 'anime') {
    $anime_per_page = 15;
    $anime_per_page_start = ($page - 1) * $anime_per_page;

    $sql = "SELECT animeID, animeTitle FROM anime ORDER BY animeID LIMIT $anime_per_page_start, $anime_per_page";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        echo 'Error preparing statements';
    } else {
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $resultCheck = mysqli_num_rows($result);
        if ($resultCheck > 0) {
            $animeDBID = array();
            $animeDBTitle = array();
            while ($row = mysqli_fetch_assoc($result)) {
                $animeDBID[] = $row['animeID'];
                $animeDBTitle[] = $row['animeTitle'];
            }
        }
    }
    $total_pages_sql = "SELECT COUNT(animeID) FROM anime";
    $result = mysqli_query($conn, $total_pages_sql);
    $total_rows = mysqli_fetch_array($result)[0];
    $total_pages = ceil($total_rows / $anime_per_page);
}

// Manga
if (isset($page) && $page > 0 && isset($_GET['view']) && $_GET['view'] == 'manga') {
    $manga_per_page = 15;
    $manga_per_page_start = ($page - 1) * $manga_per_page;

    $sql = "SELECT mangaID, mangaTitle FROM manga ORDER BY mangaID LIMIT $manga_per_page_start, $manga_per_page";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        echo 'Error preparing statements';
    } else {
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $resultCheck = mysqli_num_rows($result);
        if ($resultCheck > 0) {
            $mangaDBID = array();
            $mangaDBTitle = array();
            while ($row = mysqli_fetch_assoc($result)) {
                $mangaDBID[] = $row['mangaID'];
                $mangaDBTitle[] = $row['mangaTitle'];
            }
        }
    }
    $total_pages_sql = "SELECT COUNT(mangaID) FROM manga";
    $result = mysqli_query($conn, $total_pages_sql);
    $total_rows = mysqli_fetch_array($result)[0];
    $total_pages = ceil($total_rows / $manga_per_page);
}

// Characters
if (isset($page) && $page > 0 && isset($_GET['view']) && $_GET['view'] == 'characters') {
    $characters_per_page = 15;
    $characters_per_page_start = ($page - 1) * $characters_per_page;
    $sql = "SELECT characterID, characterName FROM characters ORDER BY characterID LIMIT $characters_per_page_start, $characters_per_page";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        echo 'Error preparing statements';
    } else {
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $resultCheck = mysqli_num_rows($result);
        if ($resultCheck > 0) {
            $characterDBID = array();
            $characterDBName = array();
            while ($row = mysqli_fetch_assoc($result)) {
                $characterDBID[] = $row['characterID'];
                $characterDBName[] = $row['characterName'];
            }
        }
    }
    $total_pages_sql = "SELECT COUNT(characterID) FROM characters";
    $result = mysqli_query($conn, $total_pages_sql);
    $total_rows = mysqli_fetch_array($result)[0];
    $total_pages = ceil($total_rows / $characters_per_page);
}

// Users
if (isset($page) && $page > 0 && isset($_GET['view']) && $_GET['view'] == 'users') {
    $users_per_page = 15;
    $users_per_page_start = ($page - 1) * $users_per_page;
    $sql = "SELECT userID, userName FROM users ORDER BY userID LIMIT $users_per_page_start, $users_per_page";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        echo 'Error preparing statements';
    } else {
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $resultCheck = mysqli_num_rows($result);
        if ($resultCheck > 0) {
            $userDBID = array();
            $userDBName = array();
            while ($row = mysqli_fetch_assoc($result)) {
                $userDBID[] = $row['userID'];
                $userDBName[] = $row['userName'];
            }
        }
    }
    $total_pages_sql = "SELECT COUNT(userID) FROM users";
    $result = mysqli_query($conn, $total_pages_sql);
    $total_rows = mysqli_fetch_array($result)[0];
    $total_pages = ceil($total_rows / $users_per_page);
}
