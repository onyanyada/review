<?php
session_start();
?>

<?php include("head.php"); ?>
<title>ユーザー確認</title>
</head>

<body>


    <!-- header -->
    <?php include("menu.php"); ?>

    <main>
        <h2>入力内容確認</h2>
        <form method="post" action="user-insert.php">
            <table>
                <tr>
                    <td>名前</td>
                    <td>
                        <p><?= h($_POST['name']) ?></p>
                    </td>
                </tr>
                <tr>
                    <td>Login ID</td>
                    <td>
                        <p><?= h($_POST['lid']) ?></p>
                    </td>
                </tr>
                <tr>
                    <td>Login Password</td>
                    <td>
                        <p><?= h($_POST['lpw']) ?></p>
                    </td>
                </tr>
            </table>

            <!-- hidden fields to pass data to user-insert.php -->
            <input type="hidden" name="name" value="<?= h($_POST['name']) ?>">
            <input type="hidden" name="lid" value="<?= h($_POST['lid']) ?>">
            <input type="hidden" name="lpw" value="<?= h($_POST['lpw']) ?>">

            <input type="submit" value="登録する">
            <button type="button" onclick="history.back()">戻る</button>
        </form>
    </main>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="js/menu.js"></script>
</body>

</html>