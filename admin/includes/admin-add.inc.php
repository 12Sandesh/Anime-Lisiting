<?php
include '../../includes/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $config = $_GET['config'] ?? '';

    if ($config == 'add-anime') {
        // Sanitize and validate inputs
        $title = htmlspecialchars(trim($_POST['title']));
        $sinopse = htmlspecialchars(trim($_POST['sinopse']));
        $type = htmlspecialchars(trim($_POST['type']));
        $episodes = (int)$_POST['episodes'];
        $status = htmlspecialchars(trim($_POST['status']));
        $dayStart = (int)$_POST['dayStart'];
        $monthStart = (int)$_POST['monthStart'];
        $yearStart = (int)$_POST['yearStart'];
        $dayEnd = (int)$_POST['dayEnd'];
        $monthEnd = (int)$_POST['monthEnd'];
        $yearEnd = (int)$_POST['yearEnd'];
        $source = htmlspecialchars(trim($_POST['source']));
        $genres = implode(', ', array_map('htmlspecialchars', $_POST['genres']));
        $characterID = array_map('intval', $_POST['characterID']);
        $characterRole = array_map('htmlspecialchars', $_POST['characterRole']);

        // Handle file uploads for avatar and banner
        $avatar = $_FILES['avatar']['name'];
        $banner = $_FILES['banner']['name'];

        // Define upload directories
        $avatarDir = "../../user/media/anime/avatar/";
        $bannerDir = "../../user/media/anime/banner/";

        // Ensure directories exist
        if (!is_dir($avatarDir)) {
            mkdir($avatarDir, 0777, true);
        }
        if (!is_dir($bannerDir)) {
            mkdir($bannerDir, 0777, true);
        }

        // Check for file upload errors
        if ($_FILES['avatar']['error'] === UPLOAD_ERR_OK && $_FILES['banner']['error'] === UPLOAD_ERR_OK) {
            // Move uploaded files to the appropriate directory
            if (move_uploaded_file($_FILES['avatar']['tmp_name'], $avatarDir . $avatar) && move_uploaded_file($_FILES['banner']['tmp_name'], $bannerDir . $banner)) {
                // Insert anime data into the database
                $start_date = "$yearStart-$monthStart-$dayStart";
                $end_date = "$yearEnd-$monthEnd-$dayEnd";
                $sql = "INSERT INTO anime (animeTitle, animeSinopse, animeType, animeEpisodes, animeStatus, animeStart, animeEnd, animeSource, animeGenres, animeAvatar, animeBanner) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param('sssssssssss', $title, $sinopse, $type, $episodes, $status, $start_date, $end_date, $source, $genres, $avatar, $banner);
                $stmt->execute();

                // Insert characters data into the database
                $animeID = $conn->insert_id;
                for ($i = 0; $i < count($characterID); $i++) {
                    if (!empty($characterID[$i])) {
                        $sql = "INSERT INTO anime_characters (animeID, characterID, characterRole) VALUES (?, ?, ?)";
                        $stmt = $conn->prepare($sql);
                        $stmt->bind_param('iis', $animeID, $characterID[$i], $characterRole[$i]);
                        $stmt->execute();
                    }
                }

                header("Location: ../php/admin.php?view=anime&page=1");
                exit();
            } else {
                echo "Error moving uploaded files.";
            }
        } else {
            echo "Error uploading files: ";
            if ($_FILES['avatar']['error'] !== UPLOAD_ERR_OK) {
                echo "Avatar upload error code " . $_FILES['avatar']['error'] . ". ";
            }
            if ($_FILES['banner']['error'] !== UPLOAD_ERR_OK) {
                echo "Banner upload error code " . $_FILES['banner']['error'] . ".";
            }
        }
    }

    if ($config == 'add-manga') {
        // Sanitize and validate inputs
        $title = htmlspecialchars(trim($_POST['title']));
        $sinopse = htmlspecialchars(trim($_POST['sinopse']));
        $type = htmlspecialchars(trim($_POST['type']));
        $chapters = (int)$_POST['chapters'];
        $volumes = (int)$_POST['volumes'];
        $status = htmlspecialchars(trim($_POST['status']));
        $dayStart = (int)$_POST['dayStart'];
        $monthStart = (int)$_POST['monthStart'];
        $yearStart = (int)$_POST['yearStart'];
        $dayEnd = (int)$_POST['dayEnd'];
        $monthEnd = (int)$_POST['monthEnd'];
        $yearEnd = (int)$_POST['yearEnd'];
        $genres = implode(', ', array_map('htmlspecialchars', $_POST['genres']));
        $characterID = array_map('intval', $_POST['characterID']);
        $characterRole = array_map('htmlspecialchars', $_POST['characterRole']);

        // Handle file uploads for avatar and banner
        $avatar = $_FILES['avatar']['name'];
        $banner = $_FILES['banner']['name'];

        // Define upload directories
        $avatarDir = "../../user/media/manga/avatar/";
        $bannerDir = "../../user/media/manga/banner/";

        // Ensure directories exist
        if (!is_dir($avatarDir)) {
            mkdir($avatarDir, 0777, true);
        }
        if (!is_dir($bannerDir)) {
            mkdir($bannerDir, 0777, true);
        }

        // Check for file upload errors
        if ($_FILES['avatar']['error'] === UPLOAD_ERR_OK && $_FILES['banner']['error'] === UPLOAD_ERR_OK) {
            // Move uploaded files to the appropriate directory
            if (move_uploaded_file($_FILES['avatar']['tmp_name'], $avatarDir . $avatar) && move_uploaded_file($_FILES['banner']['tmp_name'], $bannerDir . $banner)) {
                // Insert manga data into the database
                $start_date = "$yearStart-$monthStart-$dayStart";
                $end_date = "$yearEnd-$monthEnd-$dayEnd";
                $sql = "INSERT INTO manga (mangaTitle, mangaSinopse, mangaType, mangaChapters, mangaVolumes, mangaStatus, mangaStart, mangaEnd, mangaGenres, mangaAvatar, mangaBanner) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param('sssssssssss', $title, $sinopse, $type, $chapters, $volumes, $status, $start_date, $end_date, $genres, $avatar, $banner);
                $stmt->execute();

                // Insert characters data into the database
                $mangaID = $conn->insert_id;
                for ($i = 0; $i < count($characterID); $i++) {
                    if (!empty($characterID[$i])) {
                        $sql = "INSERT INTO manga_characters (mangaID, characterID, characterRole) VALUES (?, ?, ?)";
                        $stmt = $conn->prepare($sql);
                        $stmt->bind_param('iis', $mangaID, $characterID[$i], $characterRole[$i]);
                        $stmt->execute();
                    }
                }

                header("Location: ../php/admin.php?view=manga&page=1");
                exit();
            } else {
                echo "Error moving uploaded files.";
            }
        } else {
            echo "Error uploading files: ";
            if ($_FILES['avatar']['error'] !== UPLOAD_ERR_OK) {
                echo "Avatar upload error code " . $_FILES['avatar']['error'] . ". ";
            }
            if ($_FILES['banner']['error'] !== UPLOAD_ERR_OK) {
                echo "Banner upload error code " . $_FILES['banner']['error'] . ".";
            }
        }
    }

    if ($config == 'add-character') {
        // Sanitize and validate inputs
        $name = htmlspecialchars(trim($_POST['name']));
        $info = htmlspecialchars(trim($_POST['info']));

        // Handle file upload for avatar
        $avatar = $_FILES['avatar']['name'];

        // Define upload directory
        $avatarDir = "../../user/media/characters/avatar/";

        // Ensure directory exists
        if (!is_dir($avatarDir)) {
            mkdir($avatarDir, 0777, true);
        }

        // Check for file upload errors
        if ($_FILES['avatar']['error'] === UPLOAD_ERR_OK) {
            // Move uploaded file to the appropriate directory
            if (move_uploaded_file($_FILES['avatar']['tmp_name'], $avatarDir . $avatar)) {
                // Insert character data into the database
                $sql = "INSERT INTO characters (characterName, characterInfo, characterAvatar) VALUES (?, ?, ?)";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param('sss', $name, $info, $avatar);
                $stmt->execute();

                header("Location: ../php/admin.php?view=characters&page=1");
                exit();
            } else {
                echo "Error moving uploaded file.";
            }
        } else {
            echo "Error uploading file: Avatar upload error code " . $_FILES['avatar']['error'] . ".";
        }
    }
}
