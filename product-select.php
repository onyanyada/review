<?php
//0. SESSION開始！！
session_start();

//１．関数群の読み込み
include("funcs.php");

//LOGINチェック → funcs.phpへ関数化しましょう！
// sschk();

//2. DB接続します
$pdo = db_conn();

// タグ一覧の取得クエリ
$sql_tag = "SELECT DISTINCT tag FROM tag";
$stmt_tag = $pdo->prepare($sql_tag);
$status_tag = $stmt_tag->execute();

if ($status_tag == false) {
    sql_error($stmt_tag);
}

// タグを全て取得
$tags_list = $stmt_tag->fetchAll(PDO::FETCH_ASSOC);


// フォームから検索条件を取得
$category1 = isset($_GET['category1']) ? $_GET['category1'] : '';
$category2 = isset($_GET['category2']) ? $_GET['category2'] : '';
$tags = isset($_GET['tags']) ? $_GET['tags'] : [];
$keyword = isset($_GET['keyword']) ? $_GET['keyword'] : '';

// クエリの作成
$sql = "SELECT f.*, GROUP_CONCAT(t.tag SEPARATOR ', ') AS tag 
        FROM product f
        LEFT JOIN tag t ON f.id = t.product_id 
        WHERE 1=1";

// カテゴリ1の条件追加（正確な一致）
if (!empty($category1)) {
    $sql .= " AND f.category1 = :category1";
}
// カテゴリ2の条件追加（正確な一致）
if (!empty($category2)) {
    $sql .= " AND f.category2 = :category2";
}
// 検索ワードの条件追加（部分一致検索）
if (!empty($keyword)) {
    $sql .= " AND (f.product_name LIKE :keyword OR f.category1 LIKE :keyword OR f.category2 LIKE :keyword)";
}

// タグの条件追加（複数のタグを含む商品を検索）
if (!empty($tags)) {
    // 複数のタグを検索するクエリ
    $placeholders = implode(',', array_fill(0, count($tags), '?')); // 例: "?, ?, ?"
    $sql .= " AND t.tag IN ($placeholders)";
}

$sql .= " GROUP BY f.id";

// SQL実行の準備
$stmt = $pdo->prepare($sql);

// パラメータバインディング
if (!empty($category1)) {
    $stmt->bindValue(':category1', $category1, PDO::PARAM_STR);
}
if (!empty($category2)) {
    $stmt->bindValue(':category2', $category2, PDO::PARAM_STR);
}
if (!empty($keyword)) {
    $stmt->bindValue(':keyword', "%$keyword%", PDO::PARAM_STR);
}

// タグのバインディング
if (!empty($tags)) {
    foreach ($tags as $index => $tag) {
        $stmt->bindValue(($index + 1), $tag, PDO::PARAM_STR); // ?プレースホルダーにタグをバインド
    }
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

// json
$json = json_encode($values, JSON_UNESCAPED_UNICODE);
?>

<?php include("head.php"); ?>
<title>商品一覧</title>
<link rel="stylesheet" href="css/select.css">
<link rel="stylesheet" href="css/product-select.css">
</head>

<body>

    <!-- header -->
    <?php include("menu.php"); ?>

    <main>
        <h2>商品一覧</h2>
        <!-- 商品検索 -->
        <div class="search">
            <form method="GET" action="">
                <label for="category1">カテゴリ1:</label>
                <select name="category1" id="category1">
                    <option value="">すべて</option>
                    <option value="肉">肉</option>
                    <option value="魚">魚</option>
                    <option value="菓子">菓子</option>
                </select>

                <label for="category2">カテゴリ2:</label>
                <select name="category2" id="category2">
                    <option value="">すべて</option>
                </select>

                <label>タグ:</label>
                <?php foreach ($tags_list as $tag) { ?>
                    <label>
                        <input type="checkbox" name="tags[]" value="<?= h($tag['tag']) ?>">
                        <?= h($tag['tag']) ?>
                    </label>
                <?php } ?>

                <label for="keyword">検索ワード:</label>
                <input type="text" name="keyword" id="keyword">
                <button type="submit">検索</button>
            </form>
        </div>
        <table>
            <tr>
                <th>商品名</th>
                <th>カテゴリ1</th>
                <th>カテゴリ2</th>
                <th>タグ</th>
                <th>口コミ</th>
                <th>詳細</th>
                <th>削除</th>
            </tr>
            <?php foreach ($values as $v) { ?>

                <tr>
                    <td><?= $v["product_name"] ?></td>
                    <td><?= $v["category1"] ?></td>
                    <td><?= $v["category2"] ?></td>
                    <td><?= $v["tag"] ?></td>
                    <td><a href="all-select.php?product_id=<?= $v["id"] ?>">口コミ</a></td>
                    <td><a href="product-detail.php?id=<?= $v["id"] ?>">[更新]</a></td>
                    <td><a href="product-delete.php?id=<?= $v["id"] ?>">[削除]</a></td>
                </tr>
            <?php } ?>
        </table>
    </main>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="js/menu.js"></script>
    <script src="js/product-select.js"></script>
</body>

</html>