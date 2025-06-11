<?php
$realLanding = "https://your-money-page.com";
$botLanding  = "https://example.com/blank.html";

$userAgent = strtolower($_SERVER['HTTP_USER_AGENT'] ?? '');
$bots = ['google', 'facebook', 'twitter', 'bing', 'semrush', 'ahrefs'];

$isBot = false;
foreach ($bots as $bot) {
    if (strpos($userAgent, $bot) !== false) {
        $isBot = true;
        break;
    }
}

if ($isBot) {
    header("Location: " . $botLanding);
    exit;
} else {
    header("Location: " . $realLanding);
    exit;
}
?>
