<?php
session_start();
// Ensure the $config variable is defined
$config = $_GET['config'] ?? '';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>
        Add
        <?php
        if ($config == "add-anime") {
            echo "Anime";
        } else if ($config == "add-manga") {
            echo "Manga";
        } else if ($config == "add-character") {
            echo "Character";
        }
        ?>
        - AnimeKoji
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
            <div class="container-add">

                <img src="../img/logo11.png">
                <?php
                // Anime
                if ($_GET['config'] == 'add-anime') {
                    // Options to select genres
                    $animeGenresOptions = array("Action", "Adventure", "Cars", "Comedy", "Dementia", "Demons", "Drama", "Ecchi", "Fantasy", "Game", "Harem", "Hentai", "Historical", "Horror", "Josei", "Kids", "Magic", "Martial Arts", "Mecha", "Military", "Music", "Mystery", "Parody", "Police", "Psychological", "Romance", "Samurai", "School", "Sci-Fi", "Seinen", "Shoujo", "Shoujo Ai", "Shounen", "Shounen Ai", "Slice of Life", "Space", "Sports", "Super Power", "Supernatural", "Thriller", "Vampire", "Yaoi", "Yuri");

                    echo '
                        <form action="../includes/admin-add.inc.php?config=add-anime" method="post" enctype="multipart/form-data" id="anime-add">             
                            <h4>Anime *</h4>
                            <input type="text" placeholder="Anime title" name="title" class="form-input" id="anime-title">
                            <p class="error-messages"></p>

                            <h4>Synopsis</h4>
                            <textarea name="sinopse" placeholder="Anime synopsis" class="form-input textarea"></textarea>

                            <h4>Avatar *</h4>   
                            <div class="form-image">
                                <p>Allowed formats: JPEG, PNG. Max size: 3mb.</p>
                                <div class="dropbox">
                                    <input type="file" name="avatar" class="file-input" id="avatar">
                                    <p>Drop your image here or click to upload</p>
                                </div>
                                <div class="avatar" id="avatar-show"></div>
                            </div>
                            <p class="error-messages e-avatar"></p>

                            <h4>Banner</h4>
                            <div class="form-image">
                                <p>Allowed formats: JPEG, PNG. Max size: 6mb.</p>
                                <div class="dropbox">
                                    <input type="file" name="banner" class="file-input" id="banner">
                                    <p>Drop your image here or click to upload</p>
                                </div>
                                <div class="banner" id="banner-show"></div>
                            </div>
                            <p class="error-messages e-banner"></p>

                            <h4>Type *</h4>   
                            <select name="type" class="form-select">
                                <option value="TV">TV</option>
                                <option value="Movie">Movie</option>
                                <option value="OVA">OVA</option>
                                <option value="ONA">ONA</option>
                            </select>

                            <h4>Episodes</h4>   
                            <input type="text" placeholder="Number of episodes" name="episodes" class="form-input" id="anime-episodes">
                            <p class="error-messages"></p>

                            <h4>Status *</h4>   
                            <select name="status" class="form-select">
                                <option value="Finished">Finished</option>
                                <option value="Airing">Airing</option>
                                <option value="Not yet aired">Not yet aired</option>
                            </select>

                            <h4>Broadcast (dd/mm/yyyy)</h4>   
                            <select name="dayStart" class="form-date day" id="animeDayStart">
                                <option value="00">Select</option>';
                    for ($day = 1; $day <= 31; $day++) {
                        $day = str_pad($day, 2, 0, STR_PAD_LEFT);
                        echo '<option value="' . $day . '">' . $day . '</option>';
                    }
                    echo
                    '</select>

                            <select name="monthStart" class="form-date month" id="animeMonthStart">
                                <option value="00">Select</option>';
                    for ($month = 1; $month <= 12; $month++) {
                        $month = str_pad($month, 2, 0, STR_PAD_LEFT);
                        echo '<option value="' . $month . '">' . $month . '</option>';
                    }
                    echo
                    '</select>

                            <select name="yearStart" class="form-date year" id="animeYearStart">
                                <option value="0000">Select</option>';
                    for ($year = 2025; $year >= 1930; $year--) {
                        $year = str_pad($year, 2, 0, STR_PAD_LEFT);
                        echo '<option value="' . $year . '">' . $year . '</option>';
                    }
                    echo
                    '</select>

                            <select name="dayEnd" class="form-date day" id="animeDayEnd">
                                <option value="00">Select</option>';
                    for ($day = 1; $day <= 31; $day++) {
                        $day = str_pad($day, 2, 0, STR_PAD_LEFT);
                        echo '<option value="' . $day . '">' . $day . '</option>';
                    }
                    echo
                    '</select>

                            <select name="monthEnd" class="form-date month" id="animeMonthEnd">
                                <option value="00">Select</option>';
                    for ($month = 1; $month <= 12; $month++) {
                        $month = str_pad($month, 2, 0, STR_PAD_LEFT);
                        echo '<option value="' . $month . '">' . $month . '</option>';
                    }
                    echo
                    '</select>

                            <select name="yearEnd" class="form-date year" id="animeYearEnd">
                                <option value="0000">Select</option>';
                    for ($year = 2025; $year >= 1930; $year--) {
                        $year = str_pad($year, 2, 0, STR_PAD_LEFT);
                        echo '<option value="' . $year . '">' . $year . '</option>';
                    }
                    echo
                    '</select>
                            <p class="error-messages date"></p>
                            <p class="error-messages date double"></p>
                            <p class="error-messages date double"></p>

                            <h4>Source</h4>   
                            <select name="source" class="form-select">
                                <option value="">Select</option>
                                <option value="Manga">Manga</option>
                                <option value="Novel">Novel</option>
                                <option value="Original">Original</option>
                            </select>';

                    echo '
                            <h4>Genres</h4>
                            <select multiple size="9" name="genres[]" class="form-select multiple">';
                    foreach ($animeGenresOptions as $animeGenreOption) {
                        echo '<option value="' . $animeGenreOption . '">' . $animeGenreOption . '</option>';
                    }
                    echo '</select>
                            
                            <h4>Characters</h4>
                            <div class="characters-grid">';
                    for ($i = 0; $i <= 5; $i++) {
                        $nameValue = $i + 1;
                        $characterName[] = 'Character name #' . $nameValue;
                        echo '
                                    <div class="character-result">
                                        <div class="avatar-characters"></div>
                                        <div class="content-character">
                                            <div class="name">' . $characterName[$i] . '</div>  
                                            <input type="text" placeholder="Character ID" name="characterID[]" class="form-input-character">
                                            <select name="characterRole[]" class="form-input-character">
                                                <option value="">Select</option>
                                                <option value="Main">Main</option>
                                                <option value="Secondary">Secondary</option>
                                            </select>
                                        </div>
                                    </div>';
                    }
                    echo '</div>
                            
                            <button type="submit" name="anime-add" class="btn-submit">Add</button>
                            <button type="button" class="btn-submit btn-cancel" onclick="window.location.href=\'../php/admin.php?view=anime&page=1\'">Cancel</button>
                        </form>';
                }

                // Manga
                if ($_GET['config'] == 'add-manga') {
                    // Options to select genres
                    $mangaGenresOptions = array("Action", "Adventure", "Cars", "Comedy", "Dementia", "Demons", "Doujinshi", "Drama", "Ecchi", "Fantasy", "Game", "Gender Bender", "Harem", "Hentai", "Historical", "Horror", "Josei", "Kids", "Magic", "Martial Arts", "Mecha", "Military", "Music", "Mystery", "Parody", "Police", "Psychological", "Romance", "Samurai", "School", "Sci-Fi", "Seinen", "Shoujo", "Shoujo Ai", "Shounen", "Shounen Ai", "Slice of Life", "Space", "Sports", "Super Power", "Supernatural", "Thriller", "Vampire", "Yaoi", "Yuri");

                    echo '
                        <form action="../includes/admin-add.inc.php?config=add-manga" method="post" enctype="multipart/form-data" id="manga-add">             
                            <h4>Manga *</h4>
                            <input type="text" placeholder="Manga title" name="title" class="form-input" id="manga-title">
                            <p class="error-messages"></p>

                            <h4>Synopsis</h4>
                            <textarea name="sinopse" placeholder="Manga synopsis" class="form-input textarea"></textarea>

                            <h4>Avatar *</h4>   
                            <div class="form-image">
                                <p>Allowed formats: JPEG, PNG. Max size: 3mb.</p>
                                <div class="dropbox">
                                    <input type="file" name="avatar" class="file-input" id="avatar">
                                    <p>Drop your image here or click to upload</p>
                                </div>
                                <div class="avatar" id="avatar-show"></div>
                            </div>
                            <p class="error-messages e-avatar"></p>

                            <h4>Banner</h4>
                            <div class="form-image">
                                <p>Allowed formats: JPEG, PNG. Max size: 6mb.</p>
                                <div class="dropbox">
                                    <input type="file" name="banner" class="file-input" id="banner">
                                    <p>Drop your image here or click to upload</p>
                                </div>
                                <div class="banner" id="banner-show"></div>
                            </div>
                            <p class="error-messages e-banner"></p>

                            <h4>Type *</h4>   
                            <select name="type" class="form-select">
                                <option value="Manga">Manga</option>
                                <option value="Novel">Novel</option>
                            </select>

                            <h4>Chapters</h4>   
                            <input type="text" placeholder="Number of chapters" name="chapters" class="form-input" id="manga-chapters">
                            <p class="error-messages"></p>

                            <h4>Volumes</h4>   
                            <input type="text" placeholder="Number of volumes" name="volumes" class="form-input" id="manga-volumes"> 
                            <p class="error-messages"></p>

                            <h4>Status *</h4>   
                            <select name="status" class="form-select">
                                <option value="Finished">Finished</option>
                                <option value="Publishing">Publishing</option>
                                <option value="Not yet published">Not yet published</option>
                            </select>

                            <h4>Publication (dd/mm/yyyy)</h4>   
                            <select name="dayStart" class="form-date day" id="mangaDayStart">
                                <option value="00">Select</option>';
                    for ($day = 1; $day <= 31; $day++) {
                        $day = str_pad($day, 2, 0, STR_PAD_LEFT);
                        echo '<option value="' . $day . '">' . $day . '</option>';
                    }
                    echo
                    '</select>

                            <select name="monthStart" class="form-date month" id="mangaMonthStart">
                                <option value="00">Select</option>';
                    for ($month = 1; $month <= 12; $month++) {
                        $month = str_pad($month, 2, 0, STR_PAD_LEFT);
                        echo '<option value="' . $month . '">' . $month . '</option>';
                    }
                    echo
                    '</select>

                            <select name="yearStart" class="form-date year" id="mangaYearStart">
                                <option value="0000">Select</option>';
                    for ($year = 2025; $year >= 1930; $year--) {
                        $year = str_pad($year, 2, 0, STR_PAD_LEFT);
                        echo '<option value="' . $year . '">' . $year . '</option>';
                    }
                    echo
                    '</select>

                            <select name="dayEnd" class="form-date day" id="mangaDayEnd">
                                <option value="00">Select</option>';
                    for ($day = 1; $day <= 31; $day++) {
                        $day = str_pad($day, 2, 0, STR_PAD_LEFT);
                        echo '<option value="' . $day . '">' . $day . '</option>';
                    }
                    echo
                    '</select>

                            <select name="monthEnd" class="form-date month" id="mangaMonthEnd">
                                <option value="00">Select</option>';
                    for ($month = 1; $month <= 12; $month++) {
                        $month = str_pad($month, 2, 0, STR_PAD_LEFT);
                        echo '<option value="' . $month . '">' . $month . '</option>';
                    }
                    echo
                    '</select>

                            <select name="yearEnd" class="form-date year" id="mangaYearEnd">
                                <option value="0000">Select</option>';
                    for ($year = 2025; $year >= 1930; $year--) {
                        $year = str_pad($year, 2, 0, STR_PAD_LEFT);
                        echo '<option value="' . $year . '">' . $year . '</option>';
                    }
                    echo
                    '</select>
                            <p class="error-messages date"></p>
                            <p class="error-messages date double"></p>
                            <p class="error-messages date double"></p>

                            <h4>Genres</h4>
                            <select multiple size="9" name="genres[]" class="form-select multiple">';
                    foreach ($mangaGenresOptions as $mangaGenreOption) {
                        echo '<option value="' . $mangaGenreOption . '">' . $mangaGenreOption . '</option>';
                    }
                    echo '</select>
                            
                            <h4>Characters</h4>
                            <div class="characters-grid">';
                    for ($i = 0; $i <= 5; $i++) {
                        $nameValue = $i + 1;
                        $characterName[] = 'Character name #' . $nameValue;
                        echo '
                                    <div class="character-result">
                                        <div class="avatar-characters"></div>
                                        <div class="content-character">
                                            <div class="name">' . $characterName[$i] . '</div>  
                                            <input type="text" placeholder="Character ID" name="characterID[]" class="form-input-character">
                                            <select name="characterRole[]" class="form-input-character">
                                                <option value="">Select</option>
                                                <option value="Main">Main</option>
                                                <option value="Secondary">Secondary</option>
                                            </select>
                                        </div>
                                    </div>';
                    }
                    echo '</div>
                            
                            <button type="submit" name="manga-add" class="btn-submit">Add</button>
                            <button type="button" class="btn-submit btn-cancel" onclick="window.location.href=\'../php/admin.php?view=manga&page=1\'">Cancel</button>
                        </form>';
                }

                // Character
                if ($_GET['config'] == 'add-character') {
                    echo '
                        <form action="../includes/admin-add.inc.php?config=add-character" method="post" enctype="multipart/form-data" id="character-add">             
                            <h4>Character *</h4>
                            <input type="text" placeholder="Character name" name="name" class="form-input" id="character-name">
                            <p class="error-messages"></p>

                            <h4>Avatar *</h4>   
                            <div class="form-image">
                                <p>Allowed formats: JPEG, PNG. Max size: 3mb.</p>
                                <div class="dropbox">
                                    <input type="file" name="avatar" class="file-input" id="avatar">
                                    <p>Drop your image here or click to upload</p>
                                </div>
                                <div class="avatar" id="avatar-show"></div>
                            </div>
                            <p class="error-messages e-avatar"></p>
                            
                            <h4>Information</h4>
                            <textarea name="info" placeholder="Character information" class="form-input textarea"></textarea>
                            
                            <button type="submit" name="character-add" class="btn-submit">Add</button>
                            <button type="button" class="btn-submit btn-cancel" onclick="window.location.href=\'../php/admin.php?view=character&page=1\'">Cancel</button>
                        </form>';
                }
                ?>
            </div> <!-- Container -->
        </div> <!-- Container all -->
    </div> <!-- Page-wrap -->

    <script type="text/javascript" src="../js/script-admin.js"></script>
    <script type="text/javascript" src="../js/script-admin-errors.js"></script>
</body>

</html>