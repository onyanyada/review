<?php
session_start(); // セッションを開始
include("funcs.php");
sschk();

// セッションからデータを取得
$rating        = isset($_SESSION["rating"]) ? $_SESSION["rating"] : 'なし';
$review       = isset($_SESSION["review"]) ? $_SESSION["review"] : 'なし';
$image    = isset($_SESSION["image"]) ? $_SESSION["image"] : 'なし';

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
                    <td><img src="<?= h($image) ?>" alt=""></td>
                </tr>
            </table>

        </div>
        <a class="back" href="index.php">戻る</a>

    </main>


</body>

</html>