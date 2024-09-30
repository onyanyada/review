// 時間カテゴリ別のカウントを集計
const timeCategories = {
    '5時間': 0,
    '10時間': 0,
    '20時間': 0,
    '30時間': 0,
    '40時間': 0
};

// 時間データをカウント
hourData.forEach(hour => {
    if (hour === 5) {
        timeCategories['5時間']++;
    } else if (hour === 10) {
        timeCategories['10時間']++;
    } else if (hour === 20) {
        timeCategories['20時間']++;
    } else if (hour === 30) {
        timeCategories['30時間']++;
    } else {
        timeCategories['40時間']++;
    }
});

const timeCtx = document.getElementById('timeChart').getContext('2d');
const timeChart = new Chart(timeCtx, {
    type: 'pie',
    data: {
        labels: Object.keys(timeCategories),
        datasets: [{
            data: Object.values(timeCategories),
            backgroundColor: [
                '#FF6384',
                '#36A2EB',
                '#FFCE56',
                '#4BC0C0',
                '#9966FF'
            ]
        }]
    },
    options: {
        responsive: true,
        title: {
            display: true,
            text: '時間/週 のアンケート結果'
        }
    }
});

