<?php
include "../../includes/db.php";

if (isset($_GET['userid'])) {
    $allowed = array('jpg', 'jpeg', 'png', 'gif');
} else {
    $allowed = array('jpg', 'jpeg', 'png');
}

// Display characters when editing anime/manga
if (isset($_GET['config']) && (isset($_GET['animeid']) || isset($_GET['mangaid']))) {
    if (isset($_GET['animeid'])) {
        $showRequest = $_GET['animeid'];
        $sqlCharacters = "SELECT ac.ID, c.characterID, c.characterName, c.characterAvatar, ac.characterRole FROM characters c JOIN anime_characters ac ON c.characterID = ac.characterID WHERE ac.animeID=? ORDER BY ac.characterRole";
    } else if (isset($_GET['mangaid'])) {
        $showRequest = $_GET['mangaid'];
        $sqlCharacters = "SELECT mc.ID, c.characterID, c.characterName, c.characterAvatar, mc.characterRole FROM characters c JOIN manga_characters mc ON c.characterID = mc.characterID WHERE mc.mangaID=? ORDER BY mc.characterRole";
    }
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sqlCharacters)) {
        echo 'Error preparing statements';
    } else {
        mysqli_stmt_bind_param($stmt, "s", $showRequest);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $rowID = array();
        $characterID = array();
        $characterName = array();
        $characterAvatar = array();
        $characterRole = array();
        while ($row = mysqli_fetch_assoc($result)) {
            $rowID[] = $row['ID'];
            $characterID[] = $row['characterID'];
            $characterName[] = $row['characterName'];
            $characterAvatar[] = $row['characterAvatar'];
            $characterRole[] = $row['characterRole'];
        }
    }
}

// Display anime data
if (isset($_GET['config']) && isset($_GET['animeid'])) {
    if ($_GET['config'] == 'edit') {
        $animeID = $_GET['animeid'];

        $sql = "SELECT * FROM anime WHERE animeID=?";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            echo 'Error preparing statements';
        } else {
            mysqli_stmt_bind_param($stmt, "s", $animeID);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            while ($row = mysqli_fetch_assoc($result)) {
                $animeID = $row['animeID'];
                $animeTitle = $row['animeTitle'];
                $animeSinopse = $row['animeSinopse'];
                $animeAvatar = $row['animeAvatar'];
                $animeBanner = $row['animeBanner'];
                $animeType = $row['animeType'];
                $animeEpisodes = $row['animeEpisodes'];
                $animeStatus = $row['animeStatus'];
                $animeStart = $row['animeStart'];
                $animeEnd = $row['animeEnd'];
                $animeSource = $row['animeSource'];
                $animeGenres = $row['animeGenres'];
            }
        }
    }
}

