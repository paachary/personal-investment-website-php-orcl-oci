"use strict";

const closeBtn = document.getElementById("close");
const cancelBtn = document.getElementById("cancel");
const deleteBtn = document.getElementById("delete");
const formElement = document.getElementById("savingsInfo");
const submitForm = document.getElementById("submitForm");

const modalPage = document.getElementsByClassName("modal")[0];

closeBtn.addEventListener("click", function () {
    modalPage.style.display = "block";
});

cancelBtn.addEventListener("click", function () {
    modalPage.style.display = "none";
});

deleteBtn.addEventListener("click", function () {
    formElement.submit();
});
