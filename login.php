<?php
session_start();

include 'koneksibaru.php';

$fingerprintEnabled = true;
$loginError = "";

// Proses login hanya jika fingerprint diaktifkan dan data fingerprint dikirimkan melalui metode POST
if ($fingerprintEnabled && $_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["fingerprint"])) {
    // Ambil nilai username dan password dari data POST
    $username = htmlspecialchars($_POST["username"]);
    $password = htmlspecialchars($_POST["password"]);
    $fingerprint = htmlspecialchars($_POST["fingerprint"]);

    // Hindari SQL Injection dengan menggunakan prepared statement
    $stmt = $connectionServernew->prepare("SELECT userid, staff_name, device_name, fingerprint_data, user_blokir FROM db_mobile_collection.staff WHERE username = ? AND PASSWORD = ?");
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows == 1) {
        // Data pengguna ditemukan
        $stmt->bind_result($userid, $staff_name, $device_name, $storedFingerprint, $user_blokir);
        $stmt->fetch();

        if ($fingerprint === $storedFingerprint) {
            // Fingerprint cocok
            if ($user_blokir == 0) {
                // Akun tidak diblokir, izinkan login
                $_SESSION["userid"] = $userid;
                $_SESSION["staff_name"] = $staff_name;
                $_SESSION["device_name"] = $device_name;
                $_SESSION["fingerprint"] = $fingerprint;

                // Redirect ke halaman lain setelah login berhasil
                header("Location: dashboard.php");
                exit;
            } else {
                // Akun diblokir
                $loginError = "Akun Anda telah diblokir. Hubungi administrator untuk informasi lebih lanjut.";
            }
        } else {
            // Fingerprint tidak cocok
            $loginError = "Fingerprint tidak valid. Silakan coba lagi";
        }
    } else {
        // Pengguna dengan kombinasi username dan password tersebut tidak ditemukan
        $loginError = "Username dan/atau password tidak valid. Silakan coba lagi.";
    }

    $stmt->close();
}

$connectionServernew->close();
?>

<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=yes">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <link rel="stylesheet" href="fonts/icomoon/style.css">

    <link rel="stylesheet" href="css/owl.carousel.min.css">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    
    <!-- Style -->
    <link rel="stylesheet" href="css/style.css">

    <link rel="icon" href="img/logo_white.png" type="image/png">
    <title>Mobile Collection BPRS HIK MCI</title>
    <style>
        .progress {
            display: none;
            margin-top: 10px;
        }
        .progress-bar {
            width: 0;
        }
    </style>
</head>
<body>
<div class="content">
    <div class="container">
        <div class="row">
            <div class="col-md-6 contents">
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="mb-4">
                            <?php if (!empty($loginError)): ?>
                                <div class="alert alert-danger" role="alert">
                                    <?= $loginError; ?>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            <?php endif; ?>
                            <div class="col-md-6" align="center">
                                <img src="img/logo_MCI-removebg-preview.png" alt="Image" class="img-fluid">
                            </div>
                            <center><h3>Sign In <br>
                            <b>Si OB</b></h3></center>
                        </div>
                        <!-- Formulir login dengan username, password, dan tombol fingerprint -->
                        <form id="loginForm" method="post" action="login_process.php">
                            <div class="form-group">
                                <input type="text" class="form-control" name="username" placeholder="Username" required>
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control" name="password" placeholder="Password" required>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <button type="submit" class="btn btn-primary btn-block custom-login-button">Login</button>
                                </div>
                                <div class="col">
                                    <button type="button" class="btn btn-primary btn-block custom-fingerprint-button" id="fingerprintButton"><i class="fas fa-fingerprint"></i></button>
                                </div>
                                <div id="fingerprintInfo" class="col-md-12 mt-2"></div>
                                <input type="hidden" id="fingerprint" name="fingerprint" value="">
                            </div>
                        </form>
                        <div class="progress">
                            <div class="progress-bar progress-bar-striped progress-bar-animated" id="progressBar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0;"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/@fingerprintjs/fingerprintjs@3"></script>
<script src="js/jquery-3.3.1.min.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/main.js"></script>
<!-- Tambahkan di bagian head HTML -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Fungsi untuk meminta izin notifikasi
        function requestNotificationPermission() {
            Notification.requestPermission().then(permission => {
                if (permission === 'granted') {
                    // Izin notifikasi diberikan, lakukan sesuatu (misalnya, tampilkan notifikasi)
                    showNotification('Izin Notifikasi Diberikan', 'Sekarang Anda akan menerima notifikasi fingerprint.');
                }
            });
        }

        // Fungsi untuk menampilkan notifikasi
        function showNotification(title, message) {
            new Notification(title, {
                body: message,
                icon: 'img/notification-removebg-preview.png' // Ganti dengan path ke ikon notifikasi Anda
            });
        }

        // Fungsi untuk menampilkan tombol fingerprint dan mendapatkan fingerprint saat tombol ditekan
        function showFingerprintModal() {
            const fpPromise = FingerprintJS.load();

            fpPromise
                .then(fp => fp.get())
                .then(result => {
                    // Menampilkan data fingerprint pada elemen dengan ID "fingerprintInfo"
                    document.getElementById("fingerprintInfo").innerText = "Fingerprint: " + result.visitorId;

                    // Mengirimkan data fingerprint ke server menggunakan AJAX
                    sendFingerprintToServer(result.visitorId);

                    document.getElementById("fingerprint").value = result.visitorId;

                    // Tampilkan notifikasi bahwa fingerprint berhasil dideteksi
                    showNotification('Fingerprint berhasil dideteksi. Melakukan login...');

                    // Jalankan submit form secara otomatis setelah mendapatkan fingerprint
                    document.getElementById("loginForm").submit();
                })
                .catch(error => console.error("Error getting fingerprint:", error));
        }

        // Jalankan fungsi fingerprint saat tombol fingerprint ditekan
        document.getElementById("fingerprintButton").addEventListener("click", function () {
            // Meminta izin notifikasi sebelum menjalankan fungsi fingerprint
            requestNotificationPermission();
            showFingerprintModal();
        });
    });
</script>

</body>
</html>
