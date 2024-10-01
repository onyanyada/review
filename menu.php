<?php
include_once("funcs.php");
?>
<header class="login-header">
    <div class="nav">
        <ul>
            <?php if (isset($_SESSION["name"])) { ?>
                <li>
                    <a class="nav-item" href="product-index.php">商品登録</a>
                </li>
                <li>
                    <a class="nav-item" href="product-select.php">商品一覧</a>
                </li>

            <?php } ?>
            <?php if (!isset($_SESSION["name"])) { ?>
                <li>
                    <a class="nav-item" href="user.php">ユーザー登録</a>
                </li>
                <li>
                    <a class="nav-item" href="login.php">ログイン</a>
                </li>
            <?php } ?>
        </ul>
    </div>
    <div class="current-user">
        <div>
            <?php if (isset($_SESSION["name"])) {
                echo h($_SESSION["name"]) . "さん";
            } ?>
        </div>
    </div>
    <div class="user-menu">
        <ul>
            <li><a href="user-select.php">設定</a></li>
            <li><a href="select.php">自分の口コミ一覧</a></li>
            <li><a href="logout.php">ログアウト</a></li>
        </ul>
        <span class="close">×</span>
    </div>
</header>