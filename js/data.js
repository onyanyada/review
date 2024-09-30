
const spendingData = [];//サウナに出す金額[2]
const incomeData = [];//年収[3]
const ageData = [];//年齢[4]
const genderData = [];//性別[5]
const hourData = [];//時間[6]
// const timeZoneData = [];//時間帯[7]
const regionData = [];//居住地域[8]


datas.forEach(data => {
    spendingData.push(data.spending);
    incomeData.push(data.income);
    ageData.push(data.age);
    genderData.push(data.gender);
    hourData.push(data.hour);
    // timeZoneData.push(data.timeZone);
    regionData.push(data.region);
});

