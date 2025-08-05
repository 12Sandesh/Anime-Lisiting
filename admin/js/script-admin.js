document.addEventListener("DOMContentLoaded", function () {
  // Get URL to determine allowed file extensions
  var urlParams = new URLSearchParams(window.location.search);
  var userid = urlParams.get("userid");
  var fileExtAllow =
    userid > 0 ? ["jpg", "jpeg", "png", "gif"] : ["jpg", "jpeg", "png"]; // Allowed extensions

  // Preview avatar
  function readURLavatar(input) {
    if (input.files && input.files[0]) {
      var reader = new FileReader();
      reader.onload = function (e) {
        document.getElementById("avatar-show").style.backgroundImage =
          "url(" + e.target.result + ")";
      };
      reader.readAsDataURL(input.files[0]); // Convert to base64 string
    }
  }

  // Preview banner
  function readURLbanner(input) {
    if (input.files && input.files[0]) {
      var reader = new FileReader();
      reader.onload = function (e) {
        document.getElementById("banner-show").style.backgroundImage =
          "url(" + e.target.result + ")";
      };
      reader.readAsDataURL(input.files[0]); // Convert to base64 string
    }
  }

  // Preview list banner
  function readURLbannerList(input) {
    if (input.files && input.files[0]) {
      var reader = new FileReader();
      reader.onload = function (e) {
        document.getElementById("bannerList-show").style.backgroundImage =
          "url(" + e.target.result + ")";
      };
      reader.readAsDataURL(input.files[0]); // Convert to base64 string
    }
  }

  // Call functions when avatar/banner/list banner is changed
  document.getElementById("avatar").addEventListener("change", function () {
    var file = this.value;
    var fileExt = file.split(".").pop().toLowerCase(); // Get file extension
    var size = this.files[0].size; // Get file size

    if (fileExtAllow.includes(fileExt)) {
      // Check if extension is allowed
      if (size < 3000000) {
        // Check if file size is within limit (3MB)
        readURLavatar(this);
        document.querySelector(".e-avatar").innerHTML = ""; // Clear error message
      } else {
        document.querySelector(".e-avatar").innerHTML =
          "* Your image is too large."; // Display error for large file
      }
    } else {
      document.querySelector(".e-avatar").innerHTML =
        "* This type of image is not allowed!"; // Display error for invalid extension
    }
  });

  document.getElementById("banner").addEventListener("change", function () {
    var file = this.value;
    var fileExt = file.split(".").pop().toLowerCase(); // Get file extension
    var size = this.files[0].size; // Get file size

    if (fileExtAllow.includes(fileExt)) {
      // Check if extension is allowed
      if (size < 6000000) {
        // Check if file size is within limit (6MB)
        readURLbanner(this);
        document.querySelector(".e-banner").innerHTML = ""; // Clear error message
      } else {
        document.querySelector(".e-banner").innerHTML =
          "* Your image is too large."; // Display error for large file
      }
    } else {
      document.querySelector(".e-banner").innerHTML =
        "* This type of image is not allowed!"; // Display error for invalid extension
    }
  });

  document.getElementById("bannerList").addEventListener("change", function () {
    var file = this.value;
    var fileExt = file.split(".").pop().toLowerCase(); // Get file extension
    var size = this.files[0].size; // Get file size

    if (fileExtAllow.includes(fileExt)) {
      // Check if extension is allowed
      if (size < 6000000) {
        // Check if file size is within limit (6MB)
        readURLbannerList(this);
        document.querySelector(".e-bannerList").innerHTML = ""; // Clear error message
      } else {
        document.querySelector(".e-bannerList").innerHTML =
          "* Your image is too large."; // Display error for large file
      }
    } else {
      document.querySelector(".e-bannerList").innerHTML =
        "* This type of image is not allowed!"; // Display error for invalid extension
    }
  });

  // Function to handle redirection after form submission
  function redirectAfterSave(event) {
    event.preventDefault();
    const form = event.target.form;
    const formData = new FormData(form);
    fetch(form.action, {
      method: form.method,
      body: formData,
    })
      .then((response) => {
        if (response.ok) {
          window.location.href = "../php/admin.php?view=anime&page=1";
        } else {
          console.error("Save failed");
        }
      })
      .catch((error) => {
        console.error("Error:", error);
      });
  }

  // Attach the redirectAfterSave function to the save buttons
  document
    .querySelectorAll(
      'button[name="anime-add"], button[name="manga-add"], button[name="character-add"], button[name="anime-edit"], button[name="manga-edit"], button[name="character-edit"], button[name="user-edit"]'
    )
    .forEach((button) => {
      button.addEventListener("click", redirectAfterSave);
    });

    function redirectAfterSave(event) {
        event.preventDefault();
        const form = event.target.form;
        const formData = new FormData(form);
        fetch(form.action, {
            method: form.method,
            body: formData
        }).then(response => {
            if (response.ok) {
                window.location.href = '../php/admin.php?view=anime&page=1';
            } else {
                console.error('Save failed');
            }
        }).catch(error => {
            console.error('Error:', error);
        });
    }
});
