<?php
//必ずsession_startは最初に記述
session_start();
?>

<?php include("head.php"); ?>
<title>ログイン</title>
</head>

<body>
  <!-- header -->

  <?php include("menu.php"); ?>

  <!-- lLOGINogin_act.php は認証処理用のPHPです。 -->
  <form name="form1" action="login_act.php" method="post">
    ID:<input type="text" name="lid">
    PW:<input type="password" name="lpw">
    <input type="submit" value="ログイン">
  </form>


</body>

</html>