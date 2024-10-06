<?php
session_start();
include "funcs.php";
?>



<?php include("head.php"); ?>
<title>USERデータ登録</title>
<link href="css/index.css" rel="stylesheet">
</head>

<body>

  <!-- header -->
  <?php include("menu.php"); ?>


  <main>
    <h2>ユーザー登録</h2>
    <div class="form-wrapper">

      <form method="post" action="user-confirm.php">
        <table>
          <tr>
            <td>名前</td>
            <td><input type="text" name="name"></td>
          </tr>
          <tr>
            <td>Login ID</td>
            <td><input type="text" name="lid"></td>
          </tr>
          <tr>
            <td>Login PW</td>
            <td><input type="text" name="lpw"></td>
          </tr>
        </table>
        <button type="submit">登録</button>
      </form>

    </div>
  </main>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="js/menu.js"></script>
</body>

</html>