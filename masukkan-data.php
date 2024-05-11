<!-- 
    Dibuat oleh:
    NAMA: ANDY RAHMAN RAMADHAN
    NIM: 220401070404
    KELAS: IT403
-->

<?php

include_once "classes/Mahasiswa.php";

$re = new Mahasiswa();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $daftar = $re->regisMahasiswa($_POST);
}

?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- stylesheet -->
    <link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet">

    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <style>
        .material-symbols-outlined {
            font-variation-settings: "FILL" 0, "wght" 400, "GRAD" 0, "opsz" 24;
        }

        .alert-success {
            background-color: #d1e7dd;
            border-color: #badbcc;
            color: #0f5132;
        }

        .alert-danger {
            background-color: #f8d7da;
            border-color: #f5c2c7;
            color: #842029;
        }

        .close-icon {
            cursor: pointer;
        }
    </style>

    <!-- from cdn -->
    <script src="https://unpkg.com/@material-tailwind/html@latest/scripts/ripple.js"></script>
    <title>Registrasi Mahasiswa</title>
</head>

<body class="h-screen flex-row items-center justify-center bg-gray-100">
    <div class="container mx-auto max-w-xl p-8 bg-white rounded shadow-lg">
        <div class="flex items-center justify-between pb-6">
            <div>
                <h4 class="text-xl font-bold mb-4">Form Registrasi Mahasiswa</h4>
            </div>
            <div class="flex items-center justify-between">
                <div class="ml-2 space-x-8 lg:ml-20">
                    <a href="index.php"
                        class="flex items-center gap-2 rounded-md bg-blue-600 px-4 py-2 text-sm font-semibold text-white focus:outline-none focus:ring hover:bg-blue-700">
                        <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px"
                            fill="#e8eaed">
                            <path
                                d="M480-320q75 0 127.5-52.5T660-500q0-75-52.5-127.5T480-680q-75 0-127.5 52.5T300-500q0 75 52.5 127.5T480-320Zm0-72q-45 0-76.5-31.5T372-500q0-45 31.5-76.5T480-608q45 0 76.5 31.5T588-500q0 45-31.5 76.5T480-392Zm0 192q-146 0-266-81.5T40-500q54-137 174-218.5T480-800q146 0 266 81.5T920-500q-54 137-174 218.5T480-200Zm0-300Zm0 220q113 0 207.5-59.5T832-500q-50-101-144.5-160.5T480-720q-113 0-207.5 59.5T128-500q50 101 144.5 160.5T480-280Z" />
                        </svg>
                        Lihat Tabel
                    </a>
                </div>
            </div>
        </div>

        <?php
        if (isset($daftar)) {
            $jikaSukses = strpos($daftar, "Berhasil") !== false;
            $peringatKelas = $jikaSukses ? "bg-green-100 border-green-400 text-green-700" : "bg-red-100 border-red-400 text-red-700";
            ?>
            <div id="daftar-alert" class="<?= $peringatKelas ?> border px-4 py-3 rounded relative" role="alert">
                <strong class="font-bold"><?= $daftar ?></strong>
                <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                    <svg onclick="closeAlert('daftar-alert')" class="fill-current h-6 w-6 text-green-500" role="button"
                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                        <title>Tutup</title>
                        <path
                            d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z" />
                    </svg>
                </span>
            </div>
            <?php
        }
        ?>

        <form method="POST">
            <div class="m-10 max-w-sm">
                <label for="nama" class="mb-2 block text-sm font-medium">Nama</label>
                <div class="relative">
                    <input type="text" id="nama" name="nama"
                        class="block w-full rounded-md border border-gray-200 py-3 px-4 pr-11 text-sm shadow-sm outline-none focus:z-10 focus:border-blue-500 focus:ring-blue-500"
                        placeholder="Masukkan nama" />
                </div>
            </div>

            <div class="m-10 max-w-sm">
                <label for="nim" class="mb-2 block text-sm font-medium">NIM</label>
                <div class="relative">
                    <input type="text" id="nim" name="nim"
                        class="block w-full rounded-md border border-gray-200 py-3 px-4 pr-11 text-sm shadow-sm outline-none focus:z-10 focus:border-blue-500 focus:ring-blue-500"
                        placeholder="Masukkan NIM" />
                </div>
            </div>

            <div class="m-10 max-w-sm">
                <label for="jenis_kelamin" class="mb-2 block text-sm font-medium">Jenis Kelamin</label>
                <div class="relative">
                    <select
                        class="block w-full rounded-md border border-gray-200 py-3 px-4 pr-11 text-sm shadow-sm outline-none focus:z-10 focus:border-blue-500 focus:ring-blue-500"
                        name="jenis_kelamin"
                        >
                        <option value="laki-laki">Laki-Laki</option>
                        <option value="perempuan">Perempuan</option>
                    </select>
                </div>
            </div>

            <div class="m-10 max-w-sm">
                <label for="kelas" class="mb-2 block text-sm font-medium">Kelas</label>
                <div class="relative">
                    <input type="text" id="kelas" name="kelas"
                        class="block w-full rounded-md border border-gray-200 py-3 px-4 pr-11 text-sm shadow-sm outline-none focus:z-10 focus:border-blue-500 focus:ring-blue-500"
                        placeholder="Masukkan Kelas" />
                </div>
            </div>

            <div class="m-10 max-w-sm">
                <label for="program_studi" class="mb-2 block text-sm font-medium">Program Studi</label>
                <div class="relative">
                    <input type="text" id="program_studi" name="program_studi"
                        class="block w-full rounded-md border border-gray-200 py-3 px-4 pr-11 text-sm shadow-sm outline-none focus:z-10 focus:border-blue-500 focus:ring-blue-500"
                        placeholder="Masukkan Program Studi" />
                </div>
            </div>

            <div class="m-10 max-w-sm">
                <label for="program_studi" class="mb-2 block text-sm font-medium">Angkatan</label>
                <div class="relative">
                    <select
                        class="block w-full rounded-md border border-gray-200 py-3 px-4 pr-11 text-sm shadow-sm outline-none focus:z-10 focus:border-blue-500 focus:ring-blue-500"
                        name="angkatan"
                        >
                        <option value="2020">2020</option>
                        <option value="2021">2021</option>
                        <option value="2022">2022</option>
                        <option value="2023">2023</option>
                        <option value="2024">2024</option>
                    </select>
                </div>
            </div>
            <button class="mt-4 rounded-full bg-blue-800 px-10 py-2 font-semibold text-white"
                type="submit">Simpan</button>
        </form>
    </div>
    <script>
        function closeAlert(alertId) {
            var alertElement = document.getElementById(alertId);
            if (alertElement) {
                alertElement.style.display = 'none';
            }
        }
    </script>
</body>

</html>