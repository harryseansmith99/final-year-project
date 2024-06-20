
/* 
inspired by https://www.youtube.com/watch?v=CYlNJpltjMM&t=447s,
source code here https://codepen.io/javascriptacademy-stash/pen/oNeNMNR
*/

console.log("validateAddUser.js loaded");

const form = document.getElementById("editUserForm");
const firstName = document.getElementById("editFirstName");
const lastName = document.getElementById("editLastName");
const email = document.getElementById("editEmail");


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



// taken straight from referenced source code
const isValidEmail = email => {
    const re = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(String(email));
};

// found here:
// https://www.geeksforgeeks.org/javascript-program-to-validate-password-using-regular-expressions/
const isValidPassword = password => {
    // password must have one uppercase letter, one lowercase, one special, and 8 or more chars
    const re = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@.#$!%*?&])[A-Za-z\d@.#$!%*?&]{8,15}$/; 
    return re.test(password);
};

// console.log("first test, says true");
// console.log(isValidPassword("Fourdivs45@!"));

const validateInputs = () => {
    const firstNameValue = firstName.value.trim();
    const lastNameValue = lastName.value.trim();
    const emailValue = email.value.trim();



    let isValid = true; // Flag to check if the form is valid

    // first name
    if (firstNameValue === "") {
        setError(firstName, "First Name Is Required");
        isValid = false;
    } else {
        setSuccess(firstName);
    }


    // last name
    if (lastNameValue === "") {
        setError(lastName, "Last Name Is Required");
        isValid = false;
    } else {
        setSuccess(lastName);
    }


    // email
    if (emailValue === "") {
        setError(email, "Email Is Required");
        isValid = false;
    }
    else if (!isValidEmail(emailValue)) {
        isValid = false;
        setError(email, "Please Provide A Valid Email Address");
    }
    else {
        setSuccess(email)
    }

    return isValid; // Return the validity status
};
