<?php

include 'koneksi.php';

$sql = "SELECT * FROM material";
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
    <script>
        let materialData = []

        let input = JSON.parse(localStorage.getItem('input')) || {
            created_at: '',
            keterangan: '',
            letter_number: '',
            letter_to: '',
            letter_for: '',
            based_on: '',
            contract_spk_factur: '',
            tug8_tug9: '',
            delivery_with: '',
            barang_keluar: [],
        }

        function handleChangeInput(e) {
            input[e.target.name] = e.target.value
            syncLocalStorage()
        }

        function syncLocalStorage() {
            localStorage.setItem('input', JSON.stringify(input))
        }

        function loadLocalStorage() {
            input = JSON.parse(localStorage.getItem('input'))
        }
    </script>

    <?php

    foreach ($data as $row) {
        echo "<script>materialData.push(" . json_encode($row) . ")</script>";
    }

    ?>

    <div class='flex'>
        <aside class="sticky top-0 h-screen p-3 space-y-2 w-60 dark:bg-gray-900 dark:text-gray-100">
            <div class="flex items-center p-2 space-x-4">
                <img src="./logo.png" alt="" class="w-12 h-12 rounded-full dark:bg-gray-500">
                <div>
                    <h2 class="text-lg font-semibold">Dashboard</h2>
                    <span class="flex items-center space-x-1">
                        <a rel="noopener noreferrer" href="#" class="text-lg hover:underline dark:text-gray-400">PLN
                            Inventory</a>
                    </span>
                </div>
            </div>
            <div class="divide-y divide-gray-700">
                <ul class="pt-2 pb-4 space-y-1 text-lg">
                    <li>
                        <a rel="noopener noreferrer" href="index.php" class="flex items-center p-2 space-x-3 rounded-md">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="w-5 h-5 fill-current dark:text-gray-400">
                                <path d="M68.983,382.642l171.35,98.928a32.082,32.082,0,0,0,32,0l171.352-98.929a32.093,32.093,0,0,0,16-27.713V157.071a32.092,32.092,0,0,0-16-27.713L272.334,30.429a32.086,32.086,0,0,0-32,0L68.983,129.358a32.09,32.09,0,0,0-16,27.713V354.929A32.09,32.09,0,0,0,68.983,382.642ZM272.333,67.38l155.351,89.691V334.449L272.333,246.642ZM256.282,274.327l157.155,88.828-157.1,90.7L99.179,363.125ZM84.983,157.071,240.333,67.38v179.2L84.983,334.39Z">
                                </path>
                            </svg>
                            <span>Stok Barang</span>
                        </a>
                    </li>
                    <li class="border-l-2 dark:bg-gray-800 border-sky-400 dark:text-gray-50">
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
                            <img src="./file-text.svg" class="w-5 h-5 fill-current dark:text-gray-400">
                            <span>Transaksi</span>
                        </a>
                    </li>
                </ul>
            </div>
        </aside>

        <form action="cetak.php" method="get" class="pt-6 bg-[#F7F8FC] w-full px-20">
            <div class="flex items-center justify-between">
                <h1 class="text-2xl font-bold">Surat Jalan</h1>

                <script>
                    function confirmDelete() {
                        return confirm('Apakah anda yakin cetak dan menyimpan log data ini?')
                    }
                </script>

                <a href="cetak.php">
                    <button type="submit" onclick='return confirmDelete()' class="px-5 py-4 font-semibold text-white transition duration-200 ease-linear bg-purple-400 border-2 border-purple-400 rounded-lg hover:bg-purple-600">Simpan
                        & Cetak
                        PDF
                    </button>

                </a>
            </div>

            <div class="flex gap-5 p-5 bg-white rounded-lg mt-11">
                <div class="p-5 mt-2 bg-white rounded-lg">
                    <div class="max-w-[400px]">
                        <fieldset class="w-full space-y-2 dark:text-gray-100">
                            <div class="flex">
                                <div class="flex flex-wrap items-center w-40 px-3 pointer-events-none sm:text-lg rounded-l-md dark:bg-gray-700">
                                    Tanggal</div>
                                <input type="date" onchange="handleChangeInput(event)" required name="created_at" id="created_at" placeholder="0001321301231" class="flex flex-1 p-3 border sm:text-lg rounded-r-md focus:ring-inset dark:border-gray-700 dark:text-gray-100 dark:bg-gray-800 focus:ring-violet-400">
                            </div>

                            <div class="flex">
                                <div class="flex flex-wrap items-center w-40 px-3 pointer-events-none sm:text-lg rounded-l-md dark:bg-gray-700">
                                    Nomor Surat</div>
                                <input type="text" onchange="handleChangeInput(event)" required name="letter_number" id="letter_number" placeholder="150/LOG/SB - II / 2023" class="flex flex-1 p-3 border sm:text-lg rounded-r-md focus:ring-inset dark:border-gray-700 dark:text-gray-100 dark:bg-gray-800 focus:ring-violet-400">
                            </div>

                            <div class="flex">
                                <div class="flex flex-wrap items-center w-40 px-3 pointer-events-none sm:text-lg rounded-l-md dark:bg-gray-700">
                                    Kepada</div>
                                <input type="text" onchange="handleChangeInput(event)" required name="letter_to" id="letter_to" placeholder="Petugas Keamanan" class="flex flex-1 p-3 border sm:text-lg rounded-r-md focus:ring-inset dark:border-gray-700 dark:text-gray-100 dark:bg-gray-800 focus:ring-violet-400">
                            </div>

                            <div class="flex">
                                <div class="flex flex-wrap items-center w-40 px-3 pointer-events-none sm:text-lg rounded-l-md dark:bg-gray-700">
                                    Untuk</div>
                                <input type="text" onchange="handleChangeInput(event)" required name="letter_for" id="letter_for" placeholder="PEK Jardus" class="flex flex-1 p-3 border sm:text-lg rounded-r-md focus:ring-inset dark:border-gray-700 dark:text-gray-100 dark:bg-gray-800 focus:ring-violet-400">
                            </div>

                            <div class="flex">
                                <div class="flex flex-wrap items-center w-40 px-3 pointer-events-none sm:text-lg rounded-l-md dark:bg-gray-700">
                                    Berdasarkan</div>
                                <input type="text" onchange="handleChangeInput(event)" required name="based_on" id="based_on" placeholder="XXX" class="flex flex-1 p-3 border sm:text-lg rounded-r-md focus:ring-inset dark:border-gray-700 dark:text-gray-100 dark:bg-gray-800 focus:ring-violet-400">
                            </div>

                            <div class="flex">
                                <div class="flex flex-wrap items-center w-40 px-3 pointer-events-none sm:text-lg rounded-l-md dark:bg-gray-700">
                                    SKP / Faktur</div>
                                <input type="text" onchange="handleChangeInput(event)" required name="contract_spk_factur" id="contract_spk_factur" placeholder="SPK 157.XX" class="flex flex-1 p-3 border sm:text-lg rounded-r-md focus:ring-inset dark:border-gray-700 dark:text-gray-100 dark:bg-gray-800 focus:ring-violet-400">
                            </div>

                            <div class="flex">
                                <div class="flex flex-wrap items-center w-40 px-3 pointer-events-none sm:text-lg rounded-l-md dark:bg-gray-700">
                                    TUG-8 & TUG-9</div>
                                <input type="text" onchange="handleChangeInput(event)" required name="tug8_tug9" id="tug8_tug9" placeholder="34223" class="flex flex-1 p-3 border sm:text-lg rounded-r-md focus:ring-inset dark:border-gray-700 dark:text-gray-100 dark:bg-gray-800 focus:ring-violet-400">
                            </div>

                            <div class="flex">
                                <div class="flex flex-wrap items-center w-40 px-3 pointer-events-none sm:text-lg rounded-l-md dark:bg-gray-700">
                                    Dibawa Dengan</div>
                                <input type="text" onchange="handleChangeInput(event)" required name="delivery_with" id="delivery_with" placeholder="PT Mega Distribusi" class="flex flex-1 p-3 border sm:text-lg rounded-r-md focus:ring-inset dark:border-gray-700 dark:text-gray-100 dark:bg-gray-800 focus:ring-violet-400">
                            </div>


                            <div class="flex">
                                <div class="flex flex-wrap items-center w-40 px-3 pointer-events-none sm:text-lg rounded-l-md dark:bg-gray-700">
                                    Keterangan
                                </div>

                                <textarea placeholder="Keterangan" onchange="handleChangeInput(event)" name="keterangan" id="keterangan" cols="30" rows="3" class="flex flex-1 p-3 border sm:text-lg rounded-r-md focus:ring-inset dark:border-gray-700 dark:text-gray-100 dark:bg-gray-800 focus:ring-violet-400">
                            </textarea>
                            </div>

                        </fieldset>
                    </div>

                    <script>
                        document.getElementById('created_at').value = input.created_at;
                        document.getElementById('letter_number').value = input.letter_number;
                        document.getElementById('letter_to').value = input.letter_to;
                        document.getElementById('letter_for').value = input.letter_for;
                        document.getElementById('based_on').value = input.based_on;
                        document.getElementById('contract_spk_factur').value = input.contract_spk_factur;
                        document.getElementById('tug8_tug9').value = input.tug8_tug9;
                        document.getElementById('delivery_with').value = input.delivery_with;
                        document.getElementById('keterangan').value = input.keterangan;
                    </script>
                </div>

                <div class="p-5 mt-2 bg-white rounded-lg">
                    <div class="max-w-[400px] space-y-2">
                        <div class="flex">
                            <div class="flex flex-wrap items-center w-40 px-3 pointer-events-none sm:text-lg rounded-l-md dark:bg-gray-700">
                                Material
                            </div>

                            <select name="material" id="material" class="flex flex-1 p-3 border w-44 sm:text-lg rounded-r-md focus:ring-inset dark:border-gray-700 dark:text-gray-100 dark:bg-gray-800 focus:ring-violet-400">
                                <script>
                                    var materialSelect = document.getElementById('material');
                                    for (var i = 0; i < materialData.length; i++) {
                                        var opt = materialData[i];
                                        if (opt.stock_sap <= 0) {
                                            continue;
                                        }

                                        var el = document.createElement('option');
                                        el.textContent = opt.material_description + ' 👉 ' + opt.stock_sap + ' Unit  ';
                                        el.value = JSON.stringify(opt);
                                        materialSelect.appendChild(el);
                                    }
                                </script>
                            </select>

                            <script>
                                function syncMaterialOption() {
                                    var materialSelect = document.getElementById('material');
                                    materialSelect.innerHTML = '';

                                    for (var i = 0; i < materialData.length; i++) {
                                        var opt = materialData[i];
                                        if (opt.stock_sap <= 0) {
                                            continue;
                                        }

                                        var el = document.createElement('option');
                                        el.textContent = opt.material_description + ' 👉 ' + opt.stock_sap + ' Unit  ';
                                        el.value = JSON.stringify(opt);
                                        materialSelect.appendChild(el);
                                    }
                                }
                            </script>
                        </div>

                        <div class="flex">
                            <div class="flex flex-wrap items-center w-40 px-3 pointer-events-none sm:text-lg rounded-l-md dark:bg-gray-700">
                                Jumlah Keluar</div>
                            <input type="number" id="jumlah_keluar" required name="valuation_type" placeholder="10" class="flex flex-1 p-3 border w-60 sm:text-lg rounded-r-md focus:ring-inset dark:border-gray-700 dark:text-gray-100 dark:bg-gray-800 focus:ring-violet-400">
                        </div>

                        <div class="flex justify-end">
                            <button onclick="addMaterial()" type="button" id="tambah-material" class="px-8 py-3 mt-5 font-semibold text-white transition duration-300 bg-black border rounded-lg w-44 hover:text-black hover:bg-white hover:border-black">Tambah</button>
                        </div>
                    </div>
                </div>

                <div class="flex flex-col p-5 mt-2 bg-white rounded-lg gap-y-2" id="added-items">
                    <div id="countTotalKeluar">

                    </div>
                </div>
            </div>
        </form>
    </div>

    <script>
        function removeMaterial(el) {
            var id = el.id;

            var tempTotal = 0;
            input.barang_keluar = input.barang_keluar.filter(function(item) {
                if (item.barang_keluar_id === id) {
                    tempTotal = item.jumlah_keluar;

                    const barangKeluarId = item.barang_keluar_id.split('👉');
                    const left = barangKeluarId[0].split('|');
                    const materialDescription = left[1]

                    // add stock
                    for (var i = 0; i < materialData.length; i++) {
                        if (materialData[i].material_description.trim() === materialDescription.trim()) {
                            const temp1 = Number(materialData[i].stock_sap);
                            const temp2 = Number(item.jumlah_keluar);
                            materialData[i].stock_sap = temp1 + temp2;

                            // sync material option
                            syncMaterialOption();
                            break;
                        }
                    }
                }
                return item.barang_keluar_id !== id;
            });

            // get item on local storage and sub with tempTotal
            var totalInLocalStorage = JSON.parse(localStorage.getItem('total'));
            // change to number
            totalInLocalStorage = Number(totalInLocalStorage);
            totalInLocalStorage -= Number(tempTotal);
            localStorage.setItem('total', JSON.stringify(totalInLocalStorage));


            var totalInKeluar = document.getElementById('countTotalKeluar');
            totalInKeluar.innerHTML = 'Total = ' + totalInLocalStorage + ' Unit';


            syncLocalStorage();
            el.parentElement.parentElement.remove();
        }

        function loadMaterialFirst() {
            syncLocalStorage();

            var addedItems = document.getElementById('added-items');

            for (var i = 0; i < input.barang_keluar.length; i++) {
                var div = document.createElement('div');
                let idForCloseButton = input.barang_keluar[i].barang_keluar_id;
                let materialDesription = input.barang_keluar[i].material_description;
                let materialId = input.barang_keluar[i].material_id;
                let jumlahKeluar = input.barang_keluar[i].jumlah_keluar;

                div.innerHTML = `
            <div class="relative p-3 space-y-2 border border-black rounded-lg">

                <div class="flex items-center justify-end">
                    <button
                        type="button"
                        onclick="removeMaterial(this)"
                        id = "` + idForCloseButton + `"
                        class="absolute w-5 h-5 p-2 text-white bg-red-500 rounded-full right-2 top-3 hover:bg-red-800"></button>
                </div>

                <div class="flex">
                    <div class="flex flex-wrap items-center w-40 px-3 bg-gray-300 pointer-events-none sm:text-lg rounded-l-md dark:bg-gray-700">Material Name</div>
                <input type="text" required name="material" id="url" value="` + materialDesription +
                    `" placeholder="` +
                    materialDesription + `" class="flex flex-1 p-3 border sm:text-lg rounded-r-md focus:ring-inset dark:border-gray-700 dark:text-gray-100 dark:bg-gray-800 focus:ring-violet-400" readonly>
                </div>

                <div class="flex">
                    <div class="flex flex-wrap items-center w-40 px-3 font-semibold bg-gray-300 pointer-events-none sm:text-lg rounded-l-md dark:bg-gray-700">Jumlah Keluar</div>

                    <input type="text" name="material" id="url" value="` + jumlahKeluar + `" placeholder="` +
                    jumlahKeluar + `" class="flex flex-1 p-3 border sm:text-lg rounded-r-md focus:ring-inset dark:border-gray-700 dark:text-gray-100 dark:bg-gray-800 focus:ring-violet-400" readonly>
                </div>
            </div>
            `;
                addedItems.appendChild(div);
            }
        }

        loadMaterialFirst();

        function addMaterial() {
            var materialSelect = document.getElementById('material');
            var material = materialSelect.options[materialSelect.selectedIndex].value;
            var materialName = materialSelect.options[materialSelect.selectedIndex].text;
            var jumlahKeluar = document.getElementById('jumlah_keluar').value;

            var addedItems = document.getElementById('added-items');
            var div = document.createElement('div');

            // materialName split by '👉' and get the first index
            var materialDesription = materialName.split('👉')[0];
            materialDesription = materialDesription.trim();

            // loop the materialdata for substracting the stock
            for (var i = 0; i < materialData.length; i++) {
                if (materialData[i].material_description === materialDesription) {
                    var stock = materialData[i].stock_sap;

                    stock = Number(stock);
                    jumlahKeluar = Number(jumlahKeluar);

                    // check if stock is enough
                    if (stock < jumlahKeluar) {
                        alert('Stock tidak cukup');
                        return;
                    }

                    var newStock = stock - jumlahKeluar;
                    materialData[i].stock_sap = newStock;
                    syncMaterialOption();
                    break;
                }
            }


            let materialUnit = materialName.split('👉')[1];
            materialUnit = materialUnit.trim();
            materialUnit = materialUnit.split(' ');
            materialUnit = materialUnit[0];

            function generateExactlyUniqueID() {
                var id = Math.floor(Math.random() * 1000) + '|' + materialName + '|' + jumlahKeluar;
                var isExist = input.barang_keluar.filter(function(item) {
                    return item.barang_keluar_id === id;
                });

                if (isExist.length > 0) {
                    generateExactlyUniqueID();
                } else {
                    return id;
                }
            }

            let idForCloseButton = generateExactlyUniqueID();

            input.barang_keluar.push({
                barang_keluar_id: idForCloseButton,
                material_description: materialDesription,
                jumlah_keluar: jumlahKeluar,
                details: material,
            });

            // total for local storage
            var total = 0;
            for (var i = 0; i < input.barang_keluar.length; i++) {
                total += parseInt(input.barang_keluar[i].jumlah_keluar);
            }

            // set total to local storage
            localStorage.setItem('total', total);

            var totalInKeluar = document.getElementById('countTotalKeluar');
            totalInKeluar.innerHTML = 'Total Barang Keluar = ' + total + ' Unit';

            syncLocalStorage();

            div.innerHTML = `
            <div class="relative p-3 space-y-2 border border-black rounded-lg">

                <div class="flex items-center justify-end">
                    <button
                        type="button"
                        onclick="removeMaterial(this)"
                        id = "` + idForCloseButton + `"
                        class="absolute w-5 h-5 p-2 text-white bg-red-500 rounded-full right-2 top-3 hover:bg-red-800"></button>
                </div>

                <div class="flex">
                    <div class="flex flex-wrap items-center w-40 px-3 bg-gray-300 pointer-events-none sm:text-lg rounded-l-md dark:bg-gray-700">Material Name</div>
                    <input type="text" required name="material" id="url" value="` + materialDesription +
                `" placeholder="` +
                materialDesription + `" class="flex flex-1 p-3 border sm:text-lg rounded-r-md focus:ring-inset dark:border-gray-700 dark:text-gray-100 dark:bg-gray-800 focus:ring-violet-400" readonly>
                </div>

                <div class="flex">
                    <div class="flex flex-wrap items-center w-40 px-3 font-semibold bg-gray-300 pointer-events-none sm:text-lg rounded-l-md dark:bg-gray-700">Jumlah Keluar</div>
                    <input type="text" required name="material" id="url" value="` + jumlahKeluar + `" placeholder="` +
                jumlahKeluar + `" class="flex flex-1 p-3 border sm:text-lg rounded-r-md focus:ring-inset dark:border-gray-700 dark:text-gray-100 dark:bg-gray-800 focus:ring-violet-400" readonly>
                </div>
            </div>
            `;


            addedItems.appendChild(div);
        }
    </script>
</body>

</html>
