<?php
session_start();
// $_GET["id"]がセットされているか確認
if (!isset($_GET["id"]) || empty($_GET["id"])) {
    echo "IDが指定されていません。";
?>
    <a href="select.php">データ一覧に戻る</a>
<?php
    exit(); // 処理を終了させます
}
$id = $_GET["id"]; //?id~**を受け取る
$_SESSION["id"] = $id; // セッションにIDを保存
include("funcs.php");
sschk();
$pdo = db_conn();

//２．データ登録SQL作成
$stmt = $pdo->prepare("SELECT * FROM user WHERE id=:id");
$stmt->bindValue(":id", $id, PDO::PARAM_INT);
$status = $stmt->execute();

//３．データ表示
if ($status == false) {
    sql_error($stmt);
} else {
    $row = $stmt->fetch();
}
?>



<?php include("head.php"); ?>
<title>ユーザーデータ更新</title>
</head>

<body>
    <?php include("menu.php"); ?>



    <h2>ユーザーデータ更新</h2>

    <form method="POST" action="user-update.php">

        <legend>[編集]</legend>
        <label>名前：<input type="text" name="name" value="<?= h($row["name"]) ?>"></label><br>
        <label>Login ID：<input type="text" name="lid" value="<?= h($row["lid"]) ?>"></label><br>
        <label>新しいパスワード：<input type="password" name="lpw"></label><br>
        <label>退会</label>
        <label>
            <input type="radio" name="life_flg" value="0" <?= $row["life_flg"] == "0" ? "checked" : "" ?>> 退会しない
        </label>
        <label>
            <input type="radio" name="life_flg" value="1" <?= $row["life_flg"] == "1" ? "checked" : "" ?>> 退会する
        </label><br>
        <input type="submit" value="送信">
        <input type="hidden" name="id" value="<?= $id ?>">

    </form>
    <?php

    ?>
    <a href="user-delete-confirm.php">退会して完全削除する</a>

</body>

</html>