<?php
//必ずsession_startは最初に記述
session_start();
?>

<?php include("head.php"); ?>
<title>ログイン</title>
<link href="css/index.css" rel="stylesheet">
</head>

<body>
  <!-- header -->

  <?php include("menu.php"); ?>
  <main>
    <h2>ログイン</h2>

    <!-- lLOGINogin_act.php は認証処理用のPHPです。 -->
    <div class="form-wrapper">
      <table>
        <form name="form1" action="login_act.php" method="post">
          <tr>
            <td>ID</td>
            <td><input type="text" name="lid"></td>
          </tr>
          <tr>
            <td>PW</td>
            <td><input type="password" name="lpw"></td>
          </tr>
          <input type="submit" value="ログイン">
        </form>
      </table>
    </div>
  </main>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="js/menu.js"></script>
</body>

</html>