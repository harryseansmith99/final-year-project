
/* 
inspired by https://www.youtube.com/watch?v=CYlNJpltjMM&t=447s
*/

console.log("validateAddProduct.js loaded");

const form = document.getElementById("addProductForm");
const productName = document.getElementById("newProductName");
const serialNumber = document.getElementById("newSerialNumber");
const storageLocation = document.getElementById("storageLocationToAdd");
const receivedQuantity = document.getElementById("receivedQuantity");
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

const validateInputs = () => {
    const productNameValue = productName.value.trim();
    const serialNumberValue = serialNumber.value.trim();
    const storageLocationValue = storageLocation.value.trim();
    const receivedQuantityValue = receivedQuantity.value.trim();
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

    if (receivedQuantityValue === "") {
        setError(receivedQuantity, "Received Quantity Is Required");
        isValid = false;
    } else {
        setSuccess(receivedQuantity);
    }

    if (minQuantityValue === "") {
        setError(minQuantity, "Minimum Quantity Is Required");
        isValid = false;
    } else {
        setSuccess(minQuantity);
    }

    if (maxQuantityValue === "") {
        setError(maxQuantity, "Maximum Quantity Is Required");
        isValid = false;
    } else {
        setSuccess(maxQuantity);
    }

    return isValid; // Return the validity status
};
