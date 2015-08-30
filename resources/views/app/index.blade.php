@extends('layouts/dashboard')
@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Dashboard
    <small>Version 2.0</small>
  </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-home"></i> Home</a></li>
        <li class="active">Dashboard</li>
     </ol>
</section>

        <!-- Main content -->
<section class="content">
         <div class="row">
            <div class="col-xs-12">
              <!-- interactive chart -->
              <div class="box box-primary">
                <div class="box-header with-border">
                  <i class="fa fa-bar-chart-o"></i>
                  <h3 class="box-title">Gastos em Tempo Real (kW/h)</h3>
                </div>
                <div class="box-body">
                  
                    <div id="interactive" style="height: 300px;"></div>
                  
                </div><!-- /.box-body-->
              </div><!-- /.box -->

            </div><!-- /.col -->
          </div><!-- /.row -->
          
</section><!-- /.content -->
@endsection
@section('script')
<script src="{{asset('plugins/flot/jquery.flot.js')}}"></script>
<script>
        
    function getData(){
        $.ajax({
            method: 'GET',
            url: '/api/getData',
            data:{},
            success: function(response){
                var json = null;
                var arrayData = [];
                var maxval = 0;
                var arrayValues = [];
                for(var i = 0; i < response.data.length;i++){
                    json = JSON.parse(response.data[i].data);
                    console.log(json);    
                    arrayData.push([i,json.corrente])
                    arrayValues.push(json.corrente)
                }
                maxval = Math.max.apply(null,arrayValues)*1.1;
                console.log(maxval);
                var options = {
                        grid: {
                        borderColor: "#f3f3f3",
                        borderWidth: 1,
                        tickColor: "#f3f3f3"
                      },
                      series: {
                        shadowSize: 0, // Drawing is faster without shadows
                        color: "#3c8dbc"
                      },
                      lines: {
                        fill: true, //Converts the line chart to area chart
                        color: "#3c8dbc"
                      },
                      yaxis: {
                        min: 0,
                        max: maxval,
                        show: true
                      },
                      xaxis: {
                        show: true
                      }
                };
                
                var graph = $.plot('#interactive',[arrayData],options);
                
                options.yaxis.max = maxval;
                graph.setData([arrayData])
                graph.draw();
            }
        });   
    }
    
    setInterval(getData,1000);
         
     
                
</script>

@endsection