// Update anime data
if (isset($_POST['anime-edit'])) {
    // ID of the anime to be updated
    $animeIDEdit = $_GET['animeid'];

    // Other settings
    $animeTitleEdit = $_POST['title'];
    $animeSinopseEdit = $_POST['sinopse'];

    // Get avatar and banner
    $animeAvatarNameEdit = $_FILES['avatar']['name'];
    $animeAvatarTmpNameEdit = $_FILES['avatar']['tmp_name'];
    $animeAvatarSizeEdit = $_FILES['avatar']['size'];
    $animeAvatarErrorEdit = $_FILES['avatar']['error'];

    $animeBannerNameEdit = $_FILES['banner']['name'];
    $animeBannerTmpNameEdit = $_FILES['banner']['tmp_name'];
    $animeBannerSizeEdit = $_FILES['banner']['size'];
    $animeBannerErrorEdit = $_FILES['banner']['error'];

    $animeAvatarExtEdit = explode('.', $animeAvatarNameEdit);
    $animeAvatarActualExtEdit = strtolower(end($animeAvatarExtEdit));

    $animeBannerExtEdit = explode('.', $animeBannerNameEdit);
    $animeBannerActualExtEdit = strtolower(end($animeBannerExtEdit));

    // Other settings
    $animeTypeEdit = $_POST['type'];
    $animeEpisodesEdit = $_POST['episodes'];
    $animeStatusEdit = $_POST['status'];
    $animeSourceEdit = $_POST['source'];
    $animeDayStartEdit = $_POST['dayStart'];
    $animeMonthStartEdit = $_POST['monthStart'];
    $animeYearStartEdit = $_POST['yearStart'];
    $animeStartEdit = $animeYearStartEdit . '-' . $animeMonthStartEdit . '-' . $animeDayStartEdit;
    $animeDayEndEdit = $_POST['dayEnd'];
    $animeMonthEndEdit = $_POST['monthEnd'];
    $animeYearEndEdit = $_POST['yearEnd'];
    $animeEndEdit = $animeYearEndEdit . '-' . $animeMonthEndEdit . '-' . $animeDayEndEdit;

    // If the title is empty
    if (empty($animeTitleEdit)) {
        $animeTitleEdit = $animeTitle;
    }

    // Confirmations to upload the avatar
    if (!empty($animeAvatarNameEdit)) {
        if (in_array($animeAvatarActualExtEdit, $allowed)) {
            if ($animeAvatarErrorEdit === 0) {
                if ($animeAvatarSizeEdit < 3000000) {
                    $animeAvatarEdit = $animeIDEdit . "." . $animeAvatarActualExtEdit;
                    $animeAvatarDestinationEdit = '../../user/media/anime/avatar/' . $animeAvatarEdit;
                }
            }
        }
    }

    // Confirmations to upload the banner
    if (empty($_POST['bannerCheck']) && !empty($animeBannerNameEdit)) {
        if (in_array($animeBannerActualExtEdit, $allowed)) {
            if ($animeBannerErrorEdit === 0) {
                if ($animeBannerSizeEdit < 6000000) {
                    $animeBannerEdit = $animeIDEdit . "." . $animeBannerActualExtEdit;
                    $animeBannerDestinationEdit = '../../user/media/anime/banner/' . $animeBannerEdit;
                }
            }
        }
    }

    // If the synopsis is empty
    if (empty($animeSinopseEdit)) {
        $animeSinopseEdit = null;
    }

    // If episodes are not numeric | empty | or more than 4 digits || or less than 0
    if (!is_numeric($animeEpisodesEdit) || empty($animeEpisodesEdit) || strlen($animeEpisodesEdit) > 4 || $animeEpisodesEdit < 0) {
        $animeEpisodesEdit = null;
    }

    // If the start year is empty | If the day is not empty, but the month is | If the date is empty
    if ($animeYearStartEdit == '0000') {
        $animeStartEdit = $animeStart;
    }
    if ($animeMonthStartEdit == '00' && $animeDayStartEdit != '00') {
        $animeStartEdit = $animeStart;
    }
    if ($animeYearStartEdit == '0000' && $animeMonthStartEdit == '00' && $animeDayStartEdit == '00') {
        $animeStartEdit = null;
    }

    // If the end year is empty | If the day is not empty, but the month is | If the date is empty
    if ($animeYearEndEdit == '0000') {
        $animeEndEdit = $animeEnd;
    }
    if ($animeMonthEndEdit == '00' && $animeDayEndEdit != '00') {
        $animeEndEdit = $animeEnd;
    }
    if ($animeYearEndEdit == '0000' && $animeMonthEndEdit == '00' && $animeDayEndEdit == '00') {
        $animeEndEdit = null;
    }

    // If the end date is earlier than the start date
    if ($animeEndEdit != null) {
        if ($animeStartEdit > $animeEndEdit) {
            $animeStartEdit = null;
            $animeEndEdit = null;
        }
    }

    // If the source is empty
    if (empty($animeSourceEdit)) {
        $animeSourceEdit = null;
    }

    // Send all genres
    if (empty($_POST['genres'])) {
        $animeGenresEdit = null;
    } else {
        $animeGenresEdit = implode(', ', $_POST['genres']);
    }

    $sql = "UPDATE anime SET animeTitle=?, animeSinopse=?, animeAvatar=?, animeBanner=?, animeType=?, animeEpisodes=?, animeStatus=?, animeStart=?, animeEnd=?, animeSource=?, animeGenres=? WHERE animeID=?";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        echo 'Error preparing statements';
    } else {
        if (isset($animeAvatarEdit)) {
            unlink("../../user/media/anime/avatar/" . $animeAvatar);
            move_uploaded_file($animeAvatarTmpNameEdit, $animeAvatarDestinationEdit);
        } else {
            $animeAvatarEdit = $animeAvatar;
        }

        if (empty($_POST['bannerCheck']) && isset($animeBannerEdit)) {
            if (isset($animeBanner)) {
                unlink("../../user/media/anime/banner/" . $animeBanner);
            }
            move_uploaded_file($animeBannerTmpNameEdit, $animeBannerDestinationEdit);
        } else {
            if (!empty($_POST['bannerCheck']) && !empty($animeBanner)) {
                unlink("../../user/media/anime/banner/" . $animeBanner);
                $animeBannerEdit = null;
            } else if (empty($animeBanner)) {
                $animeBannerEdit = null;
            } else {
                $animeBannerEdit = $animeBanner;
            }
        }
        mysqli_stmt_bind_param($stmt, "ssssssssssss", $animeTitleEdit, $animeSinopseEdit, $animeAvatarEdit, $animeBannerEdit, $animeTypeEdit, $animeEpisodesEdit, $animeStatusEdit, $animeStartEdit, $animeEndEdit, $animeSourceEdit, $animeGenresEdit, $animeIDEdit);
        mysqli_stmt_execute($stmt);
    }

    // Verify the number of characters in the database
    $sqlCharacterVerify = "SELECT characterID FROM characters";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sqlCharacterVerify)) {
        echo 'Error preparing statements';
    } else {
        mysqli_stmt_execute($stmt);
        $characterVerify = mysqli_stmt_get_result($stmt);
        $characterVerifyTotal = mysqli_num_rows($characterVerify);
    }

    // Get the ID of each character and if they are main or secondary
    $characterIDPost = $_POST['characterID'];
    $characterRolePost = $_POST['characterRole'];

    for ($i = 0; $i <= 5; $i++) {
        $characterIDEdit = $characterIDPost[$i];
        $characterRoleEdit = $characterRolePost[$i];

        // Add/replace in the table only if there is a character to be added/updated in the form and if the character exists in the database
        if ($characterIDEdit > 0 && $characterIDEdit <= $characterVerifyTotal && !empty($characterRoleEdit)) {
            $sqlCharactersEdit = "REPLACE INTO anime_characters (ID, animeID, characterID, characterRole) VALUES(?,?,?,?)";
            $stmt = mysqli_stmt_init($conn);
            if (!mysqli_stmt_prepare($stmt, $sqlCharactersEdit)) {
                echo 'Error preparing statements';
            } else {
                mysqli_stmt_bind_param($stmt, "ssss", $rowID[$i], $animeIDEdit, $characterIDEdit, $characterRoleEdit);
                mysqli_stmt_execute($stmt);
            }
        }

        // If the user wants to delete the character from the anime list
        else if (empty($characterIDEdit) && empty($characterRoleEdit)) {
            $sqlCharactersEdit = "DELETE FROM anime_characters WHERE ID=?;";
            $stmt = mysqli_stmt_init($conn);
            if (!mysqli_stmt_prepare($stmt, $sqlCharactersEdit)) {
                echo 'Error preparing statements';
            } else {
                mysqli_stmt_bind_param($stmt, "s", $rowID[$i]);
                mysqli_stmt_execute($stmt);
            }
        }
    }

    // Update the AUTO_INCREMENT of the table to avoid incorrect data when data is deleted
    $sqlTableUpdate = "SET @num = 0;";
    $sqlTableUpdate .= "UPDATE anime_characters SET ID = @num := (@num+1);";
    $sqlTableUpdate .= "ALTER TABLE anime_characters AUTO_INCREMENT =1;";
    mysqli_multi_query($conn, $sqlTableUpdate);

    // Return to the anime edit page
    header("Location: ../php/admin-edit.php?config=edit&animeid=" . $animeIDEdit);
}

