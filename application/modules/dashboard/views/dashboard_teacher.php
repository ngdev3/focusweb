     <!-- ============================================================== -->
        <!-- End Left Sidebar -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page Content -->
        <!-- ============================================================== -->

<!-- ========== CHARTS JS ======= -->
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type='text/javascript'>
      google.charts.load('current', {'packages':['annotationchart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = new google.visualization.DataTable();
        data.addColumn('date', 'Date');
        data.addColumn('number', 'Kepler-22b mission');
        data.addColumn('string', 'Kepler title');
        data.addColumn('string', 'Kepler text');
        data.addColumn('number', 'Gliese 163 mission');
        data.addColumn('string', 'Gliese title');
        data.addColumn('string', 'Gliese text');
        data.addRows([
          [new Date(2314, 2, 15), 12400, undefined, undefined,
                                  10645, undefined, undefined],
          [new Date(2314, 2, 16), 24045, 'Lalibertines', 'First encounter',
                                  12374, undefined, undefined],
          [new Date(2314, 2, 17), 35022, 'Lalibertines', 'They are very tall',
                                  15766, 'Gallantors', 'First Encounter'],
          [new Date(2314, 2, 18), 12284, 'Lalibertines', 'Attack on our crew!',
                                  34334, 'Gallantors', 'Statement of shared principles'],
          [new Date(2314, 2, 19), 8476, 'Lalibertines', 'Heavy casualties',
                                  66467, 'Gallantors', 'Mysteries revealed'],
          [new Date(2314, 2, 20), 0, 'Lalibertines', 'All crew lost',
                                  79463, 'Gallantors', 'Omniscience achieved']
        ]);

        var chart = new google.visualization.AnnotationChart(document.getElementById('chart_div'));

        var options = {
          displayAnnotations: true
        };

        chart.draw(data, options);
      }




    </script>

    <!--- ================   COLUMNS CHARt ============= -->
    <script type="text/javascript">
        google.charts.load('current', {packages: ['corechart', 'bar']});
google.charts.setOnLoadCallback(drawBasic);

function drawBasic() {

      var data = new google.visualization.DataTable();
      data.addColumn('timeofday', 'Time of Day');
      data.addColumn('number', 'Motivation Level');

      data.addRows([
        [{v: [8, 0, 0], f: '8 am'}, 1],
        [{v: [9, 0, 0], f: '9 am'}, 2],
        [{v: [10, 0, 0], f:'10 am'}, 3],
        [{v: [11, 0, 0], f: '11 am'}, 4],
        [{v: [12, 0, 0], f: '12 pm'}, 5],
        [{v: [13, 0, 0], f: '1 pm'}, 6],
        [{v: [14, 0, 0], f: '2 pm'}, 7],
        [{v: [15, 0, 0], f: '3 pm'}, 8],
        [{v: [16, 0, 0], f: '4 pm'}, 9],
        [{v: [17, 0, 0], f: '5 pm'}, 10],
      ]);

      var options = {
        title: 'Motivation Level Throughout the Day',
        hAxis: {
          title: 'Time of Day',
          format: 'h:mm a',
          viewWindow: {
            min: [7, 30, 0],
            max: [17, 30, 0]
          }
        },
        vAxis: {
          title: 'Rating (scale of 1-10)'
        }
      };

      var chart = new google.visualization.ColumnChart(
        document.getElementById('chart_div_column'));

      chart.draw(data, options);
    }
    </script>
    <!--- ================   ! COLUMNS CHARt ============= -->



<!-- =========== ! CHARTS JS ======   -->

            <h3 class="box-title col-xs-12">My Classes </h3>
           <div class="row">
                    
                    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                        <div class="white-box">
                            <h2 class="text-center tab-head">5th Class</h2>
                            <div class="text-center"> 
                                <h4>Section A, B, C</h4> 
                                <h4>Eng, Hindi, Maths</h4> 
                            </div> 
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                        <div class="white-box">
                            <h2 class="text-center tab-head">6th Class</h2>
                            <div class="text-center"> 
                                <h4>Section A, B, C</h4> 
                                <h4>Eng, Hindi, Maths</h4> 
                            </div> 
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                        <div class="white-box">
                            <h2 class="text-center tab-head">7th Class</h2>
                            <div class="text-center"> 
                                <h4>Section A, B, C</h4> 
                                <h4>Eng, Hindi, Maths</h4> 
                            </div> 
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12" style="height: 167px">
                        <button class="fcbtn btn btn-danger btn-outline btn-1e" style="width: 160px; position: absolute; bottom: 2px;">View More</button>
                    </div>
                </div>


                <h3 class="box-title col-xs-12">My Subjects </h3>


                <div class="row">
                    
                    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                        <div class="white-box">
                            <h2 class="text-center tab-head">English</h2>
                            <div class="text-center"> 
                                <h4>20 Chapters</h4> 
                                <h4>20 Topics</h4> 
                                <h4>10 Videos</h4> 
                            </div> 
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                        <div class="white-box">
                            <h2 class="text-center tab-head">Maths</h2>
                            <div class="text-center"> 
                                <h4>20 Chapters</h4> 
                                <h4>20 Topics</h4> 
                                <h4>10 Videos</h4> 
                            </div> 
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                        <div class="white-box">
                            <h2 class="text-center tab-head">Computer</h2>
                            <div class="text-center"> 
                                <h4>20 Chapters</h4> 
                                <h4>20 Topics</h4> 
                                <h4>10 Videos</h4> 
                            </div> 
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12" style="height: 199px">
                        <button class="fcbtn btn btn-danger btn-outline btn-1e" style="width: 160px; position: absolute; bottom: 2px;">View More</button>
                    </div>
                </div>


                <!-- =========================== REPORTS ========================== -->

                <div class="row">
                    <div class="col-sm-6">
                        <div class="white-box">
                            <h3 class="box-title text-danger">Bar Report form of Students</h3>
                            <div class="table-responsive">
                               <div id='chart_div_column' style='width: 600px; height: 400px;'></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="white-box">
                            <h3 class="box-title text-danger">Annotation Report form Of Students</h3>
                            <div class="table-responsive">
                              <div id='chart_div' style='width: 600px; height: 400px;'></div>
                            </div>
                        </div>
                    </div>
                
            </div>

                <!-- =========================== ! REPORTS ========================== -->