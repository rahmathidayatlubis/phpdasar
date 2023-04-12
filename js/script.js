$(document).ready(function () {
  // sembunyikan tombol search
  $('#tombol-cari').hide();

  // even ketika disearch
  $('#keyword').on('keyup', function (params) {
    $('.tabel-mhs').load('ajax/mahasiswa.php?keyword=' + $('#keyword').val());
  });

});