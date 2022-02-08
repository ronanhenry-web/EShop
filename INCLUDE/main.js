let eyeSlashPass = document.getElementById('eye-slash');
let inputPass = document.getElementById('pass');
let inputConfirmPass = document.getElementById('confirm-pass');
let eyePass = document.getElementById('eye');

if (eyePass && eyeSlashPass && inputPass) {
    eyeSlashPass.style.display = "none";

    eyePass.addEventListener('click', () => {
        eyePass.style.display = "none";
        eyeSlashPass.style.display = "flex";
        inputPass.setAttribute('type', 'text'); //transformer le type de l'input en text
        inputConfirmPass.setAttribute('type', 'text'); //transformer le type de l'input en text
    })
    eyeSlashPass.addEventListener('click', () => {
        eyeSlashPass.style.display = "none";
        eyePass.style.display = "flex";
        inputPass.setAttribute('type', 'password'); //transformer le type de l'input en password
        inputConfirmPass.setAttribute('type', 'password'); //transformer le type de l'input en password
    })
}