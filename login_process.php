<?php
include 'koneksibaru.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Gunakan prepared statement untuk mencegah SQL Injection
    $query = "SELECT userid, username, password, salt, user_role FROM db_mobile_collection.staff WHERE username = ?";
    $stmt = $connectionServernew->prepare($query);

    if (!$stmt) {
        die(json_encode(array('status' => 'error', 'message' => $connectionServernew->error)));
    }

    $stmt->bind_param("s", $username);

    if (!$stmt->execute()) {
        die(json_encode(array('status' => 'error', 'message' => $stmt->error)));
    }

    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        $storedPassword = $user['password'];
        $salt = $user['salt'];

        // Verifikasi kata sandi
        if (password_verify($password . $salt, $storedPassword)) {
            // Simpan informasi pengguna di sesi
            session_start();
            $_SESSION["userid"] = $user['userid'];
            $_SESSION["username"] = $user['username'];
            $_SESSION["user_role"] = $user['user_role'];

            // Redirect sesuai dengan peran pengguna
            if ($user['user_role'] == 'Superadmin') {
                header("Location: dashboard.php");
            } elseif ($user['user_role'] == 'Staff') {
                header("Location: dashboard.php");
            } else {
                // Peran pengguna tidak valid
                echo json_encode(array('status' => 'error', 'message' => 'Invalid user role'));
            }

            exit;
        } else {
            echo json_encode(array('status' => 'error', 'message' => 'Invalid password'));
        }
    } else {
        echo json_encode(array('status' => 'error', 'message' => 'User not found'));
    }

    $stmt->close();
    $connectionServernew->close();
} else {
    // Tangani metode selain POST jika diperlukan
    echo json_encode(array('status' => 'error', 'message' => 'Invalid request method'));
}
?>
