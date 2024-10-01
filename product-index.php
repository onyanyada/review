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
<title>商品登録</title>
<link rel="stylesheet" href="css/index.css">
</head>

<!-- header -->
<?php include("menu.php"); ?>

<body>
    <header>
        <h1>商品登録</h1>
    </header>
    <main>
        <div class="form-wrapper">

            <form action="product-insert.php" method="post">
                <table>
                    <tr>
                        <td>商品名</td>
                        <td><input type="text" name="product_name"></td>
                    </tr>
                    <tr>
                        <td>カテゴリ1</td>
                        <td>
                            <select name="category1">
                                <option value="肉">肉</option>
                                <option value="魚">魚</option>
                                <option value="菓子">菓子</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>カテゴリ2</td>
                        <td>
                            <select name="category2">
                                <option value="肉">肉</option>
                                <option value="魚">魚</option>
                                <option value="菓子">菓子</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>タグ</td>
                        <td>
                            <input type="text" name="tag" placeholder="タグをカンマで区切って入力">
                        </td>
                    </tr>
                </table>
                <button type="submit">投稿</button>
            </form>
        </div>
    </main>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</body>

</html>