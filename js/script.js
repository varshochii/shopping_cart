
let navbar = document.querySelector('.header .navbar');

document.querySelector('#menu-btn').onclick = () => {
    navbar.classList.toggle('active');
}

window.scroll = () => {
    navbar.classList.remove('active');
}


document.querySelectorAll('input[type="number"]').forEach(inputNumber => {
    inputNumber.oninput = () => {
        if(inputNumber.ariaValueMax.length > inputNumber.maxLength) {
            inputNumber.value = inputNumber.value.slice(0,inputNumber.maxLength);
        }
    }
})