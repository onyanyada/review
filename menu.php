<?php
include_once("funcs.php");
?>
<header class="login-header">
    <div class="nav">
        <ul>
            <li>
                <a class="nav-item" href="select.php">口コミ一覧</a>
            </li>
            <?php if (!isset($_SESSION["name"])) { ?>
                <li>
                    <a class="nav-item" href="user.php">ユーザー登録</a>
                </li>
                <li>
                    <a class="nav-item" href="login.php">ログイン</a>
                </li>
            <?php } ?>
            <?php if (isset($_SESSION["name"])) { ?>
                <li>
                    <a class="nav-item" href="logout.php">ログアウト</a>
                </li>
            <?php } ?>
        </ul>
    </div>
    <div class="current-user">
        <a class="nav-item" href="user-select.php">
            <?php if (isset($_SESSION["name"])) {
                echo h($_SESSION["name"]) . "さん";
            } ?>
        </a>
    </div>
</header>