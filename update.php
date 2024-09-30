<?php
session_start();
//1. POSTデータ取得
$rating  = $_POST["rating"];
$review = $_POST["review"];
$id     = $_POST["id"];

// 画像処理
if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
  // ファイルがアップロードされた場合の処理
  $upload_dir = 'img/'; // 画像の保存ディレクトリ
  $filename = basename($_FILES['image']['name']);
  $target_file = $upload_dir . $filename;

  // アップロードの検証と実行
  if (move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
    $image = $target_file; // 新しい画像のパスをセット
  } else {
    echo "画像のアップロードに失敗しました。";
    exit();
  }
}


//2. DB接続します
include("funcs.php");
sschk();
$pdo = db_conn();

//３.データ更新
$stmt = $pdo->prepare("UPDATE review SET 
rating=:rating,
review=:review,
image=:image
WHERE id=:id");

$stmt->bindValue(':rating', $rating, PDO::PARAM_INT);
$stmt->bindValue(':review', $review, PDO::PARAM_STR);
$stmt->bindValue(':image', $image, PDO::PARAM_STR);
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$status = $stmt->execute(); //実行

//４．データ登録処理後
//form2_table
if ($status == false) {
  sql_error($stmt);
} else {
  // 6. 全ての処理が成功した場合にリダイレクト
  redirect("select.php");
  exit();
}
