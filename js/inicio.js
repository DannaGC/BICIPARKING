let profile = document.querySelector('.header .flex .profile');

document.querySelector('#menu-btn').onclick = () =>{
    profile.classList.toggle('active');
}

window.onscroll = () =>{
    profile.classList.remove('active');
}

let admin = document.querySelector('.header .flex .admin');

document.querySelector('#admin-btn').onclick = () =>{
    admin.classList.toggle('actives');
}

window.onscroll = () =>{
    admin.classList.remove('actives');
}

let info = document.querySelector('.header .flex .info');

document.querySelector('#info-btn').onclick = () =>{
    info.classList.toggle('active-i');
}

window.onscroll = () =>{
    info.classList.remove('active-i');
}