// Delete anime
if (isset($_POST['anime-delete'])) {
    $animeID = $_GET['animeid'];
    $sql = "DELETE FROM anime WHERE animeID=?";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        echo 'Error preparing statements';
    } else {
        mysqli_stmt_bind_param($stmt, "s", $animeID);
        mysqli_stmt_execute($stmt);
        header("Location: ../php/admin.php?view=anime&page=1");
        exit();
    }
}

// Display manga data
if (isset($_GET['config']) && isset($_GET['mangaid'])) {
    if ($_GET['config'] == 'edit') {
        $mangaID = $_GET['mangaid'];

        $sql = "SELECT * FROM manga WHERE mangaID=?";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            echo 'Error preparing statements';
        } else {
            mysqli_stmt_bind_param($stmt, "s", $mangaID);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            while ($row = mysqli_fetch_assoc($result)) {
                $mangaID = $row['mangaID'];
                $mangaTitle = $row['mangaTitle'];
                $mangaSinopse = $row['mangaSinopse'];
                $mangaAvatar = $row['mangaAvatar'];
                $mangaBanner = $row['mangaBanner'];
                $mangaType = $row['mangaType'];
                $mangaChapters = $row['mangaChapters'];
                $mangaVolumes = $row['mangaVolumes'];
                $mangaStatus = $row['mangaStatus'];
                $mangaStart = $row['mangaStart'];
                $mangaEnd = $row['mangaEnd'];
                $mangaGenres = $row['mangaGenres'];
            }
        }
    }
}

