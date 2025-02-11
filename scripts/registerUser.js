"use strict";

const userName = document.getElementById("userName");
const password = document.getElementById("password");
const confirmPassword = document.getElementById("confirmPassword");
const firstName = document.getElementById("firstName");
const lastName = document.getElementById("lastName");
const dateofbirth = document.getElementById("dateofbirth");
const gender = document.getElementById("gender");
const phoneNumber = document.getElementById("phoneNumber");
const emailId = document.getElementById("emailId");
const contactaddress = document.getElementById("contactaddress");
const city = document.getElementById("city");
const pincode = document.getElementById("pincode");
const genderCheck = document.getElementById("genderCheck");
const gender_0 = document.getElementById("gender_0");
const gender_1 = document.getElementById("gender_1");

if (genderCheck.value !== "") {
    if (genderCheck.value === "M") {
        gender_1.setAttribute("checked", "checked");
    } else {
        gender_0.setAttribute("checked", "checked");
    }
}
const message = document.getElementById("message");

const validateTextLength = function (val, min = 1, max = Infinity) {
    if (typeof val === "string") {
        val = val.trim();
        const len = val.length;
        return len >= min && len <= max;
    }
    return false;
};

const validate = function (e, elem, msg, min = 1, max = Infinity) {
    if (!validateTextLength(elem.value, min, max)) {
        message.focus();
        e.preventDefault();
        message.classList.remove("hidden");
        message.textContent = `${msg} less than ${min} characters`;
    } else {
        message.classList.add("hidden");
    }
};

const matchText = function (val1, val2) {
    val1 = val1.trim();
    val2 = val2.trim();
    return val1 === val2;
};

const validateEmail = (email) => {
    const pattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return pattern.test(email);
};

userName.addEventListener("keydown", function (e) {
    if (e.key === "Tab") {
        validate(e, userName, "User Name", 8, 50);
    }
});

password.addEventListener("keydown", function (e) {
    if (e.key === "Tab") {
        validate(e, password, "Password", 8, 20);
    }
});

confirmPassword.addEventListener("keydown", function (e) {
    if (e.key === "Tab") {
        validate(e, confirmPassword, "Password", 8, 20);
        if (!matchText(password.value, confirmPassword.value)) {
            message.classList.remove("hidden");
            message.textContent = `Password and Confirm Password values don't match!`;
            e.preventDefault();
            message.focus();
        } else {
            message.classList.add("hidden");
        }
    }
});

firstName.addEventListener("keydown", function (e) {
    if (e.key === "Tab") {
        validate(e, firstName, "First Name", 1);
    }
});

lastName.addEventListener("keydown", function (e) {
    if (e.key === "Tab") {
        validate(e, lastName, "Last Name", 1);
    }
});

phoneNumber.addEventListener("keydown", function (e) {
    if (e.key === "Tab") {
        validate(e, phoneNumber, "Phone Number", 10);
    }
});

emailId.addEventListener("keydown", function (e) {
    if (e.key === "Tab") {
        if (!validateEmail(emailId.value)) {
            message.classList.remove("hidden");
            message.textContent = `Email is not in the right format!`;
            e.preventDefault();
            message.focus();
        } else {
            message.classList.add("hidden");
        }
    }
});

contactaddress.addEventListener("keydown", function (e) {
    if (e.key === "Tab") {
        validate(e, contactaddress, "Contact Address", 1);
    }
});

pincode.addEventListener("keydown", function (e) {
    if (e.key === "Tab") {
        validate(e, pincode, "Pin Code", 1);
    }
});

city.addEventListener("keydown", function (e) {
    if (e.key === "Tab") {
        validate(e, city, "City", 1);
    }
});
