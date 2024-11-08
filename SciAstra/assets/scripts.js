// scripts/course.js

// Example of discounted courses data
const discountedCourses = [
    { name: 'Physics 101', description: 'Learn the basics of physics', price: '$50', discount: '10%' },
    { name: 'Chemistry for Beginners', description: 'Intro to chemistry concepts', price: '$40', discount: '15%' },
    { name: 'Advanced Biology', description: 'Deep dive into biology', price: '$60', discount: '20%' }
];

// Function to dynamically load the courses into the HTML
function loadDiscountedCourses() {
    const courseListContainer = document.getElementById('course-list');
    discountedCourses.forEach(course => {
        const courseItem = document.createElement('div');
        courseItem.classList.add('course-item');
        courseItem.innerHTML = `
            <h4>${course.name}</h4>
            <p>${course.description}</p>
            <p><strong>Price: ${course.price}</strong></p>
            <p><em>Discount: ${course.discount}</em></p>
        `;
        courseListContainer.appendChild(courseItem);
    });
}

// Call the function to load courses
loadDiscountedCourses();


document.addEventListener("DOMContentLoaded", function () {
    // Fetch course data from the backend (you'll need to create an API for this)
    fetch('/api/courses')
        .then(response => response.json())
        .then(courses => {
            const courseList = document.getElementById('course-list');
            courses.forEach(course => {
                const courseCard = document.createElement('div');
                courseCard.classList.add('col-md-4');
                courseCard.classList.add('mb-4');
                courseCard.innerHTML = `
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">${course.name}</h5>
                            <p class="card-text">${course.description}</p>
                            <p class="card-text">Price: $${course.price}</p>
                            <p class="card-text">Discount: ${course.discount}%</p>
                            <button class="btn btn-primary add-to-cart" data-id="${course.id}">Add to Cart</button>
                        </div>
                    </div>
                `;
                courseList.appendChild(courseCard);
            });

            // Add event listener for Add to Cart buttons
            document.querySelectorAll('.add-to-cart').forEach(button => {
                button.addEventListener('click', function () {
                    const courseId = this.getAttribute('data-id');
                    addToCart(courseId);
                });
            });
        });
});

// Function to add course to cart (using localStorage to simulate cart)
function addToCart(courseId) {
    let cart = JSON.parse(localStorage.getItem('cart')) || [];
    cart.push(courseId);
    localStorage.setItem('cart', JSON.stringify(cart));
    alert("Course added to cart!");
}

// scripts.js
document.getElementById('pay-now').addEventListener('click', function () {
    alert("Payment Successful! Thank you for your purchase.");
    // You can redirect to a success page or show a confirmation message.
    window.location.href = '/thank-you';
});

// login.js
document.getElementById('login-form').addEventListener('submit', function(event) {
    event.preventDefault(); // Prevent form from submitting the traditional way

    const email = document.getElementById('email').value;
    const password = document.getElementById('password').value;

    // Basic client-side validation
    if (email === "" || password === "") {
        alert("Please fill in all fields.");
        return;
    }

    // Send login details to the backend (e.g., via Fetch API or AJAX)
    fetch('/api/login', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ email, password })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            window.location.href = "dashboard.html"; // Redirect to the dashboard or home page
        } else {
            alert(data.message); // Show error message if login fails
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert("Login failed. Please try again.");
    });
});

// register.js
document.getElementById('register-form').addEventListener('submit', function(event) {
    event.preventDefault();

    const name = document.getElementById('name').value;
    const email = document.getElementById('email').value;
    const password = document.getElementById('password').value;

    // Basic validation
    if (name === "" || email === "" || password === "") {
        alert("Please fill in all fields.");
        return;
    }

    // Send registration data to backend
    fetch('/api/register', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ name, email, password })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            window.location.href = "login.html"; // Redirect to login page after successful registration
        } else {
            alert(data.message); // Display error message
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert("Registration failed. Please try again.");
    });
});


// payment.js
document.getElementById('payment-form').addEventListener('submit', function(event) {
    event.preventDefault();

    const paymentMethod = document.getElementById('payment-method').value;

    // Simulate payment process (could be an API call to the payment gateway)
    alert(`Payment using ${paymentMethod} is successful!`);
    window.location.href = "thank-you.html"; // Redirect to a thank you page
});

