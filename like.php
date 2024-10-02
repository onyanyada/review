<?php
session_start();
include("funcs.php");
$pdo = db_conn();

if (isset($_POST["review_id"])) {
    $review_id = $_POST["review_id"];

    // まずは現在のいいね数を取得
    $stmt = $pdo->prepare("SELECT like_count FROM review WHERE id = :review_id");
    $stmt->bindValue(":review_id", $review_id, PDO::PARAM_INT);
    $stmt->execute();
    $review = $stmt->fetch(PDO::FETCH_ASSOC);
    $current_like_count = $review['like_count'];

    // いいね数を1増やす
    $new_like_count = $current_like_count + 1;
    $stmt = $pdo->prepare("UPDATE review SET like_count = :like_count WHERE id = :review_id");
    $stmt->bindValue(":like_count", $new_like_count, PDO::PARAM_INT);
    $stmt->bindValue(":review_id", $review_id, PDO::PARAM_INT);
    $stmt->execute();

    // 新しいいいね数を返す
    echo json_encode(["new_like_count" => $new_like_count]);
}
