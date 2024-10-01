<?php
session_start();
include "funcs.php";
?>



<?php include("head.php"); ?>
<title>USERデータ登録</title>
</head>

<body>

  <!-- header -->
  <?php include("menu.php"); ?>


  <main>
    <form method="post" action="user-confirm.php">
      <h2>ユーザー登録</h2>
      <label>名前：<input type="text" name="name"></label><br>
      <label>Login ID：<input type="text" name="lid"></label><br>
      <label>Login PW<input type="text" name="lpw"></label><br>
      <input type="submit" value="送信">
    </form>
  </main>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="js/menu.js"></script>
</body>

</html>