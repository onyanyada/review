<?php
include_once("funcs.php");
?>
<header class="login-header">
    <div class="nav">
        <ul>
            <li>
                <a class="nav-item" href="all-select.php">皆の口コミ一覧</a>
            </li>
            <?php if (isset($_SESSION["name"])) { ?>
                <li>
                    <a class="nav-item" href="index.php">口コミ投稿</a>
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
        <div class="user-menu">
            <span class="close">×</span>
            <ul>
                <li><a href="user-select.php">設定</a></li>
                <li><a href="select.php">自分の口コミ一覧</a></li>
                <li><a href="logout.php">ログアウト</a></li>
            </ul>
        </div>
    </div>
</header>