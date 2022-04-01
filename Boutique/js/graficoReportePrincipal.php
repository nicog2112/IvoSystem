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
<?php  if($usuario->getIdPerfil() == 1){  ?>
var chart2 = new CanvasJS.Chart("chartContainer2", {
    theme: "light2", // "light1", "light2", "dark1", "dark2"
    exportEnabled: true,
    animationEnabled: true,
    title: {
       
    },
    data: [{
        type: "pie",
        startAngle: 25,
        toolTipContent: "<b>{label}</b>: {y}%",
        yValueFormatString: "##0.00",
        showInLegend: "true",
        legendText: "{label}",
        indexLabelFontSize: 16,
        indexLabel: "{label} - {y}%",
        dataPoints: <?php echo json_encode($dataPoints2, JSON_NUMERIC_CHECK); ?>
    }]
});
var chart3 = new CanvasJS.Chart("chartContainer3", {
    theme: "light2", // "light1", "light2", "dark1", "dark2"
    exportEnabled: true,
    animationEnabled: true,
    title: {
       
    },
    data: [{
        type: "pie",
        startAngle: 25,
        toolTipContent: "<b>{label}</b>: {y}%",
        yValueFormatString: "##0.00",
        showInLegend: "true",
        legendText: "{label}",
        indexLabelFontSize: 16,
        indexLabel: "{label} - {y}%",
        dataPoints: <?php echo json_encode($dataPoints3, JSON_NUMERIC_CHECK); ?>
    }]
});
chart3.render();
chart2.render();

<?php } ?>
chart.render();

}
<?php } ?>