/*!
* Start Bootstrap - Shop Homepage v5.0.5 (https://startbootstrap.com/template/shop-homepage)
* Copyright 2013-2022 Start Bootstrap
* Licensed under MIT (https://github.com/StartBootstrap/startbootstrap-shop-homepage/blob/master/LICENSE)
*/
// This file is intentionally blank
// Use this file to add JavaScript to your project

function seePassword() {
    let x = document.getElementById("password");
    if (x.type === "password") {
        x.type = "text";
    } else {
        x.type = "password";
    }
}

function seePasswordReg() {
    let x = document.getElementById("password");
    let y = document.getElementById("password_conf");
    if (x.type === "password" || y.type === "password") {
        x.type = "text";
        y.type = "text";
    } else {
        x.type = "password";
        y.type = "password";
    }
}

function password_show_hide_conf() {
    var x = document.getElementById("password_conf");
    var show_eye = document.getElementById("show_eye_conf");
    var hide_eye = document.getElementById("hide_eye_conf");
    hide_eye.classList.remove("d-none");
    if (x.type === "password") {
        x.type = "text";
        show_eye.style.display = "none";
        hide_eye.style.display = "block";
    } else {
        x.type = "password";
        show_eye.style.display = "block";
        hide_eye.style.display = "none";
    }
}

function incrementValue() {
    var value = parseInt(document.getElementById('number').value, 10);
    value = isNaN(value) ? 0 : value;
    if (value) {
        value++;
        document.getElementById('number').value = value;
    }
}
function decrementValue() {
    var value = parseInt(document.getElementById('number').value, 10);
    value = isNaN(value) ? 0 : value;
    if (value > 1) {
        value--;
        document.getElementById('number').value = value;
    }

}