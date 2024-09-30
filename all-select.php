<?php
//0. SESSION開始！！
session_start();

//１．関数群の読み込み
include("funcs.php");

//LOGINチェック → funcs.phpへ関数化しましょう！
sschk();

//2. DB接続します
$pdo = db_conn();

//レビューを取得
$sql = "SELECT * FROM review";
$stmt = $pdo->prepare($sql);
$status = $stmt->execute();


//３．データ表示
$values = "";
if ($status == false) {
    sql_error($stmt);
}

//全データ取得
$values =  $stmt->fetchAll(PDO::FETCH_ASSOC); //PDO::FETCH_ASSOC[カラム名のみで取得できるモード]
$json = json_encode($values, JSON_UNESCAPED_UNICODE);
?>

<?php include("head.php"); ?>
<title>皆の口コミ一覧</title>
<link rel="stylesheet" href="css/select.css">
</head>

<body>

    <!-- header -->
    <?php include("menu.php"); ?>

    <main>
        <h2>皆の口コミ一覧</h2>
        <table>
            <?php foreach ($values as $v) { ?>
                <tr>
                    <th>評価</th>
                    <th>口コミ内容</th>
                    <th>投稿画像</th>
                    <th>詳細</th>
                </tr>
                <tr>
                    <td><?= $v["rating"] ?></td>
                    <td>
                        <?php
                        // 口コミ内容が30文字以上の場合、31文字以降を非表示にし「...」を表示
                        if (mb_strlen($v["review"]) > 30) {
                            echo mb_substr($v["review"], 0, 30) . "...";
                        } else {
                            echo $v["review"];
                        }
                        ?>
                    </td>
                    <td><img src="<?= $v["image"] ?>" alt=""></td>
                    <td><a href="all-detail.php?id=<?= $v["id"] ?>">[詳細]</a></td>
                </tr>
            <?php } ?>
        </table>
    </main>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</body>

</html>