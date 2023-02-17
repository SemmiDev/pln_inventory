<?php

include 'koneksi.php';

$sql = "SELECT * FROM material";

if (isset($_GET['search'])) {
    $search = $_GET['search'];
    $sql = "SELECT * FROM material WHERE material_code LIKE '%$search%' OR material_description LIKE '%$search%' OR material_group LIKE '%$search%' OR base_unit_of_measure LIKE '%$search%' OR valuation_type LIKE '%$search%' OR stock_sap LIKE '%$search%'";
}

$sorting = $_GET['sort'] ?? 'ASC';

if (isset($_GET['sort'])) {
    $sorting = $_GET['sort'];
    $sql = "SELECT * FROM material ORDER BY material_id $sorting";
}

$query = mysqli_query($db, $sql);
$data = mysqli_fetch_all($query, MYSQLI_ASSOC);

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="./style.css" rel="stylesheet" />
    <link href="./custom.css" rel="stylesheet" />
</head>

<body>
    <div class='flex'>
        <aside class="sticky top-0 h-screen p-3 space-y-2 w-60 dark:bg-gray-900 dark:text-gray-100">
            <div class="flex items-center p-2 space-x-4">
                <img src="./logo.png" alt="" class="w-8 h-8 rounded-full dark:bg-gray-500">
                <div>
                    <h2 class="text-sm font-semibold">Dashboard</h2>
                    <span class="flex items-center space-x-1">
                        <a rel="noopener noreferrer" href="#" class="text-xs hover:underline dark:text-gray-400">PLN
                            Inventory</a>
                    </span>
                </div>
            </div>
            <div class="divide-y divide-gray-700">
                <ul class="pt-2 pb-4 space-y-1 text-lg">
                    <li class="border-l-2 dark:bg-gray-800 border-sky-400 dark:text-gray-50">
                        <a rel="noopener noreferrer" href="index.php" class="flex items-center p-2 space-x-3 rounded-md">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="w-5 h-5 fill-current dark:text-gray-400">
                                <path d="M68.983,382.642l171.35,98.928a32.082,32.082,0,0,0,32,0l171.352-98.929a32.093,32.093,0,0,0,16-27.713V157.071a32.092,32.092,0,0,0-16-27.713L272.334,30.429a32.086,32.086,0,0,0-32,0L68.983,129.358a32.09,32.09,0,0,0-16,27.713V354.929A32.09,32.09,0,0,0,68.983,382.642ZM272.333,67.38l155.351,89.691V334.449L272.333,246.642ZM256.282,274.327l157.155,88.828-157.1,90.7L99.179,363.125ZM84.983,157.071,240.333,67.38v179.2L84.983,334.39Z">
                                </path>
                            </svg>
                            <span>Stok Barang</span>
                        </a>
                    </li>
                    <li>
                        <a rel="noopener noreferrer" href="surat-jalan.php" class="flex items-center p-2 space-x-3 rounded-md">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="w-5 h-5 fill-current dark:text-gray-400">
                                <path d="M440,424V88H352V13.005L88,58.522V424H16v32h86.9L352,490.358V120h56V456h88V424ZM320,453.642,120,426.056V85.478L320,51Z">
                                </path>
                                <rect width="32" height="64" x="256" y="232"></rect>
                            </svg>
                            <span>Surat Jalan</span>
                        </a>
                    </li>
                    <li>
                        <a rel="noopener noreferrer" href="barang-keluar.php" class="flex items-center p-2 space-x-3 rounded-md">
                            <img src="./file-text.svg" class="w-5 h-5 text-black fill-current dark:text-gray-100">
                            <span>Transaksi</span>
                        </a>
                    </li>
                </ul>
            </div>
        </aside>

        <main class="pt-6 bg-[#F7F8FC] w-full px-3">
            <div class="flex justify-between">
                <div class="flex items-center gap-2">
                    <h1 class="text-2xl font-bold">Stok Barang</h1>
                    <?php
                    if (isset($_GET['search'])) {
                        $keyword = $_GET['search'];
                        // terdapat n hasil pencarian untuk keyword
                        echo "<span class='text-lg font-semibold text-pink-400 dark:text-gray-500'>(terdapat " . mysqli_num_rows($query) . " hasil pencarian untuk keyword '$keyword')</span>";
                    }
                    ?>
                </div>
                <form action="index.php">
                    <fieldset class="w-full space-y-1 dark:text-gray-100">
                        <label for="Search" class="hidden">Search</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 flex items-center pl-2">
                                <button type="button" title="search" class="p-1 focus:outline-none focus:ring">
                                    <svg fill="currentColor" viewBox="0 0 512 512" class="w-4 h-4 dark:text-gray-100">
                                        <path d="M479.6,399.716l-81.084-81.084-62.368-25.767A175.014,175.014,0,0,0,368,192c0-97.047-78.953-176-176-176S16,94.953,16,192,94.953,368,192,368a175.034,175.034,0,0,0,101.619-32.377l25.7,62.2L400.4,478.911a56,56,0,1,0,79.2-79.195ZM48,192c0-79.4,64.6-144,144-144s144,64.6,144,144S271.4,336,192,336,48,271.4,48,192ZM456.971,456.284a24.028,24.028,0,0,1-33.942,0l-76.572-76.572-23.894-57.835L380.4,345.771l76.573,76.572A24.028,24.028,0,0,1,456.971,456.284Z">
                                        </path>
                                    </svg>
                                </button>
                            </span>
                            <input type="search" name="search" placeholder="Search..." class="w-32 py-2 pl-10 text-lg rounded-md sm:w-auto focus:outline-none dark:bg-gray-800 dark:text-gray-100 focus:dark:bg-gray-900 focus:dark:border-violet-400">
                            <input type="submit" hidden />
                        </div>
                    </fieldset>
                </form>
            </div>


            <div class="p-5 bg-white rounded-lg mt-11">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-5">
                        <h1 class="text-2xl font-bold">Stok Barang</h1>
                        <?php
                        if (isset($_GET['status'])) {
                            $status = $_GET['status'];
                            echo "<span class='text-lg font-semibold text-sky-600'>$status</span>";
                        }
                        ?>
                    </div>
                    <div class="flex gap-5">
                        <a href="index.php?sort=<?php echo $sorting == 'ASC' ? 'DESC' : 'ASC' ?>">
                            <div class="flex items-center gap-2 ">
                                <img src="./sort.png" alt="">
                                <span class="text-lg">Urutkan</span>
                            </div>
                        </a>
                    </div>
                </div>
                <a href="tambah-barang.php">
                    <button type="button" class="px-8 py-3 mt-5 font-semibold text-white transition duration-300 bg-black border rounded-lg hover:text-black hover:bg-white hover:border-black">Tambah</button>
                </a>

                <div class="container p-2 mx-auto sm:p-4 dark:text-gray-100">
                    <div class="overflow-x-auto">
                        <table class="min-w-full text-lg">
                            <colgroup>
                                <col>
                                <col>
                                <col>
                                <col>
                                <col>
                                <col>
                                <col class="w-24">
                            </colgroup>
                            <thead class="dark:bg-gray-700">
                                <tr class="text-left">
                                    <th class="p-3">Code</th>
                                    <th class="p-3">Description</th>
                                    <th class="p-3">Group</th>
                                    <th class="p-3">Base Unit</th>
                                    <th class="p-3">Valuation Type</th>
                                    <th class="p-3">Stok SAP</th>
                                    <th class="p-3 text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($data as $d) {
                                    echo "<tr class='border-b border-opacity-20 dark:border-gray-700 dark:bg-gray-900'>
                                    <td class='p-3'>
                                        <p>$d[material_code]</p>
                                    </td>
                                    <td class='p-3'>
                                        <p>$d[material_description]</p>
                                    </td>
                                    <td class='p-3'>
                                        <p>$d[material_group]</p>
                                    </td>
                                    <td class='p-3'>
                                        <p>$d[base_unit_of_measure]</p>
                                    </td>
                                    <td class='p-3'>
                                        <p>$d[valuation_type]</p>
                                    </td>
                                    <td class='p-3'>
                                        <p>$d[stock_sap]</p>
                                    </td>
                                    <td class='flex items-center justify-center gap-1 p-3'>
                                        <a href='tambah-stock-barang.php?id=$d[material_id]'>
                                            <button type='button'
                                                class='px-4 py-3 font-semibold text-white transition duration-200 ease-linear bg-green-400 border-2 border-green-400 rounded-lg hover:bg-green-600'>Tambah</button>
                                        </a>
                                        <a href='edit-barang.php?id=$d[material_id]'>
                                            <button type='button'
                                                class='px-4 py-3 font-semibold text-white transition duration-200 ease-linear border-2 rounded-lg bg-sky-400 hover:bg-sky-600 border-sky-400'>Edit</button>
                                        </a>
                                        <a href='delete-barang.php?id=$d[material_id]'>
                                            <button type='button'
                                                class='px-4 py-3 font-semibold text-white transition duration-200 ease-linear bg-red-400 border-2 border-red-400 rounded-lg hover:bg-red-600'
                                                onclick='return confirmDelete()'>Delete</button>
                                        </a>
                                    </td>
                                </tr>
                                ";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </main>

        <script>
            function confirmDelete() {
                return confirm('Anda yakin ingin menghapus barang ini?');
            }
        </script>
    </div>
</body>

</html>
