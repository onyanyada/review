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
$timeZone = isset($_POST['timeZone']) ? $_POST['timeZone'] : [];
$timeZoneStr = $_POST["timeZoneStr"];
$region  = $_POST["region"];

// セッションにデータを保存
$_SESSION["name"] = $name;
$_SESSION["email"] = $email;
$_SESSION["spending"] = $spending;
$_SESSION["income"] = $income;
$_SESSION["age"] = $age;
$_SESSION["gender"] = $gender;
$_SESSION["hour"] = $hour;
$_SESSION["timeZoneStr"] = $timeZoneStr;
$_SESSION["region"] = $region;


//2. DB接続します
include("funcs.php");
$pdo = db_conn();

//３．データ登録SQL作成
$stmt = $pdo->prepare("INSERT INTO form2_table(name,email,spending,income,age,gender,hour,region,indate)
VALUES(:name,:email,:spending,:income,:age,:gender,:hour,:region,sysdate())");

$stmt->bindValue(':name', $name, PDO::PARAM_STR);
$stmt->bindValue(':email', $email, PDO::PARAM_STR);
$stmt->bindValue(':spending', $spending, PDO::PARAM_INT);
$stmt->bindValue(':income', $income, PDO::PARAM_INT);
$stmt->bindValue(':age', $age, PDO::PARAM_INT);
$stmt->bindValue(':gender', $gender, PDO::PARAM_STR);
$stmt->bindValue(':hour', $hour, PDO::PARAM_INT);
$stmt->bindValue(':region', $region, PDO::PARAM_STR);
$status = $stmt->execute(); //実行
$lastInsertId = $pdo->lastInsertId(); // form2_tableに挿入されたIDを取得


//４．データ登録処理後
if ($status == false) {
  sql_error($stmt);
} else {
  foreach ($timeZone as $tz) {
    $tz_stmt = $pdo->prepare("INSERT INTO tz_table (timeZone, form2_id) VALUES (:timeZone, :form2_id)");
    $tz_stmt->bindValue(':timeZone', $tz, PDO::PARAM_STR);
    $tz_stmt->bindValue(':form2_id', $lastInsertId, PDO::PARAM_INT); // form2_tableのIDを関連付ける
    $tz_status = $tz_stmt->execute(); // 実行

    if ($tz_status == false) {
      sql_error($tz_stmt); // エラーハンドリング
    }
  }
  // redirect("complete.php");
  header("Location: complete.php");
  exit();
}
