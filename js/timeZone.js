// tz_datasからtimeZoneフィールドを抽出
const timeZoneData = tz_datas.map(entry => entry.timeZone);

// 出現回数をカウントする辞書
const timeZoneCount = {};

// 配列をループして出現回数をカウント
timeZoneData.forEach(timeZone => {
    if (timeZoneCount[timeZone]) {
        timeZoneCount[timeZone]++; // すでに存在するならカウントを増やす
    } else {
        timeZoneCount[timeZone] = 1; // 初めてならカウントを1に
    }
});

// 結果を表示
console.log(timeZoneCount);

// 時間帯データを集計する関数
function aggregateTimeZoneData(timeZoneData) {
    const dataByDay = {
        '月': { '朝': 0, '昼': 0, '夕方': 0, '夜': 0 },
        '火': { '朝': 0, '昼': 0, '夕方': 0, '夜': 0 },
        '水': { '朝': 0, '昼': 0, '夕方': 0, '夜': 0 },
        '木': { '朝': 0, '昼': 0, '夕方': 0, '夜': 0 },
        '金': { '朝': 0, '昼': 0, '夕方': 0, '夜': 0 },
        '土': { '朝': 0, '昼': 0, '夕方': 0, '夜': 0 },
        '日': { '朝': 0, '昼': 0, '夕方': 0, '夜': 0 }
    };

    // timeZoneData 配列をループして出現回数を集計
    timeZoneData.flat().forEach(timeZone => {
        const day = timeZone.slice(0, 1); // 曜日 (例: '火')
        const period = timeZone.slice(1); // 時間帯 (例: '夕方')
        if (dataByDay[day] && dataByDay[day][period] !== undefined) {
            dataByDay[day][period]++;
        }
    });

    return dataByDay;
}

// 集計関数の呼び出し
const dataByDay = aggregateTimeZoneData(timeZoneData);

// 曜日と時間帯のラベル
const labels = ['月', '火', '水', '木', '金', '土', '日'];
const timePeriods = ['朝', '昼', '夕方', '夜'];

// グラフに表示するデータを整形する
const datasets = timePeriods.map((period, index) => ({
    label: period,
    data: labels.map(day => dataByDay[day][period]),
    backgroundColor: `rgba(${index * 60}, 100, 255, 0.5)`,  // 色を動的に設定
    borderColor: `rgba(${index * 60}, 100, 255, 1)`,
    borderWidth: 1
}));

// Chart.js の設定
const ctx = document.getElementById('timeZoneChart').getContext('2d');
const timeZoneChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: labels,  // 曜日
        datasets: datasets  // 時間帯ごとのデータ
    },
    options: {
        scales: {
            x: {
                stacked: true  // 横軸を積み上げに設定
            },
            y: {
                stacked: true  // 縦軸も積み上げに設定
            }
        }
    }
});
