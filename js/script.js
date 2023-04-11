// ambil elemen yang dibutuhkan

const keyword = document.getElementById('keyword');
const tombolCarai = document.getElementById('tombol-cari');
const tabelMhs = document.getElementById('tabel-mhs');

// tambahkan event ketika keyword diketik
keyword.addEventListener('keyup', function () {
  
  // buat object ajax
  let xhr = new XMLHttpRequest();

  // cek kesiapan ajax
  xhr.onreadystatechange = function () {
    if( xhr.readyState == 4 && xhr.status == 200 ){
      tabelMhs.innerHTML = xhr.responseText;

    }
  }

  // eksekusi ajax
  xhr.open('GET', 'ajax/mahasiswa.php?keyword='+ keyword.value, true);
  xhr.send();


});