<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ZAEEM PK 🇵🇰🙌🏻</title>
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
        .landing {
            text-align: center;
            padding: 40px;
            max-width: 600px;
        }
        .logo { font-size: 80px; margin-bottom: 10px; }
        h1 {
            font-size: 48px;
            background: linear-gradient(45deg, #FFD700, #FF6B00, #FFD700);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            animation: goldPulse 3s ease-in-out infinite;
        }
        @keyframes goldPulse {
            0%, 100% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
        }
        .subtitle { color: #888; font-size: 18px; margin: 10px 0 30px; }
        .btn-group { display: flex; gap: 15px; justify-content: center; flex-wrap: wrap; }
        .btn {
            padding: 14px 40px;
            border-radius: 10px;
            font-weight: 700;
            font-size: 16px;
            text-decoration: none;
            transition: all 0.3s;
            display: inline-flex;
            align-items: center;
            gap: 10px;
        }
        .btn-admin {
            background: linear-gradient(45deg, #FFD700, #FF6B00);
            color: #000;
        }
        .btn-admin:hover { transform: scale(1.05); }
        .btn-user {
            background: transparent;
            color: #00F5FF;
            border: 2px solid #00F5FF;
        }
        .btn-user:hover { background: #00F5FF; color: #000; transform: scale(1.05); }
        .footer { margin-top: 40px; color: #333; font-size: 13px; }
        .footer i { color: #FF2D55; }
    </style>
</head>
<body>
    <div class="landing">
        <div class="logo">💀</div>
        <h1>ZAEEM PK 🇵🇰🙌🏻</h1>
        <p class="subtitle">TikTok Security Platform</p>
        <div class="btn-group">
            <a href="admin/login.php" class="btn btn-admin"><i class="fas fa-user-shield"></i> Admin Panel</a>
            <a href="user/" class="btn btn-user"><i class="fas fa-link"></i> User Panel</a>
        </div>
        <div class="footer"><i class="fas fa-skull"></i> © 2026 ZAEEM PK</div>
    </div>
</body>
</html>
