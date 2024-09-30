<?php
//$_SESSION使うよ！
session_start();
include "funcs.php";

//1. POSTデータ取得
$name      = filter_input(INPUT_POST, "name");
$lid       = filter_input(INPUT_POST, "lid");
$lpwBefore       = filter_input(INPUT_POST, "lpw");
$lpw       = password_hash($lpwBefore, PASSWORD_DEFAULT);   //パスワードハッシュ化

//2. DB接続します
$pdo = db_conn();

//３．データ登録SQL作成
$sql = "INSERT INTO user(name,lid,lpw,life_flg)VALUES(:name,:lid,:lpw,0)";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':name', $name, PDO::PARAM_STR); //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':lid', $lid, PDO::PARAM_STR); //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':lpw', $lpw, PDO::PARAM_STR); //Integer（数値の場合 PDO::PARAM_INT)::PARAM_STR); //Integer（数値の場合 PDO::PARAM_INT)
$status = $stmt->execute();

//４．データ登録処理後
if ($status == false) {
    sql_error($stmt);
} else {
    // 登録データをセッションに保存
    $_SESSION['registered-name'] = $name;
    $_SESSION['lid'] = $lid;
    $_SESSION['lpwBefore'] = $lpwBefore;
    redirect("user-comp.php");
}
