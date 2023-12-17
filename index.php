<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Kinerja OB - BPRS HIK MCI Yogyakarta</title>
    <!-- Tambahkan link Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css">
    <!-- Tambahkan link AdminLTE CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/3.1.0/css/adminlte.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.15/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="//cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.0.1/css/buttons.dataTables.min.css"/>
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.dataTables.min.css">
    <link rel="icon" href="img/logo_white.png" type="image/png">
    <style>
        #qrcodeCanvas {
            width: 100%;
            height: auto;
        }
    </style>
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
                        <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                    </ol>
                </nav>
                <?php
                if (isset($_GET['page'])) {
                    $page = $_GET['page'];
                    if ($page === 'reportlogofficeboy' && basename($_SERVER['PHP_SELF']) !== 'reportlogofficeboy.php') {
                        header("Location: reportlogofficeboy.php");
                        exit;
                    }
                    elseif ($page === 'allstaff' && basename($_SERVER['PHP_SELF']) !== 'allstaff.php') {
                        header("Location: allstaff.php");
                        exit;
                    }
                    elseif ($page === 'alltaskdescription' && basename($_SERVER['PHP_SELF']) !== 'alltaskdescription.php') {
                        header("Location: alltaskdescription.php");
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
                    elseif ($page === 'dashboard' && basename($_SERVER['PHP_SELF']) !== 'index.php') {
                        // echo "<h2>Dashboard Sistem Report</h2>";
                        header("Location: index.php");
                        exit;
                    }
                }
                ?>
                 
                <div class="container">
                    <div class="card">
                        <div class="card-body" id="resultsContent">
                            <center><h2>QR Code Scanner Si <b><span style="color:green">OB</span></b></h2></center>
                            <fieldset>
                                <video id="video" width="100%" height="auto" style="max-width: 600px;"></video>
                            </fieldset>
                            <!-- <center><button id="startButton" class="myButton"><b>Start Camera</b></button></center> -->
                        </div>
                    </div><br>
                        
                </div>
            </main>
        </div>
    </div>
    <?php include './footer.php'; ?>
    <!-- Tambahkan skrip Bootstrap dan AdminLTE JS -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/3.1.0/js/adminlte.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <!-- <script src="https://cdn.rawgit.com/davidshimjs/qrcodejs/gh-pages/qrcode.min.js"></script> -->
    <script src="https://cdn.rawgit.com/cozmo/jsQR/master/dist/jsQR.js"></script>
    <!-- <script>
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
    </script> -->
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
        document.addEventListener('DOMContentLoaded', function() {
            const video = document.getElementById('video');
            const startButton = document.getElementById('startButton');

            // Menggunakan getUserMedia untuk mengakses kamera
            const startCamera = async () => {
                try {
                    const stream = await navigator.mediaDevices.getUserMedia({ video: {} });
                    video.srcObject = stream;
                } catch (error) {
                    console.error('Error accessing camera:', error);
                }
            };

            // Memulai kamera ketika tombol ditekan
            startButton.addEventListener('click', startCamera);

            // Memastikan untuk mematikan kamera ketika halaman ditutup
            window.addEventListener('beforeunload', () => {
                const stream = video.srcObject;
                const tracks = stream.getTracks();

                tracks.forEach(track => track.stop());
            });
        });

        // Memproses setiap frame dari video untuk mendeteksi QR code
        const processFrame = () => {
            const canvas = document.createElement('canvas');
            const context = canvas.getContext('2d');

            canvas.width = video.videoWidth;
            canvas.height = video.videoHeight;
            context.drawImage(video, 0, 0, canvas.width, canvas.height);

            const imageData = context.getImageData(0, 0, canvas.width, canvas.height);
            const code = jsQR(imageData.data, canvas.width, canvas.height);

            if (code) {
                console.log('QR Code detected:', code.data);

                // Lakukan sesuatu dengan data QR code, misalnya arahkan ke halaman terkait
                window.location.href = code.data;
            }

            // Berlanjut ke frame berikutnya
            requestAnimationFrame(processFrame);
        };

        // Memulai proses frame
        startButton.addEventListener('click', () => {
            startCamera();
            requestAnimationFrame(processFrame);
        });
    </script>
</body>
</html>
