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
    <title>Setting Area Office Boy BPRS HIK MCI Yogyakarta</title>
    <!-- Tambahkan link Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css">
    <!-- Tambahkan link AdminLTE CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/3.1.0/css/adminlte.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="icon" href="../img/logo_white.png" type="image/png">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.15/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="//cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.0.1/css/buttons.dataTables.min.css"/>
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.dataTables.min.css">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="icon" href="img/logo_white.png" type="image/png">
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
                        <li class="breadcrumb-item active" aria-current="page">Setting Area</li>
                    </ol>
                </nav>
                <?php
                if (isset($_GET['page'])) {
                    $page = $_GET['page'];
                    if ($page === 'settingarea' && basename($_SERVER['PHP_SELF']) !== 'settingarea.php') {
                        header("Location: settingarea.php");
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
                            <h2><i class="fa fa-wrench"></i> Setting Area</h2><br><hr>
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
                            
                            $action = isset($_GET['settingarea_id']) ? 'edit' : 'add';
                            $area_id = isset($_GET['settingarea_id']) ? $_GET['settingarea_id'] : null;
                            
                            // Jika ini adalah aksi edit, ambil data task dari database
                            if ($action === 'edit' && $area_id) {
                                // Gunakan prepared statement untuk mencegah SQL Injection
                                $query = "SELECT * FROM db_mobile_collection.setting_area WHERE settingarea_id = ?";
                                $stmt = $connectionServernew->prepare($query);
                                $stmt->bind_param("s", $area_id);
                                $stmt->execute();
                            
                                // Periksa apakah query dieksekusi dengan benar
                                if ($stmt === false) {
                                    die('Error executing the query: ' . $connectionServernew->error);
                                }
                            
                                // Periksa apakah ada hasil yang ditemukan
                                $result = $stmt->get_result();
                                if ($result->num_rows > 0) {
                                    $areaData = $result->fetch_assoc();
                                } else {
                                    die('No data found for the given settingarea_id');
                                }
                            
                                $stmt->close();
                            }
                            
                            // Tutup koneksi setelah selesai menggunakan
                            $connectionServernew->close();                                                                                                            
                            ?>
                            <fieldset>
                                <form id="addTaskForm" action="<?php echo $action === 'edit' ? 'edit_area.php?settingarea_id=' . $area_id : 'add_area.php'; ?>" method="post" enctype="multipart/form-data">
                                    <div class="col mb-3">
                                        <label for="area" class="form-label">Nama Area</label>
                                        <!-- <input type="text" class="form-control" id="area" name="area" oninput="validateInput()" value="<?php echo $action === 'edit' ? $areaData['area'] : ''; ?>" required placeholder="lokasi area" style="width: 100%;" pattern="^[A-Za-z]+$"> -->
                                        <input type="text" class="form-control" id="area" name="area" value="<?php echo $action === 'edit' ? $areaData['area'] : ''; ?>" required placeholder="lokasi area" style="width: 100%;" oninput="validateInput()">
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="myButton"><?php echo $action === 'edit' ? 'UPDATE' : 'SUBMIT'; ?></button>
                                        <button type="reset" class="btn btn-danger">CLEAR</button>
                                    </div>
                                </form>
                            </fieldset><hr>
                            <button class="myButton" onclick="refreshPage()">Refresh</button><br><br>
                            <table id="tasksTable" class="display table table-bordered table-striped table-hover nowrap" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th nowrap>Nama Area</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- PHP untuk menampilkan data dari database -->
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

                                    // Ambil data dari database
                                    $query = "SELECT * FROM db_mobile_collection.setting_area";
                                    $result = $connectionServernew->query($query);

                                    // Loop untuk setiap baris data dan tampilkan sebagai JSON
                                    $nomorUrutTerakhir = 1;
                                    while ($row = $result->fetch_assoc()) {
                                        echo "<tr>";
                                        echo "<td>" . $nomorUrutTerakhir . "</td>";
                                        echo "<td nowrap>{$row['area']}</td>";
                                        echo "<td>
                                                <a href='settingarea.php?action=edit&settingarea_id={$row['settingarea_id']}' class='btn btn-info btn-sm'>Edit</a>
                                                <a href='delete_area.php?settingarea_id={$row['settingarea_id']}' class='btn btn-info btn-sm'>Delete</a>
                                            </td>";
                                        $nomorUrutTerakhir++;
                                        echo "</tr>";
                                    }                                                                        
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/signature_pad/1.5.3/signature_pad.min.js"></script>
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
        // JavaScript function to refresh the page
        function refreshPage() {
        location.reload(true);
        }
    </script>
    <script>
    function validateInput() {
        var inputArea = document.getElementById("area");

        // Mengganti nilai input menjadi huruf besar
        inputArea.value = inputArea.value.toUpperCase();

        // Menghilangkan karakter yang bukan huruf besar atau spasi
        inputArea.value = inputArea.value.replace(/[^A-Z\s]/g, '');
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