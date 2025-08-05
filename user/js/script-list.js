document.addEventListener('DOMContentLoaded', () => {
    const dropdownTriggers = document.querySelectorAll('#dropdown, #dropdown2');
    const dropdown = document.getElementById('display');

    dropdownTriggers.forEach(trigger => {
        trigger.addEventListener('click', (e) => {
            e.stopPropagation();
            dropdown.classList.toggle('list-display-block');
        });
    });

    document.addEventListener('click', () => {
        dropdown.classList.remove('list-display-block');
    });
});