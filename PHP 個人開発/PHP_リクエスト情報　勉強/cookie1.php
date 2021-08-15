<?php require_once 'encode.php'; ?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>cookie1.php</title>
</head>
<body>
    <form method="POST" action="cookie2.php">
    <label for="email">メールアドレス：</label>
    <input id="email" type="text" name="email" value=<?php echo e($_COOKIE['email'] ?? ''); ?>>
    <input type="submit" value="送信">
    </form>
</body>
</html>