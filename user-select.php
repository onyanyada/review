<?php
//0. SESSION開始！！
session_start();

//１．関数群の読み込み
include("funcs.php");

//LOGINチェック → funcs.phpへ関数化しましょう！
sschk();

// セッションからログイン中のユーザーの `lid` を取得
$lid = $_SESSION["lid"];


//２．データ登録SQL作成
$pdo = db_conn();
$sql = "SELECT * FROM user WHERE lid = :lid";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':lid', $lid, PDO::PARAM_STR);
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
<title>USERデータ登録</title>
<link rel="stylesheet" href="css/select.css">
</head>

<body>

    <!-- header -->
    <?php include("menu.php"); ?>


    <!-- Main[Start] -->
    <div>

        <div class="user-info">
            <h2>プロフィール設定</h2>
            <table>
                <tr>
                    <th>名前</th>
                    <th>ログインID</th>
                    <th>パスワード</th>
                    <th>更新</th>
                </tr>
                <?php foreach ($values as $v) { ?>
                    <tr>
                        <td><?= h($v["name"]) ?></td>
                        <td><?= h($v["lid"]) ?></td>
                        <td><?= h($v["lpw"]) ?></td>
                        <td><a href="user-detail.php?id=<?= $v["id"] ?>">[更新]</a></td>
                    </tr>
                <?php } ?>
            </table>
        </div>
        <p>
            <a class="" href="select.php">自分の口コミ一覧を見る</a>
        </p>
        <p>
            <a class="nav-item" href="logout.php">ログアウト</a>
        </p>

    </div>
    <!-- Main[End] -->

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="js/menu.js"></script>
</body>

</html>