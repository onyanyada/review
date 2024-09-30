<?php
session_start();
include("funcs.php");

// POSTで送られてきたデータを受け取る
$_SESSION["rating"]  = $_POST["rating"];
$_SESSION["review"]  = $_POST["review"];
$image  = $_FILES["image"];

// 画像ファイルの処理
if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
    // 一時ファイルのパスをセッションに保存
    $temp_image_path = $_FILES['image']['tmp_name'];
    $_SESSION["temp_image_path"] = $temp_image_path;
}
?>

<?php include("head.php"); ?>
<title>口コミ投稿確認</title>
<link rel="stylesheet" href="css/index.css">
</head>

<!-- header -->
<?php include("menu.php"); ?>

<body>
    <header>
        <h1>確認画面</h1>
    </header>
    <main>
        <div class="form-wrapper">
            <div class="confirm-msg">
                <p>以下の内容で送信しますか？</p>
            </div>
            <form action="insert.php" method="post" enctype="multipart/form-data">
                <table>
                    <tr>
                        <td>評価</td>
                        <td><?= h($_SESSION["name"]) ?></td>
                    </tr>
                    <tr>
                        <td>レビュー</td>
                        <td><?= h($_SESSION["review"]) ?></td>
                    </tr>
                    <tr>
                        <td>画像</td>
                        <td>
                            <?php if (isset($_SESSION["temp_image_path"])): ?>
                                <img src="<?= 'data:image/jpeg;base64,' . base64_encode(file_get_contents($_SESSION["temp_image_path"])); ?>" width="150">
                                <input type="hidden" name="image_temp_path" value="<?= $_SESSION["temp_image_path"] ?>">


                            <?php else: ?>
                                画像はありません。
                            <?php endif; ?>
                        </td>
                    </tr>
                </table>
                <button type="submit">送信する</button>
            </form>
        </div>
    </main>
</body>

</html>