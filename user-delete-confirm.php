<?php
session_start();
include("funcs.php");
sschk();
$id = $_SESSION["id"];

if (empty($id)) {
    echo "IDが指定されていません。";
    exit();
}



?>
<?php include("head.php"); ?>
<title>ユーザー完全削除確認</title>
</head>

<body>


    <!-- header -->
    <?php include("menu.php"); ?>

    <main>
        <h2>本当に退会して完全削除しますか？</h2>

        <a href="user-delete.php?id=<?= h($id) ?>">退会して完全削除する</a>
        <a href="user-detail.php?id=<?= h($id) ?>">キャンセル</a>

    </main>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="js/menu.js"></script>
</body>

</html>