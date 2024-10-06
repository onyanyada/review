<?php
session_start();
// $_GET["id"]がセットされているか確認
if (!isset($_GET["id"]) || empty($_GET["id"])) {
    echo "IDが指定されていません。"; ?>

    <a href="product-select.php">データ一覧に戻る</a>
<?php
    exit(); // 処理を終了させます
}
$id = $_GET["id"]; //?id~**を受け取る
include("funcs.php");
sschk();
$pdo = db_conn();

//２．データ登録SQL作成
// product
$stmt = $pdo->prepare("SELECT * FROM product WHERE id=:id");
$stmt->bindValue(":id", $id, PDO::PARAM_INT);
$status = $stmt->execute();

// tag
$tag_stmt = $pdo->prepare("SELECT tag FROM tag WHERE product_id = :id");
$tag_stmt->bindValue(':id', $id, PDO::PARAM_INT);
$tag_status = $tag_stmt->execute();
$tag = [];

//３．データ表示
// form2_table
if ($status == false) {
    sql_error($stmt);
} else {
    $row = $stmt->fetch();
}

// tz_table
if ($tag_status == false) {
    sql_error($tag_stmt);
} else {
    $tag = $tag_stmt->fetchAll(PDO::FETCH_COLUMN); // 配列を取得
}

$tags = implode(',', $tag);
?>



<?php include("head.php"); ?>
<title>商品編集</title>
</head>

<body>


    <!-- header -->
    <?php include("menu.php"); ?>

    <main>
        <h2>商品編集</h2>
        <div class="form-wrapper">
            <form action="product-update.php" method="post">
                <table>
                    <tr>
                        <td>商品名</td>
                        <td><input type="text" name="product_name" value="<?= h($row['product_name']) ?>" required></td>
                    </tr>
                    <tr>
                        <td>カテゴリ1</td>
                        <td>
                            <select name="category1">
                                <option value="肉" <?= $row['category1'] == "肉" ? 'selected' : '' ?>>肉</option>
                                <option value="魚" <?= $row['category1'] == "魚" ? 'selected' : '' ?>>魚</option>
                                <option value="菓子" <?= $row['category1'] == "菓子" ? 'selected' : '' ?>>菓子</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>カテゴリ2</td>
                        <td>
                            <select name="category2">
                                <option value="肉" <?= $row['category2'] == "肉" ? 'selected' : '' ?>>肉</option>
                                <option value="魚" <?= $row['category2'] == "魚" ? 'selected' : '' ?>>魚</option>
                                <option value="菓子" <?= $row['category2'] == "菓子" ? 'selected' : '' ?>>菓子</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>タグ</td>
                        <td>
                            <input type="text" name="tag" value="<?= h($tags) ?>">
                        </td>
                    </tr>
                </table>
                <button type="submit">更新</button>
                <input type="hidden" name="id" value="<?= h($id) ?>">
            </form>
        </div>
    </main>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="js/menu.js"></script>
</body>

</html>