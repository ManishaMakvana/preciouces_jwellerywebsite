

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







document.getElementById('backbtn').addEventListener('click', function() {
    document.querySelector('.gallery').scrollBy({
        left: -300,  // Adjust this value based on how much you want to scroll
        behavior: 'smooth'
    });
});

document.getElementById('nextbtn').addEventListener('click', function() {
    document.querySelector('.gallery').scrollBy({
        left: 300,  // Adjust this value based on how much you want to scroll
        behavior: 'smooth'
    });
});






function addToCart(product) {
    const xhr = new XMLHttpRequest();
    xhr.open("POST", "add_to_cart.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

    xhr.onload = function () {
        if (xhr.status === 200) {
            const response = JSON.parse(xhr.responseText);
            if (response.status === "success") {
                alert("Product added to cart!");
                updateCartCount(); // Update cart count display
            } else {
                alert("Error adding product to cart: " + response.message);
            }
        }
    };

    xhr.send(
        `product_id=${encodeURIComponent(product.id)}&product_name=${encodeURIComponent(product.name)}&product_price=${encodeURIComponent(product.price)}`
    );
}

function updateCartCount() {
    const xhr = new XMLHttpRequest();
    xhr.open("GET", "cart_count.php", true);

    xhr.onload = function () {
        if (xhr.status === 200) {
            const response = JSON.parse(xhr.responseText);
            document.getElementById("cart-count").innerText = response.cartCount;
        }
    };

    xhr.send();
}

