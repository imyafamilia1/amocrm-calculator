<?php

$example_data = [
    [
        'name' => 'Купить сока',
        'contact_name' => 'Вася',
        'contact_telephone_number' => '79998887667',
        'note' => 'Должно быть очень вкусным.',
    ],
    [
        'name' => 'Купить воды',
        'contact_name' => 'Петя',
        'contact_telephone_number' => '79993263262',
        'note' => 'Должна быть чистой.',
    ],
    [
        'name' => 'Купить куклу',
        'contact_name' => 'Вася',
        'contact_telephone_number' => '79996667667',
        'note' => 'Что такое Советская власть? В чём заключается сущность этой новой власти, которой не хотят или не могут понять ещё в большинстве стран? Сущность её, привлекающая к себе рабочих каждой страны всё больше и больше, состоит в том, что прежде государством управляли так или иначе богатые или капиталисты, а теперь в первый раз управляют государством, притом в массовом числе, как раз те классы, которых капитализм угнетал. Даже в самой демократической, даже в самой свободной республике, пока остаётся господство капитала, пока земля остаётся в частной собственности, государством всегда управляет небольшое меньшинство, взятое на девять десятых из капиталистов или из богатых.',
    ],
    [
        'name' => 'Продать тарелки',
        'contact_name' => 'Петрович',
        'contact_telephone_number' => '79996668357',
        'note' => 'Синие тарелки красивые, но коричневые прослужат дольше.',
    ],
    [
        'name' => 'Найти манулов',
        'contact_name' => 'Красная книга',
        'contact_telephone_number' => '79996667235',
        'note' => 'Они редкие.',
    ],
];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Таблица</title>
    <style>
        table, tr, th {
            border: 1px solid black;
        }
        table {
            width: 100%;
        }
    </style>
    <script
        src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
        crossorigin="anonymous"></script>
</head>
<body>
    <table>
        <thead>
            <tr>
                <th>Сделка</th>
                <th>Имя</th>
                <th>Номер телефона</th>
                <th>Примечание</th>
                <th>Просто добавить</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($example_data as $row): ?>
                <tr>
                    <form action="save-table.php" method="GET" class="row-form">
                        <th><?php echo $row['name']; ?></th>
                        <th><?php echo $row['contact_name']; ?></th>
                        <th><?php echo $row['contact_telephone_number']; ?></th>
                        <th><?php echo $row['note']; ?></th>
                        <input type="hidden" name="lead" value="<?php echo $row['name']; ?>">
                        <input type="hidden" name="contact_name" value="<?php echo $row['contact_name']; ?>">
                        <input type="hidden" name="contact_telephone_number" value="<?php echo $row['contact_telephone_number']; ?>">
                        <input type="hidden" name="note" value="<?php echo $row['note']; ?>">
                        <th><input type="submit" value="Что-то там" class="row-button"></th>
                    </form>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <script>
        $(".row-form").submit(function(e) {
            $(".row-button").attr('disabled', true);

            e.preventDefault();

            var form = $(this);
            var url = form.attr('action');

            $.ajax({
                type: "GET",
                url: url,
                data: form.serialize(),
            });
            setTimeout(() => {
                $(".row-button").attr('disabled', false);
            }, 1500);
            });
    </script>
</body>
</html>