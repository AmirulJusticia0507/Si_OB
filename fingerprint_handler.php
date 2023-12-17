<?php
session_start();

include 'koneksibaru.php'; // Ganti dengan file koneksi database Anda

$fingerprintEnabled = true;

// Proses login hanya jika fingerprint diaktifkan
if ($fingerprintEnabled && $_SERVER["REQUEST_METHOD"] === "POST") {
    // Ambil nilai fingerprint dari data POST
    $fingerprint = htmlspecialchars($_POST["fingerprint"]);

    // Hindari SQL Injection dengan menggunakan prepared statement
    $stmt = $connectionServernew->prepare("SELECT userid, staff_name, device_name, fingerprint_data, user_blokir FROM db_mobile_collection.staff WHERE fingerprint_data = ?");
    $stmt->bind_param("s", $fingerprint);
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
                header("Location: index.php");
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
        // Pengguna dengan fingerprint tersebut tidak ditemukan
        $loginError = "Fingerprint tidak ditemukan. Silakan coba lagi.";
    }

    $stmt->close();
}

$connectionServernew->close();
?>
