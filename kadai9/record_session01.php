<?php
//セッションを使いますと宣言します！これ必須！ないと動きません
session_start();
//セッションを使うと宣言した後に、IDを取得します（発効＝これが鍵）
$sid = session_id();  //session_start()を使わないと使えません！
//echoで表示をする
echo $sid;

echo '<br/>';
$_SESSION['test'] = 'こんにち';
?>