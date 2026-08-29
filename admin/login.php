<?php
session_start();
require_once '../includes/config.php';
require_once '../includes/functions.php';

if (isAdmin()) {
    redirect('index.php');
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $password = $_POST['password'] ?? '';
    if ($password === ADMIN_PASSWORD) {
        $_SESSION['admin'] = true;
        redirect('index.php');
    } else {
        $error = 'Invalid credentials';
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ZAEEM PK — Admin Login</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            background: #0A0A0A;
            font-family: 'Segoe UI', Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }
        .login-box {
            background: #141414;
            padding: 40px;
            border-radius: 15px;
            border: 1px solid #FFD700;
            text-align: center;
            max-width: 400px;
            width: 100%;
        }
        .login-box .icon { font-size: 60px; display: block; margin-bottom: 10px; }
        .login-box h1 {
            font-size: 28px;
            background: linear-gradient(45deg, #FFD700, #FF6B00);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        .login-box p { color: #888; margin: 10px 0 20px; }
        .login-box input {
            width: 100%;
            padding: 14px;
            background: #0A0A0A;
            border: 1px solid #2A2A4A;
            border-radius: 10px;
            color: #fff;
            font-size: 16px;
            margin-bottom: 15px;
        }
        .login-box input:focus { outline: none; border-color: #FFD700; }
        .login-box button {
            width: 100%;
            padding: 14px;
            background: linear-gradient(45deg, #FFD700, #FF6B00);
            border: none;
            border-radius: 10px;
            color: #000;
            font-weight: 700;
            font-size: 16px;
            cursor: pointer;
        }
        .login-box button:hover { transform: scale(1.02); }
        .error { color: #FF2D55; margin-bottom: 10px; }
        .footer { margin-top: 15px; color: #333; font-size: 12px; }
    </style>
</head>
<body>
    <div class="login-box">
        <span class="icon">💀</span>
        <h1>ZAEEM PK</h1>
        <p>🇵🇰🙌🏻 Admin Login</p>
        <?php if ($error) echo '<p class="error">' . $error . '</p>'; ?>
        <form method="POST">
            <input type="password" name="password" placeholder="Enter Password" required>
            <button type="submit"><i class="fas fa-unlock"></i> Access Panel</button>
        </form>
        <div class="footer">© 2026 ZAEEM PK</div>
    </div>
</body>
</html>
