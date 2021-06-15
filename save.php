<?php

file_put_contents('./secret.txt', $_POST['secret']);
header("Location: https://www.amocrm.ru/oauth?client_id={$_POST['client_id']}&state=test&mode=popup");