<?php
session_start();

//2. DB接続します
include("funcs.php");
sschk();
$pdo = db_conn();


//1. POSTデータ取得
$name         = $_POST["name"];
$lid          = $_POST["lid"];
$lpw          = $_POST["lpw"];
$life_flg    = $_POST["life_flg"];
$id           = $_POST["id"];
// 新しいパスワードが入力されているか確認
$lpw = filter_input(INPUT_POST, "lpw");
if (!empty($lpw)) {
    // パスワードが入力された場合、ハッシュ化
    $lpw_hashed = password_hash($lpw, PASSWORD_DEFAULT);
} else {
    // 入力されていない場合、既存のパスワードをそのまま使用
    $stmt = $pdo->prepare("SELECT lpw FROM user WHERE id=:id");
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    $row = $stmt->fetch();
    $lpw_hashed = $row["lpw"]; // 元のハッシュ化されたパスワードを取得
}



//３．データ登録SQL作成
$stmt = $pdo->prepare("UPDATE user SET name=:name,lid=:lid,lpw=:lpw, life_flg=:life_flg WHERE id=:id");
$stmt->bindValue(':name',         $name,      PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':lid',          $lid,       PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':lpw',          $lpw_hashed, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':life_flg',     $life_flg,  PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':id',           $id,        PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
$status = $stmt->execute(); //実行

//４．データ登録処理後
if ($status == false) {
    sql_error($stmt);
} else {
    redirect("user-select.php");
}
