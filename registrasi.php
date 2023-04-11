<?php
require "functions.php";
if ( isset($_POST["registrasi"])) {
    
    if (registrasi($_POST) > 0) {
        echo "<script>
                alert('berhasil menambahkan user');
            </script>";
    } else {
        echo mysqli_error($conn);
    }

}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi</title>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.4/flowbite.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.4/flowbite.min.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
    label {
        display: block;
    }
    </style>

</head>

<body>

    <section class="flex justify-center w-full h-screen">
        <div class="bg-white border border-gray-200 rounded-xl drop-shadow-xl dark:bg-gray-800 w-1/3 h-max my-6">
            <div class="text-center w-full py-4 rounded-t-xl bg-slate-100">
                <h1 class="text-2xl font-semibold uppercase">Registrasi</h1>
            </div>
            <div class="pb-4 px-10 bg-white dark:bg-gray-800 pt-4 rounded-b-xl">
                <form action="" method="post">
                    <div class="w-full mb-5">
                        <label for="username"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Username</label>
                        <input type="text" name="username" id="username"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            required>
                    </div>
                    <div class="w-full mb-5">
                        <label for="password"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password</label>
                        <input type="password" name="password" id="password"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            required>
                    </div>
                    <div class="w-full mb-5">
                        <label for="password2"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Konfirmasi
                            password</label>
                        <input type="password" name="password2" id="password2"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            required>
                    </div>
                    <div class="mt-7 pb-5">
                        <button type="submit"
                            class="block w-full focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-base px-5 py-2.5 mr-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800"
                            name="registrasi">Registrasi</button>
                    </div>
                </form>
            </div>


        </div>
    </section>


</body>

</html>