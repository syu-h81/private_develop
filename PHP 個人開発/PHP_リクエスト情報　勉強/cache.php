<?php 
//ページ有効期限を過去の日付に設定
header('Expires: Sun, 15 jan 1970 00:00:00 GMT');
//最終更新日を常に更新
header('Last-Modified: ' . gmdate("D, d M Y H:i:s") . 'GMT');
//キャッシュを無効に設定
header('Cache-Control: no-store, no-cache, must-revalidate');
header('Cache-Control: post-check=0, pre-check=0', false);
?>