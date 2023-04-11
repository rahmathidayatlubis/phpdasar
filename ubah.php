<?php
session_start();

// cek apakah session logiin sudah terkirim atau belum
if (!isset($_SESSION["login"])) {
    header("Location: login.php");
    exit;
}

require "functions.php";

$id = $_GET["id"];

$mhs = query("SELECT * FROM mahasiswa WHERE id = $id")[0];

if( isset($_POST["submit"]) ){
    if (ubah($_POST) > 0 ) {
        echo "
            <script>
                alert('data berhasil diubah!');
                document.location.href = 'index.php';
            </script>
        ";
    } else {
        echo "
        <script>
            alert('data gagal diubah!');
            document.location.href = 'index.php';
        </script>
        ";
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.4/flowbite.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.4/flowbite.min.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Ubah data mahasiswa</title>
</head>

<body>
    <section class="flex justify-center w-full h-screen">
        <div class="bg-white border border-gray-200 rounded-xl drop-shadow-xl dark:bg-gray-800 w-1/3 h-max my-6">
            <div class="text-center w-full py-4 rounded-t-xl bg-slate-100">
                <h1 class="text-2xl font-semibold uppercase">Ubah data mahasiswa</h1>
            </div>

            <div class="pb-4 px-10 bg-white dark:bg-gray-800 pt-4 rounded-b-xl">
                <form action="" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="id" value="<?= $mhs["id"]; ?>">
                    <input type="hidden" name="nim" value="<?= $mhs["nim"]; ?>">
                    <input type="hidden" name="gambarLama" value="<?= $mhs["gambar"]; ?>">
                    <div class="w-full mb-5">
                        <label for="nama"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama</label>
                        <input type="text" name="nama" id="nama" value="<?= $mhs["nama"]; ?>"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    </div>
                    <div class="w-full mb-5">
                        <label for="email"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
                        <input type="text" name="email" id="email"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            value="<?= $mhs["email"]; ?>">
                    </div>
                    <div class="w-full mb-5">
                        <label for="jurusan"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Jurusan</label>
                        <input type="text" name="jurusan" id="jurusan"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            value="<?= $mhs["jurusan"]; ?>">
                    </div>
                    <div class="w-full mb-3">
                        <img src="img/<?= $mhs['gambar']; ?>" alt="gambar <?= $mhs['nama']; ?>" class="w-14">
                        <label for="gambar"
                            class="block mt-5 mb-2 text-sm font-medium text-gray-900 dark:text-white">Gambar</label>
                        <input type="file" name="gambar" id="gambar"
                            class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400">
                        <div class="mt-7">
                            <button type="submit" name="submit"
                                class="block w-full focus:outline-none text-white bg-orange-700 hover:bg-orange-800 focus:ring-4 focus:ring-orange-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-orange-600 dark:hover:bg-orange-700 dark:focus:ring-orange-800">Ubah
                                data</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>


</body>

</html>