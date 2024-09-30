<?php
session_start();
include("funcs.php");
sschk();
$id = $_SESSION["id"];

if (empty($id)) {
    echo "IDが指定されていません。";
    exit();
}



?>
<h2>本当に退会して完全削除しますか？</h2>

<a href="user-delete.php?id=<?= h($id) ?>">退会して完全削除する</a>
<a href="user-detail.php?id=<?= h($id) ?>">キャンセル</a>