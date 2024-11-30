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


function selectJewelry(name, price) {
    document.getElementById("selectedJewelry").value = name;
    document.getElementById("price").value = `$${price}`;
}

document.getElementById("bookingForm").addEventListener("submit", function(event) {
    event.preventDefault();
    const name = document.getElementById("name").value;
    const jewelry = document.getElementById("selectedJewelry").value;
    const message = `Thank you, ${name}! Your booking for ${jewelry} is confirmed.`;
    document.getElementById("confirmationMessage").textContent = message;
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

