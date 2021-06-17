<?php

$link = 'https://' . file_get_contents('./referer.txt');

$lead_link = "{$link}/api/v4/leads/complex";
$lead = [[
    'name' => $_GET['lead'],
    '_embedded' => [
        'contacts' => [[
                'name' => $_GET['contact_name'],
                "custom_fields_values" => [
                    [
                        "field_id" => 258167,
                        "field_name" => "Телефон",
                        "field_code" => "PHONE",
                        "field_type" => "multitext",
                        "values" => [
                            [
                                "value" => $_GET['contact_telephone_number'],
                                "enum_id" => 135911,
                                "enum_code" => "WORK"
                            ]
                        ]
                    ]
                ]
            ]
    ]]
]];

$curl = curl_init();
curl_setopt($curl,CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl,CURLOPT_URL, $lead_link);
curl_setopt($curl,CURLOPT_HTTPHEADER,['Content-Type:application/json', 'Authorization:'. file_get_contents('./token_type.txt') . ' ' . file_get_contents('./access_token.txt')]);
curl_setopt($curl,CURLOPT_CUSTOMREQUEST, 'POST');
curl_setopt($curl,CURLOPT_POSTFIELDS, json_encode($lead));
$out = curl_exec($curl);
curl_close($curl);

$out = json_decode($out, true);

$note_link = "{$link}/api/v4/leads/{$out[0]['id']}/notes";
$note = [
    [
        'note_type' => 'common',
        'params' => [
            'text' => $_GET['note'],
        ]
    ]
];

$curl = curl_init();
curl_setopt($curl,CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl,CURLOPT_URL, $note_link);
curl_setopt($curl,CURLOPT_HTTPHEADER,['Content-Type:application/json', 'Authorization:'. file_get_contents('./token_type.txt') . ' ' . file_get_contents('./access_token.txt')]);
curl_setopt($curl,CURLOPT_CUSTOMREQUEST, 'POST');
curl_setopt($curl,CURLOPT_POSTFIELDS, json_encode($note));
$out = curl_exec($curl);
curl_close($curl);

$out = json_decode($out, true);