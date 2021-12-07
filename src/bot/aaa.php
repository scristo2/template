<?php 
//API URL
$url = 'https://auth.riotgames.com/api/v1/authorization';

$data = array("username" => "sergod2", "password" => "{muestro23}");

$postdata = json_encode($data);

$ch = curl_init( $url );
# Setup request to send json via POST.
$payload =array( "username" => "scristo2", "password" => "{muestro23}");
curl_setopt( $ch, CURLOPT_POSTFIELDS,$postdata);
curl_setopt( $ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
# Return response instead of printing.
curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
# Send request.
$result = curl_exec($ch);
curl_close($ch);
# Print response.
echo "<pre>$result</pre>";