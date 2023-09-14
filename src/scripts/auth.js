//change entre les volets "connexion" et "inscription"
const signinbtnafter = document.querySelector('.signinbtnafter');
const signupbtnafter = document.querySelector('.signupbtnafter');
const formboxafter = document.querySelector('.form-box');

signinbtnafter.onclick=function(){
    formboxafter.classList.add('active');
    body.classList.add('active');
}

signupbtnafter.onclick=function(){
    formboxafter.classList.remove('active');
    body.classList.remove('active');
}



//change entre les volets "connexion" et "inscription" (responsive)
const signinbtn = document.querySelector('.signinbtn');
const signupbtn = document.querySelector('.signupbtn');
const formbox = document.querySelector('.form-box');
const body = document.querySelector('body');

signupbtn.onclick=function(){
    formbox.classList.add('active');
    body.classList.add('active');
}

signinbtn.onclick=function(){
    formbox.classList.remove('active');
    body.classList.remove('active');
}



//affiche le mot de passe dans le formulaire
const showPasswordCheckbox1 = document.getElementById("show-password-login");
const passwordField1 = document.getElementById("password1");
const passwordField2 = document.getElementById("password2");
const showPasswordCheckbox2 = document.getElementById("show-password-register");
const passwordField3 = document.getElementById("password3");
const passwordField4 = document.getElementById("password4");

showPasswordCheckbox1.addEventListener("change", function () {
    if (showPasswordCheckbox1.checked) {
        passwordField1.type = "text";
        passwordField2.type = "text";
    } else {
        passwordField1.type = "password";
        passwordField2.type = "password";
    }
});
showPasswordCheckbox2.addEventListener("change", function () {
    if (showPasswordCheckbox2.checked) {
        passwordField3.type = "text";
        passwordField4.type = "text";
    } else {
        passwordField3.type = "password";
        passwordField4.type = "password";
    }
});