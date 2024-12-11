<?php
ob_start();

// Start session as early as possible
session_start();

// Set session parameters (moved after session_start())
session_set_cookie_params(3600);

// Initialize session timeout check
if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity'] > 3600)) {
    // Session expired, logout user
    session_destroy();
    header('Location: /login.html');
    exit();
}

// Update session activity time
$_SESSION['last_activity'] = time();

// User authentication
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
        
        // Clear any buffered output
        ob_end_clean();
        
        header('Location: /index.html');
        exit();
    } else {
        $error = "Username atau Password Salah";
    }
}

// Absolute path handling
$login_html_path = $_SERVER['DOCUMENT_ROOT'] . '/login.html';

if (file_exists($login_html_path)) {
    include $login_html_path;
} else {
    echo "Salah nama pengguna atau kata sandi, silakan kontak administrator!";
}

ob_end_flush();
?>
