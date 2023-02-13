<?php

include 'koneksi.php';

$id = $_GET['id'];
$sql = "SELECT material_out.*, material.material_name as material_name FROM material_out JOIN material ON material_out.material_code = material.material_code WHERE material_out_id = '$id' LIMIT 1";
$query = mysqli_query($db, $sql);
$data = mysqli_fetch_array($query);

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
                <img src="./logo.png" alt="" class="w-12 h-12 rounded-full dark:bg-gray-500">
                <div>
                    <h2 class="text-lg font-semibold">Dashboard</h2>
                    <span class="flex items-center space-x-1">
                        <a rel="noopener noreferrer" href="#" class="text-xs hover:underline dark:text-gray-400">PLN
                            Inventory</a>
                    </span>
                </div>
            </div>
            <div class="divide-y divide-gray-700">
                <ul class="pt-2 pb-4 space-y-1 text-sm">
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
                        <a rel="noopener noreferrer" href="#" class="flex items-center p-2 space-x-3 rounded-md">
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
                            <img src="./file-text.svg" class="w-5 h-5 fill-current dark:text-gray-400">
                            <span>Barang Keluar</span>
                        </a>
                    </li>
                </ul>
            </div>
        </aside>

        <main class="pt-6 bg-[#F7F8FC] w-full px-20">
            <div class="flex justify-between">
                <h1 class="text-2xl font-bold">Barang Keluar</h1>
            </div>


            <div class="p-5 bg-white rounded-lg mt-11">
                <div class="max-w-lg mt-8">
                    <fieldset class="w-full space-y-2 dark:text-gray-100">
                        <input type="hidden" name="material_id" value="<?php echo $data['material_code']; ?>">

                        <div class="flex">
                            <div class="flex flex-wrap items-center px-3 pointer-events-none w-36 sm:text-sm rounded-l-md dark:bg-gray-700">
                                Kode Material</div>
                            <input autofocus type="text" value="<?php echo $data['material_code']; ?>" disabled required name="material_code" id="url" placeholder="0001321301231" class="flex flex-1 p-3 border sm:text-sm rounded-r-md focus:ring-inset dark:border-gray-700 dark:text-gray-100 dark:bg-gray-800 focus:ring-violet-400">
                        </div>

                        <div class="flex">
                            <div class="flex flex-wrap items-center px-3 pointer-events-none w-36 sm:text-sm rounded-l-md dark:bg-gray-700">
                                Nama Material</div>
                            <input autofocus type="text" value="<?php echo $data['material_name']; ?>" disabled required name="material_name" id="url" placeholder="0001321301231" class="flex flex-1 p-3 border sm:text-sm rounded-r-md focus:ring-inset dark:border-gray-700 dark:text-gray-100 dark:bg-gray-800 focus:ring-violet-400">
                        </div>
                        <div class="flex">
                            <div class="flex flex-wrap items-center px-3 pointer-events-none w-36 sm:text-sm rounded-l-md dark:bg-gray-700">
                                Jumlah Keluar</div>
                            <input autofocus type="text" value="<?php echo $data['total']; ?>" disabled required name="material_name" id="url" placeholder="0001321301231" class="flex flex-1 p-3 border sm:text-sm rounded-r-md focus:ring-inset dark:border-gray-700 dark:text-gray-100 dark:bg-gray-800 focus:ring-violet-400">
                        </div>
                        <div class="flex">
                            <div class="flex flex-wrap items-center px-3 pointer-events-none w-36 sm:text-sm rounded-l-md dark:bg-gray-700">
                                Tanggal Keluar</div>
                            <input autofocus type="text" value="<?php echo $data['created_at']; ?>" disabled required name="material_name" id="url" placeholder="0001321301231" class="flex flex-1 p-3 border sm:text-sm rounded-r-md focus:ring-inset dark:border-gray-700 dark:text-gray-100 dark:bg-gray-800 focus:ring-violet-400">
                        </div>

                        <div class="flex">
                            <div class="flex flex-wrap items-center px-3 pointer-events-none w-36 sm:text-sm rounded-l-md dark:bg-gray-700">
                                Nomor Surat</div>
                            <input type="text" value="<?php echo $data['letter_number']; ?>" disabled required name="letter_number" id="letter_number" placeholder="150/LOG/SB - II / 2023" class="flex flex-1 p-3 border sm:text-sm rounded-r-md focus:ring-inset dark:border-gray-700 dark:text-gray-100 dark:bg-gray-800 focus:ring-violet-400">
                        </div>

                        <div class="flex">
                            <div class="flex flex-wrap items-center px-3 pointer-events-none w-36 sm:text-sm rounded-l-md dark:bg-gray-700">
                                Kepada</div>
                            <input type="text" value="<?php echo $data['letter_to']; ?>" disabled required name="letter_to" id="letter_to" placeholder="Petugas Keamanan" class="flex flex-1 p-3 border sm:text-sm rounded-r-md focus:ring-inset dark:border-gray-700 dark:text-gray-100 dark:bg-gray-800 focus:ring-violet-400">
                        </div>

                        <div class="flex">
                            <div class="flex flex-wrap items-center px-3 pointer-events-none w-36 sm:text-sm rounded-l-md dark:bg-gray-700">
                                Untuk</div>
                            <input type="text" value="<?php echo $data['letter_for']; ?>" disabled required name="letter_for" id="letter_for" placeholder="PEK Jardus" class="flex flex-1 p-3 border sm:text-sm rounded-r-md focus:ring-inset dark:border-gray-700 dark:text-gray-100 dark:bg-gray-800 focus:ring-violet-400">
                        </div>

                        <div class="flex">
                            <div class="flex flex-wrap items-center px-3 pointer-events-none w-36 sm:text-sm rounded-l-md dark:bg-gray-700">
                                Berdasarkan</div>
                            <input type="text" value="<?php echo $data['based_on']; ?>" disabled required name="based_on" id="based_on" placeholder="XXX" class="flex flex-1 p-3 border sm:text-sm rounded-r-md focus:ring-inset dark:border-gray-700 dark:text-gray-100 dark:bg-gray-800 focus:ring-violet-400">
                        </div>

                        <div class="flex">
                            <div class="flex flex-wrap items-center px-3 pointer-events-none w-36 sm:text-sm rounded-l-md dark:bg-gray-700">
                                Kontrak/SKP/Faktur</div>
                            <input type="text" disabled value="<?php echo $data['contract_spk_factur']; ?>" required name="contract_spk_factur" id="contract_spk_factur" placeholder="SPK 157.XX" class="flex flex-1 p-3 border sm:text-sm rounded-r-md focus:ring-inset dark:border-gray-700 dark:text-gray-100 dark:bg-gray-800 focus:ring-violet-400">
                        </div>

                        <div class="flex">
                            <div class="flex flex-wrap items-center px-3 pointer-events-none w-36 sm:text-sm rounded-l-md dark:bg-gray-700">
                                TUG-8 & TUG-9</div>
                            <input type="text" value="<?php echo $data['tug8_tug9']; ?>" disabled required name="tug8_tug9" id="tug8_tug9" placeholder="34223" class="flex flex-1 p-3 border sm:text-sm rounded-r-md focus:ring-inset dark:border-gray-700 dark:text-gray-100 dark:bg-gray-800 focus:ring-violet-400">
                        </div>

                        <div class="flex">
                            <div class="flex flex-wrap items-center px-3 pointer-events-none w-36 sm:text-sm rounded-l-md dark:bg-gray-700">
                                Dibawa Dengan</div>
                            <input value="<?php echo $data['delivery_with']; ?>" type="text" disabled required name="delivery_with" id="delivery_with" placeholder="PT Mega Distribusi" class="flex flex-1 p-3 border sm:text-sm rounded-r-md focus:ring-inset dark:border-gray-700 dark:text-gray-100 dark:bg-gray-800 focus:ring-violet-400">
                        </div>

                    </fieldset>
                </div>

            </div>


        </main>
    </div>
</body>

</html>
