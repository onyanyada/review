<?php
session_start(); // セッションを開始
include("funcs.php");
sschk();

// セッションからデータを取得
$rating        = isset($_SESSION["rating"]) ? $_SESSION["rating"] : 'なし';
$review       = isset($_SESSION["review"]) ? $_SESSION["review"] : 'なし';
$image    = isset($_SESSION["image"]) ? $_SESSION["image"] : 'なし';
$product_id = $_SESSION["product_id"];
?>

<?php include("head.php"); ?>
<title>登録完了</title>
<link rel="stylesheet" href="css/complete.css">
<link rel="stylesheet" href="css/index.css">
</head>
<?php include("menu.php"); ?>

<body>

    <header>
        <h1>送信完了</h1>
    </header>
    <main>

        <p class="complete">アンケートを送信しました</p>
        <div class="form-wrapper">
            <table>
                <tr>
                    <td>名前</td>
                    <td><?= h($rating) ?></td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td><?= h($review) ?></td>
                </tr>
                <tr>
                    <td>画像</td>
                    <td>
                        <?php if ($image && file_exists($image)) : ?>
                            <img src="<?= h($image) ?>" alt="">
                        <?php else : ?>
                            画像なし
                        <?php endif; ?>
                    </td>
                </tr>
            </table>

        </div>
        <a class="back" href="all-select.php?product_id=<?= $product_id ?>">戻る</a>

    </main>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="js/menu.js"></script>
</body>

</html>