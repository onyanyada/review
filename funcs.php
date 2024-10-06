<?php
//XSS対応（ echoする場所で使用！それ以外はNG ）
function h($str)
{
  return htmlspecialchars($str, ENT_QUOTES);
}

//DB接続
function db_conn()
{
  try {
    // $db_name = "review";    //データベース名
    // $db_id   = "root";      //アカウント名
    // $db_pw   = "nyanko";   //パスワード：XAMPPはパスワード無し or MAMPはパスワード”root”に修正してください。
    // $db_host = "localhost"; //DBホスト

    $db_name = "studiohub_review";    //データベース名
    $db_id   = "studiohub";      //アカウント名
    $db_pw   = "b_3FVwSWrcYY";   //パスワード：XAMPPはパスワード無し or MAMPはパスワード”root”に修正してください。
    $db_host = "mysql3101.db.sakura.ne.jp"; //DBホスト
    return new PDO('mysql:dbname=' . $db_name . ';charset=utf8;host=' . $db_host, $db_id, $db_pw);
  } catch (PDOException $e) {
    exit('DB Connection Error:' . $e->getMessage());
  }
}

//SQLエラー
function sql_error($stmt)
{
  //execute（SQL実行時にエラーがある場合）
  $error = $stmt->errorInfo();
  exit("SQLError:" . $error[2]);
}

//リダイレクト
function redirect($file_name)
{
  header("Location: " . $file_name);
  exit();
}

//SessionCheck(スケルトン)
function sschk()
{
  if (!isset($_SESSION["chk_ssid"]) || $_SESSION["chk_ssid"] != session_id()) {
    exit("Login Error");
  } else {
    session_regenerate_id(true); //SESSION KEYを入れ替え
    $_SESSION["chk_ssid"] = session_id();
  }
}
