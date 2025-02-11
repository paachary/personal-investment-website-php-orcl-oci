"use strict";
const cancelBtn = document.getElementById("cancel");
const deleteBtn = document.getElementById("delete");
const formElement = document.getElementById("deleteAccountForm");

const modalPage = document.getElementsByClassName("modal")[0];
const buttons = document.querySelectorAll("button");

for (var i = 0; i < buttons.length; i++) {
    if (buttons[i].id.split("_")[0] === "deleteAccount") {
        buttons[i].onclick = function (e) {
            const acctNbr = this.id.split("_")[1];
            document.getElementById("acctNbr").value = acctNbr;
            modalPage.style.display = "block";
        };
    }
}

cancelBtn.addEventListener("click", function () {
    console.log("in click");
    modalPage.style.display = "none";
});

deleteBtn.addEventListener("click", function () {
    formElement.submit();
});
