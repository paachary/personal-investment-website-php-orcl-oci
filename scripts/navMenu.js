"use strict";

const overlay = document.querySelector(".overlay");

const banksLnk = document.getElementById("banks");

const createAcctLnk = document.getElementById("newAcct");

const editAcctLink = document.getElementById("editAcct");

const viewAcctLink = document.getElementById("viewAcct");

const instrumentTypesLink = document.getElementById("instrumentTypes");

const newInvstLink = document.getElementById("newInvst");

const viewInvstLink = document.getElementById("viewInvst");

const mnthlyDebitRptLnk = document.getElementById("mnthlyDebitRpt");

const activeInvestmentsReptLnk = document.getElementById(
    "activeInvestmentsRept"
);

const modalPage1 = document.getElementsByClassName("searchModal")[0];

const cancelBtn1 = document.getElementById("cancel1");

const proceedBtn = document.getElementById("proceed");

const headerValue = document.getElementById("search-modal-header");

const formElement1 = document.getElementById("acctSearch-form");

const selectedVal = document.getElementById("selected");

const logoutForm = document.getElementById("logoutForm");

const logout = document.getElementById("logout");

banksLnk.addEventListener("click", function () {
    window.location.href = "/banks";
});

const buttonClickedEvent = function (msg, val) {
    headerValue.innerHTML = msg;
    if (selectedVal !== null) selectedVal.setAttribute("value", val);
    modalPage1.classList.remove("hidden");
    overlay.classList.remove("hidden");
};

if (createAcctLnk !== null) {
    createAcctLnk.addEventListener("click", function () {
        window.location.href = "/accounts/create";
    });
}

viewAcctLink.addEventListener("click", function () {
    window.location.href = "/accounts";
});

if (editAcctLink !== null) {
    editAcctLink.addEventListener("click", function () {
        buttonClickedEvent("Edit Account", "editAcct");
    });
}

instrumentTypesLink.addEventListener("click", function () {
    window.location.href = "/instrumentTypes";
});

if (newInvstLink !== null) {
    newInvstLink.addEventListener("click", function () {
        buttonClickedEvent("Add New Investment", "newInvst");
    });
}

viewInvstLink.addEventListener("click", function () {
    buttonClickedEvent("View Your Investments", "viewInvst");
});

mnthlyDebitRptLnk.addEventListener("click", function () {
    window.location.href = "/reports/debitSumm";
});

activeInvestmentsReptLnk.addEventListener("click", function () {
    window.location.href = "/reports/activeInvestmentsReport";
});

if (cancelBtn1 !== null) {
    cancelBtn1.addEventListener("click", function () {
        modalPage1.classList.add("hidden");
        overlay.classList.add("hidden");
    });
}
if (proceedBtn !== null) {
    proceedBtn.addEventListener("click", function () {
        formElement1.submit();
    });
}

logout.addEventListener("click", function () {
    logoutForm.submit();
});
