<?php
//0. SESSION開始！！
session_start();

//１．関数群の読み込み
include("funcs.php");

//LOGINチェック → funcs.phpへ関数化しましょう！
sschk();

?>
<?php include("head.php"); ?>
<title>フリーアンケート表示</title>
<link rel="stylesheet" href="css/select.css">
</head>

<body>

  <!-- header -->
  <?php include("menu.php"); ?>

  <main>
    <h2>皆の口コミ一覧</h2>

  </main>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</body>

</html>