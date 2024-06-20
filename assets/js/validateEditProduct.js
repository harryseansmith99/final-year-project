
/* 
inspired by https://www.youtube.com/watch?v=CYlNJpltjMM&t=447s
*/

console.log("validatEditProduct.js loaded");

const form = document.getElementById("editProductForm");
const productName = document.getElementById("newProductName");
const serialNumber = document.getElementById("newSerialNumber");
const storageLocation = document.getElementById("storageLocationToAdd");
const minQuantity = document.getElementById("possibleMinimumQuantity");
const maxQuantity = document.getElementById("possibleMaximumQuantity");

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
    const productNameValue = productName.value.trim();
    const serialNumberValue = serialNumber.value.trim();
    const storageLocationValue = storageLocation.value.trim();
    const minQuantityValue = minQuantity.value.trim();
    const maxQuantityValue = maxQuantity.value.trim();

    let isValid = true; // Flag to check if the form is valid

    if (productNameValue === "") {
        setError(productName, "Product Name Is Required");
        isValid = false;
    } else {
        setSuccess(productName);
    }

    if (serialNumberValue === "") {
        setError(serialNumber, "Serial Number Is Required");
        isValid = false;
    } else {
        setSuccess(serialNumber);
    }

    if (storageLocationValue === "") {
        setError(storageLocation, "Storage Location Is Required");
        isValid = false;
    } else {
        setSuccess(storageLocation);
    }

    if (minQuantityValue === "") {
        setError(minQuantity, "Minimum Quantity Is Required");
        isValid = false;
    } else if (!isValidAmount(minQuantityValue)) {
        setError(minQuantity, "Quantity must be a whole positive number");
        isValid = false;
    }
    else {
        setSuccess(minQuantity);
    }


    if (maxQuantityValue === "") {
        setError(maxQuantity, "Maximum Quantity Is Required");
        isValid = false;
    } else if (!isValidAmount(maxQuantityValue)) {
        setError(maxQuantity, "Quantity must be a whole positive number");
        isValid = false;
    }
    else {
        setSuccess(maxQuantity);
    }


    return isValid; // Return the validity status
};
