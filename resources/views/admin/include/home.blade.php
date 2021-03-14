@extends('admin.master')

@section('title')
    Admin || Dashboard
@endsection

@section('content')
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Dashboard</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Dashboard</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- Main content -->
      <div class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-info">
                <div class="inner">
                  <h3>{{ $post }}</h3>

                  <p>Posts</p>
                </div>
                <div class="icon">
                  <i class="fas fa-pen-square"></i>
                </div>
              </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-success">
                <div class="inner">
                  <h3>{{ $category }}</h3>

                  <p>Categories</p>
                </div>
                <div class="icon">
                  <i class="fas fa-tags"></i>
                </div>
              </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-warning">
                <div class="inner">
                  <h3>{{ $tag }}</h3>

                  <p>Tags</p>
                </div>
                <div class="icon">
                  <i class="fas fa-tag"></i>
                </div>
              </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-danger">
                <div class="inner">
                  <h3>{{ $user }}</h3>

                  <p>Users</p>
                </div>
                <div class="icon">
                  <i class="fas fa-user"></i>
                </div>
              </div>
            </div>
            <!-- ./col -->
            <div class="col-md-6" style="border: 1px solid green;margin:0">
                    <div class="panel panel-default">
                     <div class="panel-heading">
                      <h3 class="panel-title">Percentage of Users</h3>
                     </div>
                     <div class="panel-body" align="center">
                      <div id="pie_chart" style="width:550px; height:450px;">

                      </div>
                     </div>
                    </div>
            </div>
            <div class="col-md-6" style="border: 1px solid blue;margin:0">
                <div class="panel panel-default">
                 <div class="panel-heading">
                  <h3 class="panel-title">HighChart</h3>
                 </div>
                 <div class="panel-body" align="center">
                  <div id="chart-container" style="width:550px; height:450px;">

                  </div>
                 </div>
                </div>
        </div>
          </div>
          <!-- /.row -->

        </div><!-- /.container-fluid -->
      </div>
      <script type="text/javascript">
        var analytics = <?php echo $type; ?>


        google.charts.load('current', {'packages':['corechart']});

        google.charts.setOnLoadCallback(drawChart);

        function drawChart()
        {
         var data = google.visualization.arrayToDataTable(analytics);
         var options = {
          title : 'Percentage of Users'
         };
         var chart = new google.visualization.PieChart(document.getElementById('pie_chart'));
         chart.draw(data, options);
        }
        //var datas=<?php echo $datas; ?>

       </script>
       <script type="text/javascript">
        {{-- var datas=<?php echo $datas; ?> --}}
        var datas={{ $datas }}
        console.log(<?php echo $datas; ?>);
        Highcharts.chart('chart-container', {
            title: {
                text: 'New User Growth, 2020'
            },
            subtitle: {
                text: 'Source: Surfside Media'
            },
            xAxis: {
                categories: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September',
                    'October', 'November', 'December'
                ]
            },
            yAxis: {
                title: {
                    text: 'Number of New Users'
                }
            },
            legend: {
                layout: 'vertical',
                align: 'right',
                verticalAlign: 'middle'
            },
            plotOptions: {
                series: {
                    allowPointSelect: true
                }
            },
            series: [{
                name: 'New Users',
                data: datas
            }],
            responsive: {
                rules: [{
                    condition: {
                        maxWidth: 500
                    },
                    chartOptions: {
                        legend: {
                            layout: 'horizontal',
                            align: 'center',
                            verticalAlign: 'bottom'
                        }
                    }
                }]
            }
        });
       </script>

@endsection
