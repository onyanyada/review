<?php
session_start();
//1. POSTデータ取得
$rating  = $_POST["rating"];
$review = $_POST["review"];
$image = $_FILES["image"];

// 画像ファイルの処理
if ($image["error"] == 0) {
  // アップロードされた画像の保存先ディレクトリを指定
  $upload_dir = "img/";
  // ユニークなファイル名を生成して、同名ファイルの衝突を回避
  $image_name = uniqid() . "_" . basename($image["name"]);
  $image_path = $upload_dir . $image_name;
  $tmp_name = $image["tmp_name"]; // 一時ファイルのパス

  // 画像を指定されたディレクトリに移動
  if (move_uploaded_file($tmp_name, $image_path)) {
    // 画像の移動が成功した場合の処理
    $_SESSION["image"] = $image_path; // セッションに画像パスを保存
  } else {
    // エラー処理（ファイルの移動が失敗した場合）
    echo "画像のアップロードに失敗しました。";
    exit();
  }
} else {
  $image_path = null; // 画像がアップロードされていない場合
}

// セッションにデータを保存
$_SESSION["rating"] = $rating;
$_SESSION["review"] = $review;


//2. DB接続します
include("funcs.php");
$pdo = db_conn();

//３．データ登録SQL作成
$stmt = $pdo->prepare("INSERT INTO review(rating,review,image,indate)
VALUES(:rating,:review,:image,sysdate())");

$stmt->bindValue(':rating', $rating, PDO::PARAM_INT);
$stmt->bindValue(':review', $review, PDO::PARAM_STR);
$stmt->bindValue(':image', $image_path, PDO::PARAM_STR);
$status = $stmt->execute(); //実行
$lastInsertId = $pdo->lastInsertId(); // form2_tableに挿入されたIDを取得


//４．データ登録処理後
if ($status == false) {
  sql_error($stmt);
} else {
  // redirect("complete.php");
  header("Location: complete.php");
  exit();
}
