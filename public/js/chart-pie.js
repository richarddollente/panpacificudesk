// Demo Pie Chart
//
// The style configurations in this demo are
// intended to match the Material Design styling.
// Use this demo chart as a starting point and for
// reference when creating charts within an app.
//
// Chart.js v3 is being used, which is currently
// in beta. For the v3 docs, visit
// https://www.chartjs.org/docs/master/

var ctx = document.getElementById('myStatusPieChart').getContext('2d');
var myStatusPieChart = new Chart(ctx, {
    type: 'pie',
    data: {
        labels: ['Open', 'In Progress', 'Closed'],
        datasets: [{
            data: [1, 3, 2],
            backgroundColor: [RedColor, YellowColor, GreenColor],
        }],
    },
});

var ctx = document.getElementById('myPriorityPieChart').getContext('2d');
var myPriorityPieChart = new Chart(ctx, {
    type: 'pie',
    data: {
        labels: ['Critical', 'High', 'Medium', 'Low'],
        datasets: [{
            data: [1, 3, 2, 5],
            backgroundColor: [RedColor, OrangeColor, YellowColor, GreenColor],
        }],
    },
});

var ctx = document.getElementById('myCategoryPieChart').getContext('2d');
var myCategoryPieChart = new Chart(ctx, {
    type: 'pie',
    data: {
        labels: ['Uncategorized', 'PU Official Website', 'AIMS', 'Google Classroom', 'PU Email', 'Computer Laboratory', 'School Wi-Fi'],
        datasets: [{
            data: [1, 3, 2, 5, 2, 4, 1],
            backgroundColor: [OrangeColor, BlueColor, IndigoColor, RedColor, CyanColor, GreenColor, DarkColor],
        }],
    },
});
