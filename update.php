<?php
session_start();
//1. POSTデータ取得
$name  = $_POST["name"];
$email = $_POST["email"];
$spending  = $_POST["spending"];
$income  = $_POST["income"];
$age  = $_POST["age"];
$gender  = $_POST["gender"];
$hour  = $_POST["hour"];
$timeZones = isset($_POST['timeZone']) ? $_POST['timeZone'] : [];
$region  = $_POST["region"];
$id = $_POST["id"];

//2. DB接続します
include("funcs.php");
sschk();
$pdo = db_conn();

//３.form2_tableデータ更新
$stmt = $pdo->prepare("UPDATE form2_table SET 
name=:name,
email=:email,
spending=:spending,
income=:income,
age=:age,
gender=:gender,
hour=:hour,
region=:region
WHERE id=:id");

$stmt->bindValue(':name', $name, PDO::PARAM_STR);
$stmt->bindValue(':email', $email, PDO::PARAM_STR);
$stmt->bindValue(':spending', $spending, PDO::PARAM_INT);
$stmt->bindValue(':income', $income, PDO::PARAM_INT);
$stmt->bindValue(':age', $age, PDO::PARAM_INT);
$stmt->bindValue(':gender', $gender, PDO::PARAM_STR);
$stmt->bindValue(':hour', $hour, PDO::PARAM_INT);
$stmt->bindValue(':region', $region, PDO::PARAM_STR);
$stmt->bindValue(':id', $id, PDO::PARAM_STR);
$status = $stmt->execute(); //実行

//４．データ登録処理後
//form2_table
if ($status == false) {
  sql_error($stmt);
}


//３.tz_tableデータ更新
// 既存の timeZone データを削除してから新しいデータを挿入する
$delete_stmt = $pdo->prepare("DELETE FROM tz_table WHERE form2_id = :id");
$delete_stmt->bindValue(':id', $id, PDO::PARAM_INT);
$delete_status = $delete_stmt->execute();

if ($delete_status == false) {
  sql_error($delete_stmt);
}

// timeZone が送信されている場合は新たに挿入する
foreach ($timeZones as $tz) {
  $insert_stmt = $pdo->prepare("INSERT INTO tz_table (timeZone, form2_id) VALUES (:timeZone, :form2_id)");
  $insert_stmt->bindValue(':timeZone', $tz, PDO::PARAM_STR);
  $insert_stmt->bindValue(':form2_id', $id, PDO::PARAM_INT);
  $insert_status = $insert_stmt->execute();
  //４．データ登録処理後
  if ($insert_status == false) {
    sql_error($insert_stmt);
  }
}

// 6. 全ての処理が成功した場合にリダイレクト
redirect("select.php");
exit();
