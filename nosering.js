document.addEventListener('DOMContentLoaded', (event) => {
    const dropdownButton = document.querySelector('.dropdown-button');
    const dropdown = document.querySelector('.dropdown');

    dropdownButton.addEventListener('click', () => {
        dropdown.classList.toggle('show');
    });

    window.addEventListener('click', (e) => {
        if (!dropdown.contains(e.target)) {
            dropdown.classList.remove('show');
        }
    });
});




document.addEventListener('DOMContentLoaded', (event) => {
    const dropdownButton = document.querySelector('.dropdown-button1');
    const dropdown = document.querySelector('.dropdown1');

    dropdownButton.addEventListener('click', () => {
        dropdown.classList.toggle('show');
    });

    window.addEventListener('click', (e) => {
        if (!dropdown.contains(e.target)) {
            dropdown.classList.remove('show');
        }
    });
});


document.addEventListener('DOMContentLoaded', (event) => {
    const dropdownButton = document.querySelector('.dropdown-button2');
    const dropdown = document.querySelector('.dropdown2');

    dropdownButton.addEventListener('click', () => {
        dropdown.classList.toggle('show');
    });

    window.addEventListener('click', (e) => {
        if (!dropdown.contains(e.target)) {
            dropdown.classList.remove('show');
        }
    });
});

