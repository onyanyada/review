<?php
session_start(); // セッションを開始

// セッションからデータを取得
$name        = isset($_SESSION["name"]) ? $_SESSION["name"] : '不明な名前';
$email       = isset($_SESSION["email"]) ? $_SESSION["email"] : '不明なメールアドレス';
$spending    = isset($_SESSION["spending"]) ? $_SESSION["spending"] : '不明な';
$income      = isset($_SESSION["income"]) ? $_SESSION["income"] : '不明な内容';
$age         = isset($_SESSION["age"]) ? $_SESSION["age"] : '不明な名前';
$gender      = isset($_SESSION["gender"]) ? $_SESSION["gender"] : '不明なメールアドレス';
$hour        = isset($_SESSION["hour"]) ? $_SESSION["hour"] : '不明な年齢';
$timeZoneStr = isset($_SESSION["timeZoneStr"]) ? $_SESSION["timeZoneStr"] : '不明な内容';
$region      = isset($_SESSION["region"]) ? $_SESSION["region"] : '不明な内容';


// セッションデータをクリア（完了後は不要なセッションデータを消す）
session_unset();
session_destroy();
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
        <h1>送信完了</h1>
    </header>
    <!-- Head[End] -->

    <!-- Main[Start] -->
    <main>

        <p class="complete">アンケートを送信しました</p>
        <div class="form-wrapper">
            <table>
                <tr>
                    <td>名前</td>
                    <td><?= htmlspecialchars($name) ?></td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td><?= htmlspecialchars($email) ?></td>
                </tr>
                <tr>
                    <td>漫画年間支出額</td>
                    <td><?= htmlspecialchars($spending) ?></td>
                </tr>
                <tr>
                    <td>収入</td>
                    <td><?= htmlspecialchars($income) ?></td>
                </tr>
                <tr>
                    <td>年齢</td>
                    <td><?= htmlspecialchars($age) ?></td>
                </tr>
                <tr>
                    <td>性別</td>
                    <td><?= htmlspecialchars($gender) ?></td>
                </tr>
                <tr>
                    <td>時間/週</td>
                    <td><?= htmlspecialchars($hour) ?></td>
                </tr>
                <tr>
                    <td>時間帯</td>
                    <td><?= htmlspecialchars($timeZoneStr) ?></td>
                </tr>
                <tr>
                    <td>地域</td>
                    <td><?= htmlspecialchars($region) ?></td>
                </tr>
            </table>

        </div>
        <a class="back" href="index.php">戻る</a>

    </main>


</body>

</html>