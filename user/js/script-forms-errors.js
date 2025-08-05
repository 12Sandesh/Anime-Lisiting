document.addEventListener("DOMContentLoaded", () => {
  // Errors when registering an account
  const signupForm = document.getElementById("signup");
  if (signupForm) {
    // Check if the form exists on the page
    signupForm.addEventListener("submit", (event) => {
      // Get input values
      const username = document.getElementById("username").value;
      const email = document.getElementById("email").value;
      const password = document.getElementById("password").value;
      const passwordConfirm = document.getElementById("password_confirm").value;
      const termsAccept = document.getElementById("terms-accept").checked; // Get checked state

      // Accepted patterns
      const usernameAccept = /^[A-Za-z-0-9]+$/;
      const emailAccept =
        /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$/;
      const passwordAccept = /^[A-Za-z-0-9-*]+$/;

      // Check submission
      let submit = true;

      // Validate username
      const usernameError = document.querySelector(
        ".form-error:nth-of-type(1)"
      );
      if (
        username.length < 2 ||
        username.length > 16 ||
        !username.match(usernameAccept)
      ) {
        usernameError.textContent =
          "* The username must be between 2 and 16 characters. [A-Za-z] [0-9]";
        submit = false;
      } else {
        usernameError.textContent = "";
      }

      // Validate email
      const emailError = document.querySelector(".form-error:nth-of-type(2)");
      if (email === "" || !email.match(emailAccept)) {
        emailError.textContent = "* A valid email is required.";
        submit = false;
      } else {
        emailError.textContent = "";
      }

      // Validate password
      const passwordError = document.querySelector(
        ".form-error:nth-of-type(3)"
      );
      if (
        password.length < 5 ||
        password.length > 16 ||
        !password.match(passwordAccept)
      ) {
        passwordError.textContent =
          "* The password must be between 5 and 16 characters. [A-Za-z] [0-9] [*]";
        submit = false;
      } else {
        passwordError.textContent = "";
      }

      // Confirm password
      const passwordConfirmError = document.querySelector(
        ".form-error:nth-of-type(4)"
      );
      if (
        passwordConfirm.length < 5 ||
        passwordConfirm.length > 16 ||
        passwordConfirm !== password ||
        !passwordConfirm.match(passwordAccept)
      ) {
        passwordConfirmError.textContent = "* The passwords do not match.";
        submit = false;
      } else {
        passwordConfirmError.textContent = "";
      }

      // Confirm terms acceptance
      const termsError = document.querySelector(".form-error:nth-of-type(5)");

      if (!termsAccept) {
        termsError.textContent = "* You must agree to the terms of use.";
        submit = false;
      } else {
        termsError.textContent = "";
      }

      if (!submit) {
        event.preventDefault(); // Prevent form submission if validation fails
      }
    });
  }

  // Errors when logging into an account
  const loginForm = document.getElementById("login");
  if (loginForm) {
    loginForm.addEventListener("submit", (event) => {
      // Get input values
      const username = document.getElementById("username").value;
      const password = document.getElementById("password").value;

      // Check submission
      let submit = true;

      // Validate username
      const usernameError = document.querySelector(
        ".form-error:nth-of-type(1)"
      );
      if (username === "") {
        usernameError.textContent = "* The username cannot be blank.";
        submit = false;
      } else {
        usernameError.textContent = "";
      }

      // Validate password
      const passwordError = document.querySelector(
        ".form-error:nth-of-type(2)"
      );
      if (password === "") {
        passwordError.textContent = "* The password cannot be blank.";
        submit = false;
      } else {
        passwordError.textContent = "";
      }

      if (!submit) {
        event.preventDefault();
      }
    });
  }

  // Do not submit the form if the search query is empty in the search bar
  const searchForm = document.getElementById("search-form");
  if (searchForm) {
    searchForm.addEventListener("submit", (event) => {
      // Get search value
      const searchValue = document.getElementById("search-autocomplete").value;

      // Validate search query
      if (searchValue.length < 1) {
        event.preventDefault(); // Prevent form submission
      }
    });
  }

  // Errors when updating general profile settings
  const settingsForm = document.getElementById("settings");
  if (settingsForm) {
    settingsForm.addEventListener("submit", (event) => {
      // Get input values
      const about = document.getElementById("about").value;
      const localization = document.getElementById("localization").value;
      const day = document.getElementById("day").value;
      const month = document.getElementById("month").value;
      const year = document.getElementById("year").value;
      const birthday = day + month + year;

      // Check submission
      let submit = true;

      // Validate user bio
      const aboutError = document.querySelector(".error:nth-of-type(1)");
      if (about.length > 5000) {
        aboutError.textContent = "* No more than 5000 characters are allowed.";
        submit = false;
      } else {
        aboutError.textContent = "";
      }

      // Validate location
      const locationError = document.querySelector(".error:nth-of-type(2)");
      if (localization.length > 12) {
        locationError.textContent =
          "* The location cannot be longer than 12 characters.";
        submit = false;
      } else {
        locationError.textContent = "";
      }

      // Validate birthday
      const birthdayError = document.querySelector(".error:nth-of-type(3)");
      if (birthday.length > 1 && birthday.length < 8) {
        birthdayError.textContent = "* Enter a valid birthday.";
        submit = false;
      } else {
        birthdayError.textContent = "";
      }

      if (!submit) {
        event.preventDefault();
      }
    });
  }

  // Error when submitting a comment on the profile
  const commentsForm = document.getElementById("comments");
  if (commentsForm) {
    commentsForm.addEventListener("submit", (event) => {
      // Get input value
      const comment = document.getElementById("comment").value;

      // Check submission
      let submit = true;

      // Validate comment
      const commentError = document.querySelector(
        ".error-comment:nth-of-type(1)"
      );
      if (comment.length < 1) {
        commentError.textContent = "* Your comment cannot be blank.";
        submit = false;
      } else if (comment.length > 20000) {
        commentError.textContent =
          "* Your comment cannot exceed 20000 characters.";
        submit = false;
      }

      if (!submit) {
        event.preventDefault();
      }
    });
  }
});
