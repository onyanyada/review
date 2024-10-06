// カテゴリ2の選択肢を設定する関数
function setCategory2Options(category1Value) {
    const category2 = document.getElementById('category2');
    category2.innerHTML = ''; // カテゴリ2の選択肢をクリア

    if (category1Value === "肉") {
        const options = [
            { value: "鶏肉", text: "鶏肉" },
            { value: "豚肉", text: "豚肉" },
            { value: "羊肉", text: "羊肉" }
        ];
        options.forEach(optionData => {
            const option = document.createElement('option');
            option.value = optionData.value;
            option.text = optionData.text;
            category2.appendChild(option);
        });
    } else if (category1Value === "魚") {
        const options = [
            { value: "鮭", text: "鮭" },
            { value: "さわら", text: "さわら" }
        ];
        options.forEach(optionData => {
            const option = document.createElement('option');
            option.value = optionData.value;
            option.text = optionData.text;
            category2.appendChild(option);
        });
    } else {
        // すべての選択肢
        const option = document.createElement('option');
        option.value = "";
        option.text = "すべて";
        category2.appendChild(option);
    }
}

// カテゴリ1の選択が変更されたときのイベントリスナー
document.getElementById('category1').addEventListener('change', function () {
    setCategory2Options(this.value);
});
