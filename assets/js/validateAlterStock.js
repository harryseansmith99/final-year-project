
/* 
inspired by https://www.youtube.com/watch?v=CYlNJpltjMM&t=447s
*/

console.log("validateAlterStock.js loaded");

const form = document.getElementById("alterStockForm");
const amount = document.getElementById("amount");


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

// taken from https://www.quora.com/What-is-the-regular-expression-for-positive-integers-without-leading-zeros-minus-signs-or-commas
const isValidAmount = amount => {
    const re = /^[1-9][0-9]*$/;
    console.log(re.test(amount));
    return re.test(amount);
}

const validateInputs = () => {
    const amountValue = amount.value.trim();

    let isValid = true; 

    // check if amount is empty
    if (amountValue === "") {
        setError(amount, "Amount Is Required");
        isValid = false;
    } 
    else if (!isValidAmount(amountValue)) {
        setError(amount, "Amount must be a whole positive number");
        isValid = false;
    }
    else {
        setSuccess(amount);
    }

    return isValid;
};
