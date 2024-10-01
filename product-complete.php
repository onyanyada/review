<?php
session_start(); // セッションを開始
include("funcs.php");
// セッションからデータを取得
// 必須入力項目は直接取得
$product_name        = $_SESSION["product_name"];
$category1       = $_SESSION["category1"];
$category2    = $_SESSION["category2"];
$tagstr      = $_SESSION["tagstr"];

?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>登録完了</title>
    <link rel="stylesheet" href="css/complete.css">
    <link rel="stylesheet" href="css/index.css">
</head>

<body>

    <!-- Head[Start] -->
    <header>
        <h1>商品送信完了</h1>
    </header>
    <!-- Head[End] -->

    <!-- Main[Start] -->
    <main>

        <p class="complete">アンケートを送信しました</p>
        <div class="form-wrapper">
            <table>
                <tr>
                    <td>商品名</td>
                    <td><?= h($product_name) ?></td>
                </tr>
                <tr>
                    <td>カテゴリ1</td>
                    <td><?= h($category1) ?></td>
                </tr>
                <tr>
                    <td>カテゴリ12</td>
                    <td><?= h($category2) ?></td>
                </tr>
                <tr>
                    <td>タグ</td>
                    <td><?= h($tagstr) ?></td>
                </tr>
            </table>

        </div>
        <a class="back" href="product-index.php">戻る</a>

    </main>


</body>

</html>