<?php

require_once __DIR__ . '/vendor/autoload.php';

require 'functions.php';

$mahasiswa = query("SELECT * FROM mahasiswa ORDER BY nama ASC");

$mpdf = new \Mpdf\Mpdf();

$html = '<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Print</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
    <div style="text-align: center">
        <h1>Daftar Mahasiswa</h1>
    </div>
    

    <table border="1" cellpadding="10" cellspacing="0">

    <tr>
        <td>No</td>
        <td>Gambar</td>
        <td>NIM</td>
        <td>Nama</td>
        <td>Email</td>
        <td>Jurusan</td>
    </tr>';

    $i = 1;
    foreach ($mahasiswa as $row) {
        $html .= '
        <tr>
            <td>'. $i++ .'</td>
            <td><img src="img/'. $row["gambar"] .'" width="50"></td>
            <td>'. $row["nim"] .'</td>
            <td>'. $row["nama"] .'</td>
            <td>'. $row["email"] .'</td>
            <td>'. $row["jurusan"] .'</td>
        </tr>';
    }

$html .= '</table>
</body>

</html>';

$mpdf->WriteHTML($html);
$mpdf->Output('daftar-mahasiswa.pdf', \Mpdf\Output\Destination::INLINE);

?>