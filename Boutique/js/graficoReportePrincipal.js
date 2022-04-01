window.onload = function() {

var chart = new CanvasJS.Chart("chartContainer", {
    animationEnabled: true,
    title: {
        
    },
    data: [{
        type: "column",
        startAngle: 240,
        yValueFormatString: "$##0.00",
        indexLabel: "{y}",
        dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
    }]
});

chart.render();

