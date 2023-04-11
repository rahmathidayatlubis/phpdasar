<?php
// menjalankan session disetipa halaman yang akan menggunakan super global variabel session
session_start();

require "functions.php";

if( isset($_COOKIE['key1']) && isset($_COOKIE['key2']) ){
    $key1 = $_COOKIE['key1'];
    $key2 = $_COOKIE['key2'];

    // ambil username berdasarkan id
    $result = mysqli_query($conn, "SELECT username FROM users WHERE id = $key1");

    $row = mysqli_fetch_assoc($result);

    // cek cookie dan username
    if ( $key2 === hash('sha256', $row['username']) ){
        $_SESSION['login'] = true;
    }

}


if (isset($_SESSION["login"])) {
    header("Location: index.php");
    exit;
}


if ( isset($_POST["login"])) {
    

    $username = $_POST["username"];
    $password = $_POST["password"];

    
    $result = mysqli_query($conn, "SELECT * FROM users WHERE username = '$username'");

    // cek username
    if( mysqli_num_rows($result) === 1){
        // cek password
        $row = mysqli_fetch_assoc($result);
        if( password_verify($password, $row["password"]) ){
            // set session
            $_SESSION["login"] = true;


            // cek remember me
            if( isset($_POST['remember'])){
                // buat cookie

                setcookie('key1', $row['id'], time()+30);
                setcookie('key2', hash('sha256', $row['username']), time()+30);
            }

            header("Location: index.php");
            exit;
        }
    }

    $error = true;

}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Login</title>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.4/flowbite.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.4/flowbite.min.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>

</head>

<body>
    <section class="flex justify-center w-full h-screen">
        <div class="bg-white border border-gray-200 rounded-xl drop-shadow-xl dark:bg-gray-800 w-1/3 h-max my-6">
            <div class="text-center w-full py-4 rounded-t-xl bg-slate-100">
                <h1 class="text-2xl font-semibold uppercase">Login</h1>
            </div>

            <div class="pb-9 px-10 bg-white dark:bg-gray-800 pt-4 rounded-b-xl">

                <?php if( isset($error)) : ?>
                <div class="flex p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400"
                    role="alert">
                    <svg aria-hidden="true" class="flex-shrink-0 inline w-5 h-5 mr-3" fill="currentColor"
                        viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                            clip-rule="evenodd"></path>
                    </svg>
                    <span class="sr-only">Info</span>
                    <div>
                        <span class="font-medium">Danger alert!</span> Change a few things up and try submitting again.
                    </div>
                </div>
                <?php endif; ?>

                <form action="" method="post">
                    <div class="w-full mb-5">
                        <label for="username"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Username</label>
                        <input type="text" name="username" id="username" autocomplete="off"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            required>
                    </div>
                    <div class="w-full mb-3">
                        <label for="password"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password</label>
                        <input type="password" name="password" id="password"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            required>
                    </div>
                    <div class="w-full mb-5">
                        <input type="checkbox" name="remember" id="remember"
                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                        <label for="remember" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Remember
                            Me</label>
                    </div>
                    <div class="mt-7">
                        <button type="submit"
                            class="block w-full focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-base px-5 py-2.5 mr-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800"
                            name="login">Login</button>
                    </div>

                </form>

            </div>
        </div>
    </section>
</body>

</html>