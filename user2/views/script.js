document.getElementById('loginBtn').addEventListener('click', () => {
    document.getElementById('login').style.opacity = '1';
    document.getElementById('register').style.opacity = '0';
});

document.getElementById('registerBtn').addEventListener('click', () => {
    document.getElementById('login').style.opacity = '0';
    document.getElementById('register').style.opacity = '1';
});

document.getElementById('menuToggle').addEventListener('click', () => {
    const menu = document.querySelector('.nav-menu');
    menu.classList.toggle('responsive');
});
