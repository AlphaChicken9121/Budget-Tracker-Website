google.charts.load('current', {'packages':['corechart']});
google.charts.setOnLoadCallback(drawChart);

function drawChart() {

  var data = google.visualization.arrayToDataTable([
    ['Transactions', 'Ammount'],
    ['Food',     2540],
    ['Clothes',      800],
    ['Tech',  1400],
    ['Bill', 1578],
    ['Furniture',    670]
  ]);

  var options = {
    title: 'Category Wise Spendings In A Month',
    pieHole: 0.4,
    backgroundColor: 'black',
    color: 'white',
    legend: {textStyle: {color: 'white'}},
    titleTextStyle: {color: 'white'},
  };

  var chart = new google.visualization.PieChart(document.getElementById('piechart'));

  chart.draw(data, options);
}

google.charts.load('current', {packages: ['corechart', 'line']});
google.charts.setOnLoadCallback(drawLineColors);

function drawLineColors() {
    var data = new google.visualization.DataTable();
    data.addColumn('number', 'X');
    data.addColumn('number', 'Payments');
    data.addColumn('number', 'Income');

    data.addRows([
      [0, 0, 0],    [1, 8000, 10000],   [2, 9000, 11000],  [3, 10000, 9000],   [4, 15000, 13000],  [5, 9000, 13000], [6, 8000, 11000],
      [7, 9500, 12750],  [8, 11247, 13500],  [9, 13000, 11000],  [10, 9000, 12400], [11, 12480, 14753], [12, 10846, 13345]
    ]);

    var options = {
      theme: {
        chartArea: {width: '65%', height: 'auto'}
      },
      hAxis: {
        title: 'Year',
        textStyle: {color: 'white'},
        titleTextStyle: {
          color: 'white'
        }
      },
      vAxis: {
        title: 'Ammount',
        textStyle: {color: 'white'},
        titleTextStyle: {
          color: 'white'
        }
      },
      colors: ['red', '#59e800'],
      title: 'Income vs Payments In A Year',
      pieHole: 0.4,
      backgroundColor: '#2e2e2e',
      color: 'white',
      legend: {textStyle: {color: 'white'}},
      titleTextStyle: {color: 'white'},
    };

    var chart = new google.visualization.LineChart(document.getElementById('chart_div'));
    chart.draw(data, options);
}
