<?php
//0. SESSION開始！！
session_start();

//１．関数群の読み込み
include("funcs.php");

//LOGINチェック → funcs.phpへ関数化しましょう！
sschk();

//2. DB接続します
$pdo = db_conn();

//$user_idをもとにレビューを取得
$sql = "SELECT * FROM review WHERE user_id = :user_id";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':user_id', $user_id, PDO::PARAM_STR);
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
<title>自分の口コミ一覧</title>
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
                    <th>口コミ</th>
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
                    <td><?= mb_substr($v["indate"], 0, 10) ?></td>
                    <td><a href="detail.php?id=<?= $v["id"] ?>">[更新]</a></td>
                    <td><a href="delete.php?id=<?= $v["id"] ?>">[削除]</a></td>

                </tr>
            <?php } ?>
        </table>
    </main>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="js/menu.js"></script>
</body>

</html>