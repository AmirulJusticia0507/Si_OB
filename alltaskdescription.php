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
    <title>Laporan Sistem Kinerja Office Boy BPRS HIK MCI Yogyakarta</title>
    <!-- Tambahkan link Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css">
    <!-- Tambahkan link AdminLTE CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/3.1.0/css/adminlte.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha384-hz0ht0zjPGYO5bVwY1+biF9cCUF/4MWLDbPHlOrpz5qL5cfMyB2sAeIrMC2cdwMO" crossorigin="anonymous"> -->
    <link rel="icon" href="img/logo_white.png" type="image/png">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.15/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="//cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.0.1/css/buttons.dataTables.min.css"/>
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.dataTables.min.css">
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <!-- <link rel="icon" href="img/logo_white.png" type="image/png"> -->
    <style>
        .myButton {
            box-shadow: 3px 4px 0px 0px #899599;
            background: linear-gradient(to bottom, #ededed 5%, #bab1ba 100%);
            background-color: #ededed;
            border-radius: 15px;
            border: 1px solid #d6bcd6;
            display: inline-block;
            cursor: pointer;
            color: #3a8a9e;
            font-family: Arial;
            font-size: 17px;
            padding: 7px 25px;
            text-decoration: none;
            text-shadow: 0px 1px 0px #e1e2ed;
        }

        .myButton:hover {
            background: linear-gradient(to bottom, #bab1ba 5%, #ededed 100%);
            background-color: #bab1ba;
        }

        .myButton:active {
            position: relative;
            top: 1px;
        }
    </style>
    <style>
        div.dataTables_wrapper {
            width: auto;
            margin: 0 auto;
        }

        /* Atur gaya tabel */
        table.table {
            width: 100%;
            border-collapse: collapse;
        }

        /* Atur batas sel di tabel */
        table.table th,
        table.table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        /* Atur latar belakang header tabel */
        table.table th {
            background-color: #f2f2f2;
        }

        /* Beri warna latar belakang pada baris ganjil */
        table.table tbody tr:nth-child(odd) {
            background-color: #f9f9f9;
        }

        /* Hindari pemotongan teks dalam sel */
        table.table th,
        table.table td {
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            max-width: 300px;
            /* Sesuaikan dengan kebutuhan Anda */
        }
    </style>
      <style>
    /* Styling for the button */
    .refresh-button {
      padding: 10px;
      background-color: #4CAF50;
      color: white;
      border: none;
      border-radius: 5px;
      cursor: pointer;
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
                        <li class="breadcrumb-item active" aria-current="page">Setting Tasks</li>
                    </ol>
                </nav>
                <?php
                if (isset($_GET['page'])) {
                    $page = $_GET['page'];
                    if ($page === 'alltaskdescription' && basename($_SERVER['PHP_SELF']) !== 'alltaskdescription.php') {
                        header("Location: alltaskdescription.php");
                        exit;
                    }
                    elseif ($page === 'allstaff' && basename($_SERVER['PHP_SELF']) !== 'allstaff.php') {
                        header("Location: allstaff.php");
                        exit;
                    }
                    elseif ($page === 'settingdetailsarea' && basename($_SERVER['PHP_SELF']) !== 'settingdetailsarea.php') {
                        header("Location: settingdetailsarea.php");
                        exit;
                    }
                    elseif ($page === 'settingarea' && basename($_SERVER['PHP_SELF']) !== 'settingarea.php') {
                        header("Location: settingarea.php");
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
                            <?php
                            $server = "192.168.1.184";
                            $username = "root";
                            $password = "";
                            $database = "db_mobile_collection";

                            // Buat koneksi ke server
                            $connectionServernew = new mysqli($server, $username, $password, $database);

                            // Periksa koneksi ke server
                            if ($connectionServernew->connect_error) {
                                die('Connection failed: ' . $connectionServernew->connect_error);
                            }

                            $action = isset($_GET['id']) ? 'edit' : 'add';
                            $taskId = isset($_GET['id']) ? $_GET['id'] : null;

                            // Jika ini adalah aksi edit, ambil data task dari database
                            if ($action === 'edit' && $taskId) {
                                // Gunakan prepared statement untuk mencegah SQL Injection
                                $query = "SELECT * FROM db_mobile_collection.tasks WHERE id = ?";
                                $stmt = $connectionServernew->prepare($query);
                                $stmt->bind_param("s", $taskId);
                                $stmt->execute();

                                // Periksa apakah query dieksekusi dengan benar
                                if ($stmt === false) {
                                    die('Error executing the query: ' . $connectionServernew->error);
                                }

                                // Periksa apakah ada hasil yang ditemukan
                                $result = $stmt->get_result();
                                if ($result->num_rows > 0) {
                                    $taskData = $result->fetch_assoc();
                                } else {
                                    die('No data found for the given task id');
                                }

                                $stmt->close();
                            }

                            // Tutup koneksi setelah selesai menggunakan
                            $connectionServernew->close();
                            ?>

                            <h2><i class="fa fa-cogs"></i> Setting Tasks</h2><br><hr>
                                <?php
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

                                // Ambil data dari database dengan JOIN
                                $query = "SELECT 
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
                                -- LEFT JOIN db_mobile_collection.staff s ON t.userid = s.userid
                                ";

                                // Eksekusi query dan periksa hasil
                                $result = $connectionServernew->query($query);

                                if (!$result) {
                                    die('Query Error: ' . $connectionServernew->error);
                                }

                                // Fetch the results only if the query was successful
                                if ($result->num_rows > 0) {
                                    // Initialize $settingArea and $settingDetailsArea before the loop
                                    $settingArea = "";
                                    $settingDetailsArea = "";

                                    // Loop through the query results to get the last row
                                    while ($row = $result->fetch_assoc()) {
                                        $settingArea = $row['setting_area'];
                                        $settingDetailsArea = $row['setting_details_area'];
                                    }
                                }
                                ?>

                                <div class="modal fade" id="qrCodeModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">QR Code</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <img id="qrCodeImage" src="" alt="QR Code" style="width: 200px; height:auto" class="img-fluid">
                                                    </div>
                                                    <div class="col-md-6">
                                                        <h3>Description:</h3>
                                                        <p>Lokasi (Area): <?php echo $settingArea; ?></p>
                                                        <p>Details Area: <?php echo $settingDetailsArea; ?></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <fieldset>
                                    <form id="addTaskForm" action="<?php echo $action === 'edit' ? 'edit_task.php?id=' . $taskId : 'add_task.php'; ?>" method="post" enctype="multipart/form-data">
                                            <div class="col mb-3">
                                                <label for="job_name" class="form-label">Nama Pekerjaan</label>
                                                <input type="text" class="form-control" id="job_name" name="job_name" value="<?php echo $action === 'edit' ? $taskData['job_name'] : ''; ?>" placeholder="masukkan detail Pekerjaan" required>
                                            </div><hr>
                                            <div class="row">
                                                <div class="col mb-3">
                                                    <label for="area">Lokasi (Area):</label>
                                                    <select class="form-select" id="area" name="area" required style="width: 100%;">
                                                        <option value="" disabled selected>Pilih Lokasi</option>
                                                    </select>
                                                </div>
                                                <div class="col mb-3">
                                                    <label for="detail_area">Detail Area:</label>
                                                    <select class="form-select" id="detail_area" name="detail_area" required style="width: 100%;">
                                                        <option value="" disabled selected>Pilih Detail Area</option>
                                                    </select>
                                                </div>
                                            </div><hr>
                                            <div class="col mb-3">
                                                <label>Jam Kerja:</label><br>

                                                <?php
                                                $server = "192.168.1.184";
                                                $username = "root";
                                                $password = "";
                                                $database = "db_mobile_collection";
                                                // Buat koneksi ke server
                                                $connectionServernew = new mysqli($server, $username, $password, $database);

                                                // Periksa koneksi ke server
                                                if ($connectionServernew->connect_error) {
                                                    die('Connection failed: ' . $connectionServernew->connect_error);
                                                }
                                                $query = "SELECT jobs_id, time_start, time_ended FROM db_mobile_collection.jobdesk";
                                                $result = $connectionServernew->query($query);
                                                while ($row = $result->fetch_assoc()) {
                                                    $start_time = $row['time_start'];
                                                    $end_time = $row['time_ended'];
                                                    $job_id = $row['jobs_id'];
                                                
                                                    $isChecked = isset($taskData['job_schedule']) && in_array($job_id, explode(',', $taskData['job_schedule']));
                                                
                                                    echo "<input type='checkbox' id='job_schedule_$job_id' name='job_schedule[]' value='$job_id' " . ($isChecked ? 'checked' : '') . ">";
                                                    echo "<label for='job_schedule_$job_id'>$start_time - $end_time</label><br>";
                                                }
                                                $connectionServernew->close();
                                                ?>
                                            </div>
                                        <div class="form-group">
                                            <button type="submit" class="myButton"><?php echo $action === 'edit' ? 'UPDATE' : 'SUBMIT'; ?></button>
                                            <button type="reset" class="btn btn-danger">CLEAR</button>
                                        </div>
                                    </form>
                                </fieldset><hr>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-body" id="resultsContent">
                                <button class="myButton" onclick="refreshPage()">Refresh</button><br><br>
                                <table id="tasksTable" class="display table table-bordered table-striped table-hover nowrap" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Lokasi (Area)</th>
                                            <th>Detail Area</th>
                                            <th nowrap>Job Desc</th>
                                            <th>Time</th>
                                            <th>Time Status</th>
                                            <th>Staff</th>
                                            <th>Time Start - Time Ended</th>
                                            <th>QR Code</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- PHP untuk menampilkan data dari database -->
                                        <?php
                                        // $loggedInUserId = isset($_SESSION['userid']) ? $_SESSION['userid'] : null;
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

                                        // Ambil data dari database dengan JOIN
                                        $query = "SELECT 
                                            t.id,
                                            sa.AREA AS setting_area,
                                            sda.details_area AS setting_details_area,
                                            t.job_name,
                                            t.create_date,
                                            t.create_time,
                                            t.status_watch,
                                            j.time_start,
                                            j.time_ended,
                                            s.staff_name,
                                            s.userid,
                                            t.photo_document,
                                            t.staff_id
                                        FROM db_mobile_collection.tasks t
                                        LEFT JOIN db_mobile_collection.setting_area sa ON t.area_id = sa.settingarea_id
                                        LEFT JOIN db_mobile_collection.settingdetails_area sda ON t.detail_area_id = sda.settingdetailsarea_id
                                        LEFT JOIN db_mobile_collection.jobdesk j ON t.id = j.jobs_id
                                        LEFT JOIN db_mobile_collection.staff s ON t.staff_id = s.userid
                                        ";
                                        $result = $connectionServernew->query($query);

                                        if (!$result) {
                                            die('Query Error: ' . $connectionServernew->error);
                                        }
                                        // $settingArea = '';
                                        $settingArea = "";
                                        $settingDetailsArea = "";
                                        // Loop untuk setiap baris data dan tampilkan sebagai JSON
                                        $nomorUrutTerakhir = 1;
                                        while ($row = $result->fetch_assoc()) {
                                            // Add staff information to the QR code URL
                                            $staff_id = $row['staff_id'];
                                            $qrCodeUrl = "generate_qr_code.php?id={$row['id']}&staff={$staff_id}";
                                            $settingArea = $row['setting_area'];
                                            $settingDetailsArea = $row['setting_details_area'];

                                            echo "<tr>";
                                            echo "<td>" . $nomorUrutTerakhir . "</td>";
                                            echo "<td>{$row['setting_area']}</td>";
                                            echo "<td>{$row['setting_details_area']}</td>";
                                            echo "<td nowrap>{$row['job_name']}</td>";
                                            $formattedDate = date('d-M-Y', strtotime($row['create_date']));
                                            echo "<td>{$formattedDate} {$row['create_time']}</td>";
                                            echo "<td>{$row['status_watch']}</td>";
                                            echo "<td>{$row['staff_name']}</td>";
                                            // Menghitung selisih waktu
                                            // $timeStart = strtotime($row['time_start']);
                                            // $timeEnded = strtotime($row['time_ended']);
                                            // $duration = $timeEnded - $timeStart;

                                            // // Format durasi ke dalam jam:menit:detik
                                            // $formattedDuration = gmdate("H:i:s", $duration);

                                            // Menampilkan selisih waktu
                                            // echo "<td>{$formattedDuration}</td>";
                                            echo "<td>{$row['time_start']} - {$row['time_ended']}</td>";
                                            echo "<td><img src='{$qrCodeUrl}' alt='QR Code'></td>";
                                            echo "<td>
                                                    <a href='alltaskdescription.php?action=edit&id={$row['id']}' class='btn btn-info btn-sm'><i class='fas fa-edit'></i> Edit</a>
                                                    <a href='delete_task.php?id={$row['id']}' class='btn btn-danger btn-sm'><i class='fas fa-trash'></i> Delete</a>
                                                    <button class='btn btn-success btn-sm' onclick='showQRCodeModal(\"$qrCodeUrl\")'> Generate QR Code</button>
                                                </td>";
                                            $nomorUrutTerakhir++;
                                            echo "</tr>";
                                        }
                                        
                                        echo "</div>";
                                        // Tutup koneksi setelah selesai menggunakan
                                        $connectionServernew->close();
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                </div>
            </main>
        </div>
    </div>

    <?php include './footer.php'; ?>
    <!-- Tambahkan skrip Bootstrap dan AdminLTE JS -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.15/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
    <script src="//cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
        
        <!-- Tambahkan link Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/3.1.0/js/adminlte.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.3/umd/popper.min.js"></script>
        
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/2.0.1/js/dataTables.buttons.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.html5.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <!-- <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.print.min.js"></script> -->
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script> -->
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/signature_pad/1.5.3/signature_pad.min.js"></script> -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(function () {
            $('#tasksTable').DataTable({
                responsive: true,
                scrollX: true,
                searching: true,
                lengthMenu: [10, 25, 50, 100],
                pageLength: 10,
                dom: 'lBfrtip',
                buttons: [
                    'copy', 'excel', 'pdf'
                ]
            });
        });
    </script>
    <script>
        function exportToExcel() {
            /* Ambil referensi tabel */
            var table = document.getElementById("transactionTable");
            /* Buat array data kosong untuk menyimpan data dari tabel */
            var data = [];
            /* Loop melalui setiap baris dan sel tabel */
            for (var i = 0; i < table.rows.length; i++) {
                var rowData = [];
                for (var j = 0; j < table.rows[i].cells.length; j++) {
                    rowData.push(table.rows[i].cells[j].innerText);
                }
                data.push(rowData);
            }
            /* Buat objek workbook dengan nama lembar kerja */
            var ws = XLSX.utils.aoa_to_sheet(data);
            var wb = XLSX.utils.book_new();
            XLSX.utils.book_append_sheet(wb, ws, "LembarKerja1");
            /* Simpan file Excel */
            var today = new Date();
            var dd = String(today.getDate()).padStart(2, '0');
            var mm = String(today.getMonth() + 1).padStart(2, '0'); // January is 0!
            var yyyy = today.getFullYear();
            today = dd + '-' + mm + '-' + yyyy;

            XLSX.writeFile(wb, "data_report_" + today + ".xlsx");
        }
    </script>
    <script>
        // JavaScript function to refresh the page
        function refreshPage() {
        location.reload(true);
        }
    </script>
    <script>
        $(document).ready(function () {
            // Mengambil data "Area" dari server menggunakan Ajax
            $.ajax({
                type: "GET",
                url: "get_area.php",
                dataType: "json",
                success: function (data) {
                    // Mengisi opsi pada select box "Area"
                    $("#area").empty();
                    $("#area").append('<option value="" disabled selected>Pilih Lokasi</option>');
                    $.each(data, function (key, value) {
                        $("#area").append('<option value="' + value.id + '">' + value.area + '</option>');
                    });

                    // Jika sedang dalam mode edit, pilih area yang sesuai
                    var selectedAreaId = "<?php echo ($action === 'edit') ? $taskData['area_id'] : ''; ?>";
                    if (selectedAreaId) {
                        $("#area").val(selectedAreaId).change();
                    }
                }
            });

            // Menangani perubahan pada pilihan "Area"
            $("#area").change(function () {
                var selectedAreaId = $(this).val();

                // Mengambil data "Detail Area" berdasarkan "Area" yang dipilih
                $.ajax({
                    type: "GET",
                    url: "get_detail_area.php",
                    dataType: "json",
                    data: { area_id: selectedAreaId },
                    success: function (data) {
                        // Mengisi opsi pada select box "Detail Area"
                        $("#detail_area").empty();
                        $("#detail_area").append('<option value="" disabled selected>Pilih Detail Area</option>');
                        $.each(data, function (key, value) {
                            $("#detail_area").append('<option value="' + value.settingdetailsarea_id + '">' + value.details_area + '</option>');
                        });

                        // Jika sedang dalam mode edit, pilih detail area yang sesuai
                        var selectedDetailAreaId = "<?php echo ($action === 'edit') ? $taskData['settingdetailsarea_id'] : ''; ?>";
                        if (selectedDetailAreaId) {
                            $("#detail_area").val(selectedDetailAreaId);
                        }
                    }
                });
            });

            // Jika sedang dalam mode edit, pilih waktu yang sesuai
            var selectedJobTask = "<?php echo ($action === 'edit') ? $taskData['job_task'] : ''; ?>";
            if (selectedJobTask) {
                $("#job_task").val(selectedJobTask);
            }
        });
    </script>
    <script>
        // JavaScript function to show the QR Code modal
        function showQRCodeModal(qrCodeUrl) {
            // Set the source of the QR Code image
            document.getElementById('qrCodeImage').src = qrCodeUrl;

            // Show the modal
            $('#qrCodeModal').modal('show');
        }
    </script>
    <script>
        $(document).ready(function() {
            // Tambahkan event click pada tombol pushmenu
            $('.nav-link[data-widget="pushmenu"]').on('click', function() {
                // Toggle class 'sidebar-collapse' pada elemen body
                $('body').toggleClass('sidebar-collapse');
            });
        });
    </script>
</body>
</html>