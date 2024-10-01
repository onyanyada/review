<?php
//最初にSESSIONを開始！！ココ大事！！
session_start();

//POST値
$lid = $_POST["lid"]; //lid
$lpw = $_POST["lpw"]; //lpw

//1.  DB接続します
include("funcs.php");
$pdo = db_conn();

//2. データ登録SQL作成
//* PasswordがHash化→条件はlidのみ！！
$stmt = $pdo->prepare("SELECT * FROM user WHERE lid=:lid");
$stmt->bindValue(':lid', $lid, PDO::PARAM_STR);
$status = $stmt->execute();

//3. SQL実行時にエラーがある場合STOP
if ($status == false) {
  sql_error($stmt);
}

//4. 抽出データ数を取得
$val = $stmt->fetch();         //1レコードだけ取得する方法


// 5. 該当1レコードがあればSESSIONに値を代入
if ($val) {
  // life_flgが1の場合は「権限を失いました」と表示
  if ($val["life_flg"] == 1) {
    echo "ユーザーは権限を失いました。";
    exit();
  }

  //入力したPasswordと暗号化されたPasswordを比較
  $pw = password_verify($lpw, $val["lpw"]);
  if ($pw) {
    //Login成功時
    $_SESSION["chk_ssid"]  = session_id();
    $_SESSION["lid"]      = $val['lid'];
    $_SESSION["name"]      = $val['name'];
    //Login成功時（select.phpへ）
    redirect("all-select.php");
    // redirect("user-select.php");
  } else {
    //Login失敗時(login.phpへ)
    // Passwordが一致しない場合のエラーメッセージ
    echo "パスワードが一致しません。";
  }
} else {
  // 該当するユーザーがいない場合のエラーメッセージ
  echo "該当するユーザーがいません。";
  exit();
}
exit();
