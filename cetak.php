<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="custom.css">
    <title>Cetak</title>
</head>

<body class="text-sm font-bold">
    <script>
        var input = JSON.parse(localStorage.getItem('input'));

        function formatDate() {
            // from 2021-08-01 to 01 Agustus 2021

            var date = new Date(input.created_at);
            var month = date.getMonth() + 1;
            var day = date.getDate();
            var year = date.getFullYear();

            var monthNames = [
                "Januari", "Februari", "Maret",
                "April", "Mei", "Juni", "Juli",
                "Agustus", "September", "Oktober",
                "November", "Desember"
            ];

            var monthIndex = month - 1;
            var formattedDate = day + ' ' + monthNames[monthIndex] + ' ' + year;


            // set title of html
            document.title = input.letter_number + ' - ' + formattedDate;

            return formattedDate;
        }
    </script>

    <main class="max-w-[800px] mx-auto min-h-screen w-full p-5 border">
        <div class="flex items-start justify-between">
            <div class="font-bold">
                <h1 class="font-bold">PT PLN (PERSERO)</h1>
                <h1 class="font-bold">UIW RIAU DAN KEPRI</h1>
                <h1 class="font-bold">UP3 PEKANBARU</h1>
            </div>
            <div>
                <h1>
                    <script>
                        document.write('Pekanbaru, ' + formatDate(input.created_at));
                    </script>
                </h1>
            </div>
        </div>

        <div>
            <h1 class="text-lg text-center">SURAT KETERANGAN KELUAR</h1>
            <h1 class="text-lg text-center">NO : <script>
                    document.write(input.letter_number);
                </script>
            </h1>
        </div>

        <div class="space-y-2 mt-14">
            <div class="flex gap-2">
                <div class="w-40">KEPADA</div>
                <div>:
                    <script>
                        document.write(input.letter_to);
                    </script>
                </div>
            </div>

            <div class="flex gap-2">
                <div class="w-40">UNTUK</div>
                <div>:
                    <script>
                        document.write(input.letter_for);
                    </script>
                </div>
            </div>

            <div class="flex gap-2">
                <div class="w-40">BERDASARKAN</div>
                <div>:
                    <script>
                        document.write(input.based_on);
                    </script>
                </div>
            </div>

            <div class="flex gap-2">
                <div class="w-40">KONRAK/SKPP/FAKTUR</div>
                <div>:
                    <script>
                        document.write(input.contract_spk_factur);
                    </script>
                </div>
            </div>

            <div class="flex gap-2">
                <div class="w-40">TUG-8 & TUG-9</div>
                <div>:
                    <script>
                        document.write(input.tug8_tug9);
                    </script>
                </div>
            </div>

            <div class="flex gap-2">
                <div class="w-40">DIBAWA DENGAN</div>
                <div>:
                    <script>
                        document.write(input.delivery_with);
                    </script>
                </div>
            </div>
        </div>

        <p class="mt-5">
            Dengan penyerahan dari pada lembar asli Surat Keterangan Keluar Material sesuai dengan Delivery Order / TUG
            9 di atas harap Saudara berikan material dibawah ini dengan perincian sebagai berikut :
        </p>

        <table class="p-2 mt-5 space-y-2 text-sm border">
            <tr>
                <th class="w-40 p-3">NO</th>
                <th class="w-40 p-3">NOMOR</th>
                <th class="w-40 p-3">DESKRIPSI</th>
                <th class="w-40 p-3">TIPE</th>
                <th class="w-40 p-3">STN</th>
                <th class="w-40 p-3">JUMLAH</th>
                <th class="w-40 p-3">KETERANGAN</th>
            </tr>

            <script>
                var materials = input.barang_keluar;
                var no = 1;

                materials.forEach(material => {
                    let details = JSON.parse(material.details)
                    document.write(`
                <tr class="border">
                    <td class='p-2 font-normal text-center'>${no}</td>
                    <td class='p-2 font-normal text-center'>${details.material_code ?? ''}</td>
                    <td class='p-2 font-normal text-center'>${details.material_description ?? ''}</td>
                    <td class='p-2 font-normal text-center'>${details.valuation_type ?? ''}</td>
                    <td class='p-2 font-normal text-center'>${details.base_unit_of_measure ?? ''}</td>
                    <td class='p-2 font-normal text-center'>${material.jumlah_keluar ?? ''}</td>
                    <td class='flex flex-wrap p-2 font-normal text-center break-all'>
                        ${input.keterangan ?? ''}
                    </td>
                </tr>
                `);
                    no++;
                });
            </script>
        </table>

        <p class="mt-3 font-bold">
            Material yang sudah keluar dari Gudang PT.PLN (Persero) UP3 Pekabaru menjadi tanggung jawab pihak penerima barang.
        </p>

        <div class="flex mt-12 justify-evenly">
            <div class="flex flex-col items-center justify-between h-32">
                <div>
                    <h1 class="text-center">PEMERIKSA</h1>
                    <h1 class="text-center">
                        <script>
                            document.write(input.letter_to);
                        </script>
                    </h1>
                </div>
                <div>
                    (.....................)
                </div>
            </div>
            <div class="flex flex-col items-center justify-between h-32">
                <div>
                    <h1 class="text-center">PENERIMA</h1>
                    <h1 class="text-center">
                        <script>
                            document.write(input.delivery_with);
                        </script>
                    </h1>
                </div>
                <div>
                    (.....................)
                </div>
            </div>
            <div class="flex flex-col items-center justify-between h-32">
                <div>

                    <h1 class="text-center">PETUGAS GUDANG</h1>
                </div>
                <div>
                    (.....................)
                </div>
            </div>
        </div>
    </main>

    <script>
        // when rendering is done
        // print the page without headers and footers

        window.onload = function() {
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

        // after printed, redirect to the previous page
        window.onafterprint = function() {
            var input = JSON.parse(localStorage.getItem('input'));
            window.location.href = "done.php?input=" + JSON.stringify(input);
        }
    </script>
</body>

</html>
