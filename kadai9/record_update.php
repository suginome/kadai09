<?php
//PHP:コード記述/修正の流れ
//1. insert.phpの処理をマルっとコピー。
//   POSTデータ受信 → DB接続 → SQL実行 → 前ページへ戻る
//2. $id = POST["id"]を追加
//3. SQL修正
//   "UPDATE テーブル名 SET 変更したいカラムを並べる WHERE 条件"
//   bindValueにも「id」の項目を追加
//4. header関数"Location"を「select.php」に変更


//1. POSTデータ取得
$date = $_POST['date'];
$time = $_POST['time'];
$kaigi_id = $_POST['kaigi_id'];
$team = $_POST['team'];
$name = $_POST['name'];
$gidai = $_POST['gidai'];
$url = $_POST['url']; 

// これはdetail.php hiddenで送られたid
$id = $_POST["id"];


//2. DB接続します
//*** function化する！  *****************
// try {
//     $db_name = 'gs_db3';    //データベース名
//     $db_id   = 'root';      //アカウント名
//     $db_pw   = 'root';      //パスワード：XAMPPはパスワード無しに修正してください。
//     $db_host = 'localhost'; //DBホスト
//     $pdo = new PDO('mysql:dbname=' . $db_name . ';charset=utf8;host=' . $db_host, $db_id, $db_pw);
// } catch (PDOException $e) {
//     exit('DB Connection Error:' . $e->getMessage());
// }
// function.phpに記述したものを書きますよ
// 

// 関数化
require_once('record_funcs.php');
$pdo = db_conn();


//３．データ登録SQL作成
// $stmt = $pdo->prepare("INSERT INTO gs_an_table(name,email,age,content,indate)VALUES(:name,:email,:age,:content,sysdate())");
// $stmt = $pdo->prepare( 'UPDATE gs_an_table SET name = :name, email = :email, age = :age, content = :content, indate = sysdate() WHERE id = :id;' );

$sql = "UPDATE record_db SET id = :id, date = :date, time = :time, kaigi_id  = :kaigi_id, team= :team, name= :name, gidai= :gidai, url= :url WHERE id=:id";
$stmt = $pdo->prepare($sql);




// -- // 数値の場合 PDO::PARAM_INT
// -- // 文字の場合 PDO::PARAM_STR
// -- // $stmt->bindValue(':name', $name, PDO::PARAM_STR);
// -- // $stmt->bindValue(':email', $email, PDO::PARAM_STR);
// -- // $stmt->bindValue(':age', $age, PDO::PARAM_INT);
// -- // $stmt->bindValue(':content', $content, PDO::PARAM_STR);
$stmt->bindValue('date', $date, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue('time', $time, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue('kaigi_id', $kaigi_id, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue('team', $team, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue('name', $name, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue('gidai', $gidai, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue('url', $url, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)


// hiddenで受け取ったidをbindValueを用いて「安全かチェック」をする＝SQLインジェクション対策
$stmt->bindValue(':id', $id, PDO::PARAM_STR);
$status = $stmt->execute(); //実行


//４．データ登録処理後
if ($status == false) {
 sql_error($stmt);
} else {
 redirect('record_select.php');
}


// if($status==false){
//  // SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
//  $error = $stmt->errorInfo();
//  exit("ErrorMessage:".$error[2]);
// }else{
//  // ５．index.phpへリダイレクト
//  header("Location: recording.php");
//  exit;
// }