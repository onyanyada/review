$(document).ready(function () {
    $(".like-btn").on("click", function () {
        const reviewId = $(this).data("review-id");

        $.ajax({
            url: "like.php", // いいね処理をするPHPファイル
            type: "POST",
            data: {
                review_id: reviewId
            },
            success: function (response) {
                // 成功したら、いいね数を更新
                const newLikeCount = JSON.parse(response).new_like_count;
                $("#like-count-" + reviewId).text(newLikeCount);
            },
            error: function () {
                alert("いいねの処理に失敗しました。");
            }
        });
    });
});
