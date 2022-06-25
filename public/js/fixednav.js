// fixed nav
const nav = document.getElementById('nav');

window.addEventListener('scroll', function () {
    scrollposition = window.scrollY;

    if (scrollposition >= 650) {
        nav.classList.add('bg-light')
    } else if (scrollposition <= 650) {
        nav.classList.remove('bg-light')
    }
})