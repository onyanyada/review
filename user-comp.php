<?php
session_start();
?>

<?php include("head.php"); ?>
<title>アンケート編集</title>
</head>

<body>
    <!-- header -->
    <?php include("menu.php"); ?>
    <main>
        <h2>ユーザー登録が完了しました</h2>
        <table>
            <tr>
                <td>名前:</td>
                <td><?= h($_SESSION['registered-name']) ?></td>
            </tr>
            <tr>
                <td>Login ID:</td>
                <td><?= h($_SESSION['lid']) ?></td>
            </tr>
            <tr>
                <td>Login PASS</td>
                <td><?= h($_SESSION['lpwBefore']) ?></td>
            </tr>
        </table>
        <a href="user.php">ユーザー登録画面に戻る</a>
    </main>

</body>

</html>