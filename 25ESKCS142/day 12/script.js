document.getElementById('enquiryForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const alertBox = document.getElementById('alertBox');
    const name = document.getElementById('nameInput').value.trim();
    const email = document.getElementById('emailInput').value.trim();
    
    alertBox.className = "alert d-none"; // Re-evaluate dynamic states safely

    // Handle Client-Side Validation Elements
    if (name === "" || email === "") {
        alertBox.textContent = "Error: All details are required to process admission records.";
        alertBox.classList.remove('d-none');
        alertBox.classList.add('alert-danger');
        return;
    }

    if (!email.includes('@')) {
        alertBox.textContent = "Error: Please input a valid structure mapping email format configurations.";
        alertBox.classList.remove('d-none');
        alertBox.classList.add('alert-danger');
        return;
    }

    // Success response
    alertBox.textContent = `Thank you, ${name}! Your admission info packet has been successfully sent to: ${email}.`;
    alertBox.classList.remove('d-none');
    alertBox.classList.add('alert-success');
    this.reset();
});