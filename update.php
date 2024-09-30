<?php
session_start();
include("funcs.php");
sschk();
//1. POSTデータ取得
$rating  = $_POST["rating"];
$review = $_POST["review"];
$id     = $_POST["id"];

// 画像がアップロードされていない場合の処理
$image = null;

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
$pdo = db_conn();

// 既存の画像パスを取得する
if ($image === null) {
  // 画像がアップロードされていない場合、既存の画像パスを取得
  $stmt = $pdo->prepare("SELECT image FROM review WHERE id=:id");
  $stmt->bindValue(':id', $id, PDO::PARAM_INT);
  $stmt->execute();
  $result = $stmt->fetch(PDO::FETCH_ASSOC);
  if ($result) {
    $image = $result['image']; // 既存の画像パスをセット
  } else {
    echo "データが見つかりませんでした。";
    exit();
  }
}



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
