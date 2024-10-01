<?php
//0. SESSION開始！！
session_start();

//１．関数群の読み込み
include("funcs.php");

//LOGINチェック → funcs.phpへ関数化しましょう！
// sschk();

//2. DB接続します
$pdo = db_conn();

// クエリの作成
// $sql = "SELECT * FROM product";
$sql = "SELECT f.*, GROUP_CONCAT(t.tag SEPARATOR ', ') AS tag 
        FROM product f
        LEFT JOIN tag t ON f.id = t.product_id 
        GROUP BY f.id";

// SQL実行の準備
$stmt = $pdo->prepare($sql);

// SQL実行
$status = $stmt->execute();


//３．データ表示
$values = "";
if ($status == false) {
    sql_error($stmt);
}

//全データ取得
$values =  $stmt->fetchAll(PDO::FETCH_ASSOC); //PDO::FETCH_ASSOC[カラム名のみで取得できるモード]

// json
$json = json_encode($values, JSON_UNESCAPED_UNICODE);
?>

<?php include("head.php"); ?>
<title>商品一覧</title>
<link rel="stylesheet" href="css/select.css">
</head>

<body>

    <!-- header -->
    <?php include("menu.php"); ?>

    <main>
        <h2>商品一覧</h2>
        <table>
            <?php foreach ($values as $v) { ?>
                <tr>
                    <th>商品名</th>
                    <th>カテゴリ1</th>
                    <th>カテゴリ2</th>
                    <th>タグ</th>
                    <th>詳細</th>
                </tr>
                <tr>
                    <td><?= $v["name"] ?></td>
                    <td><?= $v["category1"] ?></td>
                    <td><?= $v["category2"] ?></td>
                    <td><?= $v["tag"] ?></td>
                    <td><a href="product-detail.php?id=<?= $v["id"] ?>">[詳細]</a></td>
                </tr>
            <?php } ?>
        </table>
    </main>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="js/menu.js"></script>
</body>

</html>