// Update manga data
if (isset($_POST['manga-edit'])) {
    // ID of the manga to be updated
    $mangaIDEdit = $_GET['mangaid'];

    // Other settings
    $mangaTitleEdit = $_POST['title'];
    $mangaSinopseEdit = $_POST['sinopse'];

    // Get avatar and banner
    $mangaAvatarNameEdit = $_FILES['avatar']['name'];
    $mangaAvatarTmpNameEdit = $_FILES['avatar']['tmp_name'];
    $mangaAvatarSizeEdit = $_FILES['avatar']['size'];
    $mangaAvatarErrorEdit = $_FILES['avatar']['error'];

    $mangaBannerNameEdit = $_FILES['banner']['name'];
    $mangaBannerTmpNameEdit = $_FILES['banner']['tmp_name'];
    $mangaBannerSizeEdit = $_FILES['banner']['size'];
    $mangaBannerErrorEdit = $_FILES['banner']['error'];

    $mangaAvatarExtEdit = explode('.', $mangaAvatarNameEdit);
    $mangaAvatarActualExtEdit = strtolower(end($mangaAvatarExtEdit));

    $mangaBannerExtEdit = explode('.', $mangaBannerNameEdit);
    $mangaBannerActualExtEdit = strtolower(end($mangaBannerExtEdit));

    // Other settings
    $mangaTypeEdit = $_POST['type'];
    $mangaChaptersEdit = $_POST['chapters'];
    $mangaVolumesEdit = $_POST['volumes'];
    $mangaStatusEdit = $_POST['status'];
    $mangaDayStartEdit = $_POST['dayStart'];
    $mangaMonthStartEdit = $_POST['monthStart'];
    $mangaYearStartEdit = $_POST['yearStart'];
    $mangaStartEdit = $mangaYearStartEdit . '-' . $mangaMonthStartEdit . '-' . $mangaDayStartEdit;
    $mangaDayEndEdit = $_POST['dayEnd'];
    $mangaMonthEndEdit = $_POST['monthEnd'];
    $mangaYearEndEdit = $_POST['yearEnd'];
    $mangaEndEdit = $mangaYearEndEdit . '-' . $mangaMonthEndEdit . '-' . $mangaDayEndEdit;

    // If the title is empty
    if (empty($mangaTitleEdit)) {
        $mangaTitleEdit = $mangaTitle;
    }

    // Confirmations to upload the avatar
    if (!empty($mangaAvatarNameEdit)) {
        if (in_array($mangaAvatarActualExtEdit, $allowed)) {
            if ($mangaAvatarErrorEdit === 0) {
                if ($mangaAvatarSizeEdit < 3000000) {
                    $mangaAvatarEdit = $mangaIDEdit . "." . $mangaAvatarActualExtEdit;
                    $mangaAvatarDestinationEdit = '../../user/media/manga/avatar/' . $mangaAvatarEdit;
                }
            }
        }
    }

    // Confirmations to upload the banner
    if (empty($_POST['bannerCheck']) && !empty($mangaBannerNameEdit)) {
        if (in_array($mangaBannerActualExtEdit, $allowed)) {
            if ($mangaBannerErrorEdit === 0) {
                if ($mangaBannerSizeEdit < 6000000) {
                    $mangaBannerEdit = $mangaIDEdit . "." . $mangaBannerActualExtEdit;
                    $mangaBannerDestinationEdit = '../../user/media/manga/banner/' . $mangaBannerEdit;
                }
            }
        }
    }

    // If the synopsis is empty
    if (empty($mangaSinopseEdit)) {
        $mangaSinopseEdit = null;
    }

    // If chapters are not numeric | empty | or more than 4 digits || or less than 0
    if (!is_numeric($mangaChaptersEdit) || empty($mangaChaptersEdit) || strlen($mangaChaptersEdit) > 4 || $mangaChaptersEdit < 0) {
        $mangaChaptersEdit = null;
    }

    // If volumes are not numeric | empty | or more than 4 digits || or less than 0
    if (!is_numeric($mangaVolumesEdit) || empty($mangaVolumesEdit) || strlen($mangaVolumesEdit) > 4 || $mangaVolumesEdit < 0) {
        $mangaVolumesEdit = null;
    }

    // If the start year is empty | If the day is not empty, but the month is | If the date is empty
    if ($mangaYearStartEdit == '0000') {
        $mangaStartEdit = $mangaStart;
    }
    if ($mangaMonthStartEdit == '00' && $mangaDayStartEdit != '00') {
        $mangaStartEdit = $mangaStart;
    }
    if ($mangaYearStartEdit == '0000' && $mangaMonthStartEdit == '00' && $mangaDayStartEdit == '00') {
        $mangaStartEdit = null;
    }

    // If the end year is empty | If the day is not empty, but the month is | If the date is empty
    if ($mangaYearEndEdit == '0000') {
        $mangaEndEdit = $mangaEnd;
    }
    if ($mangaMonthEndEdit == '00' && $mangaDayEndEdit != '00') {
        $mangaEndEdit = $mangaEnd;
    }
    if ($mangaYearEndEdit == '0000' && $mangaMonthEndEdit == '00' && $mangaDayEndEdit == '00') {
        $mangaEndEdit = null;
    }

    // If the end date is earlier than the start date
    if ($mangaEndEdit != null) {
        if ($mangaStartEdit > $mangaEndEdit) {
            $mangaStartEdit = null;
            $mangaEndEdit = null;
        }
    }

    // Send all genres
    if (empty($_POST['genres'])) {
        $mangaGenresEdit = null;
    } else {
        $mangaGenresEdit = implode(', ', $_POST['genres']);
    }

    $sql = "UPDATE manga SET mangaTitle=?, mangaSinopse=?, mangaAvatar=?, mangaBanner=?, mangaType=?, mangaChapters=?, mangaVolumes=?, mangaStatus=?, mangaStart=?, mangaEnd=?, mangaGenres=? WHERE mangaID=?";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        echo 'Error preparing statements';
    } else {
        if (isset($mangaAvatarEdit)) {
            unlink("../../user/media/manga/avatar/" . $mangaAvatar);
            move_uploaded_file($mangaAvatarTmpNameEdit, $mangaAvatarDestinationEdit);
        } else {
            $mangaAvatarEdit = $mangaAvatar;
        }

        if (empty($_POST['bannerCheck']) && isset($mangaBannerEdit)) {
            if (isset($mangaBanner)) {
                unlink("../../user/media/manga/banner/" . $mangaBanner);
            }
            move_uploaded_file($mangaBannerTmpNameEdit, $mangaBannerDestinationEdit);
        } else {
            if (!empty($_POST['bannerCheck']) && !empty($mangaBanner)) {
                unlink("../../user/media/manga/banner/" . $mangaBanner);
                $mangaBannerEdit = null;
            } else if (empty($mangaBanner)) {
                $mangaBannerEdit = null;
            } else {
                $mangaBannerEdit = $mangaBanner;
            }
        }
        mysqli_stmt_bind_param($stmt, "ssssssssssss", $mangaTitleEdit, $mangaSinopseEdit, $mangaAvatarEdit, $mangaBannerEdit, $mangaTypeEdit, $mangaChaptersEdit, $mangaVolumesEdit, $mangaStatusEdit, $mangaStartEdit, $mangaEndEdit, $mangaGenresEdit, $mangaIDEdit);
        mysqli_stmt_execute($stmt);
    }

    // Verify the number of characters in the database
    $sqlCharacterVerify = "SELECT characterID FROM characters";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sqlCharacterVerify)) {
        echo 'Error preparing statements';
    } else {
        mysqli_stmt_execute($stmt);
        $characterVerify = mysqli_stmt_get_result($stmt);
        $characterVerifyTotal = mysqli_num_rows($characterVerify);
    }

    // Get the ID of each character and if they are main or secondary
    $characterIDPost = $_POST['characterID'];
    $characterRolePost = $_POST['characterRole'];

    for ($i = 0; $i <= 5; $i++) {
        $characterIDEdit = $characterIDPost[$i];
        $characterRoleEdit = $characterRolePost[$i];

        // Add/replace in the table only if there is a character to be added/updated in the form and if the character exists in the database
        if ($characterIDEdit > 0 && $characterIDEdit <= $characterVerifyTotal && !empty($characterRoleEdit)) {
            $sqlCharactersEdit = "REPLACE INTO manga_characters (ID, mangaID, characterID, characterRole) VALUES(?,?,?,?)";
            $stmt = mysqli_stmt_init($conn);
            if (!mysqli_stmt_prepare($stmt, $sqlCharactersEdit)) {
                echo 'Error preparing statements';
            } else {
                mysqli_stmt_bind_param($stmt, "ssss", $rowID[$i], $mangaIDEdit, $characterIDEdit, $characterRoleEdit);
                mysqli_stmt_execute($stmt);
            }
        }

        // If the user wants to delete the character from the manga list
        else if (empty($characterIDEdit) && empty($characterRoleEdit)) {
            $sqlCharactersEdit = "DELETE FROM manga_characters WHERE ID=?;";
            $stmt = mysqli_stmt_init($conn);
            if (!mysqli_stmt_prepare($stmt, $sqlCharactersEdit)) {
                echo 'Error preparing statements';
            } else {
                mysqli_stmt_bind_param($stmt, "s", $rowID[$i]);
                mysqli_stmt_execute($stmt);
            }
        }
    }

    // Update the AUTO_INCREMENT of the table to avoid incorrect data when data is deleted
    $sqlTableUpdate = "SET @num = 0;";
    $sqlTableUpdate .= "UPDATE manga_characters SET ID = @num := (@num+1);";
    $sqlTableUpdate .= "ALTER TABLE manga_characters AUTO_INCREMENT =1;";
    mysqli_multi_query($conn, $sqlTableUpdate);

    // Return to the manga edit page
    header("Location: ../php/admin-edit.php?config=edit&mangaid=" . $mangaIDEdit);
}

