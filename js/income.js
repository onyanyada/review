//年収チャート
const incomeCtx = document.getElementById('incomeChart').getContext('2d');
const incomeChart = new Chart(incomeCtx, {
    type: 'scatter',
    data: {
        datasets: [{
            label: '年収とサウナ課金額の関係',
            data: datas.map(data => ({
                x: data.spending,
                y: data.income
            })),
            backgroundColor: 'rgba(75, 192, 192, 0.6)',
            pointRadius: 5
        }]
    },
    options: {
        scales: {
            x: {
                type: 'linear',
                position: 'bottom',
                title: {
                    display: true,
                    text: 'サウナ課金額（年）'
                }
            },
            y: {
                title: {
                    display: true,
                    text: '年収'
                }
            }
        }
    }
});

