<?php
session_start();

// cek apakah session logiin sudah terkirim atau belum
if (!isset($_SESSION["login"])) {
    header("Location: login.php");
    exit;
}


require 'functions.php';

$mahasiswa = query("SELECT * FROM mahasiswa ORDER BY id ASC");

// tombol cari diclick
if (isset($_POST["cari"])) {
    $mahasiswa = cari($_POST["keyword"]);
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
    <title>CRUD</title>
</head>

<body>
    <header class="px-6 mt-6 mb-6">
        <div class="flex justify-center mb-6">
            <h1 class="text-3xl font-bold">Daftar Mahasiswa</h1>
        </div>
        <div class="flex justify-between">
            <a class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-base px-5 py-3 mr-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800"
                href="tambah.php">Tambah mahasiswa</a>
            <a href="logout.php"
                class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-3 mr-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">Logout</a>
        </div>

    </header>

    <section class="px-6 mt-3">
        <form action="" method="post" class="flex items-center">
            <label for="keyword" class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white"></label>
            <div class="relative w-full sm:w-1/2 md:w-2/5">
                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                    <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor"
                        viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                            clip-rule="evenodd"></path>
                    </svg>
                </div>
                <input id="keyword" type="search" name="keyword"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="Search Keyword ..." autocomplete="off" autofocus id="keyword">
            </div>
            <button type="submit" name="cari"
                class="p-2.5 ml-2 text-sm font-medium text-white bg-blue-700 rounded-lg border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                id="tombol-cari">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                </svg>
            </button>
        </form>
    </section>

    <div class="px-6 mt-2">
        <div id="tabel-mhs" class="relative overflow-x-auto">
            <table
                class="w-full text-sm text-left text-gray-500 dark:text-gray-400 mt-2 shadow-md sm:rounded-lg border">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr class="text-center">
                        <th scope="col" class="px-6 py-3 border">No.</th>
                        <th scope="col" class="px-6 py-3 border">Aksi</th>
                        <th scope="col" class="px-6 py-3 border">Gambar</th>
                        <th scope="col" class="px-6 py-3 border">NIM</th>
                        <th scope="col" class="px-6 py-3 border">Nama</th>
                        <th scope="col" class="px-6 py-3 border">Email</th>
                        <th scope="col" class="px-6 py-3 border">Jurusan</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i=1; ?>
                    <?php foreach($mahasiswa as $row) : ?>
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <td class="px-6 py-4 text-center border"><?= $i; ?></td>
                        <td class="px-6 py-4 text-center border">
                            <div class="inline-flex rounded-md shadow-sm" role="group">
                                <a class="px-4 py-2 text-sm font-medium text-gray-900 bg-orange-500 border-l border-y border-gray-900 rounded-l-lg hover:bg-orange-600 hover:text-white focus:z-10 focus:ring-2 focus:ring-gray-500 focus:bg-gray-900 focus:text-white dark:border-white dark:text-white dark:hover:text-white dark:hover:bg-gray-700 dark:focus:bg-gray-700"
                                    href="ubah.php?id=<?= $row["id"];?>">Ubah</a>
                                <a class="px-4 py-2 text-sm font-medium text-gray-900 bg-red-500 border border-gray-900 rounded-r-md hover:bg-red-600 hover:text-white focus:z-10 focus:ring-2 focus:ring-gray-500 focus:bg-gray-900 focus:text-white dark:border-white dark:text-white dark:hover:text-white dark:hover:bg-gray-700 dark:focus:bg-gray-700"
                                    href="hapus.php?id=<?= $row["id"];?>" onclick="return confirm('Yakin??');">Hapus</a>
                            </div>

                        </td>
                        <td class="px-6 py-4 flex justify-center">
                            <div class="w-14">
                                <img class="object-cover object-top h-16 w-full rounded-sm"
                                    src="img/<?= $row["gambar"];?>" alt="gambar <?= $row["nama"]; ?>">
                            </div>


                        </td>
                        <td class="px-6 py-4 border"><?= $row["nim"]; ?></td>
                        <td class="px-6 py-4 border"><?= $row["nama"]; ?></td>
                        <td class="px-6 py-4 border"><?= $row["email"]; ?></td>
                        <td class="px-6 py-4 border"><?= $row["jurusan"]; ?></td>
                    </tr>
                    <?php $i++; ?>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>


    </div>



    <script src="js/jquery-3.6.4.min.js"></script>
    <script src="js/script.js"></script>
</body>

</html>