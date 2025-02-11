"use strict";
const investmentId = document.getElementById("investmentId");
const cancelBtn = document.getElementById("cancel");
const deleteBtn = document.getElementById("delete");
const formElement = document.getElementById("formDelete");
const submitForm = document.getElementById("submitForm");
const table = document.querySelector("table");
const amount = document.getElementById("amount");

var sum = 0;
for (var i = 1; i < table.rows.length - 1; i++) {
    var indTotal = parseInt(
        table.rows[i].cells[5].textContent.replace(",", "").split("₹")[1].trim()
    );
    sum += indTotal;
}

if (sum === 0) {
    amount.textContent = "₹0";
} else {
    amount.textContent = sum.toLocaleString("en-IN", {
        maximumFractionDigits: 2,
        style: "currency",
        currency: "INR",
    });
}

const modalPage = document.getElementsByClassName("modal")[0];

const textItems = document.querySelectorAll("input");

var investId = 0;

const buttons = document.querySelectorAll("button");

for (var i = 0; i < buttons.length; i++) {
    if (buttons[i].id.split("_")[0] === "deleteInvestment") {
        buttons[i].onclick = function (e) {
            investId = this.id.split("_")[1];
            document.getElementById("investmentId").value = investId;
            modalPage.style.display = "block";
        };
    }
}

cancelBtn.addEventListener("click", function () {
    modalPage.style.display = "none";
});

deleteBtn.addEventListener("click", function () {
    formElement.submit();
});
