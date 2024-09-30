<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>アンケート</title>
    <link rel="stylesheet" href="css/index.css">
</head>

<body>
    <header>
        <h1>漫画アンケート</h1>
    </header>
    <main>
        <div class="form-wrapper">
            <form action="confirm.php" method="post">
                <table>
                    <tr>
                        <td>
                            <div class="label-wrapper">
                                <span class="itemName">名前</span>
                                <span class="required">必須</span>
                            </div>
                        </td>
                        <td><input type="text" name="name" placeholder="山田太郎" required></td>
                    </tr>
                    <tr>
                        <td>
                            <div class="label-wrapper">
                                <span class="itemName">Email</span>
                                <span class="required">必須</span>
                            </div>
                        </td>
                        <td><input type="email" name="email" placeholder="taro@gmail.com" required></td>
                    </tr>
                    <tr>
                        <td>
                            <div class="label-wrapper">
                                <span class="itemName">漫画年間<br>支出額</span>
                                <span class="required">必須</span>
                            </div>
                        </td>
                        <td>
                            <select name="spending">
                                <option value="5">5万円以下</option>
                                <option value="10">5~10万円</option>
                                <option value="15">10~15万円</option>
                                <option value="20">15~20万円</option>
                                <option value="25">25万円以上</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="label-wrapper">
                                <span class="itemName">年収</span>
                                <span class="required">必須</span>
                            </div>
                        </td>
                        <td>
                            <select name="income">
                                <option value="200">200万円以下</option>
                                <option value="300">300万円代</option>
                                <option value="400">400万円代</option>
                                <option value="500">500万円代</option>
                                <option value="600">600万円以上</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="label-wrapper">
                                <span class="itemName">年齢</span>
                                <span class="required">必須</span>
                            </div>
                        </td>
                        <td>
                            <select name="age">
                                <option value="10">10代</option>
                                <option value="20">20代</option>
                                <option value="30">30代</option>
                                <option value="40">40代</option>
                                <option value="50">50代</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="label-wrapper">
                                <span class="itemName">性別</span>
                                <span class="required">必須</span>
                            </div>
                        </td>
                        <td>
                            <input type="radio" name="gender" value="male" required>
                            <label for="male">男</label>
                            <input type="radio" name="gender" value="female">
                            <label for="female">女</label>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="label-wrapper">
                                <span class="itemName">時間/週</span>
                                <span class="required">必須</span>
                            </div>
                        </td>
                        <td>
                            <select name="hour" required>
                                <option value="5">5時間以下</option>
                                <option value="10">10時間以下</option>
                                <option value="20">20時間以下</option>
                                <option value="30">30時間以下</option>
                                <option value="40">40時間以上</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>時間帯</td>
                        <td>
                            <?php
                            $days = ['月', '火', '水', '木', '金', '土', '日'];
                            $times = ['朝', '昼', '夕方', '夜'];

                            foreach ($days as $day) {
                                foreach ($times as $time) {
                                    echo "<label><input type='checkbox' name='timeZone[]' value='{$day}{$time}'>{$day}{$time}</label><br>";
                                }
                            }
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="label-wrapper">
                                <span class="itemName">地域</span>
                                <span class="required">必須</span>
                            </div>
                        </td>
                        <td>
                            <select name="region" required>
                                <option value="tokyo">東京</option>
                                <option value="saitama">埼玉</option>
                                <option value="kanagawa">神奈川</option>
                                <option value="chiba">千葉</option>
                            </select>
                        </td>
                    </tr>
                </table>
                <button type="submit">送信</button>
            </form>
        </div>
    </main>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        $(' form').on('submit', function(event) {
            // メールが正しい形式か確認
            const email = $('input[name="email"]').val();
            const emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;

            if (!emailPattern.test(email)) {
                alert('正しいメールアドレスを入力してください');
                event.preventDefault(); // フォーム送信を停止
            }
        });
    </script>
</body>

</html>