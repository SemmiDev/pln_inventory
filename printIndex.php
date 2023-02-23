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

        <main class="pt-6 bg-[#F7F8FC] w-full px-3">
            <div class="flex flex-col gap-5" id="hehe">
            </div>
            <div class="p-5 bg-white rounded-lg mt-11">
                <div class="container p-2 mx-auto sm:p-4 dark:text-gray-100">
                    <div class="overflow-x-auto">
                        <table class="min-w-full text-lg" border="1">
                            <colgroup>
                                <col>
                                <col>
                                <col>
                                <col>
                                <col>
                                <col>
                            </colgroup>
                            <thead class="dark:bg-gray-700">
                                <tr class="text-left">
                                    <th class="p-3">Code</th>
                                    <th class="p-3">Description</th>
                                    <th class="p-3">Group</th>
                                    <th class="p-3">Base Unit</th>
                                    <th class="p-3">Valuation Type</th>
                                    <th class="p-3">Stok SAP</th>
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
    <script>
        // when rendering is done
        // print the page without headers and footers


        // when onload
        window.onload = function() {
            let hehe = document.getElementById("hehe");
            let div1 = document.createElement("div");
            let div2 = document.createElement("div");
            div1.innerHTML = "Location Code : ";
            div2.innerHTML = "Location Name : ";
            hehe.appendChild(div1);
            hehe.appendChild(div2);

            document.querySelectorAll("*").forEach((e) => {
                e.style.fontSize = "8px";
            });

            // add config for remote header and footer
            var config = {
                header: {
                    height: "0mm",
                },
                footer: {
                    height: "0mm",
                },
            };

            // print the page
            window.print();
        }

        // when print is done
        // redirect to the original page
        window.onafterprint = function() {
            window.location.href = "index.php";
        }
    </script>
</body>

</html>