// Delete manga
if (isset($_POST['manga-delete'])) {
    $mangaID = $_GET['mangaid'];
    $sql = "DELETE FROM manga WHERE mangaID=?";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        echo 'Error preparing statements';
    } else {
        mysqli_stmt_bind_param($stmt, "s", $mangaID);
        mysqli_stmt_execute($stmt);
        header("Location: ../php/admin.php?view=manga&page=1");
        exit();
    }
}

// Display character data
if (isset($_GET['config']) && isset($_GET['characterid'])) {
    if ($_GET['config'] == 'edit') {
        $characterID = $_GET['characterid'];

        $sql = "SELECT * FROM characters WHERE characterID=?";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            echo 'Error preparing statements';
        } else {
            mysqli_stmt_bind_param($stmt, "s", $characterID);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            $resultTotal = mysqli_num_rows($result);
            while ($row = mysqli_fetch_assoc($result)) {
                $characterID = $row['characterID'];
                $characterName = $row['characterName'];
                $characterAvatar = $row['characterAvatar'];
                $characterInfo = $row['characterInfo'];
            }
        }
    }
}

// Update character data
if (isset($_POST['character-edit'])) {
    // ID
    $characterIDEdit = $_GET['characterid'];

    // Name
    $characterNameEdit = $_POST['name'];

    // Get avatar
    $characterAvatarNameEdit = $_FILES['avatar']['name'];
    $characterAvatarTmpNameEdit = $_FILES['avatar']['tmp_name'];
    $characterAvatarSizeEdit = $_FILES['avatar']['size'];
    $characterAvatarErrorEdit = $_FILES['avatar']['error'];

    $characterAvatarExtEdit = explode('.', $characterAvatarNameEdit);
    $characterAvatarActualExtEdit = strtolower(end($characterAvatarExtEdit));

    // Info
    $characterInfoEdit = $_POST['info'];

    // If the name is empty
    if (empty($characterNameEdit)) {
        $characterNameEdit = $characterName;
    }

    // Confirmations to upload the avatar
    if (!empty($characterAvatarNameEdit)) {
        if (in_array($characterAvatarActualExtEdit, $allowed)) {
            if ($characterAvatarErrorEdit === 0) {
                if ($characterAvatarSizeEdit < 3000000) {
                    $characterAvatarEdit = $characterIDEdit . "." . $characterAvatarActualExtEdit;
                    $characterAvatarDestinationEdit = '../../user/media/characters/avatar/' . $characterAvatarEdit;
                }
            }
        }
    }

    // If the info is empty
    if (empty($characterInfoEdit)) {
        $characterInfoEdit = null;
    }

    $sql = "UPDATE characters SET characterName=?, characterAvatar=?, characterInfo=? WHERE characterID=?";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        echo 'Error preparing statements';
    } else {
        if (isset($characterAvatarEdit)) {
            unlink("../../user/media/characters/avatar/" . $characterAvatar);
            move_uploaded_file($characterAvatarTmpNameEdit, $characterAvatarDestinationEdit);
        } else {
            $characterAvatarEdit = $characterAvatar;
        }
        mysqli_stmt_bind_param($stmt, "ssss", $characterNameEdit, $characterAvatarEdit, $characterInfoEdit, $characterIDEdit);
        mysqli_stmt_execute($stmt);
        header("Location: ../php/admin-edit.php?config=edit&characterid=" . $characterIDEdit);
    }
}

