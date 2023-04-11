<?php
require "../functions.php";
$keyword = $_GET["keyword"];
$query = "SELECT * FROM mahasiswa WHERE nama  LIKE '%$keyword%' OR
nim  LIKE '%$keyword%' OR
email  LIKE '%$keyword%' OR
jurusan  LIKE '%$keyword%'";
$mahasiswa = query($query);

?>

<table class="w-full text-sm text-left text-gray-500 dark:text-gray-400 mt-2 shadow-md sm:rounded-lg border">
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
                    <img class="object-cover object-top h-16 w-full rounded-sm" src="img/<?= $row["gambar"];?>"
                        alt="gambar <?= $row["nama"]; ?>">
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