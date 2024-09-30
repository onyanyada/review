<?php
// POSTで送られてきたデータを受け取る
$name  = $_POST["name"];
$email = $_POST["email"];
$spending  = $_POST["spending"];
$income  = $_POST["income"];
$age  = $_POST["age"];
$gender  = $_POST["gender"];
$hour  = $_POST["hour"];
$timeZone = isset($_POST['timeZone']) ? $_POST['timeZone'] : [];
$timeZoneStr = implode(".", $timeZone);
$region  = $_POST["region"];
?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>確認画面</title>
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="css/confirm.css">
</head>

<body>
    <header>
        <h1>確認画面</h1>
    </header>
    <main>
        <div class="form-wrapper">
            <div class="confritm-msg">
                <p>以下の内容で送信しますか？</p>
            </div>
            <form action="insert.php" method="post">
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
                <!-- 確認用にデータを再送信 -->
                <input type="hidden" name="name" value="<?= htmlspecialchars($name) ?>">
                <input type="hidden" name="email" value="<?= htmlspecialchars($email) ?>">
                <input type="hidden" name="spending" value="<?= htmlspecialchars($spending) ?>">
                <input type="hidden" name="income" value="<?= htmlspecialchars($income) ?>">
                <input type="hidden" name="age" value="<?= htmlspecialchars($age) ?>">
                <input type="hidden" name="gender" value="<?= htmlspecialchars($gender) ?>">
                <input type="hidden" name="hour" value="<?= htmlspecialchars($hour) ?>">
                <input type="hidden" name="timeZoneStr" value="<?= htmlspecialchars($timeZoneStr) ?>">
                <input type="hidden" name="region" value="<?= htmlspecialchars($region) ?>">
                <!-- TimeZone配列の各要素を個別に送信 -->
                <?php foreach ($timeZone as $tz): ?>
                    <input type="hidden" name="timeZone[]" value="<?= htmlspecialchars($tz) ?>">
                <?php endforeach; ?>
                <button type="submit">送信する</button>
            </form>
        </div>
    </main>
</body>

</html>