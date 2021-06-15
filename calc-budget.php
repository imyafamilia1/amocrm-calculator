<?php
$lead = $_POST['leads'];
$account = $_POST['account'];

$link = "https://{$account['subdomain']}.amocrm.ru/api/v4/leads/{$lead['status'][0]['id']}"; //Формируем URL для запроса

$values = [];

foreach ($lead['status'][0]['custom_fields'] as $key => $value) {
    if($value['name'] == 'Всего') {
        $values['total'] = $value['values'][0]['value'];
    }
}

foreach ($lead['status'][0]['custom_fields'] as $key => $value) {
    if($value['name'] == 'Расходы') {
        $values['spendings'] = $value['values'][0]['value'];
    }
}

$price = $values['total'] - $values['spendings'];
if($price < 0) {
    $price = 0;
}

$change = ['price' => $price];

$curl = curl_init();
curl_setopt($curl,CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl,CURLOPT_URL, $link);
curl_setopt($curl,CURLOPT_HTTPHEADER,['Content-Type:application/json', 'Authorization:'. file_get_contents('./token_type.txt') . ' ' . file_get_contents('./access_token.txt')]);
curl_setopt($curl,CURLOPT_CUSTOMREQUEST, 'PATCH');
curl_setopt($curl,CURLOPT_POSTFIELDS, json_encode($change));
$out = curl_exec($curl);
curl_close($curl);