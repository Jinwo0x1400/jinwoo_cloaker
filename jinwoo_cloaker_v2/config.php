<html><head><title>Jinwoo Cloaker Config</title>
<style>
body { font-family: Arial; padding: 40px; background: #f4f4f4; }
h2 { color: #333; }
label { display: block; margin-top: 15px; }
input[type=text] { width: 100%; padding: 8px; }
button { margin-top: 20px; padding: 10px 20px; background: black; color: white; border: none; }
</style></head><body>
<h2>🔧 Jinwoo Cloaker Configuration</h2>
<form method="POST" action="">
    <label>Real Landing Page URL</label>
    <input type="text" name="real" placeholder="https://your-landing.com">

    <label>Bot Redirect Page</label>
    <input type="text" name="bot" placeholder="https://your-blank.html">

    <label>Whitelist IPs (comma separated)</label>
    <input type="text" name="whitelist" placeholder="123.123.123.123,8.8.8.8">

    <button type="submit">Generate cloaker.php</button>
</form>
<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $real = $_POST['real'];
    $bot = $_POST['bot'];
    $ips = explode(',', $_POST['whitelist']);
    $ipList = array_map('trim', $ips);

    $cloaker = "<?php\n";
    $cloaker .= '$realLanding = "' . $real . '";\n';
    $cloaker .= '$botLanding = "' . $bot . '";\n';
    $cloaker .= '$whitelist = ["' . implode('","', $ipList) . '"];\n';
    $cloaker .= file_get_contents("cloaker_template.php");

    file_put_contents("cloaker.php", $cloaker);
    echo "<p><b>✅ cloaker.php generated!</b></p>";
}
?>
</body></html>
