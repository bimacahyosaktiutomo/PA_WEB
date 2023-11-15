let menuicn = document.querySelector(".menuicn");
let nav = document.querySelector(".navcontainer");

menuicn.addEventListener("click", () => {
	nav.classList.toggle("navopen");
})


const menuToggle = document.getElementById('menu-toggle');
const buka = document.getElementById('menuBuka');
const tutup = document.getElementById('menuTutup');
const menu = document.getElementById('menu');
menuToggle.addEventListener('click', () => {
    menu.classList.toggle('active');
    if (buka.style.display == 'none'){
        buka.style.display = 'block';
        tutup.style.display = 'none';
    } else {
        buka.style.display = 'none';
        tutup.style.display = 'block';
    }
});


function mode(){
    const ubahbody = document.body;
    ubahbody.classList.toggle("dark1");
    
    var icon = document.getElementById('webicon2');
    icon.classList.toggle("dark");

    var light = document.getElementById("light")
    var night = document.getElementById("night")
    light.classList.toggle("dark");
    night.classList.toggle("dark");

    if (light.style.display == 'none'){
        light.style.display = 'block';
        night.style.display = 'none';
    } else {
        light.style.display = 'none';
        night.style.display = 'block';
    }
}