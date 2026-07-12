document.getElementById('upgradeForm').addEventListener('submit', function(event) {
    const errorBox = document.getElementById('error-box');
    const errorList = document.getElementById('error-list');
    
    // Clear out old errors before re-evaluating
    errorList.innerHTML = '';
    errorBox.style.display = 'none';

    let validationErrors = [];

    // Capture explicit inputs
    const fullName = document.getElementById('fullName').value.trim();
    const email = document.getElementById('email').value.trim();
    const photo = document.getElementById('profilePhoto').files[0];
    const genderSelected = document.querySelector('input[name="gender"]:checked');
    const course = document.getElementById('course').value;
    const address = document.getElementById('address').value.trim();

    // 1. Better Validation: No numbers allowed in name field
    const numberRegex = /\d/;
    if (fullName === '') {
        validationErrors.push('Full Name field cannot be empty.');
    } else if (numberRegex.test(fullName)) {
        validationErrors.push('Full Name must only contain letters (numbers are prohibited).');
    }

    // 2. Email structural baseline validation
    if (!email.includes('@')) {
        validationErrors.push('Please provide a legitimate Email Address structure.');
    }

    // 3. Photo selection validation
    if (!photo) {
        validationErrors.push('Please upload a profile photo image file.');
    }

    // 4. Better Validation: Required gender selection
    if (!genderSelected) {
        validationErrors.push('Please explicitly select a Gender track option.');
    }

    // 5. Dropdown validation
    if (course === '') {
        validationErrors.push('Please choose an academic Course Module.');
    }

    // 6. Better Validation: Address field minimum length constraint (e.g., 10 characters)
    if (address === '') {
        validationErrors.push('Address field cannot be empty.');
    } else if (address.length < 10) {
        validationErrors.push('Please provide a comprehensive Address structure (Minimum 10 characters).');
    }

    // If anomalies were intercepted, block transmission and render the error box list
    if (validationErrors.length > 0) {
        event.preventDefault(); // Stop form destination routing
        
        validationErrors.forEach(function(errorMessage) {
            const listElement = document.createElement('li');
            listElement.textContent = errorMessage;
            errorList.appendChild(listElement);
        });

        errorBox.style.display = 'block'; // Reveal hidden alert box row
        window.scrollTo({ top: 0, behavior: 'smooth' }); // Scroll to top to ensure visibility
    }
});