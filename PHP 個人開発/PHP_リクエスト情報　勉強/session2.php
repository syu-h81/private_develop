<?php
session_start();
$_SESSION['email'] = $_POST['email'];
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>cookie2.php</title>
</head>
<body>
    セッション情報を保存しました
</body>
</html>