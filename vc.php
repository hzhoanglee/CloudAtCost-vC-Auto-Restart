<?php
//Define zone
$telegram_token = ""; //Telegram Token
$telegram_chatid = ""; //Telegram ChatID
$cac_apikey = ""; //CloudAtCost VC API Key
$cac_apipass = ""; //CloudAtCost VC API Password
$logging = true; // true for enable logging, false for disable logging
$telegram_noti = true; // true for enable Sending Notification, false for disable Sending Notification
$i = 0;

function telegramnoti($noti){
    global $telegram_chatid; global $telegram_token;
    $text = urlencode("VC Cloud Started:\n$noti\nTime: " . date("d-m-Y H:i:s"));
    $uri = "https://api.telegram.org/bot$telegram_token/sendMessage?chat_id=$telegram_chatid&text=$text";
    echo $uri;
    $response = CallCurl($uri);
    return $response;
}

function CallCurl($url){
    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_RETURNTRANSFER => 1,
        CURLOPT_URL => $url,
        CURLOPT_SSL_VERIFYPEER => false
    ));
    
    $resp = curl_exec($curl);
    curl_close($curl);
    $response = json_decode($resp, true);
    return $response;
}

function storelog($content){
    $fp = fopen('vcloudrestart.log', 'a');//opens file in append mode  
    $content = "[" . date("d-m-Y H:i:s") . "] - $content";
    fwrite($fp, $content);  
    fclose($fp);  
}

echo "Script Start\n";
while (true){
    echo "Loop: " . $i++ . "\n";
    $status_details = CallCurl("https://my.cloudatcost.com:4083/index.php?act=listvs&api=json&apikey=$cac_apikey&apipass=$cac_apipass");
    $status_list = $status_details["vs"];
    foreach ($status_list as $key => $vc){
        if ($vc['status'] == 0){
            $restart_details = CallCurl("https://my.cloudatcost.com:4083/index.php?svs=$key&act=start&api=json&apikey=$cac_apikey&apipass=$cac_apipass&do=1");
            if ($restart_details["status"] == 0){
                $msg = "Start $key Failed";
            } else {
                $msg = "Start $key Successfully";
            }
            if ($telegram_noti == true){
                telegramnoti($msg);
            }
        } else {
            $msg = "VM $key is online. Not performing start\n";
        }
        echo $msg;
        if ($logging == true){
            storelog($msg);
        }
    }
    sleep(5);
}