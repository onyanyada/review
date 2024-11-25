<?php
session_start();
// $_GET["id"]がセットされているか確認
if (!isset($_GET["id"]) || empty($_GET["id"])) {
    echo "IDが指定されていません。"; ?>

    <a href="select.php">データ一覧に戻る</a>
<?php
    exit(); // 処理を終了させます
}
$id = $_GET["id"]; //?id~**を受け取る
include("funcs.php");
sschk();

$product_id = $_SESSION["product_id"];

$pdo = db_conn();

//２．データ登録SQL作成
// form2_table
$stmt = $pdo->prepare("SELECT * FROM review WHERE id=:id");
$stmt->bindValue(":id", $id, PDO::PARAM_INT);
$status = $stmt->execute();

//３．データ表示
// form2_table
if ($status == false) {
    sql_error($stmt);
} else {
    $row = $stmt->fetch();
}

?>



<?php include("head.php"); ?>
<link rel="stylesheet" href="css/index.css">
<link rel="stylesheet" href="css/common.css">
<title>口コミ詳細</title>
</head>

<body>

    <?php include("menu.php"); ?>
    <main>
        <h2>口コミ詳細</h2>

        <div class="form-wrapper">
            <table>
                <tr>
                    <td>評価</td>
                    <td><?= h($row['rating']) ?></td>
                </tr>
                <tr>
                    <td>口コミ</td>
                    <td><?= h($row['review']) ?></td>
                </tr>
                <tr>
                    <td>画像</td>
                    <td><img src="<?= h($row['image']) ?>" alt=""></td>
                </tr>
            </table>
        </div>
        <a href="all-select.php?product_id=<?= $product_id ?>" class="link">一覧に戻る</a>
    </main>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="js/menu.js"></script>
</body>

</html>