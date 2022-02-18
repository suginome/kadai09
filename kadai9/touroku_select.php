<?php

session_start();
//1.DB接続します
// try{
//   $pdo = new PDO('mysql:dbname=gs_db;charset=utf8;host=localhost','root','root');
// } catch (PDOException $e){
//   exit('DBConnectError'.$e->getMessage());
// } 

// 関数化
require_once('touroku_funcs.php');
$pdo = db_conn();


// 2.データ取得SQL作成
$stmt = $pdo->prepare("SELECT*FROM gs_user_table");
$status = $stmt->execute();

//3.データ表示
$view="";
if ($status==false){
     // execute(SQL実行時にエラーがある場合)
  $error = $stmt->execute();
  exit("ErrorQuery:".$error[2]);

}else{
  //Selectデータの数だけ自動でループしてくれる
  //FETCH_ASSOC=http://php.net/manual/ja/pdostatement.fetch.php
  while( $result = $stmt->fetch(PDO::FETCH_ASSOC)){
    // $view .="<p>".$result["date"]." ".$result["time"]." ".$result["kaigi_id"].$result["team"].$result["name"].$result["gidai"].$result["url"]."</p>";
    
    //GETデータ送信リンク作成
        // <a>で囲う。
        $view .= '<p>';
        $view .= '<a href="touroku_detail.php?id='. $result["id"].'">';
        $view .= $result['id'] . '：' . $result['name'];
        $view .= '</a>';
        $view .= '<a href="touroku_delete.php?id=' . $result['id'].'">';//追記
        $view .= '  [削除]';//追記
        $view .= '</a>';//追記
        $view .= '</p>';

  }

}

?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ユーザー一覧</title>
  <link rel="stylesheet" href="css/record.css">
</head>

<body>

<a>ユーザー一覧</a>



<div><?= $view?></div>

</body>





</html>