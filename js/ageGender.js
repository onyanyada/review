//年齢・性別チャート
let ageGenderCtx = document.getElementById('ageGenderChart').getContext('2d');

// データを整理して、性別によって色分け
let maleData = datas
    .filter(d => d.gender === 'male')//dは配列の各要素
    .map(d => ({ y: d.age, x: d.spending }));//元の配列の各要素に変換処理。結果を基に新しい配列を作成

let femaleData = datas
    .filter(d => d.gender === 'female')
    .map(d => ({ y: d.age, x: d.spending }));

let ageGenderChart = new Chart(ageGenderCtx, {
    type: 'scatter',
    data: {
        datasets: [
            {
                label: '男性',
                data: maleData,
                backgroundColor: 'rgba(54, 162, 235, 0.6)', // 青
                borderColor: 'rgba(54, 162, 235, 1)',
                pointRadius: 5
            },
            {
                label: '女性',
                data: femaleData,
                backgroundColor: 'rgba(255, 99, 132, 0.6)', // 赤
                borderColor: 'rgba(255, 99, 132, 1)',
                pointRadius: 5
            }
        ]
    },
    options: {
        scales: {
            y: {
                type: 'linear',
                title: {
                    display: true,
                    text: '年齢'
                },
                beginAtZero: true
            },
            x: {
                title: {
                    display: true,
                    text: 'サウナ課金額（年）'
                },
                beginAtZero: true
            }
        }
    }
});
