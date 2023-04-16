$(document).ready(function () {
  // sembunyikan tombol search
  $('#tombol-cari').hide();

  // even ketika disearch
  $('#keyword').on('keyup', function () {   
    console.log("hello");
    $('#tabel-mhs').load('ajax/mahasiswa.php?keyword=' + $('#keyword').val());
  });

});