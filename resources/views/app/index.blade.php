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
            <div class="col-md-3 col-sm-6 col-xs-12">
              <div class="info-box bg-aqua">
                <span class="info-box-icon"><i class="fa fa-money"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Gasto</span>
                  <span class="info-box-number" id="actualCost"></span>
                  <div class="progress">
                    <div class="progress-bar" style="width: 70%"></div>
                  </div>
                  <span class="progress-description" id="lastHourDescription">
                    
                  </span>
                </div><!-- /.info-box-content -->
              </div><!-- /.info-box -->
            </div><!-- /.col -->  
              <div class="col-md-3 col-sm-6 col-xs-12">
              <div class="info-box bg-green">
                <span class="info-box-icon"><i class="fa fa-power-off"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text"></span><br>
                  <span class="info-box-number">
                      <input type="checkbox" name="my-checkbox"  {!! $status!!} data-switch-set="size" data-switch-value="large">
                  </span>
                </div><!-- /.info-box-content -->
              </div><!-- /.info-box -->
            </div><!-- /.col -->  
               
        </div>
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
                //console.log(response);
                var json = null;
                var arrayData = [];
                var maxval = 0;
                var arrayValues = [];
                for(var i = 0; i < response.data.length;i++){
                    json = JSON.parse(response.data[i].data);
                    //console.log(json);    
                    arrayData.push([i,json.corrente])
                    arrayValues.push(json.corrente)
                }
                maxval = Math.max.apply(null,arrayValues)*1.1;
                
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
                        show: false
                      }
                };
                
                var graph = $.plot('#interactive',[arrayData],options);
                
                options.yaxis.max = maxval;
                graph.setData([arrayData])
                graph.draw();
            }
        });
        
        $.ajax({
           method: 'GET',
           url: '/api/getLastHourData',
           data:{},
           success: function(response){
               var lastHour = [];
               var now = [];
               var lhData = [];
               var nData = [];
               var sumLastHour = 0;
               var sumNow = 0;
               var calc = null;
               var preco = 0.56474;
               
               lastHour = response.data.lastHourData;
               now      = response.data.nowData;
               for(var i=0;i<lastHour.length;i++){
                   lhData = JSON.parse(lastHour[i].data);
                   
                   if(lhData.corrente != null || lhData.corrente != undefined){
                        sumLastHour += parseFloat(lhData.corrente);
                        sumLastHour = (sumLastHour*127)/1000     
                   }
                   
               }
               
               for(var i =0; i < now.length;i++){
                    nData = JSON.parse(now[i].data);
                   
                   if(nData.corrente != null || nData.corrente != undefined){
                        sumNow += parseFloat(nData.corrente);
                            sumNow += (sumNow*127)/1000;
                   }
               }
              // console.log(sumNow+'-'+sumLastHour);
               if(sumNow == 0 ){
                    calc = -100;   
               }
               if(sumLastHour == 0){
                    calc = 100;   
               }
               
               if(sumLastHour == 0 && sumNow == 0){
                    calc=0;
                   $(".progress-bar").css('width',calc+'%');
               }
               
               if(sumNow != 0 && sumLastHour != 0){
                   calc = (sumNow/sumLastHour)-1;
               }
               
               $("#actualCost").html('');
               $("#actualCost").append('R$ '+Math.floor(sumNow*preco));
               $("#lastHourDescription").html('');
               
               if(calc < 0){
                    $("#lastHourDescription").append('Redução de '+Math.floor(calc*-100)+'%');
                   $(".progress-bar").css('width',-100*calc+'%');
                   $(".progress-bar").addClass('progress-bar-green');
               }
               
               if(calc >= 0){
                    $("#lastHourDescription").append('Aumento de '+Math.floor(calc*100)+'%'); 
                   $(".progress-bar").css('width',100*calc+'%');
                   $(".progress-bar").addClass('progress-bar-red');
               }
               
                              
               //console.log(sumLastHour);
               //console.log(lastHour); 
              // console.log(json);
           }
        });
    }
    
    setInterval(getData,3000);
      //getData();   
    $("[name='my-checkbox']").bootstrapSwitch();
    
    $('input[name="my-checkbox"]').on('switchChange.bootstrapSwitch', function(event, state) {
    //console.log(this); // DOM element
        //console.log(event); // jQuery event
        
        //console.log(state); // true | false
        
        $.ajax({
            method:'POST',
            url: '/api/switchLight',
            data: {'status':state },
            success:function(response){
                console.log(response)
            }
        });
        
    });
     
                
</script>

@endsection