<?php
session_start();
// $_GET["id"]がセットされているか確認
if (!isset($_GET["id"]) || empty($_GET["id"])) {
  echo "IDが指定されていません。"; ?>

  <a href="select.php">データ一覧に戻る</a>
<?php
  exit(); // 処理を終了させます
}
$id = $_GET["id"]; //?id~**を受け取る
include("funcs.php");
sschk();
$pdo = db_conn();

//２．データ登録SQL作成
// form2_table
$stmt = $pdo->prepare("SELECT * FROM form2_table WHERE id=:id");
$stmt->bindValue(":id", $id, PDO::PARAM_INT);
$status = $stmt->execute();

// tz_table
$tz_stmt = $pdo->prepare("SELECT timeZone FROM tz_table WHERE form2_id = :id");
$tz_stmt->bindValue(':id', $id, PDO::PARAM_INT);
$tz_status = $tz_stmt->execute();
$timeZones = [];

//３．データ表示
// form2_table
if ($status == false) {
  sql_error($stmt);
} else {
  $row = $stmt->fetch();
}

// tz_table
if ($tz_status == false) {
  sql_error($tz_stmt);
} else {
  $timeZones = $tz_stmt->fetchAll(PDO::FETCH_COLUMN); // timeZone の配列を取得
}
?>



<?php include("head.php"); ?>
<title>アンケート編集</title>
</head>

<body>


  <!-- header -->
  <?php include("menu.php"); ?>
  <h2>アンケート編集</h2>

  <div class="form-wrapper">
    <form action="update.php" method="post">
      <table>
        <!-- 名前 -->
        <tr>
          <td>名前</td>
          <td><input type="text" name="name" value="<?= h($row['name']) ?>" required></td>
        </tr>

        <!-- Email -->
        <tr>
          <td>Email</td>
          <td><input type="email" name="email" value="<?= h($row['email']) ?>" required></td>
        </tr>

        <!-- 漫画年間支出額 -->
        <tr>
          <td>漫画年間支出額</td>
          <td>
            <select name="spending">
              <option value="5" <?= $row['spending'] == 5 ? 'selected' : '' ?>>5万円以下</option>
              <option value="10" <?= $row['spending'] == 10 ? 'selected' : '' ?>>5~10万円</option>
              <option value="15" <?= $row['spending'] == 15 ? 'selected' : '' ?>>10~15万円</option>
              <option value="20" <?= $row['spending'] == 20 ? 'selected' : '' ?>>15~20万円</option>
              <option value="25" <?= $row['spending'] == 25 ? 'selected' : '' ?>>25万円以上</option>
            </select>
          </td>
        </tr>

        <!-- 年収 -->
        <tr>
          <td>年収</td>
          <td>
            <select name="income">
              <option value="200" <?= $row['income'] == 200 ? 'selected' : '' ?>>200万円以下</option>
              <option value="300" <?= $row['income'] == 300 ? 'selected' : '' ?>>300万円代</option>
              <option value="400" <?= $row['income'] == 400 ? 'selected' : '' ?>>400万円代</option>
              <option value="500" <?= $row['income'] == 500 ? 'selected' : '' ?>>500万円代</option>
              <option value="600" <?= $row['income'] == 600 ? 'selected' : '' ?>>600万円以上</option>
            </select>
          </td>
        </tr>

        <!-- 年齢 -->
        <tr>
          <td>年齢</td>
          <td>
            <select name="age">
              <option value="10" <?= $row['age'] == 10 ? 'selected' : '' ?>>10代</option>
              <option value="20" <?= $row['age'] == 20 ? 'selected' : '' ?>>20代</option>
              <option value="30" <?= $row['age'] == 30 ? 'selected' : '' ?>>30代</option>
              <option value="40" <?= $row['age'] == 40 ? 'selected' : '' ?>>40代</option>
              <option value="50" <?= $row['age'] == 50 ? 'selected' : '' ?>>50代</option>
            </select>
          </td>
        </tr>

        <!-- 性別 -->
        <tr>
          <td>性別</td>
          <td>
            <input type="radio" name="gender" value="male" <?= $row['gender'] == 'male' ? 'checked' : '' ?>> 男
            <input type="radio" name="gender" value="female" <?= $row['gender'] == 'female' ? 'checked' : '' ?>> 女
          </td>
        </tr>

        <!-- 時間/週 -->
        <tr>
          <td>時間/週</td>
          <td>
            <select name="hour" required>
              <option value="5" <?= $row['hour'] == 5 ? 'selected' : '' ?>>5時間以下</option>
              <option value="10" <?= $row['hour'] == 10 ? 'selected' : '' ?>>10時間以下</option>
              <option value="20" <?= $row['hour'] == 20 ? 'selected' : '' ?>>20時間以下</option>
              <option value="30" <?= $row['hour'] == 30 ? 'selected' : '' ?>>30時間以下</option>
              <option value="40" <?= $row['hour'] == 40 ? 'selected' : '' ?>>40時間以上</option>
            </select>
          </td>
        </tr>

        <!-- 時間帯 -->
        <tr>
          <td>時間帯</td>
          <td>
            <?php
            $days = ['月', '火', '水', '木', '金', '土', '日'];
            $times = ['朝', '昼', '夕方', '夜'];

            foreach ($days as $day) {
              foreach ($times as $time) {
                $value = $day . $time;
                $checked = in_array($value, $timeZones) ? 'checked' : '';
                echo "<label><input type='checkbox' name='timeZone[]' value='{$value}' {$checked}>{$value}</label><br>";
              }
            }
            ?>
          </td>
        </tr>

        <!-- 地域 -->
        <tr>
          <td>地域</td>
          <td>
            <select name="region" required>
              <option value="tokyo" <?= $row['region'] == 'tokyo' ? 'selected' : '' ?>>東京</option>
              <option value="saitama" <?= $row['region'] == 'saitama' ? 'selected' : '' ?>>埼玉</option>
              <option value="kanagawa" <?= $row['region'] == 'kanagawa' ? 'selected' : '' ?>>神奈川</option>
              <option value="chiba" <?= $row['region'] == 'chiba' ? 'selected' : '' ?>>千葉</option>
            </select>
          </td>
        </tr>
      </table>
      <button type="submit">更新</button>
      <input type="hidden" name="id" value="<?= h($id) ?>">
    </form>
  </div>
  </main>

  <!-- ここまで -->


</body>

</html>