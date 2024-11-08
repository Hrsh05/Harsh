// cart.js
const cart = JSON.parse(localStorage.getItem('cart')) || [];

function addToCart(course) {
    cart.push(course);
    localStorage.setItem('cart', JSON.stringify(cart));
}

function displayCart() {
    // Show cart items and total price
}

// scripts/cart.js
document.addEventListener("DOMContentLoaded", function () {
    const cart = JSON.parse(localStorage.getItem('cart')) || [];
    const cartItemsContainer = document.getElementById('cart-items');
    let totalPrice = 0;

    cart.forEach(courseId => {
        // Assuming you have a function to fetch course details by ID
        fetch(`/api/courses/${courseId}`)
            .then(response => response.json())
            .then(course => {
                const courseElement = document.createElement('div');
                courseElement.innerHTML = `
                    <p>${course.name} - $${course.price}</p>
                `;
                cartItemsContainer.appendChild(courseElement);
                totalPrice += parseFloat(course.price);
                document.getElementById('total-price').innerText = totalPrice.toFixed(2);
            });
    });

    // Checkout functionality (redirect to dummy payment page)
    document.getElementById('checkout').addEventListener('click', function () {
        window.location.href = '/payment';
    });
});
