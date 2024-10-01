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
$sql = "SELECT * FROM review";

// 絞り込みがある場合のクエリの追加
if (isset($_GET['rating_filter']) && $_GET['rating_filter'] != "") {
    $sql .= " WHERE rating = :rating_filter";
}

// 並び替えの条件を設定
if (isset($_GET['sort'])) {
    if ($_GET['sort'] == 'rating_desc') {
        $sql .= " ORDER BY rating DESC";
    } elseif ($_GET['sort'] == 'rating_asc') {
        $sql .= " ORDER BY rating ASC";
    } elseif ($_GET['sort'] == 'date_desc') {
        $sql .= " ORDER BY indate DESC";
    } elseif ($_GET['sort'] == 'date_asc') {
        $sql .= " ORDER BY indate ASC";
    }
} else {
    $sql .= " ORDER BY indate DESC";
}

// SQL実行の準備
$stmt = $pdo->prepare($sql);

// 絞り込みのための値をバインド
if (isset($_GET['rating_filter']) && $_GET['rating_filter'] != "") {
    $stmt->bindValue(':rating_filter', $_GET['rating_filter'], PDO::PARAM_INT);
}

// SQL実行
$status = $stmt->execute();


//３．データ表示
$values = "";
if ($status == false) {
    sql_error($stmt);
}

//全データ取得
$values =  $stmt->fetchAll(PDO::FETCH_ASSOC); //PDO::FETCH_ASSOC[カラム名のみで取得できるモード]

// ログインしていない場合、口コミを3つまでに制限
if (!isset($_SESSION["name"])) {
    $values = array_slice($values, 0, 3); // 最初の3つを取得
}

// json
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
        <form method="GET" action="">
            <label for="sort">並び替え:</label>
            <select name="sort" id="sort">
                <option value="date_desc" <?= (isset($_GET['sort']) && $_GET['sort'] == 'date_desc') ? 'selected' : '' ?>>新しい順</option>
                <option value="date_asc" <?= (isset($_GET['sort']) && $_GET['sort'] == 'date_asc') ? 'selected' : '' ?>>古い順</option>
                <option value="rating_desc" <?= (isset($_GET['sort']) && $_GET['sort'] == 'rating_desc') ? 'selected' : '' ?>>評価が高い順</option>
                <option value="rating_asc" <?= (isset($_GET['sort']) && $_GET['sort'] == 'rating_asc') ? 'selected' : '' ?>>評価が低い順</option>
            </select>

            <label for="rating_filter">評価の絞り込み:</label>
            <select name="rating_filter" id="rating_filter">
                <option value="">すべて</option>
                <option value="5" <?= (isset($_GET['rating_filter']) && $_GET['rating_filter'] == '5') ? 'selected' : '' ?>>5</option>
                <option value="4" <?= (isset($_GET['rating_filter']) && $_GET['rating_filter'] == '4') ? 'selected' : '' ?>>4</option>
                <option value="3" <?= (isset($_GET['rating_filter']) && $_GET['rating_filter'] == '3') ? 'selected' : '' ?>>3</option>
                <option value="2" <?= (isset($_GET['rating_filter']) && $_GET['rating_filter'] == '2') ? 'selected' : '' ?>>2</option>
                <option value="1" <?= (isset($_GET['rating_filter']) && $_GET['rating_filter'] == '1') ? 'selected' : '' ?>>1</option>
            </select>

            <button type="submit">適用</button>
        </form>
        <table>
            <?php foreach ($values as $v) { ?>
                <tr>
                    <th>評価</th>
                    <th>口コミ内容</th>
                    <th>投稿画像</th>
                    <th>投稿日</th>
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
                    <td><?= mb_substr($v["indate"], 0, 10) ?></td>
                    <td><a href="all-detail.php?id=<?= $v["id"] ?>">[詳細]</a></td>
                </tr>
            <?php } ?>
        </table>
        <?php if (!isset($_SESSION["name"])) { ?>
            <a href="login.php">もっと見るためにログインする</a>
        <?php } ?>
    </main>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="js/menu.js"></script>
</body>

</html>