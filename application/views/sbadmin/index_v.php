<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Admin</title>
        
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="/css/sbadmin.css" />
        
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    </head>
    
    
    <body>
        
        <div class="container-fluid" >
            <div class="row" >
                <!-- LEFT BEGIN -->
                <div class="col-2 left-sidebar-block">
                    <ul>
                        <li><a href="/us/sbadmin/history/show_graph/3/">US - 3</a></li>
                        <li><a href="/ca/sbadmin/history/show_graph/3/">CA - 3</a></li>
                        <li><a href="/uk/sbadmin/history/show_graph/3/">UK - 3</a></li>
                        <li><a href="/de/sbadmin/history/show_graph/3/">DE - 3</a></li>
                        <li><a href="/fr/sbadmin/history/show_graph/3/">FR - 3</a></li>
                        <li><a href="/au/sbadmin/history/show_graph/3/">AU - 3</a></li>
                        <li><a href="/br/sbadmin/history/show_graph/3/">BR - 3</a></li>
                        <li><a href="/ru/sbadmin/history/show_graph/3/">RU - 3</a></li>
                    </ul>
                </div>
                <!-- LEFT END -->
                
                <!-- RIGHT BEGIN -->
                <div class="col">
                    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
                    <script type="text/javascript">
                      google.charts.load('current', {'packages':['corechart']});
                      google.charts.setOnLoadCallback(drawChart);
                      
                      <?php
                        foreach ($categoryData as $catData){
                            echo "google.charts.setOnLoadCallback({$catData['funcName']});\n";
                        }
                      ?>
                       
                       ////////////////// Functions Declaration BEGIN ///////////////////
                       
                    function drawChart() {
                        var data = google.visualization.arrayToDataTable([
                          ['Date', 'News' ],
                        <?php 
                            foreach ($dateDataAr as $dateData):
                        ?>
                          ['<?=$dateData['ddate']?>',  <?=$dateData['cnt']?>],
                        <?php
                            endforeach; 
                        ?>
                        ]);

                        var options = {
                          title: 'Daily News Loaded',
                          curveType: 'function',
                          legend: { position: 'bottom' }
                        };

                        var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));

                        chart.draw(data, options);
                    }
                      
                      
                      
                      <?php foreach ($categoryData as $catData):?>
                        function <?=$catData['funcName'];?>() {
                            var data = google.visualization.arrayToDataTable([
                              ['Date', '<?=$catData['full_uri']?>' ],
                            <?php
//                                echo "\n--- catData ---".count($catData['dateData'])."-\n";
//                                print_r($catData);
                            
                                if(count($catData['dateData']) > 1):
                                    foreach ($catData['dateData'] as $dateData):
                            ?>
                              ['<?=$dateData['ddate']?>',  <?=$dateData['cnt']?>],
                            <?php
                                    endforeach; 
                                endif;
                            ?>
                            ]);

                            var options = {
                              title: '<?=$catData['name'];?>',
                              curveType: 'function',
                              legend: { position: 'bottom' }
                            };

                            var chart = new google.visualization.LineChart(document.getElementById('<?=$catData['funcName'];?>'));

                            chart.draw(data, options);
                        }
                      <?php endforeach;?>
                      
                      ////////////////// Functions Declaration END ///////////////////
                      
                      
                    </script>
                    
                    <div id="curve_chart" style="width: 97%; height: 600px"></div>
                    
                    <?php foreach ($categoryData as $catData):?>
                    <p>
                        ----- 
                        <b><?=$catData['name'];?>:</b> 
                        &nbsp;&nbsp;
                        <i>
                            <?=$catData['dateData'][count($catData['dateData'])-1]['ddate'];?>
                        </i> 
                        -----
                    </p>
                    <div id="<?=$catData['funcName'];?>" style="width: 97%; height: 600px"></div>
                    <?php endforeach;?>
                    
                </div>
                <!-- RIGHT END -->
                
            </div>
        </div>
        
        
    </body>
</html>