<!-- 
    Dibuat oleh:
    NAMA: ANDY RAHMAN RAMADHAN
    NIM: 220401070404
    KELAS: IT403
-->

<?php
include_once "classes/Mahasiswa.php";

$re = new Mahasiswa();

// Limit paginasi
$limit = 10; // Jumlah data per halaman
$halaman = isset($_GET['halaman']) ? (int) $_GET['halaman'] : 1;
$offset = ($halaman - 1) * $limit;

// Get Students and Total Count
$semuaMahasiswa = $re->semuaMahasiswa($limit, $offset);
$totalMahasiswa = $re->hitungMahasiswa();

// Calculate Total halamans
$totalHalaman = ceil($totalMahasiswa / $limit);

function linkPaginasi($halaman, $totalHalaman)
{
    $paginasi = [];

    // Always show the first halaman
    if ($halaman > 3) {
        $paginasi[] = 1;
        if ($halaman > 4) {
            $paginasi[] = '...';
        }
    }

    // halamans around the current halaman
    for ($i = max(1, $halaman - 2); $i <= min($totalHalaman, $halaman + 2); $i++) {
        $paginasi[] = $i;
    }

    // Always show the last halaman
    if ($halaman < $totalHalaman - 2) {
        if ($halaman < $totalHalaman - 3) {
            $paginasi[] = '...';
        }
        $paginasi[] = $totalHalaman;
    }

    return $paginasi;
}

$linkPaginasi = linkPaginasi($halaman, $totalHalaman);
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <style>
        .material-symbols-outlined {
            font-variation-settings: "FILL" 0, "wght" 400, "GRAD" 0, "opsz" 24;
        }
    </style>
    <link rel="icon" type="image/x-icon" href="public/favicon.ico">

    <title>Daftar Mahasiswa</title>
</head>

<body class="h-screen flex-row items-center justify-center bg-gray-100">
    <div class="container mx-auto max-w-5xl p-8 bg-white rounded shadow-lg">
        <div class="mx-auto max-w-screen-lg px-4 py-8 sm:px-8">
            <div class="flex items-center justify-between pb-6">
                <div>
                    <h2 class="font-semibold text-gray-700">Daftar Mahasiswa</h2>
                    <span class="text-xs text-gray-500">Tabel mahasiswa yang telah dimasukkan</span>
                </div>
                <div class="flex items-center justify-between">
                    <div class="ml-10 space-x-8 lg:ml-40">
                        <a href="masukkan-data.php"
                            class="flex items-center gap-2 rounded-md bg-blue-600 px-4 py-2 text-sm font-semibold text-white focus:outline-none focus:ring hover:bg-blue-700">
                            <svg xmlns="http://www.w3.org/2000/svg" height="20px" viewBox="0 -960 960 960" width="24px"
                                fill="#e8eaed">
                                <path d="M440-440H200v-80h240v-240h80v240h240v80H520v240h-80v-240Z" />
                            </svg>
                            Tambah Data
                        </a>
                    </div>
                </div>
            </div>
            <div class="overflow-y-hidden rounded-lg border">
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr
                                class="bg-blue-600 text-left text-xs font-semibold uppercase tracking-widest text-white">
                                <th class="px-5 py-3">Nama</th>
                                <th class="px-5 py-3">NIM</th>
                                <th class="px-5 py-3">Jenis Kelamin</th>
                                <th class="px-5 py-3">Kelas</th>
                                <th class="px-5 py-3">Program Studi</th>
                                <th class="px-5 py-3">Angkatan</th>

                            </tr>
                        </thead>
                        <tbody class="text-gray-500">
                            <?php
                            if ($semuaMahasiswa) {
                                while ($row = mysqli_fetch_assoc($semuaMahasiswa)) {
                                    ?>
                                    <tr>
                                        <td class="border-b border-gray-200 bg-white px-5 py-5 text-sm">
                                            <p class="whitespace-no-wrap"><?= $row["nama"] ?></p>
                                        </td>
                                        <td class="border-b border-gray-200 bg-white px-5 py-5 text-sm">
                                            <p class="whitespace-no-wrap"><?= $row["nim"] ?></p>
                                        </td>
                                        <td class="border-b border-gray-200 bg-white px-5 py-5 text-sm">
                                            <p class="whitespace-no-wrap"><?= $row["jenis_kelamin"] ?></p>
                                        </td>
                                        <td class="border-b border-gray-200 bg-white px-5 py-5 text-sm">
                                            <p class="whitespace-no-wrap"><?= $row["kelas"] ?></p>
                                        </td>
                                        <td class="border-b border-gray-200 bg-white px-5 py-5 text-sm">
                                            <p class="whitespace-no-wrap"><?= $row["program_studi"] ?></p>
                                        </td>
                                        <td class="border-b border-gray-200 bg-white px-5 py-5 text-sm">
                                            <p class="whitespace-no-wrap"><?= $row["angkatan"] ?></p>
                                        </td>
                                    </tr>
                                    <?php
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
                <div class="flex flex-col items-center border-t bg-white px-5 py-5 sm:flex-row sm:justify-between">
                    <span class="text-xs text-gray-600 sm:text-sm"> Memperlihatkan <?= ($offset + 1) ?> sampai
                        <?= min($offset + $limit, $totalMahasiswa) ?> dari <?= $totalMahasiswa ?> Data </span>
                    <div class="mt-2 inline-flex sm:mt-0">
                        <a href="?halaman=<?= max(1, $halaman - 1) ?>"
                            class="mr-2 flex h-10 w-10 items-center justify-center rounded-full border border-gray-300 bg-white text-sm font-semibold text-gray-600 hover:bg-gray-100 transition duration-150">←</a>
                        <?php foreach ($linkPaginasi as $link) { ?>
                            <?php if ($link == '...') { ?>
                                <span
                                    class="mr-2 flex h-10 w-10 items-center justify-center rounded-full border border-gray-300 bg-white text-sm font-semibold text-gray-600">...</span>
                            <?php } else { ?>
                                <a href="?halaman=<?= $link ?>"
                                    class="mr-2 flex h-10 w-10 items-center justify-center rounded-full border border-gray-300 bg-white text-sm font-semibold <?= $link == $halaman ? 'bg-blue-600 text-white' : 'text-gray-600' ?> hover:bg-gray-100 transition duration-150"><?= $link ?></a>
                            <?php } ?>
                        <?php } ?>
                        <a href="?halaman=<?= min($totalHalaman, $halaman + 1) ?>"
                            class="flex h-10 w-10 items-center justify-center rounded-full border border-gray-300 bg-white text-sm font-semibold text-gray-600 hover:bg-gray-100 transition duration-150">→</a>
                    </div>
                </div>
            </div>
        </div>
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