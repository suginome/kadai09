<?php

//1. POSTデータ取得

$name = $_POST['name'];
$lid = $_POST['lid'];
$lpw = $_POST['lpw'];
$kanri_flg = $_POST['kanri_flg'];
$life_flg = $_POST['life_flg'];


//2. DB接続します
// try{
// $pdo = new PDO('mysql:dbname=gs_db;charset=utf8;host=localhost','root','root');
// } catch (PDOException $e) {
//   exit('DBConnectError:'.$e->getMessage());
// }

// 関数化
require_once('touroku_funcs.php');
$pdo = db_conn();




// 1. SQL文を用意
$sql = "INSERT INTO gs_user_table(id, name, lid, lpw, kanri_flg, life_flg )VALUES(NULL, :a1, :a2, :a3, :a4, :a5)";
$stmt = $pdo->prepare($sql);

// $stmt = $pdo->prepare("INSERT INTO record_db(id, time, kaigi_id, team, name, gidai ,url)
// VALUES(NULL, :a2, :a3, :a4, :a5, ;a6, :a7)");

$stmt->bindValue(':a1', $name, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':a2', $lid, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':a3', $lpw, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':a4', $kanri_flg, PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':a5', $life_flg, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)

// セキュリティのためのもの。ホスト


//  3. 実行
$status = $stmt->execute();

//４．データ登録処理後
if($status==false){
  // SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
  $error = $stmt->errorInfo();
  exit("ErrorMessage:".$error[2]);
}else{
  // ５．index.phpへリダイレクト
  header("Location: record_index.php");
  exit;
}
?>