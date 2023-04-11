<?php 
    // koneksi kedatabase
    $conn = mysqli_connect("localhost", "root", "", "phpdasar");

    function query($query){
        // penggunaan keyword global untuk mencari variabel global pada global scope
        global $conn;
        $result = mysqli_query($conn, $query);
        $rows = [];
        while ( $row = mysqli_fetch_assoc($result)) {
            $rows[] = $row;
        }
        return $rows;
    }


    function tambah($data){
        global $conn;
        
        // penggunaan method htmlspecialchars, untuk mengantisipasi kejahilan user agar tidak bisa menginputkan html lalu tereksekusi, hasil input akan menjadi string
        $nim = htmlspecialchars($data["nim"]);
        $nama = htmlspecialchars($data["nama"]);
        $email = htmlspecialchars($data["email"]);
        $jurusan = htmlspecialchars($data["jurusan"]);

        // upload gambar
        $gambar = upload();
        if(!$gambar){
            return false;
        }


        $query = "INSERT INTO mahasiswa
                VALUES ('', '$nim','$nama', '$email', '$jurusan', '$gambar' )";

        mysqli_query($conn, $query);

        return mysqli_affected_rows($conn);
    }

    function upload(){
        $namaFile = $_FILES["gambar"]["name"];
        $ukuranFile = $_FILES["gambar"]["size"];
        $error = $_FILES["gambar"]["error"];
        $temName = $_FILES["gambar"]["tmp_name"];

        // cek upload gambar
        if( $error === 4 ){
            echo "<script>
                alert('Pilih gambar terlebih dahulu!');
            </script>";
        }

        // cek ektensi gambar
        $ektensiGambarValid = ['jpg', 'jpeg', 'png'];

        // function 'explode()' berfungsi untuk memecah nama dan ektensi file yang di upload
        $ektensiGambar = explode('.', $namaFile);

        // function 'end()' berfungsi untuk mengambil urutan terakhir(type ektensi yang telah dipecah oleh function 'explode()')

        // function 'strtolower()' berfungsi untuk memaksa ektensi yang diupoal menjadi string huruf kecil semua. jadi setelah kita melakukan upload, file akan dipecah menjadi 2 bagian olkeh function 'explode()'. kemudian mengambil type filenya
        $ektensiGambar = strtolower(end($ektensiGambar));

        // function 'in_array()' berfungsi untuk mengecek adakah string dalam sebuah array
        if(!in_array($ektensiGambar, $ektensiGambarValid)){
            echo "<script>
                alert('yang anda upload bukan gambar');
            </script>";
            return false;
        }

        // pembatasan ukuran filke gambar yang diupload
        if( $ukuranFile > 1000000){
            echo "<script>
                alert('ukuran gambar terlalu besar');
            </script>";
        }

        // generate nama gambar yang akan diupload ke folder img
        // function 'uniqid()' berfungsi untuk membuat string yang berupa angka random
        $namaFileBaru = uniqid();
        $namaFileBaru .= '.';
        $namaFileBaru .= $ektensiGambar;
        // lakukan pengecekan gambar siap diupload
        move_uploaded_file($temName, 'img/'.$namaFileBaru);

        // return dibawah berfungsi sebagai nilai kembalian dari function upload() ini
        return $namaFileBaru;

    }


    function hapus($id){
        global $conn;
        mysqli_query($conn, "DELETE FROM mahasiswa WHERE id = $id");

        return mysqli_affected_rows($conn);
    }

    function ubah($data){
        global $conn;
        
        // penggunaan method htmlspecialchars, untuk mengantisipasi kejahilan user agar tidak bisa menginputkan html lalu tereksekusi, hasil input akan menjadi string
        $id = $data["id"];
        $nim = htmlspecialchars($data["nim"]);
        $nama = htmlspecialchars($data["nama"]);
        $email = htmlspecialchars($data["email"]);
        $jurusan = htmlspecialchars($data["jurusan"]);
        $gambarLama = htmlspecialchars($data["gambarLama"]);

        // cek apakah user mengubah gambar atau tidak
        // === 4 artinya user tidak mengupload foto
        if( $_FILES['gambar']['error'] === 4){
            $gambar = $gambarLama;
        } else {
            $gambar = upload();
        }
        


        $query = "UPDATE mahasiswa SET nim = '$nim', nama = '$nama', email = '$email', jurusan = '$jurusan', gambar = '$gambar' WHERE id = $id";

        mysqli_query($conn, $query);

        return mysqli_affected_rows($conn);
    }

    function cari($keyword){
        $query = "SELECT * FROM mahasiswa WHERE nama  LIKE '%$keyword%' OR
                                                nim  LIKE '%$keyword%' OR
                                                email  LIKE '%$keyword%' OR
                                                jurusan  LIKE '%$keyword%'";

        return query($query);
    }

    function registrasi($data){
        global $conn;

        $username = strtolower(stripslashes($data["username"]));
        $password = mysqli_real_escape_string($conn, $data["password"]);
        $password2 = mysqli_real_escape_string($conn, $data["password2"]);


        // cek username sudah ada atau belum
        $result = mysqli_query($conn, "SELECT username FROM users WHERE username = '$username'");

        if ( mysqli_fetch_assoc($result)) {
            echo "<script>
                alert('username yang dipilih sudah terdaftar');
            </script>";
            return false;
        }

        // cek konfirmasi password
        if ( $password !== $password2) {
            echo "<script>
                alert('password tidak sesuai');
            </script>";
            return false;
        }

        // enkripsi password
        $password = password_hash($password, PASSWORD_DEFAULT);


        // menambahkan pasword kedalam database
        mysqli_query($conn, "INSERT INTO users VALUES ('', '$username', '$password')");

        return mysqli_affected_rows($conn);
    }
?>