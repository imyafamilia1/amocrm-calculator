<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h4>Добавьте ссылку https://amocrm-integration.herokuapp.com/auth.php для интеграции и https://amocrm-integration.herokuapp.com/calc-budget.php для вебхука</h4>
    <form action="save.php" method="post">
        <input type="text" name="client_id" id="client_id" placeholder="ID интеграции" required><br>
        <input type="text" name="secret" id="secret" placeholder="Секретный ключ" required><br>
        <input type="submit" value="Интегрировать">
    </form>
</body>
</html>