// Delete character
if (isset($_POST['character-delete'])) {
    $characterID = $_GET['characterid'];
    $sql = "DELETE FROM characters WHERE characterID=?";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        echo 'Error preparing statements';
    } else {
        mysqli_stmt_bind_param($stmt, "s", $characterID);
        mysqli_stmt_execute($stmt);
        header("Location: ../php/admin.php?view=characters&page=1");
        exit();
    }
}

// Display user data
if (isset($_GET['config']) && isset($_GET['userid'])) {
    if ($_GET['config'] == 'edit') {
        $userID = $_GET['userid'];

        $sql = "SELECT userID, userName, userEmail, userPassword, userPermissions, userAvatar, userBanner, userBannerList, userAbout, userGender, userBirthday, userLocalization, userDate, userOnlineStatus FROM users WHERE userID=?";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            echo 'Error preparing statements';
        } else {
            mysqli_stmt_bind_param($stmt, "s", $userID);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            while ($row = mysqli_fetch_assoc($result)) {
                $userID = $row['userID'];
                $userName = $row['userName'];
                $userEmail = $row['userEmail'];
                $userPassword = $row['userPassword'];
                $userPermissions = $row['userPermissions'];
                $userAvatar = $row['userAvatar'];
                $userBanner = $row['userBanner'];
                $userBannerList = $row['userBannerList'];
                $userAbout = $row['userAbout'];
                $userGender = $row['userGender'];
                $userBirthday = $row['userBirthday'];
                $userLocalization = $row['userLocalization'];
                $userDateSignUP = $row['userDate'];
                $userLastOnline = $row['userOnlineStatus'];
            }
        }
    }
}

