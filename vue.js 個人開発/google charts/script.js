'use strict';

//////  グラフに使うデータ  ///////
var orgdata = [
    ['種類', '個数'],
    ['幕ノ内', 3],['カルビ弁当', 5],['オムライス', 5],
    ['冷やし中華', 1],['ビビンバ', 3],['ざるそば', 1]
];

google.charts.load('current', {packages: ['corechart']});
google.charts.setOnLoadCallback(drawBasic);

//////---- グラフを表示する関数 ------/////////
function drawBasic() {
    var data = google.visualization.arrayToDataTable(orgdata);
    var options = {title: '好きなランチ', "is3D": true};
    var chart = new google.visualization.PieChart(
        document.getElementById('chart_div')
    );
    chart.draw(data, options);
}

var app = new Vue({
    el: '#app',
    data: {
        dataArray: orgdata
    },
    methods: {
        addOne: function(val) {
            var obj = this.dataArray[val];
            obj[1]++;
            this.dataArray.splice(val, 1, obj);
            drawBasic();
        }
    }
});