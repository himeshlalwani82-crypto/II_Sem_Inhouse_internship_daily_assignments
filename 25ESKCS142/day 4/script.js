// ====== 02. DARK MODE TOGGLE logic ======
const themeToggleBtn = document.getElementById('theme-toggle');

themeToggleBtn.addEventListener('click', () => {
    document.body.classList.toggle('dark');
    
    if (document.body.classList.contains('dark')) {
        themeToggleBtn.textContent = 'Light Mode ☀️';
    } else {
        themeToggleBtn.textContent = 'Dark Mode 🌙';
    }
});

// ====== 03. CLICK COUNTER LOGIC ======
let count = 0;
const counterValue = document.getElementById('counter-value');
const btnClick = document.getElementById('btn-click');
const btnReset = document.getElementById('btn-reset');

btnClick.addEventListener('click', () => {
    count++;
    counterValue.textContent = count;
});

btnReset.addEventListener('click', () => {
    count = 0;
    counterValue.textContent = count;
});

// ====== 04. FORM VALIDATION LOGIC ======
const sprintForm = document.getElementById('sprint-form');
const usernameInput = document.getElementById('username');
const emailInput = document.getElementById('email');

const nameError = document.getElementById('name-error');
const emailError = document.getElementById('email-error');

sprintForm.addEventListener('submit', (event) => {
    // Prevent the standard browser form reload behavior
    event.preventDefault();
    
    let isFormValid = true;

    // Reset error fields cleanly before verification
    nameError.textContent = '';
    emailError.textContent = '';

    // Validate name field (must not be empty)
    if (usernameInput.value.trim() === '') {
        nameError.textContent = 'Name field cannot be left blank.';
        isFormValid = false;
    }

    // Validate email field (must contain basic text validation with '@')
    if (!emailInput.value.includes('@')) {
        emailError.textContent = 'Please enter a valid email containing an "@" symbol.';
        isFormValid = false;
    }

    // Processing mock completion logic
    if (isFormValid) {
        alert(`Success! Validation passed for: ${usernameInput.value}`);
        sprintForm.reset();
    }
});