// Update user data
if (isset($_POST['user-edit']) || isset($_POST['user-ban']) || isset($_POST['user-desban'])) {
    $userIDEdit = $_GET['userid'];
    $userNameEdit = $_POST['name'];
    $userEmailEdit = $_POST['email'];

    $userPasswordEdit = $_POST['password'];
    $userHashedPasswordEdit = password_hash($userPasswordEdit, PASSWORD_DEFAULT);

    $userPermissionsEdit = $_POST['permissions'];

    $userAvatarNameEdit = $_FILES['avatar']['name'];
    $userAvatarTmpNameEdit = $_FILES['avatar']['tmp_name'];
    $userAvatarSizeEdit = $_FILES['avatar']['size'];
    $userAvatarErrorEdit = $_FILES['avatar']['error'];

    $userBannerNameEdit = $_FILES['banner']['name'];
    $userBannerTmpNameEdit = $_FILES['banner']['tmp_name'];
    $userBannerSizeEdit = $_FILES['banner']['size'];
    $userBannerErrorEdit = $_FILES['banner']['error'];

    $userBannerListNameEdit = $_FILES['banner-list']['name'];
    $userBannerListTmpNameEdit = $_FILES['banner-list']['tmp_name'];
    $userBannerListSizeEdit = $_FILES['banner-list']['size'];
    $userBannerListErrorEdit = $_FILES['banner-list']['error'];

    $userAvatarExtEdit = explode('.', $userAvatarNameEdit);
    $userAvatarActualExtEdit = strtolower(end($userAvatarExtEdit));

    $userBannerExtEdit = explode('.', $userBannerNameEdit);
    $userBannerActualExtEdit = strtolower(end($userBannerExtEdit));

    $userBannerListExtEdit = explode('.', $userBannerListNameEdit);
    $userBannerListActualExtEdit = strtolower(end($userBannerListExtEdit));

    $userAboutEdit = $_POST['about'];
    $userGenderEdit = $_POST['gender'];
    $userDayBirthdayEdit = $_POST['dayBirthday'];
    $userMonthBirthdayEdit = $_POST['monthBirthday'];
    $userYearBirthdayEdit = $_POST['yearBirthday'];
    $userBirthdayEdit = $userYearBirthdayEdit . '-' . $userMonthBirthdayEdit . '-' . $userDayBirthdayEdit;
    $userLocalizationEdit = $_POST['localization'];

    // Keep the name if it contains invalid characters, or if it is longer than 16 or shorter than 2
    if (!preg_match("/^[a-zA-Z0-9]*$/", $userNameEdit) || strlen($userNameEdit) > 16 || strlen($userNameEdit) < 2) {
        $userNameEdit = $userName;
    }

    // Keep the email if it is not valid
    if (!filter_var($userEmailEdit, FILTER_VALIDATE_EMAIL)) {
        $userEmailEdit = $userEmail;
    }

    // Confirmations to upload the avatar
    if (empty($_POST['avatarCheck']) && !empty($userAvatarNameEdit)) {
        if (in_array($userAvatarActualExtEdit, $allowed)) {
            if ($userAvatarErrorEdit === 0) {
                if ($userAvatarSizeEdit < 3000000) {
                    $userAvatarEdit = time() . uniqid(rand()) . "." . $userAvatarActualExtEdit;
                    $userAvatarDestinationEdit = '../../user/media/users/avatar/' . $userAvatarEdit;
                }
            }
        }
    }

    // Confirmations to upload the banner
    if (empty($_POST['bannerCheck']) && !empty($userBannerNameEdit)) {
        if (in_array($userBannerActualExtEdit, $allowed)) {
            if ($userBannerErrorEdit === 0) {
                if ($userBannerSizeEdit < 6000000) {
                    $userBannerEdit = time() . uniqid(rand()) . "." . $userBannerActualExtEdit;
                    $userBannerDestinationEdit = '../../user/media/users/banner/' . $userBannerEdit;
                }
            }
        }
    }

    // Confirmations to upload the list banner
    if (empty($_POST['bannerListCheck']) && !empty($userBannerListNameEdit)) {
        if (in_array($userBannerListActualExtEdit, $allowed)) {
            if ($userBannerListErrorEdit === 0) {
                if ($userBannerListSizeEdit < 6000000) {
                    $userBannerListEdit = time() . uniqid(rand()) . "." . $userBannerListActualExtEdit;
                    $userBannerListDestinationEdit = '../../user/media/users/bannerList/' . $userBannerListEdit;
                }
            }
        }
    }

    // If the user's about is empty
    if (empty($userAboutEdit)) {
        $userAboutEdit = null;
    }
    if ($userAboutEdit > 5000) {
        $userAbout = $_SESSION['userAbout'];
    }

    // If any part of the birthday is empty
    if ($userDayBirthdayEdit == '00' || $userMonthBirthdayEdit == '00' || $userYearBirthdayEdit == '0000') {
        $userBirthdayEdit = null;
    }

    // If the localization is empty or longer than 12
    if (empty($userLocalizationEdit)) {
        $userLocalizationEdit = null;
    }
    if (strlen($userLocalizationEdit) > 12) {
        $userLocalizationEdit = $userLocalization;
    }

    if (!empty($userPasswordEdit) && strlen($userPasswordEdit) >= 5 && strlen($userPasswordEdit) <= 16) {
        $sql = "UPDATE users SET userName=?, userEmail=?, userPassword=?, userPermissions=?, userAvatar=?, userBanner=?, userBannerList=?, userAbout=?, userGender=?, userBirthday=?, userLocalization=? WHERE userID=?";
    } else {
        $sql = "UPDATE users SET userName=?, userEmail=?, userPermissions=?, userAvatar=?, userBanner=?, userBannerList=?, userAbout=?, userGender=?, userBirthday=?, userLocalization=? WHERE userID=?";
    }
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        echo 'Error preparing statements';
    } else {
        if (empty($_POST['bannerCheck']) && isset($userAvatarEdit)) {
            if (isset($userAvatar)) {
                unlink("../../user/media/users/avatar/" . $userAvatar);
            }
            move_uploaded_file($userAvatarTmpNameEdit, $userAvatarDestinationEdit);
        } else {
            if (!empty($_POST['avatarCheck']) && !empty($userAvatar)) {
                unlink("../../user/media/users/avatar/" . $userAvatar);
                $userAvatarEdit = null;
            } else if (empty($userAvatar)) {
                $userAvatarEdit = null;
            } else {
                $userAvatarEdit = $userAvatar;
            }
        }

        if (empty($_POST['bannerCheck']) && isset($userBannerEdit)) {
            if (isset($userBanner)) {
                unlink("../../user/media/users/banner/" . $userBanner);
            }
            move_uploaded_file($userBannerTmpNameEdit, $userBannerDestinationEdit);
        } else {
            if (!empty($_POST['bannerCheck']) && !empty($userBanner)) {
                unlink("../../user/media/users/banner/" . $userBanner);
                $userBannerEdit = null;
            } else if (empty($userBanner)) {
                $userBannerEdit = null;
            } else {
                $userBannerEdit = $userBanner;
            }
        }

        if (empty($_POST['bannerListCheck']) && isset($userBannerListEdit)) {
            if (isset($userBannerList)) {
                unlink("../../user/media/users/bannerList/" . $userBannerList);
            }
            move_uploaded_file($userBannerListTmpNameEdit, $userBannerListDestinationEdit);
        } else {
            if (!empty($_POST['bannerListCheck']) && !empty($userBannerList)) {
                unlink("../../user/media/users/bannerList/" . $userBannerList);
                $userBannerListEdit = null;
            } else if (empty($userBannerList)) {
                $userBannerListEdit = null;
            } else {
                $userBannerListEdit = $userBannerList;
            }
        }

        if (!empty($userPasswordEdit) && strlen($userPasswordEdit) >= 5 && strlen($userPasswordEdit) <= 16) {
            mysqli_stmt_bind_param($stmt, "ssssssssssss", $userNameEdit, $userEmailEdit, $userHashedPasswordEdit, $userPermissionsEdit, $userAvatarEdit, $userBannerEdit, $userBannerListEdit, $userAboutEdit, $userGenderEdit, $userBirthdayEdit, $userLocalizationEdit, $userIDEdit);
            mysqli_stmt_execute($stmt);
        } else {
            mysqli_stmt_bind_param($stmt, "sssssssssss", $userNameEdit, $userEmailEdit, $userPermissionsEdit, $userAvatarEdit, $userBannerEdit, $userBannerListEdit, $userAboutEdit, $userGenderEdit, $userBirthdayEdit, $userLocalizationEdit, $userIDEdit);
            mysqli_stmt_execute($stmt);
        }

        // Return to the user edit page
        header("Location: ../admin-edit.php?config=edit&userid=" . $userIDEdit);
    }
}

if (isset($_POST['user-ban']) || isset($_POST['user-desban'])) {
    $userIDEdit = $_GET['userid'];

    if (isset($_POST['user-ban'])) {
        $userBanStatus = 1;
    } else {
        $userBanStatus = 0;
    }

    $sql = "UPDATE users SET userBanStatus=? WHERE userID=?";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        echo 'Error preparing statements';
    } else {
        mysqli_stmt_bind_param($stmt, "ss", $userBanStatus, $userIDEdit);
        mysqli_stmt_execute($stmt);
        header("Location: ../php/admin-edit.php?config=edit&userid=" . $userIDEdit);
    }
}

// Delete user
if (isset($_POST['user-delete'])) {
    $userID = $_GET['userid'];
    $sql = "DELETE FROM users WHERE userID=?";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        echo 'Error preparing statements';
    } else {
        mysqli_stmt_bind_param($stmt, "s", $userID);
        mysqli_stmt_execute($stmt);
        header("Location: ../php/admin.php?view=users&page=1");
        exit();
    }
}
