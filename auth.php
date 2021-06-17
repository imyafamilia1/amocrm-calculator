<?php
$link = 'https://' . $_GET['referer'] . '/oauth2/access_token';

$data = [
	'client_id' => $_GET['client_id'],
	'client_secret' => file_get_contents('./secret.txt'),
	'grant_type' => 'authorization_code',
	'code' => $_GET['code'],
	'redirect_uri' => 'https://amocrm-integration.herokuapp.com/auth.php',
];

$curl = curl_init();
curl_setopt($curl,CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl,CURLOPT_USERAGENT,'amoCRM-oAuth-client/1.0');
curl_setopt($curl,CURLOPT_URL, $link);
curl_setopt($curl,CURLOPT_HTTPHEADER,['Content-Type:application/json']);
curl_setopt($curl,CURLOPT_CUSTOMREQUEST, 'POST');
curl_setopt($curl,CURLOPT_POSTFIELDS, json_encode($data));
$out = curl_exec($curl);
curl_close($curl);

$response = json_decode($out, true);

$access_token = $response['access_token'];
$refresh_token = $response['refresh_token'];
$token_type = $response['token_type'];
$expires_in = $response['expires_in'];

file_put_contents('./access_token.txt', $access_token);
file_put_contents('./refresh_token.txt', $refresh_token);
file_put_contents('./token_type.txt', $token_type);
file_put_contents('./referer.txt', $_GET['referer']);