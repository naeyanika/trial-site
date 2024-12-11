<?php
ob_start(); // Start output buffering
session_start();
session_set_cookie_params(3600);

// Periksa apakah sesi masih aktif
if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity'] > 3600)) {
    // Sesi berakhir, logout pengguna
    session_destroy();
    header('Location: /login.html');
    exit();
}

// Perbarui waktu aktivitas sesi
$_SESSION['last_activity'] = time();

// Array untuk menyimpan username dan password
$users = [
    'joey' => 'admin',
    'audit' => 'audit'
];

$error = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = isset($_POST['username']) ? $_POST['username'] : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';
    
    if (isset($users[$username]) && $users[$username] === $password) {
        $_SESSION['username'] = $username;
        $_SESSION['logged_in'] = true;
        header('Location: /index.html'); 
        exit();
    } else {
        $error = "Username atau password salah!";
    }
}

include '../login.html'; // Adjust path to point to login.html outside of /api
ob_end_flush();
?>
