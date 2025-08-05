document.addEventListener("DOMContentLoaded", () => {
    // Change text on the page
    const textChangingElement = document.getElementById("text-changing");
    let text = 1;
    let string;
  
    textChangingElement.textContent = "YOUR ANIME AND MANGA LIST"; // Initial text
  
    setInterval(() => {
      switch (text) {
        case 1:
          string = "CREATE YOUR PROFILE";
          break;
        case 2:
          string = "ADD YOUR FAVORITES";
          break;
        case 3:
          string = "DISCOVER NEW ANIME AND MANGA";
          break;
        case 4:
          string = "YOUR ANIME AND MANGA LIST";
          break;
      }
      textChangingElement.textContent = string;
      text = text !== 4 ? text + 1 : 1; // Cycle through text options
    }, 2000);
  
    // Profile dropdown toggle
    const profile = document.getElementById("profile");
    const profileLinks = document.getElementById("profile-links");

    // When clicking on the profile, toggle the visibility of the profile links
    profile.addEventListener("click", (e) => {
        e.stopPropagation();  // Prevent click event from propagating to document
        profileLinks.style.display = profileLinks.style.display === "block" ? "none" : "block";
        profile.classList.toggle("clicked");
    });

    // Close the profile dropdown if clicking outside of the profile
    window.addEventListener("click", (event) => {
        if (!profile.contains(event.target)) {
        profileLinks.style.display = "none";  // Hide the dropdown if clicked outside
        }
    });
  
    // Responsive menu toggle
    const linksActivator = document.getElementById("links-activator");
    const links = document.getElementById("links");
    const search = document.getElementById("search");
  
    // When clicking anywhere else, close the responsive menu and search
    document.addEventListener("click", (e) => {
      if (!links.contains(e.target) && !linksActivator.contains(e.target)) {
        links.classList.remove("view");
      }
      if (!search.contains(e.target) && e.target !== document.getElementById("searchResponsive")) {
        search.style.display = "none";
      }
    });
  
    // Toggle the responsive menu
    linksActivator.addEventListener("click", (e) => {
      e.stopPropagation();
      links.classList.toggle("view");
      search.style.display = "none"; // Hide search when opening menu
    });
  
    // Search toggle for responsive menu
    const searchResponsive = document.getElementById("searchResponsive");
    searchResponsive.addEventListener("click", (e) => {
      e.stopPropagation();
      search.style.display = search.style.display === "block" ? "none" : "block";
      links.classList.remove("view"); // Close the menu when search is opened
    });
  });
  