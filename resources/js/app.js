require("./bootstrap");

var moreOption = document.getElementById("more-option");
var moreOptionBtn = document.querySelector("#more-option-show");
var moreOptionCancel = document.querySelector("#more-option-cancel");
var moreOpBar = document.querySelector("#more-option-bar");

moreOpBar.onclick = function () {
    moreOption.style.display = "block";
};

moreOptionBtn.onclick = function () {
    if (moreOption.style.display == "none") {
        moreOption.style.display = "block";
    } else {
        moreOption.style.display = "none";
    }
};

moreOptionCancel.onclick = function () {
    moreOption.style.display = "none";
};

var cartBox = document.querySelector("#cart-box");
var cartBoxClose = document.querySelector("#cart-box-close");
var cartBoxOpen = document.querySelector("#cart-box-open");

cartBoxOpen.onclick = function () {
    cartBox.style.width = "500px";
};

cartBoxClose.onclick = function () {
    cartBox.style.width = 0;
};
