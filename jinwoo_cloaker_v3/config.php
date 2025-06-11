<html><head><title>Jinwoo Cloaker Config</title>
<style>
body { font-family: Arial; background: #1a1a1a; color: #eee; padding: 40px; }
input, textarea { width: 100%; padding: 8px; margin: 5px 0; background: #2e2e2e; color: #fff; border: 1px solid #555; }
button { padding: 10px 20px; background: #00cc66; color: white; border: none; margin-top: 20px; }
</style>
</head><body>
<h2>🛡️ Jinwoo Cloaker Config (v3)</h2>

<?php
$password = "jinwoo1400"; // Ganti password ini
session_start();
if (!isset($_SESSION['authenticated'])) {
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['pass'] === $password) {
        $_SESSION['authenticated'] = true;
    } else {
        echo '<form method="post"><input type="password" name="pass" placeholder="Enter Password"><button>Access</button></form>';
        exit;
    }
}
?>

<form method="POST" action="">
    <label>Real Landing URL</label>
    <input type="text" name="real" placeholder="https://your-money-page.com" required>

    <label>Bot Redirect URL</label>
    <input type="text" name="bot" placeholder="https://blank-page.com" required>

    <label>Whitelist IPs (comma separated)</label>
    <input type="text" name="whitelist" placeholder="123.123.123.123,8.8.8.8">

    <button type="submit">Generate cloaker.php</button>
</form>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['real'])) {
    $real = $_POST['real'];
    $bot = $_POST['bot'];
    $ips = explode(',', $_POST['whitelist']);
    $ipList = array_map('trim', $ips);
    $encodedIPs = '"' . implode('","', $ipList) . '"';

    $code = <<<PHP
<?php
\$a="$real";
\$b="$bot";
\$c=[$encodedIPs];
\$d=\$_SERVER['REMOTE_ADDR']??'UNKNOWN';
\$e=strtolower(\$_SERVER['HTTP_USER_AGENT']??'');
\$f=date("Y-m-d H:i:s");
\$g=['google','facebook','twitter','bing','semrush','ahrefs'];
\$h=false;
foreach(\$g as \$i){if(strpos(\$e,\$i)!==false){\$h=true;break;}}
\$j=in_array(\$d,\$c);
\$k="[\$f] IP:\$d | UA:\$e | TYPE:".(\$j?"WHITELIST":(\$h?"BOT":"HUMAN"));
file_put_contents("logs.txt",\$k."\n",FILE_APPEND);
header("Location:".(\$j||!\$h?\$a:\$b));exit;
?>
PHP;

    file_put_contents("cloaker.php", $code);
    echo "<p><b>✅ cloaker.php generated with obfuscation!</b></p>";
}
?>
</body></html>
