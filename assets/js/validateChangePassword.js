
/* 
inspired by https://www.youtube.com/watch?v=CYlNJpltjMM&t=447s,
source code here https://codepen.io/javascriptacademy-stash/pen/oNeNMNR
*/

console.log("validateChangePassword.js loaded");

const form = document.getElementById("changePasswordForm");
const password = document.getElementById("newPassword");
const confirmPassword = document.getElementById("confirmPassword");


form.addEventListener("submit", e => {
    e.preventDefault();

    if (validateInputs()) {
        form.submit(); // Submit the form if validation is successful
    }
});

const setError = (element, message) => {
    const inputControl = element.parentElement;
    const errorDisplay = inputControl.querySelector(".error");
    errorDisplay.innerText = message;
    inputControl.classList.add("error");
    inputControl.classList.remove("success");
}

const setSuccess = element => {
    const inputControl = element.parentElement;
    const errorDisplay = inputControl.querySelector(".error");
    errorDisplay.innerText = "";
    inputControl.classList.add("success");
    inputControl.classList.remove("error");
};


// found here:
// https://www.geeksforgeeks.org/javascript-program-to-validate-password-using-regular-expressions/
const isValidPassword = password => {
    // password must have one uppercase letter, one lowercase, one special, and 8 or more chars
    const re = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@.#$!%*?&])[A-Za-z\d@.#$!%*?&]{8,15}$/; 
    return re.test(password);
};


const validateInputs = () => {
    const passwordValue = password.value.trim();
    const confirmPasswordValue = confirmPassword.value.trim();


    let isValid = true; // Flag to check if the form is valid

    // password
    if (passwordValue === "") {
        setError(password, "Password Is Required")
        isValid = false;
    }
    else if (!isValidPassword(passwordValue)) {
        setError(password, "Password must have at least: 1 uppercase, 1 lowercase, 1 special character, and must be 8 or more chars in length");
        isValid = false;
    }
    else {
        setSuccess(password);
    }

    // confirm password
    if (confirmPasswordValue === "") {
        setError(confirmPassword, "Confirm Password Is Required");
        isValid = false;
    }
    else if (confirmPasswordValue !== passwordValue) {
        setError(confirmPassword, "Passwords Do Not Match");
        isValid = false;
    }
    else {
        setSuccess(confirmPassword);
    }


    return isValid; // Return the validity status
};
