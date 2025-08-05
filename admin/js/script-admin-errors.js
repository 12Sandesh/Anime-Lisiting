document.addEventListener("DOMContentLoaded", function() {
    var config = window.location.href.substring(window.location.href.lastIndexOf('=') + 1);

    // Errors when adding or editing anime
    document.querySelectorAll("#anime-add, #anime-edit").forEach(function(form) {
        form.addEventListener("submit", function(event) {
            // Get values
            var anime_title = document.getElementById("anime-title").value;
            var avatar = document.getElementById("avatar").value;
            var avatarCheck = document.querySelector(".error-messages.e-avatar").textContent;
            var bannerCheck = document.querySelector(".error-messages.e-banner").textContent;
            var anime_episodes = document.getElementById("anime-episodes").value;

            var animeDayStart = document.getElementById("animeDayStart").value;
            var animeMonthStart = document.getElementById("animeMonthStart").value;
            var animeYearStart = document.getElementById("animeYearStart").value;
            var animeStart = animeYearStart + animeMonthStart + animeDayStart;

            var animeDayEnd = document.getElementById("animeDayEnd").value;
            var animeMonthEnd = document.getElementById("animeMonthEnd").value;
            var animeYearEnd = document.getElementById("animeYearEnd").value;
            var animeEnd = animeYearEnd + animeMonthEnd + animeDayEnd;

            // Check submission
            var submit = true;

            // Validate title
            if (anime_title === "") {
                document.querySelector(".error-messages:nth-of-type(1)").innerHTML = "* The title cannot be empty.";
                submit = false;
            } else {
                document.querySelector(".error-messages:nth-of-type(1)").innerHTML = "";
            }

            // Validate avatar
            if (avatar === "" && config === "add-anime") {
                document.querySelector(".error-messages:nth-of-type(2)").innerHTML = "* An avatar is required.";
                submit = false;
            } else if (avatarCheck === "* This type of image is not allowed!") {
                document.querySelector(".error-messages:nth-of-type(2)").innerHTML = "* This type of image is not allowed!";
                submit = false;
            } else if (avatarCheck === "* Your image is too large!") {
                document.querySelector(".error-messages:nth-of-type(2)").innerHTML = "* Your image is too large!";
                submit = false;
            }

            // Validate banner
            if (bannerCheck === "* This type of image is not allowed!") {
                document.querySelector(".error-messages:nth-of-type(3)").innerHTML = "* This type of image is not allowed!";
                submit = false;
            } else if (bannerCheck === "* Your image is too large!") {
                document.querySelector(".error-messages:nth-of-type(3)").innerHTML = "* Your image is too large!";
                submit = false;
            }

            // Validate number of episodes
            if (anime_episodes.length > 0) {
                if (isNaN(anime_episodes) || anime_episodes.length > 4) {
                    document.querySelector(".error-messages:nth-of-type(4)").innerHTML = "* The number of episodes is invalid.";
                    submit = false;
                } else {
                    document.querySelector(".error-messages:nth-of-type(4)").innerHTML = "";
                }
            } else {
                document.querySelector(".error-messages:nth-of-type(4)").innerHTML = "";
            }

            // Validate start date
            if (animeYearStart !== '0000' || animeMonthStart !== '00' || animeDayStart !== '00') {
                if (animeYearStart === '0000') {
                    document.querySelector(".error-messages:nth-of-type(5)").innerHTML = "* Enter a valid start date in dd/mm/yyyy, mm/yyyy, or 00-00-0000 format.";
                    submit = false;
                } else if (animeMonthStart === '00' && animeDayStart !== '00') {
                    document.querySelector(".error-messages:nth-of-type(5)").innerHTML = "* Enter a valid start date in dd/mm/yyyy, mm/yyyy, or 00-00-0000 format.";
                    submit = false;
                } else {
                    document.querySelector(".error-messages:nth-of-type(5)").innerHTML = "";
                }
            } else {
                document.querySelector(".error-messages:nth-of-type(5)").innerHTML = "";
            }

            // Validate end date
            if (animeYearEnd !== '0000' || animeMonthEnd !== '00' || animeDayEnd !== '00') {
                if (animeYearEnd === '0000') {
                    document.querySelector(".error-messages:nth-of-type(6)").innerHTML = "* Enter a valid end date in dd/mm/yyyy, mm/yyyy, or 00-00-0000 format.";
                    submit = false;
                } else if (animeMonthEnd === '00' && animeDayEnd !== '00') {
                    document.querySelector(".error-messages:nth-of-type(6)").innerHTML = "* Enter a valid end date in dd/mm/yyyy, mm/yyyy, or 00-00-0000 format.";
                    submit = false;
                } else {
                    document.querySelector(".error-messages:nth-of-type(6)").innerHTML = "";
                }
            } else {
                document.querySelector(".error-messages:nth-of-type(6)").innerHTML = "";
            }

            // Compare dates and validate if acceptable
            if (animeEnd > 0) {
                if (animeStart > animeEnd) {
                    document.querySelector(".error-messages:nth-of-type(7)").innerHTML = "* The start date cannot be greater than the end date.";
                    submit = false;
                } else {
                    document.querySelector(".error-messages:nth-of-type(7)").innerHTML = "";
                }
            } else {
                document.querySelector(".error-messages:nth-of-type(7)").innerHTML = "";
            }

            if (!submit) {
                event.preventDefault();
            }
        });
    });

    // Errors when adding or editing manga (same pattern as anime)
    document.querySelectorAll("#manga-add, #manga-edit").forEach(function(form) {
        form.addEventListener("submit", function(event) {
            var manga_title = document.getElementById("manga-title").value;
            var avatar = document.getElementById("avatar").value;
            var avatarCheck = document.querySelector(".error-messages.e-avatar").textContent;
            var bannerCheck = document.querySelector(".error-messages.e-banner").textContent;
            var manga_chapters = document.getElementById("manga-chapters").value;
            var manga_volumes = document.getElementById("manga-volumes").value;

            var mangaDayStart = document.getElementById("mangaDayStart").value;
            var mangaMonthStart = document.getElementById("mangaMonthStart").value;
            var mangaYearStart = document.getElementById("mangaYearStart").value;
            var mangaStart = mangaYearStart + mangaMonthStart + mangaDayStart;

            var mangaDayEnd = document.getElementById("mangaDayEnd").value;
            var mangaMonthEnd = document.getElementById("mangaMonthEnd").value;
            var mangaYearEnd = document.getElementById("mangaYearEnd").value;
            var mangaEnd = mangaYearEnd + mangaMonthEnd + mangaDayEnd;

            var submit = true;

            // Validate title
            if (manga_title === "") {
                document.querySelector(".error-messages:nth-of-type(1)").innerHTML = "* The title cannot be empty.";
                submit = false;
            } else {
                document.querySelector(".error-messages:nth-of-type(1)").innerHTML = "";
            }

            // Validate avatar
            if (avatar === "" && config === "add-manga") {
                document.querySelector(".error-messages:nth-of-type(2)").innerHTML = "* An avatar is required.";
                submit = false;
            } else if (avatarCheck === "* This type of image is not allowed!") {
                document.querySelector(".error-messages:nth-of-type(2)").innerHTML = "* This type of image is not allowed!";
                submit = false;
            } else if (avatarCheck === "* Your image is too large!") {
                document.querySelector(".error-messages:nth-of-type(2)").innerHTML = "* Your image is too large!";
                submit = false;
            }

            // Validate banner
            if (bannerCheck === "* This type of image is not allowed!") {
                document.querySelector(".error-messages:nth-of-type(3)").innerHTML = "* This type of image is not allowed!";
                submit = false;
            } else if (bannerCheck === "* Your image is too large!") {
                document.querySelector(".error-messages:nth-of-type(3)").innerHTML = "* Your image is too large!";
                submit = false;
            }

            // Validate number of chapters
            if (manga_chapters.length > 0) {
                if (isNaN(manga_chapters) || manga_chapters.length > 4) {
                    document.querySelector(".error-messages:nth-of-type(4)").innerHTML = "* The number of chapters is invalid.";
                    submit = false;
                } else {
                    document.querySelector(".error-messages:nth-of-type(4)").innerHTML = "";
                }
            } else {
                document.querySelector(".error-messages:nth-of-type(4)").innerHTML = "";
            }

            // Validate number of volumes
            if (manga_volumes.length > 0) {
                if (isNaN(manga_volumes) || manga_volumes.length > 4) {
                    document.querySelector(".error-messages:nth-of-type(5)").innerHTML = "* The number of volumes is invalid.";
                    submit = false;
                } else {
                    document.querySelector(".error-messages:nth-of-type(5)").innerHTML = "";
                }
            } else {
                document.querySelector(".error-messages:nth-of-type(5)").innerHTML = "";
            }

            // Validate start date
            if (mangaYearStart !== '0000' || mangaMonthStart !== '00' || mangaDayStart !== '00') {
                if (mangaYearStart === '0000') {
                    document.querySelector(".error-messages:nth-of-type(6)").innerHTML = "* Enter a valid start date in dd/mm/yyyy, mm/yyyy, or 00-00-0000 format.";
                    submit = false;
                } else if (mangaMonthStart === '00' && mangaDayStart !== '00') {
                    document.querySelector(".error-messages:nth-of-type(6)").innerHTML = "* Enter a valid start date in dd/mm/yyyy, mm/yyyy, or 00-00-0000 format.";
                    submit = false;
                } else {
                    document.querySelector(".error-messages:nth-of-type(6)").innerHTML = "";
                }
            } else {
                document.querySelector(".error-messages:nth-of-type(6)").innerHTML = "";
            }

            // Validate end date
            if (mangaYearEnd !== '0000' || mangaMonthEnd !== '00' || mangaDayEnd !== '00') {
                if (mangaYearEnd === '0000') {
                    document.querySelector(".error-messages:nth-of-type(7)").innerHTML = "* Enter a valid end date in dd/mm/yyyy, mm/yyyy, or 00-00-0000 format.";
                    submit = false;
                } else if (mangaMonthEnd === '00' && mangaDayEnd !== '00') {
                    document.querySelector(".error-messages:nth-of-type(7)").innerHTML = "* Enter a valid end date in dd/mm/yyyy, mm/yyyy, or 00-00-0000 format.";
                    submit = false;
                } else {
                    document.querySelector(".error-messages:nth-of-type(7)").innerHTML = "";
                }
            } else {
                document.querySelector(".error-messages:nth-of-type(7)").innerHTML = "";
            }

            // Compare dates and validate if acceptable
            if (mangaEnd > 0) {
                if (mangaStart > mangaEnd) {
                    document.querySelector(".error-messages:nth-of-type(8)").innerHTML = "* The start date cannot be greater than the end date.";
                    submit = false;
                } else {
                    document.querySelector(".error-messages:nth-of-type(8)").innerHTML = "";
                }
            } else {
                document.querySelector(".error-messages:nth-of-type(8)").innerHTML = "";
            }

            if (!submit) {
                event.preventDefault();
            }
        });
    });
});
