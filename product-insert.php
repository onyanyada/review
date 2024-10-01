<?php
session_start();

//1. POSTデータ取得
$product_name  = $_POST["product_name"];
$category1 = $_POST["category1"];
$category2 = $_POST["category2"];
$tag = $_POST["tag"];
$tags = explode(',', $tag); // カンマで分割して配列に変換


// セッションにデータを保存
$_SESSION["product_name"] = $product_name;
$_SESSION["category1"] = $category1;
$_SESSION["category2"] = $category2;
$_SESSION["tag"] = $tag;

//2. DB接続します
include("funcs.php");
$pdo = db_conn();


//３．データ登録SQL作成
$stmt = $pdo->prepare("INSERT INTO product(product_name,category1,category2,indate)
VALUES(:product_name,:category1,:category2,sysdate())");

$stmt->bindValue(':product_name', $product_name, PDO::PARAM_STR);
$stmt->bindValue(':category1', $category1, PDO::PARAM_STR);
$stmt->bindValue(':category2', $category2, PDO::PARAM_STR);
$status = $stmt->execute(); //実行
$lastInsertId = $pdo->lastInsertId(); // form2_tableに挿入されたIDを取得


//４．データ登録処理後
if ($status == false) {
    sql_error($stmt);
} else {
    foreach ($tags as $t) {
        $tag_stmt = $pdo->prepare("INSERT INTO tag (tag, product_id) VALUES (:tag, :product_id)");
        $tag_stmt->bindValue(':tag', $t, PDO::PARAM_STR);
        $tag_stmt->bindValue(':product_id', $lastInsertId, PDO::PARAM_INT); // form2_tableのIDを関連付ける
        $tag_status = $tag_stmt->execute(); // 実行

        if ($tag_status == false) {
            sql_error($tag_stmt); // エラーハンドリング
        }
    }
    header("Location: product-complete.php");
    exit();
}
