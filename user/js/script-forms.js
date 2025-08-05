document.addEventListener('DOMContentLoaded', () => {
    // Get anime/manga ID from the URL
    const urlParams = new URLSearchParams(window.location.search);
    const animeID = urlParams.get('animeid') || urlParams.get('mangaid'); // Handles both animeid and mangaid

    // Function to handle form submissions (reduces code duplication)
    function submitForm(formId, url, successCallback, errorElement) {
        const form = document.getElementById(formId);
        form.addEventListener('change', (event) => { // Use 'change' for select elements
            event.preventDefault();
            const formData = new FormData(form);

            fetch(url, {
                method: 'POST',
                body: formData
            })
            .then(response => {
                if (!response.ok) {
                  throw new Error(`HTTP error! status: ${response.status}`);
                }
                return response;
            })
            .then(data => {
              if (typeof successCallback === 'function') {
                successCallback(data);
              }
                form.style.backgroundColor = 'rgba(255, 154, 60, 1)';
            })
            .catch(error => {
                console.error("Error:", error);
                if (errorElement) {
                  errorElement.textContent = "An error occurred. Please try again.";
                } else {
                  alert("An error occurred. Please try again.");
                }
            });
        });
    }


    // Anime
    submitForm('animeStatus', `includes/anime-submit.inc.php?animeid=${animeID}`);
    submitForm('animeScore', `includes/anime-submit.inc.php?animeid=${animeID}`);

    const animeEpisodesForm = document.getElementById('animeEpisodes');
    animeEpisodesForm.addEventListener('submit', (event) => {
      event.preventDefault();
        const formData = new FormData(animeEpisodesForm);
        fetch(`includes/anime-submit.inc.php?animeid=${animeID}`, {
            method: 'POST',
            body: formData
        })
        .then(response => {
          if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
          }
          return response;
        })
        .then(() => {
            // Reload only the necessary part of the page.
            const animeEpisodesContainer = document.getElementById('animeEpisodes');
            fetch(window.location.href + " #animeEpisodes>*") // Fetch the updated HTML
                .then(response => response.text())
                .then(html => {
                    animeEpisodesContainer.innerHTML = html; // Update the container's content
                    const userEpisodesElements = document.querySelectorAll('.user-episodes, .user-episodes input');
                    userEpisodesElements.forEach(el => el.style.backgroundColor = 'rgba(255, 154, 60, 1)');
                })
        })
        .catch(error => {
            console.error("Error:", error);
            alert("Error updating the number of episodes. Please refresh the page and try again.");
        });
    });


    // Manga
    submitForm('mangaStatus', `includes/manga-submit.inc.php?mangaid=${animeID}`); // Use animeID as mangaID (adjust if needed)
    submitForm('mangaScore', `includes/manga-submit.inc.php?mangaid=${animeID}`); // Use animeID as mangaID (adjust if needed)

    const mangaChaptersForm = document.getElementById('mangaChapters');
    mangaChaptersForm.addEventListener('submit', (event) => {
        event.preventDefault();
        const formData = new FormData(mangaChaptersForm);

        fetch(`includes/manga-submit.inc.php?mangaid=${animeID}`, { // Use animeID as mangaID (adjust if needed)
            method: 'POST',
            body: formData
        })
        .then(response => {
          if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
          }
          return response;
        })
        .then(() => {
            const mangaChaptersContainer = document.getElementById('mangaChapters');
            fetch(window.location.href + " #mangaChapters>*")
                .then(response => response.text())
                .then(html => {
                    mangaChaptersContainer.innerHTML = html;
                    const userChaptersElements = document.querySelectorAll('.user-chapters, .user-chapters input');
                    userChaptersElements.forEach(el => el.style.backgroundColor = 'rgba(255, 154, 60, 1)');
                })
        })
        .catch(error => {
            console.error("Error:", error);
            alert("Error updating the number of chapters. Please refresh the page and try again.");
        });
    });

    const mangaVolumesForm = document.getElementById('mangaVolumes');
    mangaVolumesForm.addEventListener('submit', (event) => {
        event.preventDefault();
        const formData = new FormData(mangaVolumesForm);
        fetch(`includes/manga-submit.inc.php?mangaid=${animeID}`, { // Use animeID as mangaID (adjust if needed)
            method: 'POST',
            body: formData
        })
        .then(response => {
          if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
          }
          return response;
        })
        .then(() => {
            const mangaVolumesContainer = document.getElementById('mangaVolumes');
            fetch(window.location.href + " #mangaVolumes>*")
                .then(response => response.text())
                .then(html => {
                    mangaVolumesContainer.innerHTML = html;
                    const userVolumesElements = document.querySelectorAll('.user-volumes, .user-volumes input');
                    userVolumesElements.forEach(el => el.style.backgroundColor = 'rgba(255, 154, 60, 1)');
                })
        })
        .catch(error => {
            console.error("Error:", error);
            alert("Error updating the number of volumes. Please refresh the page and try again.");
        });
    });


    // Profile settings
    function handleProfileSetting(formId, errorClass) {
        const form = document.getElementById(formId);
        form.addEventListener('change', (e) => {
            e.preventDefault();
            const formData = new FormData(form);
            const errorElement = document.querySelector(`.error-image.${errorClass}`);

            fetch('includes/settings.inc.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.text())
            .then(data => {
                if (data === 'Error1') {
                    errorElement.textContent = "This type of image is not allowed!";
                } else if (data === 'Error2') {
                    errorElement.textContent = "An error occurred while uploading your image. Please try again!";
                } else if (data === 'Error3') {
                    errorElement.textContent = "Your image is too large.";
                } else {
                    if (formId === 'profile-avatar') {
                        const avatarLoad = document.getElementById('avatar-load');
                        const profileAvatar = document.getElementById('profile-avatar');

                        fetch(window.location.href + " #avatar-load>*")
                            .then(response => response.text())
                            .then(html => avatarLoad.innerHTML = html);

                        fetch(window.location.href + " #profile-avatar>*")
                            .then(response => response.text())
                            .then(html => profileAvatar.innerHTML = html);

                    } else if (formId === 'profile-banner') {
                        const profileBanner = document.getElementById('profile-banner');
                        fetch(window.location.href + " #profile-banner>*")
                            .then(response => response.text())
                            .then(html => profileBanner.innerHTML = html);

                    } else if (formId === 'list-banner') {
                        const listBanner = document.getElementById('list-banner');
                        fetch(window.location.href + " #list-banner>*")
                            .then(response => response.text())
                            .then(html => listBanner.innerHTML = html);
                    }
                    errorElement.textContent = "";
                }
            })
            .catch(error => {
              console.error("Error:", error);
              errorElement.textContent = "A network error occurred. Please try again.";
            });
        });
    }

    handleProfileSetting('profile-avatar', 'e-avatar');
    handleProfileSetting('profile-banner', 'e-banner');
    handleProfileSetting('list-banner', 'e-bannerList');
});