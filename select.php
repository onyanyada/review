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
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>

  <!-- header -->
  <?php include("menu.php"); ?>

  <main>
    <h2>皆の口コミ一覧</h2>

  </main>

  <script>
    const datas = <?= $json; ?>;
    console.dir(datas);
    const tz_datas = <?= $tz_json; ?>;
    console.dir(tz_datas);
  </script>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</body>

</html>