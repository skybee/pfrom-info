<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
    google.charts.load('current', {'packages': ['corechart']});
    google.charts.setOnLoadCallback(drawChart);

<?php
foreach ($categoryData as $catData) {
    echo "google.charts.setOnLoadCallback({$catData['funcName']});\n";
}
?>

    ////////////////// Functions Declaration BEGIN ///////////////////

    function drawChart() {
        var data = google.visualization.arrayToDataTable([
            ['Date', 'News'],
<?php
foreach ($dateDataAr as $dateData):
    ?>
                ['<?= $dateData['ddate'] ?>', <?= $dateData['cnt'] ?>],
    <?php
endforeach;
?>
        ]);

        var options = {
            title: 'Daily News Loaded',
            curveType: 'function',
            legend: {position: 'bottom'}
        };

        var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));

        chart.draw(data, options);
    }



<?php foreach ($categoryData as $catData): ?>
        function <?= $catData['funcName']; ?>() {
            var data = google.visualization.arrayToDataTable([
                ['Date', '<?= $catData['full_uri'] ?>'],
    <?php
//                                echo "\n--- catData ---".count($catData['dateData'])."-\n";
//                                print_r($catData);

    if (count($catData['dateData']) > 1):
        foreach ($catData['dateData'] as $dateData):
            ?>
                        ['<?= $dateData['ddate'] ?>', <?= $dateData['cnt'] ?>],
            <?php
        endforeach;
    endif;
    ?>
            ]);

            var options = {
                title: '<?= $catData['name']; ?>',
                curveType: 'function',
                legend: {position: 'bottom'}
            };

            var chart = new google.visualization.LineChart(document.getElementById('<?= $catData['funcName']; ?>'));

            chart.draw(data, options);
        }
<?php endforeach; ?>

    ////////////////// Functions Declaration END ///////////////////


</script>

<div id="curve_chart" style="width: 97%; height: 600px"></div>

<?php foreach ($categoryData as $catData): ?>
    <p>
        ----- 
        <b><?= $catData['name']; ?>:</b> 
        &nbsp;&nbsp;
        <i>
            <?= $catData['dateData'][count($catData['dateData']) - 1]['ddate']; ?>
        </i> 
        -----
    </p>
    <div id="<?= $catData['funcName']; ?>" style="width: 97%; height: 600px"></div>
<?php endforeach; ?>
                    