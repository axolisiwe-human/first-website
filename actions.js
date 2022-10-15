let menu = document.querySelector('#menubar')
let navbar = document.querySelector('.navbar')

menu.onclick = () =>{
    menu.classList.toggle('fa-times')
    navbar.classList.toggle('active')
}

window.onscroll = () =>{
    menu.classList.remove('fa-times')
    navbar.classList.remove('active')
}

if(window.scrollY > 60){
    document.querySelector('#top-scroll').classList.add('active');
    document.querySelector('#top-scroll').classList.remove('active');
}