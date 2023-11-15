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
    var light = document.getElementById("light")
    var night = document.getElementById("night")

    const ubahbody = document.body;
    // var ubah3 = document.getElementById('logo2');
    // var ubah4 = document.getElementById('logo3');
    var ubah5 = document.getElementById('webicon');
    
    menu.classList.toggle("dark1")
    menuToggle.classList.toggle("dark")
    ubahbody.classList.toggle("dark1");
    // ubah3.classList.toggle("dark");
    // ubah4.classList.toggle("dark");
    ubah5.classList.toggle("dark");

    if (light.style.display == 'none'){
        light.style.display = 'block';
        night.style.display = 'none';
    } else {
        light.style.display = 'none';
        night.style.display = 'block';
    }
}

// var link = document.getElementById('download');
// link.addEventListener('click', function (event) {
//     var konfirmasi = confirm('Apakah Anda yakin ingin melanjutkan?');
//     if (!konfirmasi) {
//         event.preventDefault(); 
//     }
// }
// );


