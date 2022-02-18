<?php

// 関数化
require_once('record_funcs.php');
// DB接続ができます
$pdo = db_conn();



/**
 * １．PHP
 * [ここでやりたいこと]
 * まず、クエリパラメータの確認 = GETで取得している内容を確認する
 * イメージは、select.phpで取得しているデータを一つだけ取得できるようにする。
 * →select.phpのPHP<?php ?>の中身をコピー、貼り付け
 * ※SQLとデータ取得の箇所を修正します。
 */

// GET送信されたIDを取得
$id = $_GET["id"];
$id = $_GET["id"];
echo "更新ID: ". $id;

// SQLを準備する
$stmt = $pdo->prepare('SELECT * FROM record_db WHERE id=:id;');

// SQLga安全かチェックする
$stmt->bindValue(':id',$id,PDO::PARAM_INT);

// SQLを実行
$status = $stmt->execute();


$view = '';

if ($status === false) {
   sql_error($status);
} else {
   $result = $stmt->fetch();
}


?>
<!--
２．HTML
以下にindex.phpのHTMLをまるっと貼り付ける！
(入力項目は「登録/更新」はほぼ同じになるから)
※form要素 input type="hidden" name="id" を１項目追加（非表示項目）
※form要素 action="update.php"に変更
※input要素 value="ここに変数埋め込み"
-->

<!DOCTYPE html>
<html lang="ja">

<head>
   <meta charset="UTF-8">
   <title>スギノメモ</title>
   <link href="css/record.css" rel="stylesheet">
   <nav id="gnav">
      <label for="menu_bar01">メニュー</label>
         <div  id="menu_bar01" >
            <ul class="inner">
                  <li><a href="#">トップ</a></li>
                  <li><a href="#">録音</a></li>
                  <li><a href="#">会議スケジュール予約</a></li>
                  <li><a href="#">実施会議一覧</a></li>
                  <li><a href="#">使い方</a></li>
                  <li><a href="#">会議参加心得</a></li>
            </ul>
         </div>
   </nav>


</head>

<body>
   <header>
      <nav class="navbar navbar-default">
            <div class="container-fluid">
               <div class="navbar-header"><a class="navbar-brand" href="record_select.php">スギノメモ</a></div>
            </div>
      </nav>
   </header>





   <form method="POST" action="record_update.php">
      <h1 class="kihon">基本情報
                  <div class=jouhou>
                        <label>開催日<br><input type="date" name="date" value="<?= $result['date']?>"></label>
                        <p>開催時間<br><input type="time" name="time" value="<?= $result['time']?>"></p>
                        <p>会議ID<br><input type="text" name="kaigi_id" value="<?= $result['kaigi_id']?>"/></p>
                     <fieldset>
                        <legend>会議詳細情報</legend>
                        <p>部門・チーム<br><input type="text" name="team" value="<?= $result['team']?>"></p>                         <p>氏名<br><input type="text" name="name" value="<?= $result['name']?>"></p>
                        <p>議題<br><textarea name="gidai"><?= $result["gidai"]?></textarea></p>
                        <p>記録先ドキュメント<br><input type="URL" name="url" value="<?= $result['url']?>"></input>
                        <!-- ここに一つ追加します -->
                        <input type='hidden' name="id" value="<?=$result["id"]?>">
                        <!-- ここに一つ追加します -->
                     </fieldset>
                  </div>
         <input type="submit" value="登録">
      </h1>
   </form>
</body>

</html>
