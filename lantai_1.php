<?php
session_start();

// Periksa apakah sesi telah dimulai
if (isset($_SESSION['userid'])) {
    // Sesi sudah ada, gunakan $_SESSION['userid']
    $userID = $_SESSION['userid'];
}
else {
    // Jika sesi belum dimulai atau 'userid' belum diset, sesuaikan dengan logika Anda
    // Misalnya, alihkan pengguna ke halaman login atau lakukan tindakan lainnya
    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lantai 1 - Sistem Kinerja Office Boy - BPRS HIK MCI Yogyakarta</title>
    <!-- Tambahkan link Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css">
    <!-- Tambahkan link AdminLTE CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/3.1.0/css/adminlte.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="icon" href="../img/logo_white.png" type="image/png">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.10/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.dataTables.min.css">
    <link rel="icon" href="./img/logo_white.png" type="image/png">
    <style>
        /* Mengubah warna latar belakang header tabel */
        #officeboyTable thead th {
            background-color: #007BFF;
            color: white;
        }

        /* Mengubah warna latar belakang baris ganjil */
        #officeboyTable tbody tr:nth-child(odd) {
            background-color: #f2f2f2;
        }

        /* Mengubah warna latar belakang baris genap */
        #officeboyTable tbody tr:nth-child(even) {
            background-color: #dddddd;
        }

        /* Mengatur padding pada sel tabel */
        #officeboyTable tbody td {
            padding: 8px;
        }

        /* Mengubah warna latar belakang sel saat dihover */
        #officeboyTable tbody tr:hover {
            background-color: #ffdb58;
        }
    </style>
    <style>
        .myButton {
            box-shadow: 3px 4px 0px 0px #899599;
            background:linear-gradient(to bottom, #ededed 5%, #bab1ba 100%);
            background-color:#ededed;
            border-radius:15px;
            border:1px solid #d6bcd6;
            display:inline-block;
            cursor:pointer;
            color:#3a8a9e;
            font-family:Arial;
            font-size:17px;
            padding:7px 25px;
            text-decoration:none;
            text-shadow:0px 1px 0px #e1e2ed;
        }
        .myButton:hover {
            background:linear-gradient(to bottom, #bab1ba 5%, #ededed 100%);
            background-color:#bab1ba;
        }
        .myButton:active {
            position:relative;
            top:1px;
        }
    </style>
</head>
<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
            </ul>
            <?php include 'header.php'; ?>
        </nav>
        
        <?php include 'sidebar.php'; ?>
        <div class="content-wrapper">
            <!-- Konten Utama -->
            <main class="content">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Detail Lantai 1</li>
                    </ol>
                </nav>
                <?php
                if (isset($_GET['page'])) {
                    $page = $_GET['page'];
                    if ($page === 'settingdetailsarea' && basename($_SERVER['PHP_SELF']) !== 'settingdetailsarea.php') {
                        header("Location: settingdetailsarea.php");
                        exit;
                    }
                    elseif ($page === 'allstaff' && basename($_SERVER['PHP_SELF']) !== 'allstaff.php') {
                        header("Location: allstaff.php");
                        exit;
                    }
                    elseif ($page === 'settingarea' && basename($_SERVER['PHP_SELF']) !== 'settingarea.php') {
                        header("Location: settingarea.php");
                        exit;
                    }
                    elseif ($page === 'alltaskdescription' && basename($_SERVER['PHP_SELF']) !== 'alltaskdescription.php') {
                        header("Location: alltaskdescription.php");
                        exit;
                    }
                    elseif ($page === 'lantai_1' && basename($_SERVER['PHP_SELF']) !== 'lantai_1.php') {
                        header("Location: lantai_1.php");
                        exit;
                    }
                    elseif ($page === 'lantai_2' && basename($_SERVER['PHP_SELF']) !== 'lantai_2.php') {
                        header("Location: lantai_2.php");
                        exit;
                    }
                    // elseif ($page === 'Area_Parkir' && basename($_SERVER['PHP_SELF']) !== 'Area_Parkir.php') {
                    //     header("Location: Area_Parkir.php");
                    //     exit;
                    // }
                    // elseif ($page === 'ruangdireksi' && basename($_SERVER['PHP_SELF']) !== 'ruangdireksi.php') {
                    //     header("Location: ruangdireksi.php");
                    //     exit;
                    // }
                    elseif ($page === 'dashboard' && basename($_SERVER['PHP_SELF']) !== 'dashboard.php') {
                        // echo "<h2>Dashboard Sistem Report</h2>";
                        header("Location: dashboard.php");
                        exit;
                    }
                }
                ?>
                <div class="container">
                        <div class="card">
                            <div class="card-body" id="resultsContent">
                                <h2><i class="fa fa-book"></i> Detail Lantai 1</h2>
                                
                                <p>Please, Scan Here...</p>
                                <!-- <div align="center"><img src="img/lantai_1.png" alt=""></div><br> -->
                                <?php
                                include('phpqrcode/qrlib.php');
                                $server = "192.168.1.184";
                                $username = "root";
                                $password = "";
                                $database = "db_mobile_collection";

                                // Buat koneksi ke server
                                $connectionServernew = new mysqli($server, $username, $password, $database);

                                // Periksa koneksi ke server
                                if ($connectionServernew->connect_error) {
                                    $hasil['STATUS'] = "000199";
                                    die(json_encode($hasil));
                                }

                                // Query SQL
                                $sqlQuery = "SELECT 
                                t.id,
                                sa.AREA AS setting_area,
                                sda.details_area AS setting_details_area,
                                t.job_name,
                                t.create_date,
                                t.create_time,
                                t.status_watch,
                                j.time_start,
                                j.time_ended,
                                -- s.staff_name,
                                t.photo_document,
                                t.staff_id
                                FROM db_mobile_collection.tasks t
                                LEFT JOIN db_mobile_collection.setting_area sa ON t.area_id = sa.settingarea_id
                                LEFT JOIN db_mobile_collection.settingdetails_area sda ON t.detail_area_id = sda.settingdetailsarea_id
                                LEFT JOIN db_mobile_collection.jobdesk j ON t.id = j.jobs_id
                                WHERE sa.AREA = 'LANTAI SATU'";

                                // Eksekusi query dan peroleh data
                                $result = $connectionServernew->query($sqlQuery);

                                // Periksa apakah query berhasil dijalankan
                                if (!$result) {
                                    die('Query Error: ' . $connectionServernew->error);
                                }
                                ?>
                                <div class="mb-3">
                                    <label for="checkboxList" class="form-label">Objective:</label><br>
                                    <?php
                                    // Memulai formulir
                                    echo '<form id="checkboxForm" enctype="multipart/form-data" action="save_data_lantai_1.php" method="post">';
                                    
                                    while ($row = $result->fetch_assoc()) {
                                        $dataForQRCode = json_encode($row); // Ubah data menjadi format JSON
                                        $filename = "qrcodes/qrcode_{$row['id']}.png"; // Nama file untuk menyimpan QR code

                                        // Generate QR code
                                        QRcode::png($dataForQRCode, $filename);

                                        echo "<div class='form-check'>";
                                        echo "<input class='form-check-input' type='checkbox' id='action{$row['id']}' name='actions[]' value='{$row['job_name']}'>";
                                        echo "<label class='form-check-label' for='action{$row['id']}'>{$row['job_name']}</label><br>";
                                        echo "<img src='{$filename}' alt='QR Code'><br>";
                                        echo "<div class='row'>";
                                        echo "<div class='col' align='center'>";
                                        echo "<label for=''>BEFORE</label>";
                                        echo "<input type='file' class='form-control' name='action{$row['id']}_before' accept='image/*' capture='camera'>";
                                        echo "<span class='file-status' id='before-status'></span>";
                                        echo "</div>";
                                        echo "<div class='col' align='center'>";
                                        echo "<label for=''>AFTER</label>";
                                        echo "<input type='file' class='form-control' name='action{$row['id']}_after' accept='image/*' capture='camera'>";
                                        echo "<span class='file-status' id='after-status'></span>";
                                        echo "</div>";
                                        echo "</div>";
                                        echo "</div><br><hr>";
                                    }
                                    // Tombol simpan
                                    echo "<div align='center'><button type='submit' class='myButton'>Simpan</button></div>";
                                    // Menutup formulir
                                    echo '</form>';
                                    ?>
                                </div>
                                <?php
                                // Menutup koneksi setelah selesai menggunakan
                                $connectionServernew->close();
                                ?>
                            </div>
                        </div>
                </div>
            </main>
        </div>
    </div>
    <?php include './footer.php'; ?>
    <!-- Tambahkan skrip Bootstrap dan AdminLTE JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/3.1.0/js/adminlte.min.js"></script>
    <script src="//cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
    <script src="phpqrcode/qrlib.php"></script>
    <!-- DataTables Buttons -->
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/2.0.1/js/dataTables.buttons.min.js"></script>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        $(document).ready(function() {
            // Tambahkan event click pada tombol pushmenu
            $('.nav-link[data-widget="pushmenu"]').on('click', function() {
                // Toggle class 'sidebar-collapse' pada elemen body
                $('body').toggleClass('sidebar-collapse');
            });
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Event listener untuk setiap perubahan pada checkbox
            $('input[name="actions[]"]').change(function () {
                var checkbox = this;
                var statusElement = checkbox.nextElementSibling.nextElementSibling; // Mendapatkan elemen span status

                // Memeriksa apakah checkbox dicentang atau tidak
                if (checkbox.checked) {
                    // Checkbox dicentang, tampilkan notifikasi ceklist hijau
                    statusElement.style.color = 'green';
                    statusElement.innerHTML = '&#10004; ' + checkbox.value;
                } else {
                    // Checkbox tidak dicentang, hapus notifikasi
                    statusElement.innerHTML = '';
                }
            });

            // Event submit pada formulir checkbox
            $('#checkboxForm').submit(function (e) {
                // Cegah pengiriman formulir ke server
                e.preventDefault();

                // Dapatkan nilai dari hasil scan
                const barcodeResult = $('#barcodeResult').val();

                // Dapatkan nilai checkbox yang dipilih
                const selectedActions = $('input[name="actions[]"]:checked').map(function () {
                    return this.value;
                }).get();

                // Dapatkan nilai file foto before dan after
                const beforeFiles = $('input[name^="action"]:file').filter(function (index) {
                    return this.name.endsWith("_before");
                });
                const afterFiles = $('input[name^="action"]:file').filter(function (index) {
                    return this.name.endsWith("_after");
                });

                // Validasi bahwa setiap tindakan memiliki file before dan after
                for (let i = 0; i < selectedActions.length; i++) {
                    const action = selectedActions[i];
                    const beforeFile = beforeFiles[i].files[0];
                    const afterFile = afterFiles[i].files[0];

                    if (!beforeFile || !afterFile) {
                        alert('Mohon unggah file "before" dan "after" untuk setiap tindakan.');
                        return;
                    }
                }

                // Mengirim data ke server
                sendDataToServer({
                    barcodeResult: barcodeResult,
                    selectedActions: selectedActions,
                    beforeFiles: beforeFiles,
                    afterFiles: afterFiles
                });
            });

            // Fungsi untuk mengirim data ke server
            function sendDataToServer(data) {
                // Contoh menggunakan Fetch API untuk mengirim data ke server
                fetch('save_data_lantai_1.php', {
                    method: 'POST',
                    body: data
                })
                .then(response => response.json())
                .then(result => {
                    console.log('Server response:', result);
                })
                .catch(error => {
                    console.error('Error sending data to server:', error);
                });
            }
        });
    </script>

</body>
</html>