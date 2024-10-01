<?php
session_start();
//1. POSTデータ取得
$name  = $_POST["name"];
$category1 = $_POST["category1"];
$category2 = $_POST["category2"];
$tag = isset($_POST['tag']) ? $_POST['tag'] : [];
$id = $_POST["id"];

//2. DB接続します
include("funcs.php");
sschk();
$pdo = db_conn();

//３.form2_tableデータ更新
$stmt = $pdo->prepare("UPDATE product SET 
name=:name,
category1=:category1,
category2=:category2
WHERE id=:id");

$stmt->bindValue(':name', $name, PDO::PARAM_STR);
$stmt->bindValue(':category1', $category1, PDO::PARAM_STR);
$stmt->bindValue(':category2', $category2, PDO::PARAM_STR);
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$status = $stmt->execute(); //実行

//４．データ登録処理後
//form2_table
if ($status == false) {
    sql_error($stmt);
}


//３.tz_tableデータ更新
// 既存の timeZone データを削除してから新しいデータを挿入する
$delete_stmt = $pdo->prepare("DELETE FROM tag WHERE product_id = :id");
$delete_stmt->bindValue(':id', $id, PDO::PARAM_INT);
$delete_status = $delete_stmt->execute();

if ($delete_status == false) {
    sql_error($delete_stmt);
}

// timeZone が送信されている場合は新たに挿入する
foreach ($tag as $t) {
    $insert_stmt = $pdo->prepare("INSERT INTO tag (tag, product_id) VALUES (:tag, :product_id)");
    $insert_stmt->bindValue(':tag', $t, PDO::PARAM_STR);
    $insert_stmt->bindValue(':product_id', $id, PDO::PARAM_INT);
    $insert_status = $insert_stmt->execute();
    //４．データ登録処理後
    if ($insert_status == false) {
        sql_error($insert_stmt);
    }
}

// 6. 全ての処理が成功した場合にリダイレクト
redirect("product-select.php");
exit();
