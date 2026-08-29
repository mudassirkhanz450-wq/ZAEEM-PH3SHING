<?php
function getDevice($userAgent) {
    if (strpos($userAgent, 'iPhone') !== false) return '📱 iPhone';
    if (strpos($userAgent, 'Android') !== false) return '📱 Android';
    if (strpos($userAgent, 'iPad') !== false) return '📱 iPad';
    if (strpos($userAgent, 'Windows') !== false) return '💻 Windows';
    if (strpos($userAgent, 'Mac') !== false) return '💻 Mac';
    return '💻 Desktop';
}

function getLocation($ip) {
    try {
        $response = @file_get_contents("http://ip-api.com/json/$ip?fields=status,country,city");
        $data = json_decode($response, true);
        if ($data && $data['status'] === 'success') {
            return [
                'country' => $data['country'] ?? 'Unknown',
                'city' => $data['city'] ?? 'Unknown',
                'flag' => getCountryFlag($data['country'] ?? '')
            ];
        }
    } catch (Exception $e) {}
    return ['country' => 'Unknown', 'city' => 'Unknown', 'flag' => '🌍'];
}

function getCountryFlag($country) {
    $flags = [
        'Pakistan' => '🇵🇰', 'India' => '🇮🇳', 'United States' => '🇺🇸',
        'United Kingdom' => '🇬🇧', 'Canada' => '🇨🇦', 'Australia' => '🇦🇺',
        'Germany' => '🇩🇪', 'France' => '🇫🇷', 'Italy' => '🇮🇹',
        'Spain' => '🇪🇸', 'Brazil' => '🇧🇷', 'Mexico' => '🇲🇽',
        'Japan' => '🇯🇵', 'China' => '🇨🇳', 'South Korea' => '🇰🇷',
        'Russia' => '🇷🇺', 'South Africa' => '🇿🇦', 'Egypt' => '🇪🇬',
        'Saudi Arabia' => '🇸🇦', 'UAE' => '🇦🇪'
    ];
    return $flags[$country] ?? '🌍';
}

function generateSessionId() {
    return 'TT-' . strtoupper(substr(bin2hex(random_bytes(3)), 0, 6));
}

function isAdmin() {
    return isset($_SESSION['admin']) && $_SESSION['admin'] === true;
}

function redirect($url) {
    header("Location: $url");
    exit;
}

function getClientIP() {
    $ip = $_SERVER['HTTP_CLIENT_IP'] ?? $_SERVER['HTTP_X_FORWARDED_FOR'] ?? $_SERVER['REMOTE_ADDR'];
    return explode(',', $ip)[0];
}
?>
