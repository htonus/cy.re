<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en" dir="ltr">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>FxPro</title>
</head>
<body style="background:none;">

<!--<script src="/js/jquery/jquery-1.7.1.min.js"></script>-->
<script src="/js/amcharts/amcharts.js"></script>


<div id="volume_chartdiv" style="width: 358px; height: 380px; background-color: #EEE;"></div>

<?php




?>

<span id="volume-ps-current-data" style="display:none;">[{"ValueUSD":33.2,"Symbol":"EURUSD"},{"ValueUSD":17.5,"Symbol":"EURCHF"},{"ValueUSD":14.9,"Symbol":"GBPUSD"},{"ValueUSD":6.6,"Symbol":"AUDUSD"},{"ValueUSD":5.5,"Symbol":"EURGBP"},{"ValueUSD":3.6,"Symbol":"USDJPY"},{"ValueUSD":3.4,"Symbol":"EURJPY"},{"ValueUSD":3.2,"Symbol":"GBPAUD"},{"ValueUSD":1.9,"Symbol":"USDCAD"},{"ValueUSD":1.8,"Symbol":"GBPJPY"},{"ValueUSD":1.3,"Symbol":"USDCHF"},{"ValueUSD":0.9,"Symbol":"USDTRY"},{"ValueUSD":0.8,"Symbol":"EURTRY"},{"ValueUSD":0.8,"Symbol":"AUDJPY"},{"ValueUSD":0.6,"Symbol":"NZDUSD"}]</span>

<script type="text/javascript">

window.onload = function(){
	drawVolumeChartData();
}

function initVolumeChartData() {
    //var volume_per_symbol = Drupal.settings.volume_per_symbol;
	var volume_per_symbol = document.getElementById('volume-ps-current-data').innerText;
    var volume_obj = JSON.parse(volume_per_symbol);
    var chartData = new Array;

    for(var vol in volume_obj) {
        chartData.push(
            {Symbol: volume_obj[vol]['Symbol'],
            ValueUSD: volume_obj[vol]['ValueUSD']}
        );
    }

    return chartData;
}

function drawVolumeChartData() {
    var volumeChartData = initVolumeChartData();

    // PIE CHART
    var chart = new AmCharts.AmPieChart();
    chart.dataProvider = volumeChartData;
    chart.titleField = "Symbol";
	chart.descriptionField = "Symbol";
    chart.valueField = "ValueUSD";

    // LEGEND
    var legend = new AmCharts.AmLegend();
    legend.align = "center";
    legend.markerType = "square";
    legend.valueTextRegular = "[[low]]";
    legend.markerSize = 8;
    //legend.position = "absolute";
    //legend.top = "350px";
    legend.valueText = "";
    legend.markerLabelGap = 4;
    legend.verticalGap = 0;
    //legend.marginTop = -150;

    chart.addLegend(legend);

    chart.labelRadius = 25;
    //chart.fontSize = 10;
    chart.minRadius = 110;
    chart.labelText = "[[value]]%";
	chart.balloonText = "[[value]]% ([[description]])";

    //3D
    chart.depth3D = 10;
    chart.angle = 55;

    // WRITE
    chart.write("volume_chartdiv");

//	volumeChartTimeout = setTimeout(volumeChartReload, pageReloadTime);
}
</script>

</body>
</html>