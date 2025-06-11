<?php
$realLanding = "https://your-money-page.com";
$botLanding  = "https://example.com/blank.html";

// Optional IP Whitelist
$whitelist = ['123.123.123.123', '8.8.8.8']; // Add safe IPs here

$visitorIP = $_SERVER['REMOTE_ADDR'] ?? 'UNKNOWN';
$userAgent = strtolower($_SERVER['HTTP_USER_AGENT'] ?? '');
$time = date("Y-m-d H:i:s");
$isBot = false;

$bots = ['google', 'facebook', 'twitter', 'bing', 'semrush', 'ahrefs'];

foreach ($bots as $bot) {
    if (strpos($userAgent, $bot) !== false) {
        $isBot = true;
        break;
    }
}

$isWhitelisted = in_array($visitorIP, $whitelist);

// Logging
$log = "[".$time."] IP: ".$visitorIP." | UA: ".$userAgent." | TYPE: ";
$log .= $isWhitelisted ? "WHITELIST" : ($isBot ? "BOT" : "HUMAN");
file_put_contents("logs.txt", $log . "\n", FILE_APPEND);

// Redirect logic
if ($isWhitelisted || !$isBot) {
    header("Location: " . $realLanding);
    exit;
} else {
    header("Location: " . $botLanding);
    exit;
}
?>
