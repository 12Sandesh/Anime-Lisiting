<?php
session_start();
// Include the required file
include "../includes/admin.inc.php";
include "../includes/admin-edit.inc.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>
        <?php
        $animeTitle = $animeTitle ?? '';
        $mangaTitle = $mangaTitle ?? '';
        $characterName = $characterName ?? '';
        $userName = $userName ?? '';

        echo isset($_GET['animeid']) ? "$animeTitle" : "";
        echo isset($_GET['mangaid']) ? "$mangaTitle" : "";
        echo isset($_GET['characterid']) ? "$characterName" : "";
        echo isset($_GET['userid']) ? "$userName" : "";
        ?>
        Edit - AnimeKoji
    </title>
    <meta charset="UTF-8">
    <link rel="shortcut icon" href="../img/logo_init.png">
    <link rel="stylesheet" type="text/css" href="../css/admin.css">
    <link rel="stylesheet" type="text/css" href="../css/menu.css">
    <link rel="stylesheet" type="text/css" href="../css/footer.css">
    <link rel="stylesheet" type="text/css" href="../css/fontawesome.min.css">
</head>

<body>
    <div class="page-wrap">
        <div class="container-all">
            <div class="container-edit">
                <img src="../img/logo11.png">
                <?php
                // Anime
                if ($_GET['config'] == 'edit' && isset($_GET['animeid'])) {
                    // Ensure all required variables are defined
                    $animeStart = $animeStart ?? '';
                    $animeEnd = $animeEnd ?? '';
                    $animeType = $animeType ?? '';
                    $animeStatus = $animeStatus ?? '';
                    $animeSource = $animeSource ?? '';
                    $animeGenres = $animeGenres ?? '';
                    $animeID = $animeID ?? '';
                    $animeTitle = $animeTitle ?? '';
                    $animeSinopse = $animeSinopse ?? '';
                    $animeAvatar = $animeAvatar ?? '';
                    $animeBanner = $animeBanner ?? '';
                    $animeEpisodes = $animeEpisodes ?? '';
                    $characterID = $characterID ?? [];
                    $characterName = $characterName ?? [];
                    $characterAvatar = $characterAvatar ?? [];
                    $characterRole = $characterRole ?? [];
                    $characterID = is_array($characterID) ? $characterID : [];
                    $characterName = is_array($characterName) ? $characterName : [];
                    $characterAvatar = is_array($characterAvatar) ? $characterAvatar : [];
                    $characterRole = is_array($characterRole) ? $characterRole : [];

                    // Check the date the anime started
                    $yearStart = substr($animeStart, 0, 4);
                    $monthStart = substr($animeStart, 5, 2);
                    $dayStart = substr($animeStart, 8, 2);

                    // Check the date the anime ended
                    $yearEnd = substr($animeEnd, 0, 4);
                    $monthEnd = substr($animeEnd, 5, 2);
                    $dayEnd = substr($animeEnd, 8, 2);

                    // Check which type is selected
                    $typeTV = $animeType == "TV" ? "selected" : "";
                    $typeMovie = $animeType == "Movie" ? "selected" : "";
                    $typeOVA = $animeType == "OVA" ? "selected" : "";
                    $typeONA = $animeType == "ONA" ? "selected" : "";

                    // Check which status is selected
                    $statusFinished = $animeStatus == "Finished" ? "selected" : "";
                    $statusAiring = $animeStatus == "Airing" ? "selected" : "";
                    $statusNotAired = $animeStatus == "Not yet aired" ? "selected" : "";

                    // Check which source is selected
                    $sourceManga = $animeSource == "Manga" ? "selected" : "";
                    $sourceNovel = $animeSource == "Novel" ? "selected" : "";
                    $sourceOriginal = $animeSource == "Original" ? "selected" : "";

                    // Options to select genres and already selected genres
                    $animeGenresOptions = array("Action", "Adventure", "Cars", "Comedy", "Dementia", "Demons", "Drama", "Ecchi", "Fantasy", "Game", "Harem", "Hentai", "Historical", "Horror", "Josei", "Kids", "Magic", "Martial Arts", "Mecha", "Military", "Music", "Mystery", "Parody", "Police", "Psychological", "Romance", "Samurai", "School", "Sci-Fi", "Seinen", "Shoujo", "Shoujo Ai", "Shounen", "Shounen Ai", "Slice of Life", "Space", "Sports", "Super Power", "Supernatural", "Thriller", "Vampire", "Yaoi", "Yuri");
                    $animeGenres = explode(", ", $animeGenres);

                    echo '
                        <form action="../includes/admin-edit.inc.php?config=edit&animeid=' . $animeID . '" method="post" enctype="multipart/form-data" id="anime-edit">        
                            <h4>ID *</h4>     
                            <input type="text" value="' . $animeID . '" name="ID" class="form-input" disabled>

                            <h4>Anime *</h4>
                            <input type="text" value="' . $animeTitle . '" placeholder="Anime title" name="title" class="form-input" id="anime-title">
                            <p class="error-messages"></p>

                            <h4>Synopsis</h4>
                            <textarea name="sinopse" placeholder="Anime synopsis" class="form-input textarea">' . $animeSinopse . '</textarea>

                            <h4>Avatar *</h4>   
                            <div class="form-image">
                                <p>Allowed formats: JPEG, PNG. Max size: 3mb.</p>
                                <div class="dropbox">
                                    <input type="file" name="avatar" class="file-input" id="avatar">
                                    <p>Drop your image here or click to upload</p>
                                </div>
                                <div class="avatar" id="avatar-show" style="background-image:url(../../user/media/anime/avatar/' . $animeAvatar . ')"></div>
                            </div>
                            <p class="error-messages e-avatar"></p>

                            <h4>Banner</h4>
                            <div class="form-image">
                                <p>Allowed formats: JPEG, PNG. Max size: 6mb.</p>
                                <div class="dropbox">
                                    <input type="file" name="banner" class="file-input" id="banner">
                                    <p>Drop your image here or click to upload</p>
                                </div>
                                <div class="banner" id="banner-show" style="background-image:url(../../user/media/anime/banner/' . $animeBanner . ')"></div>
                                <div class="form-checkbox">
                                    <input type="checkbox" name="bannerCheck" id="bannerCheck"> <label for="bannerCheck">Delete anime banner</label>
                                </div>
                            </div>
                            <p class="error-messages e-banner"></p>

                            <h4>Type *</h4>   
                            <select name="type" class="form-select">
                                <option value="TV" ' . $typeTV . '>TV</option>
                                <option value="Movie" ' . $typeMovie . '>Movie</option>
                                <option value="OVA" ' . $typeOVA . '>OVA</option>
                                <option value="ONA" ' . $typeONA . '>ONA</option>
                            </select>

                            <h4>Episodes</h4>   
                            <input type="text" value="' . $animeEpisodes . '" placeholder="Number of episodes" name="episodes" class="form-input" id="anime-episodes">
                            <p class="error-messages"></p>

                            <h4>Status *</h4>   
                            <select name="status" class="form-select">
                                <option value="Finished" ' . $statusFinished . '>Finished</option>
                                <option value="Airing" ' . $statusAiring . '>Airing</option>
                                <option value="Not yet aired" ' . $statusNotAired . '>Not yet aired</option>
                            </select>

                            <h4>Broadcast (dd/mm/yyyy)</h4>   
                            <select name="dayStart" class="form-date day" id="animeDayStart">
                                <option value="00">Select</option>';
                    for ($day = 1; $day <= 31; $day++) {
                        $day = str_pad($day, 2, 0, STR_PAD_LEFT);
                        if ($dayStart == $day) {
                            $daySS = 'selected';
                        } else {
                            $daySS = '';
                        }
                        echo '<option value="' . $day . '" ' . $daySS . '>' . $day . '</option>';
                    }
                    echo
                    '</select>

                            <select name="monthStart" class="form-date month" id="animeMonthStart">
                                <option value="00">Select</option>';
                    for ($month = 1; $month <= 12; $month++) {
                        $month = str_pad($month, 2, 0, STR_PAD_LEFT);
                        if ($monthStart == $month) {
                            $monthSS = 'selected';
                        } else {
                            $monthSS = '';
                        }
                        echo '<option value="' . $month . '" ' . $monthSS . '>' . $month . '</option>';
                    }
                    echo
                    '</select>

                            <select name="yearStart" class="form-date year" id="animeYearStart">
                                <option value="0000">Select</option>';
                    for ($year = 2025; $year >= 1930; $year--) {
                        $year = str_pad($year, 2, 0, STR_PAD_LEFT);
                        if ($yearStart == $year) {
                            $yearSS = 'selected';
                        } else {
                            $yearSS = '';
                        }
                        echo '<option value="' . $year . '" ' . $yearSS . '>' . $year . '</option>';
                    }
                    echo
                    '</select>

                            <select name="dayEnd" class="form-date day" id="animeDayEnd">
                                <option value="00">Select</option>';
                    for ($day = 1; $day <= 31; $day++) {
                        $day = str_pad($day, 2, 0, STR_PAD_LEFT);
                        if ($dayEnd == $day) {
                            $dayES = 'selected';
                        } else {
                            $dayES = '';
                        }
                        echo '<option value="' . $day . '" ' . $dayES . '>' . $day . '</option>';
                    }
                    echo
                    '</select>

                            <select name="monthEnd" class="form-date month" id="animeMonthEnd">
                                <option value="00">Select</option>';
                    for ($month = 1; $month <= 12; $month++) {
                        $month = str_pad($month, 2, 0, STR_PAD_LEFT);
                        if ($monthEnd == $month) {
                            $monthES = 'selected';
                        } else {
                            $monthES = '';
                        }
                        echo '<option value="' . $month . '" ' . $monthES . '>' . $month . '</option>';
                    }
                    echo
                    '</select>

                            <select name="yearEnd" class="form-date year" id="animeYearEnd">
                                <option value="0000">Select</option>';
                    for ($year = 2025; $year >= 1930; $year--) {
                        $year = str_pad($year, 2, 0, STR_PAD_LEFT);
                        if ($yearEnd == $year) {
                            $yearES = 'selected';
                        } else {
                            $yearES = '';
                        }
                        echo '<option value="' . $year . '" ' . $yearES . '>' . $year . '</option>';
                    }
                    echo
                    '</select>
                            <p class="error-messages date"></p>
                            <p class="error-messages date double"></p>
                            <p class="error-messages date double"></p>

                            <h4>Source</h4>   
                            <select name="source" class="form-select">
                                <option value="">Select</option>
                                <option value="Manga" ' . $sourceManga . '>Manga</option>
                                <option value="Novel" ' . $sourceNovel . '>Novel</option>
                                <option value="Original" ' . $sourceOriginal . '>Original</option>
                            </select>';


                    echo '
                            <h4>Genres</h4>
                            <select multiple size="9" name="genres[]" class="form-select multiple">';
                    foreach ($animeGenresOptions as $animeGenreOption) {
                        echo '<option value="' . $animeGenreOption . '"';
                        foreach ($animeGenres as $animeGenre) {
                            if ($animeGenre == $animeGenreOption) {
                                $selected = 'selected';
                            } else {
                                $selected = '';
                            }
                            echo $selected;
                        }
                        echo '>' . $animeGenreOption . '</option>';
                    }
                    echo '</select>
                            
                            <h4>Characters</h4>
                            <div class="characters-grid">';
                    // If there are not 6 characters in the anime database
                    for ($i = 0; $i <= 5; $i++) {
                        if (empty($characterID[$i])) {
                            $nameValue = $i + 1;
                            $characterID[$i] = '';
                            $characterName[$i] = 'Character name #' . $nameValue;
                            $characterAvatar[$i] = '';
                            $characterRole[$i] = '';
                        }
                    }

                    for ($i = 0; $i < count($characterID) && $i < count($characterName) && $i < count($characterAvatar) && $i < count($characterRole); $i++) {
                        // Mark as selected if main or secondary
                        $characterRoleMain[$i] = $characterRole[$i] == "Main" ? "selected" : "";
                        $characterRoleSecondary[$i] = $characterRole[$i] == "Secondary" ? "selected" : "";

                        echo '
                                    <div class="character-result">
                                        <div class="avatar-characters" style="background-image:url(../../user/media/characters/avatar/' . $characterAvatar[$i] . ')"></div>
                                        <div class="content-character">
                                            <div class="name">' . $characterName[$i] . '</div>  
                                            <input type="text" placeholder="Character ID" value="' . $characterID[$i] . '" name="characterID[]" class="form-input-character">
                                            <select name="characterRole[]" class="form-input-character">
                                                <option value="">Select</option>
                                                <option value="Main" ' . $characterRoleMain[$i] . '>Main</option>
                                                <option value="Secondary" ' . $characterRoleSecondary[$i] . '>Secondary</option>
                                            </select>
                                        </div>
                                    </div>';
                    }
                    echo '</div>

                            <button type="submit" name="anime-edit" class="btn-submit" onclick="redirectAfterSave(event)">Save</button>
                            <button type="button" class="btn-submit btn-cancel" onclick="window.location.href=\'../php/admin.php?view=anime&page=1\'">Cancel</button>
                            <button type="submit" name="anime-delete" class="btn-submit btn-delete" onclick="return confirm(\'Are you sure you want to delete this anime?\')">Delete</button>
                        </form>';
                }

                // Manga
                if ($_GET['config'] == 'edit' && isset($_GET['mangaid'])) {
                    // Ensure all required variables are defined
                    $mangaStart = $mangaStart ?? '';
                    $mangaEnd = $mangaEnd ?? '';
                    $mangaType = $mangaType ?? '';
                    $mangaStatus = $mangaStatus ?? '';
                    $mangaGenres = $mangaGenres ?? '';
                    $mangaID = $mangaID ?? '';
                    $mangaTitle = $mangaTitle ?? '';
                    $mangaSinopse = $mangaSinopse ?? '';
                    $mangaAvatar = $mangaAvatar ?? '';
                    $mangaBanner = $mangaBanner ?? '';
                    $mangaChapters = $mangaChapters ?? '';
                    $mangaVolumes = $mangaVolumes ?? '';
                    $characterID = $characterID ?? [];
                    $characterName = $characterName ?? [];
                    $characterAvatar = $characterAvatar ?? [];
                    $characterRole = $characterRole ?? [];
                    $characterID = is_array($characterID) ? $characterID : [];
                    $characterName = is_array($characterName) ? $characterName : [];
                    $characterAvatar = is_array($characterAvatar) ? $characterAvatar : [];
                    $characterRole = is_array($characterRole) ? $characterRole : [];

                    // Check the year the manga started
                    $yearStart = substr($mangaStart, -10, 4);
                    $monthStart = substr($mangaStart, -5, 2);
                    $dayStart = substr($mangaStart, -2, 2);

                    // Check the year the manga ended
                    $yearEnd = substr($mangaEnd, -10, 4);
                    $monthEnd = substr($mangaEnd, -5, 2);
                    $dayEnd = substr($mangaEnd, -2, 2);

                    // Check which type is selected
                    $typeManga = $mangaType == "Manga" ? "selected" : "";
                    $typeNovel = $mangaType == "Novel" ? "selected" : "";

                    // Check which status is selected
                    $statusFinished = $mangaStatus == "Finished" ? "selected" : "";
                    $statusPublished = $mangaStatus == "Publishing" ? "selected" : "";
                    $statusNotPublished = $mangaStatus == "Not yet published" ? "selected" : "";

                    // Options to select genres and already selected genres
                    $mangaGenresOptions = array("Action", "Adventure", "Cars", "Comedy", "Dementia", "Demons", "Doujinshi", "Drama", "Ecchi", "Fantasy", "Game", "Gender Bender", "Harem", "Hentai", "Historical", "Horror", "Josei", "Kids", "Magic", "Martial Arts", "Mecha", "Military", "Music", "Mystery", "Parody", "Police", "Psychological", "Romance", "Samurai", "School", "Sci-Fi", "Seinen", "Shoujo", "Shoujo Ai", "Shounen", "Shounen Ai", "Slice of Life", "Space", "Sports", "Super Power", "Supernatural", "Thriller", "Vampire", "Yaoi", "Yuri");
                    $mangaGenres = explode(", ", $mangaGenres);

                    echo '
                        <form action="../includes/admin-edit.inc.php?config=edit&mangaid=' . $mangaID . '" method="post" enctype="multipart/form-data" id="manga-edit">    
                            <h4>ID *</h4>    
                            <input type="text" value="' . $mangaID . '" name="ID" class="form-input" disabled>

                            <h4>Manga *</h4>
                            <input type="text" value="' . $mangaTitle . '" placeholder="Manga title" name="title" class="form-input" id="manga-title">
                            <p class="error-messages"></p>

                            <h4>Synopsis</h4>
                            <textarea name="sinopse" placeholder="Manga synopsis" class="form-input textarea">' . $mangaSinopse . '</textarea>

                            <h4>Avatar *</h4>   
                            <div class="form-image">
                                <p>Allowed formats: JPEG, PNG. Max size: 3mb.</p>
                                <div class="dropbox">
                                    <input type="file" name="avatar" class="file-input" id="avatar">
                                    <p>Drop your image here or click to upload</p>
                                </div>
                                <div class="avatar" id="avatar-show" style="background-image:url(../../user/media/manga/avatar/' . $mangaAvatar . ')"></div>
                            </div>
                            <p class="error-messages e-avatar"></p>

                            <h4>Banner</h4>
                            <div class="form-image">
                                <p>Allowed formats: JPEG, PNG. Max size: 6mb.</p>
                                <div class="dropbox">
                                    <input type="file" name="banner" class="file-input" id="banner">
                                    <p>Drop your image here or click to upload</p>
                                </div>
                                <div class="banner" id="banner-show" style="background-image:url(../../user/media/manga/banner/' . $mangaBanner . ')"></div>
                                <div class="form-checkbox">
                                    <input type="checkbox" name="bannerCheck" id="bannerCheck"> <label for="bannerCheck">Delete manga banner</label>
                                </div>
                            </div>
                            <p class="error-messages e-banner"></p>

                            <h4>Type *</h4>   
                            <select name="type" class="form-select">
                                <option value="Manga" ' . $typeManga . '>Manga</option>
                                <option value="Novel" ' . $typeNovel . '>Novel</option>
                            </select>

                            <h4>Chapters</h4>   
                            <input type="text" value="' . $mangaChapters . '" placeholder="Number of chapters" name="chapters" class="form-input" id="manga-chapters">
                            <p class="error-messages"></p>

                            <h4>Volumes</h4>   
                            <input type="text" value="' . $mangaVolumes . '" placeholder="Number of volumes" name="volumes" class="form-input" id="manga-volumes">
                            <p class="error-messages"></p>

                            <h4>Status *</h4>   
                            <select name="status" class="form-select">
                                <option value="Finished" ' . $statusFinished . '>Finished</option>
                                <option value="Publishing" ' . $statusPublished . '>Publishing</option>
                                <option value="Not yet published" ' . $statusNotPublished . '>Not yet published</option>
                            </select>

                            <h4>Publication (dd/mm/yyyy)</h4>   
                            <select name="dayStart" class="form-date day" id="mangaDayStart">
                                <option value="00">Select</option>';
                    for ($day = 1; $day <= 31; $day++) {
                        $day = str_pad($day, 2, 0, STR_PAD_LEFT);
                        if ($dayStart == $day) {
                            $daySS = 'selected';
                        } else {
                            $daySS = '';
                        }
                        echo '<option value="' . $day . '" ' . $daySS . '>' . $day . '</option>';
                    }
                    echo
                    '</select>

                            <select name="monthStart" class="form-date month" id="mangaMonthStart">
                                <option value="00">Select</option>';
                    for ($month = 1; $month <= 12; $month++) {
                        $month = str_pad($month, 2, 0, STR_PAD_LEFT);
                        if ($monthStart == $month) {
                            $monthSS = 'selected';
                        } else {
                            $monthSS = '';
                        }
                        echo '<option value="' . $month . '" ' . $monthSS . '>' . $month . '</option>';
                    }
                    echo
                    '</select>

                            <select name="yearStart" class="form-date year" id="mangaYearStart">
                                <option value="0000">Select</option>';
                    for ($year = 2025; $year >= 1930; $year--) {
                        $year = str_pad($year, 2, 0, STR_PAD_LEFT);
                        if ($yearStart == $year) {
                            $yearSS = 'selected';
                        } else {
                            $yearSS = '';
                        }
                        echo '<option value="' . $year . '" ' . $yearSS . '>' . $year . '</option>';
                    }
                    echo
                    '</select>

                            <select name="dayEnd" class="form-date day" id="mangaDayEnd">
                                <option value="00">Select</option>';
                    for ($day = 1; $day <= 31; $day++) {
                        $day = str_pad($day, 2, 0, STR_PAD_LEFT);
                        if ($dayEnd == $day) {
                            $dayES = 'selected';
                        } else {
                            $dayES = '';
                        }
                        echo '<option value="' . $day . '" ' . $dayES . '>' . $day . '</option>';
                    }
                    echo
                    '</select>

                            <select name="monthEnd" class="form-date month" id="mangaMonthEnd">
                                <option value="00">Select</option>';
                    for ($month = 1; $month <= 12; $month++) {
                        $month = str_pad($month, 2, 0, STR_PAD_LEFT);
                        if ($monthEnd == $month) {
                            $monthES = 'selected';
                        } else {
                            $monthES = '';
                        }
                        echo '<option value="' . $month . '" ' . $monthES . '>' . $month . '</option>';
                    }
                    echo
                    '</select>

                            <select name="yearEnd" class="form-date year" id="mangaYearEnd">
                                <option value="0000">Select</option>';
                    for ($year = 2025; $year >= 1930; $year--) {
                        $year = str_pad($year, 2, 0, STR_PAD_LEFT);
                        if ($yearEnd == $year) {
                            $yearES = 'selected';
                        } else {
                            $yearES = '';
                        }
                        echo '<option value="' . $year . '" ' . $yearES . '>' . $year . '</option>';
                    }
                    echo
                    '</select>
                            <p class="error-messages date"></p>
                            <p class="error-messages date double"></p>
                            <p class="error-messages date double"></p>';

                    echo '
                            <h4>Genres</h4>
                            <select multiple size="9" name="genres[]" class="form-select multiple">';
                    foreach ($mangaGenresOptions as $mangaGenreOption) {
                        echo '<option value="' . $mangaGenreOption . '"';
                        foreach ($mangaGenres as $mangaGenre) {
                            if ($mangaGenre == $mangaGenreOption) {
                                $selected = 'selected';
                            } else {
                                $selected = '';
                            }
                            echo $selected;
                        }
                        echo '>' . $mangaGenreOption . '</option>';
                    }
                    echo '</select>
                            
                            <h4>Characters</h4>
                            <div class="characters-grid">';
                    // If there are not 6 characters in the manga database
                    for ($i = 0; $i <= 5; $i++) {
                        if (empty($characterID[$i])) {
                            $nameValue = $i + 1;
                            $characterID[$i] = '';
                            $characterName[$i] = 'Character name #' . $nameValue;
                            $characterAvatar[$i] = '';
                            $characterRole[$i] = '';
                        }
                    }

                    for ($i = 0; $i < count($characterID) && $i < count($characterName) && $i < count($characterAvatar) && $i < count($characterRole); $i++) {
                        // Mark as selected if main or secondary
                        $characterRoleMain[$i] = $characterRole[$i] == "Main" ? "selected" : "";
                        $characterRoleSecondary[$i] = $characterRole[$i] == "Secondary" ? "selected" : "";

                        echo '
                                    <div class="character-result">
                                        <div class="avatar-characters" style="background-image:url(../../user/media/characters/avatar/' . $characterAvatar[$i] . ')"></div>
                                        <div class="content-character">
                                            <div class="name">' . $characterName[$i] . '</div>  
                                            <input type="text" placeholder="Character ID" value="' . $characterID[$i] . '" name="characterID[]" class="form-input-character">
                                            <select name="characterRole[]" class="form-input-character">
                                                <option value="">Select</option>
                                                <option value="Main" ' . $characterRoleMain[$i] . '>Main</option>
                                                <option value="Secondary" ' . $characterRoleSecondary[$i] . '>Secondary</option>
                                            </select>
                                        </div>
                                    </div>';
                    }
                    echo '</div>
                            
                            <button type="submit" name="manga-edit" class="btn-submit" onclick="redirectAfterSave(event)">Save</button>
                            <button type="button" class="btn-submit btn-cancel" onclick="window.location.href=\'../php/admin.php?view=anime&page=1\'">Cancel</button>
                            <button type="submit" name="manga-delete" class="btn-submit btn-delete" onclick="return confirm(\'Are you sure you want to delete this manga?\')">Delete</button>
                        </form>';
                }

                // Characters
                if ($_GET['config'] == 'edit' && isset($_GET['characterid'])) {
                    $characterID = $characterID ?? '';
                    $characterAvatar = $characterAvatar ?? '';
                    $characterInfo = $characterInfo ?? '';
                    echo '
                        <form action="../includes/admin-edit.inc.php?config=edit&characterid=' . $characterID . '" method="post" enctype="multipart/form-data" id="character-edit">   
                            <h4>ID *</h4>              
                            <input type="text" value="' . $characterID . '" name="ID" class="form-input" disabled>

                            <h4>Character *</h4>
                            <input type="text" value="' . $characterName . '" placeholder="Character name" name="name" class="form-input" id="character-name">
                            <p class="error-messages"></p>

                            <h4>Avatar *</h4>   
                            <div class="form-image">
                                <p>Allowed formats: JPEG, PNG. Max size: 3mb.</p>
                                <div class="dropbox">
                                    <input type="file" name="avatar" class="file-input" id="avatar">
                                    <p>Drop your image here or click to upload</p>
                                </div>
                                <div class="avatar" id="avatar-show" style="background-image:url(../../user/media/characters/avatar/' . $characterAvatar . ')"></div>
                            </div>
                            <p class="error-messages e-avatar"></p>
                            
                            <h4>Information</h4>
                            <textarea name="info" placeholder="Character information" class="form-input textarea">' . $characterInfo . '</textarea>
                    
                            <button type="submit" name="character-edit" class="btn-submit" onclick="redirectAfterSave(event)">Save</button>
                            <button type="button" class="btn-submit btn-cancel" onclick="window.location.href=\'../php/admin.php?view=anime&page=1\'">Cancel</button>
                            <button type="submit" name="character-delete" class="btn-submit btn-delete" onclick="return confirm(\'Are you sure you want to delete this character?\')">Delete</button>
                        </form>';
                }

                // Users
                if ($_GET['config'] == 'edit' && isset($_GET['userid'])) {
                    $userBirthday = $userBirthday ?? '';
                    $userDateSignUP = $userDateSignUP ?? '';
                    $userPermissions = $userPermissions ?? '';
                    $userGender = $userGender ?? '';
                    $userLastOnline = $userLastOnline ?? '';
                    $userID = $userID ?? '';
                    $userName = $userName ?? '';
                    $userEmail = $userEmail ?? '';
                    $userPassword = $userPassword ?? '';
                    $userAvatar = $userAvatar ?? '';
                    $userBanner = $userBanner ?? '';
                    $userBannerList = $userBannerList ?? '';
                    $userAbout = $userAbout ?? '';
                    $userLocalization = $userLocalization ?? '';
                    $userBanStatus = $userBanStatus ?? '';

                    $yearBirthday = substr($userBirthday, -10, 4);
                    $monthBirthday = substr($userBirthday, -5, 2);
                    $dayBirthday = substr($userBirthday, -2, 2);

                    $yearSignUP = substr($userDateSignUP, -10, 4);
                    $monthSignUP = substr($userDateSignUP, -5, 2);
                    $daySignUP = substr($userDateSignUP, -2, 2);

                    $permissionMember = $userPermissions == "0" ? "selected" : "";
                    $permissionAdmin = $userPermissions == "1" ? "selected" : "";

                    $genderNotSpecified = $userGender == "0" ? "selected" : "";
                    $genderMale = $userGender == "1" ? "selected" : "";
                    $genderFemale = $userGender == "2" ? "selected" : "";

                    $userDateSignUP = date('d-m-Y', strtotime($userDateSignUP));
                    $userLastOnline = date('d-m-Y H:i:s', strtotime($userLastOnline));

                    echo '
                        <form action="../includes/admin-edit.inc.php?config=edit&userid=' . $userID . '" method="post" enctype="multipart/form-data" id="user-edit">             
                            <h4>ID *</h4>    
                            <input type="text" value="' . $userID . '" name="ID" class="form-input" disabled>

                            <h4>User *</h4>
                            <input type="text" value="' . $userName . '" placeholder="User name" name="name" class="form-input" id="userName">
                            <p class="error-messages"></p>
                            
                            <h4>Email *</h4>
                            <input type="text" value="' . $userEmail . '" placeholder="User email" name="email" class="form-input" id="userEmail">
                            <p class="error-messages"></p>

                            <h4>Password *</h4>
                            <input type="text" value="' . $userPassword . '" class="form-input" disabled>

                            <input type="text" placeholder="Change user password" name="password" class="form-input" id="userPassword">
                            <p class="error-messages"></p>
                            
                            <h4>Permissions *</h4>   
                            <select name="permissions" class="form-select">
                                <option value="0" ' . $permissionMember . '>Member</option>
                                <option value="1" ' . $permissionAdmin . '>Administrator</option>
                            </select>
                            
                            <h4>Avatar</h4>   
                            <div class="form-image margin-bottom">
                                <p>Allowed formats: JPEG, PNG, GIF. Max size: 3mb.</p>
                                <div class="dropbox">
                                    <input type="file" name="avatar" class="file-input" id="avatar">
                                    <p>Drop your image here or click to upload</p>
                                </div>
                                <div class="avatar" id="avatar-show" style="background-image:url(../../user/media/users/avatar/' . $userAvatar . ')"></div>
                                <div class="form-checkbox">
                                    <input type="checkbox" name="avatarCheck" id="avatarCheck"> <label for="avatarCheck">Delete user avatar</label>
                                </div>
                            </div>
                            <p class="error-messages e-avatar"></p>
                            
                            <h4>Profile banner</h4>
                            <div class="form-image margin-bottom">
                                <p>Allowed formats: JPEG, PNG, GIF. Max size: 6mb.</p>
                                <div class="dropbox">
                                    <input type="file" name="banner" class="file-input" id="banner">
                                    <p>Drop your image here or click to upload</p>
                                </div>
                                <div class="banner" id="banner-show" style="background-image:url(../../user/media/users/banner/' . $userBanner . ')"></div>
                                <div class="form-checkbox">
                                    <input type="checkbox" name="bannerCheck" id="bannerCheck"> <label for="bannerCheck">Delete user banner</label>
                                </div>
                            </div>
                            <p class="error-messages e-banner"></p>
                            
                            <h4>List banner</h4>
                            <div class="form-image margin-bottom">
                                <p>Allowed formats: JPEG, PNG, GIF. Max size: 6mb.</p>
                                <div class="dropbox">
                                    <input type="file" name="banner-list" class="file-input" id="bannerList">
                                    <p>Drop your image here or click to upload</p>
                                </div>
                                <div class="banner" id="bannerList-show" style="background-image:url(../../user/media/users/bannerList/' . $userBannerList . ')"></div>
                                <div class="form-checkbox">
                                    <input type="checkbox" name="bannerListCheck" id="bannerListCheck"> <label for="bannerListCheck">Delete user list banner</label>
                                </div>
                            </div>
                            <p class="error-messages e-bannerList"></p>

                            <h4>About</h4>
                            <textarea name="about" placeholder="About the user" class="form-input textarea" id="userAbout">' . $userAbout . '</textarea>
                            <p class="error-messages"></p>

                            <h4>Gender</h4>   
                            <select name="gender" class="form-select">
                                <option value="0" ' . $genderNotSpecified . '>Not specified</option>
                                <option value="1" ' . $genderMale . '>Male</option>
                                <option value="2" ' . $genderFemale . '>Female</option>
                            </select>
                            
                            <h4>Birthday (dd/mm/yyyy)</h4>   
                            <select name="dayBirthday" class="form-date day" id="userDay">
                                <option value="00">Select</option>';
                    for ($day = 1; $day <= 31; $day++) {
                        $day = str_pad($day, 2, 0, STR_PAD_LEFT);
                        if ($dayBirthday == $day) {
                            $dayBS = 'selected';
                        } else {
                            $dayBS = '';
                        }
                        echo '<option value="' . $day . '" ' . $dayBS . '>' . $day . '</option>';
                    }
                    echo
                    '</select>

                            <select name="monthBirthday" class="form-date month" id="userMonth">
                                <option value="00">Select</option>';
                    for ($month = 1; $month <= 12; $month++) {
                        $month = str_pad($month, 2, 0, STR_PAD_LEFT);
                        if ($monthBirthday == $month) {
                            $monthBS = 'selected';
                        } else {
                            $monthBS = '';
                        }
                        echo '<option value="' . $month . '" ' . $monthBS . '>' . $month . '</option>';
                    }
                    echo
                    '</select>

                            <select name="yearBirthday" class="form-date year" id="userYear">
                                <option value="0000">Select</option>';
                    for ($year = 2025; $year >= 1930; $year--) {
                        $year = str_pad($year, 2, 0, STR_PAD_LEFT);
                        if ($yearBirthday == $year) {
                            $yearBS = 'selected';
                        } else {
                            $yearBS = '';
                        }
                        echo '<option value="' . $year . '" ' . $yearBS . '>' . $year . '</option>';
                    }
                    echo
                    '</select>
                            <p class="error-messages date"></p>
                            
                            <h4 class="margin">Location</h4>
                            <input type="text" value="' . $userLocalization . '" placeholder="User location" name="localization" class="form-input" id="userLocalization">
                            <p class="error-messages"></p>
            
                            <h4>Sign-up date (dd/mm/yyyy)</h4>   
                            <input type="text" value="' . $userDateSignUP . '" class="form-input" disabled>
                            
                            <h4>Last online</h4>
                            <input type="text" value="' . $userLastOnline . '" class="form-input" disabled>';

                    if (isset($_GET['userid']) && isset($_SESSION['userID']) && $_GET['userid'] != $_SESSION['userID']) {
                        if (isset($userBanStatus) && $userBanStatus == 1) {
                            echo '<button type="submit" name="user-desban" class="btn-submit ban">Unban</button>';
                        } else {
                            echo '<button type="submit" name="user-ban" class="btn-submit desban">Ban</button>';
                        }
                    }

                    echo '<button type="submit" name="user-edit" class="btn-submit">Save</button>
                            <button type="button" class="btn-submit btn-cancel" onclick="window.location.href=\'../php/admin.php?view=anime&page=1\'">Cancel</button>
                            <button type="submit" name="user-delete" class="btn-submit btn-delete" onclick="return confirm(\'Are you sure you want to delete this user?\')">Delete</button>
                        </form>';
                }
                ?>
            </div> <!-- Container edit -->
        </div> <!-- Container all -->
    </div> <!-- Page wrap -->

    <script type="text/javascript" src="../js/script-admin.js"></script>
    <script type="text/javascript" src="../js/script-admin-errors.js"></script>
</body>

</html>