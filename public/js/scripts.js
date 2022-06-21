/*!
    * Start Bootstrap - SB Admin v7.0.5 (https://startbootstrap.com/template/sb-admin)
    * Copyright 2013-2022 Start Bootstrap
    * Licensed under MIT (https://github.com/StartBootstrap/startbootstrap-sb-admin/blob/master/LICENSE)
    */
// 
// Scripts
// 

window.addEventListener('DOMContentLoaded', event => {

    // Toggle the side navigation
    const sidebarToggle = document.body.querySelector('#sidebarToggle');
    if (sidebarToggle) {
        // Uncomment Below to persist sidebar toggle between refreshes
        // if (localStorage.getItem('sb|sidebar-toggle') === 'true') {
        //     document.body.classList.toggle('sb-sidenav-toggled');
        // }
        sidebarToggle.addEventListener('click', event => {
            event.preventDefault();
            document.body.classList.toggle('sb-sidenav-toggled');
            localStorage.setItem('sb|sidebar-toggle', document.body.classList.contains('sb-sidenav-toggled'));
        });
    }

});

let rupiah = document.getElementById('harga_produk');
rupiah.addEventListener('keyup', function (e) {
    // tambahkan 'Rp.' pada saat form di ketik
    // gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
    rupiah.value = formatRupiah(this.value);
});

// function formatRupiah(angka, prefix) {
//     let number_string = angka.replace(/[^,\d]/g, '').toString(),
//         split = number_string.split(','),
//         sisa = split[0].length % 3,
//         rupiah = split[0].substr(0, sisa),
//         ribuan = split[0].substr(sisa).match(/\d{3}/gi);

//     // tambahkan titik jika yang di input sudah menjadi angka ribuan
//     if (ribuan) {
//         separator = sisa ? '.' : '';
//         rupiah += separator + ribuan.join('.');
//     }

//     rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
//     return prefix == undefined ? rupiah : (rupiah ? + rupiah : '');
// }

function previewImg() {
    frame.src = URL.createObjectURL(event.target.files[0]);
}
