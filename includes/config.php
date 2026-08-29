<?php
// ==========================================
// ZAEEM PK 🇵🇰🙌🏻 - Configuration
// ==========================================

// Database
define('DB_HOST', 'localhost');
define('DB_NAME', 'zaeem_panel');
define('DB_USER', 'root');
define('DB_PASS', '');

// Firebase
define('FIREBASE_API_KEY', 'AIzaSyBkXx8LpXyXyXyXyXyXyXyXyXyXyXyXyXy');
define('FIREBASE_AUTH_DOMAIN', 'your-project.firebaseapp.com');
define('FIREBASE_DATABASE_URL', 'https://your-project-default-rtdb.firebaseio.com');
define('FIREBASE_PROJECT_ID', 'your-project');

// Telegram
define('TELEGRAM_BOT_TOKEN', '8602121637:AAFGuxZI7bdLYh-yeMpl97KjYNOmzptt8xE');
define('TELEGRAM_CHAT_ID', '6676795360');

// App
define('SITE_NAME', 'ZAEEM PK 🇵🇰🙌🏻');
define('ADMIN_PASSWORD', 'ZAEEM@2026');

// Session
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

error_reporting(0);
ini_set('display_errors', 0);
?>
