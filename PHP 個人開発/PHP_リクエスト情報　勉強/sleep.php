<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>sleep</title>
</head>
<body>
    <?php 
    for($i = 0; $i < 3; $i++) {
        sleep(2);
        echo date( "Y/m/d (D) H:i:s", time() );
        echo "<br>";
    }
    ?>
</body>
</html>