<?php
header('Content-Type: application/ocset-stream');
//Content-Dispositionはダウンロード時にデフォルトで割り当てられるファイル名を表示
header('Content-Disposition: attachment; filename="flower.jpg"');
echo file_get_contents('./doc/flower.jpg');