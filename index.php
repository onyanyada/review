<?php
session_start();
include("funcs.php");

//LOGINチェック
sschk();

if (!isset($_SESSION['lid'])) {
    header("Location: login.php");
    exit();
}
?>


<?php include("head.php"); ?>
<title>フリーアンケート表示</title>
<link rel="stylesheet" href="css/index.css">
</head>

<!-- header -->
<?php include("menu.php"); ?>

<body>
    <header>
        <h1>口コミ</h1>
    </header>
    <main>
        <div class="form-wrapper">
            <form action="insert.php" method="post" enctype="multipart/form-data">
                評価: <input type="number" name="rating" min="1" max="5"><br>
                口コミ: <textarea name="review"></textarea><br>
                画像: <input type="file" name="image"><br>
                <button type="submit">投稿</button>
            </form>
        </div>
    </main>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</body>

</html>