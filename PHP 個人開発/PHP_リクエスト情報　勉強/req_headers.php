<?php require_once 'encode.php'; ?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <table border="1">
    <?php
    //$_SERVERのキー/値を順に取得
    foreach($_SERVER as $key => $value) {
        //キーがHTTP_で始まる場合のみ、その値を出力
        if (mb_strpos($key, 'HTTP_') === 0) {
    ?>
        <tr valign="top">
        <th><?php echo e($key); ?></th>
        <th><?php echo e($value); ?></th>
        </tr>
        <?php
        }
    }
    ?>
    </table>
</body>
</html>