
/* 
inspired by https://www.youtube.com/watch?v=CYlNJpltjMM&t=447s
*/

console.log("validateEditCategory.js loaded");

const form = document.getElementById("editCategoryForm");
const categoryName = document.getElementById("newCategoryName");


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
    const categoryNameValue = categoryName.value.trim();


    let isValid = true; // Flag to check if the form is valid

    if (categoryNameValue === "") {
        setError(categoryName, "Category Name Is Required");
        isValid = false;
    } else {
        setSuccess(categoryName);
    }

    return isValid; // Return the validity status
};
