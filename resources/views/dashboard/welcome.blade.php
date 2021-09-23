@extends('layouts.dashboard.app')

@section('content')
<link rel="stylesheet" href="{{ asset('dashboard_files/plugins/fontawesome-free/css/all.min.css') }}"> 
<link rel="stylesheet" href="{{ asset('dashboard_files/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }} ">

  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <div class="content-wrapper">

        <section class="content-header">

            <h1>@lang('site.dashboard')</h1>

            <ol class="breadcrumb">
                <li class="active"><i class="fa fa-dashboard"></i> @lang('site.dashboard')</li>
            </ol>
        </section>

        <section class="content">

            <div class="row">

                {{-- categories--}}
                <div class="col-lg-3 col-xs-6">
                    <div class="small-box bg-aqua">
                        <div class="inner">
                            <h3>{{ $categories_count }}</h3>

                            <p>@lang('site.categories')</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-bag"></i>
                        </div>
                        <a href="{{ route('dashboard.categories.index') }}" class="small-box-footer">@lang('site.read') <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>

                {{--products--}}
                <div class="col-lg-3 col-xs-6">
                    <div class="small-box bg-green">
                        <div class="inner">
                            <h3>{{ $products_count }}</h3>

                            <p>@lang('site.products')</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-stats-bars"></i>
                        </div>
                        <a href="{{ route('dashboard.products.index') }}" class="small-box-footer">@lang('site.read') <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>

                {{--clients--}}
                <div class="col-lg-3 col-xs-6">
                    <div class="small-box bg-red">
                        <div class="inner">
                            <h3>{{ $clients_count }}</h3>

                            <p>@lang('site.clients')</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-user"></i>
                        </div>
                        <a href="{{route('dashboard.clients.index') }}" class="small-box-footer">@lang('site.read') <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>

                {{--users--}}
                <div class="col-lg-3 col-xs-6">
                    <div class="small-box bg-yellow">
                        <div class="inner">
                            <h3>{{ $users_count }}</h3>

                            <p>@lang('site.users')</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-users"></i>
                        </div>
                        <a href="{{ route('dashboard.users.index') }}" class="small-box-footer">@lang('site.read') <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>

            </div><!-- end of row -->

            <div class="row">
          <div class="col-md-6" style="background-color: white;margin: 19px;" >
          <div class="card">
              <div class="card-header border-0">
                <div class="d-flex justify-content-between">
                  <h3 class="card-title">Gold Rates Over Month</h3>
                 
                </div>
              </div>
              <div id="container" style="height: 400px; min-width: 310px"></div>


              <div class="card-body">
                <div class="d-flex">
                  <p class="d-flex flex-column">
                    <span class="text-bold text-lg"></span>
                    <span></span>
                  </p>
                  <p class="ml-auto d-flex flex-column text-right">
                    <span class="text-success">
                      <i class="fas fa-arrow-up"></i> 
                    </span>
                    <span class="text-muted"></span>
                  </p>
                </div>
                <!-- /.d-flex 

                <div class="position-relative mb-4">
                  <canvas id="visitors-chart" height="200"></canvas>
                </div>-->

                <div class="d-flex flex-row justify-content-end">
                  <span class="mr-2">
                    <i class="fas fa-square text-primary"></i> 
                  </span>

                  <span>
                    <i class="fas fa-square text-gray"></i> 
                  </span>
                </div>
              </div>









            </div>
          <!-- /.col ///sales --> 
          @foreach($revenueMonth as $row)
          <input type="hidden" value="{{$row->mx}}" class="mxprices">
          <input type="hidden" value="{{$row->mn}}" class="mnprices">
          <input type="hidden" value="{{ Carbon\Carbon::parse($row->created_at)->format('m')}}" class="dayes">
          

          @endforeach
        </div>

        
          <!-- Left col -->
        
            <!-- MAP & BOX PANE -->
          
            <!-- /.card -->
       
           
              <!-- /.col -->

              <div class="col-md-4" style="background-color: white;margin: 19px;">
                <!-- USERS LIST -->
                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">Latest Members</h3>

                    <div class="card-tools">
                      <span class="badge badge-danger">{{count($latestclients )}} New Members</span>
                      <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                      </button>
                      <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i>
                      </button>
                    </div>
                  </div>
                  <!-- /.card-header -->
                  <div class="card-body p-0">
                    <ul class="users-list clearfix">
                      
                      
                      
                      @foreach($latestclients as $latestclient)
                      <li>
                        <img src="{{ asset('uploads/clients/'.$latestclient->id_image) }}" alt="User Image">
                        <a class="users-list-name" >{{$latestclient->first_name}}</a>
                        <span class="users-list-date">{{$latestclient->created_at}}</span>
                      </li>
                      @endforeach
                    </ul>
                    <!-- /.users-list -->
                  </div>
                  <!-- /.card-body -->
                  <div class="card-footer text-center" style="margin-top: 15px;">
                    <a href="{{ route('dashboard.clients.index') }}">View All Users</a>
                  </div>
                  <!-- /.card-footer -->
                </div>
                <!--/.card -->
              </div>
              <!-- /.col -->
          
            <!-- /.row -->

            <!-- TABLE: LATEST ORDERS -->
            <div class="row">
            <div class="col-md-12" >

            <div class="card" style="background-color: white;margin: 19px;">
              <div class="card-header border-transparent" style=" padding: 10px 15px;">
                <h3 class="card-title">Latest Orders</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0">
                <div class="table-responsive">
                  <table class="table m-0" style=" padding: 10px 15px;">
                    <thead>
                    <tr>
                      <th>Order ID</th>
                      <th>Item</th>
                      <th>Status</th>
                      <th>total Qty</th> 
                    </tr>
                    </thead>
                    <tbody>
                   @foreach($client_orders as $client_order)
                    <tr>
                      <td>{{$client_order->id}}</td>
                      <td>{{$client_order->product_name}}</td>
                      <td><span class="badge badge-success">{{$client_order->delivery_type}}</span></td>
                      <td>
                        <div class="sparkbar" data-color="#00a65a" data-height="20">{{$client_order->totalQty}}</div>
                      </td>
                    </tr>
                    @endforeach
                    </tbody>
                  </table>
                </div>
                <!-- /.table-responsive -->
              </div>
              <!-- /.card-body -->
              <div class="card-footer clearfix">
                
             <!--   <a href="javascript:void(0)" class="btn btn-sm btn-secondary float-right">View All Orders</a> -->
              </div>
              <!-- /.card-footer -->
            </div>
            </div>
            </div>
            <!-- /.card -->
        
          <!-- /.col -->

        
          <!-- /.col -->
        </div>


        </section><!-- end of content -->

    </div><!-- end of content wrapper -->
    <script src="{{ asset('dashboard_files/plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap -->
<script src="{{ asset('dashboard_files/plugins/bootstrap/js/bootstrap.bundle.min.js') }} "></script>

<!-- overlayScrollbars -->
<script src="{{ asset('dashboard_files/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }} "></script>
<!-- AdminLTE App -->
<script src="{{ asset('dashboard_files/dist/js/adminlte.js') }} "></script>

<!-- OPTIONAL SCRIPTS -->
<script src="{{ asset('dashboard_files/dist/js/demo.js') }} "></script>

<!-- PAGE PLUGINS -->
<!-- jQuery Mapael -->
<script src="{{ asset('dashboard_files/plugins/jquery-mousewheel/jquery.mousewheel.js') }} "></script>
<script src="{{ asset('dashboard_files/plugins/raphael/raphael.min.js') }} "></script>


<script src="{{ asset('dashboard_files/plugins/jquery-mapael/jquery.mapael.min.js') }} "></script>
    <script src=" {{ asset('dashboard_files/plugins/chart.js/Chart.min.js') }}"></script>
    <script src="{{ asset('dashboard_files/plugins/jquery-mapael/maps/usa_states.min.js') }} "></script>
    
   
    <script src="https://code.highcharts.com/stock/highstock.js"></script>
<script src="https://code.highcharts.com/stock/modules/data.js"></script>
<script src="https://code.highcharts.com/stock/modules/drag-panes.js"></script>
<script src="https://code.highcharts.com/stock/modules/exporting.js"></script>


    <script >
    
    $(function () {
  'use strict'

  var ticksStyle = {
    fontColor: '#495057',
    fontStyle: 'bold'
  }

  var mode      = 'index'
  var intersect = true

  var $salesChart = $('#sales-chart')
  
  var dayes = $(".dayes");
  var alldayes = [];
  for(var i = 0; i < dayes.length; i++){
    alldayes.push($(dayes[i]).val());
}
  var goldvalues = $(".mxprices");
  var mnprices = $(".mnprices");
  
  var prices = [];
  for(var i = 0; i < goldvalues.length; i++){
    prices.push($(goldvalues[i]).val());
}


var prices2 = [];
  for(var i = 0; i < mnprices.length; i++){
    prices2.push($(mnprices[i]).val());
}
/*
console.log(prices2);
  console.log(prices);*/


  var $visitorsChart = $('#visitors-chart')
  var visitorsChart  = new Chart($visitorsChart, {
    data   : {
      labels  : alldayes,
      datasets: [{
        type                : 'line',
        data                : prices,
        backgroundColor     : 'transparent',
        borderColor         : '#007bff',
        pointBorderColor    : '#007bff',
        pointBackgroundColor: '#007bff',
        fill                : false
   
      },
        {
          type                : 'line',
        data                : prices2,
          backgroundColor     : 'tansparent',
          borderColor         : '#ced4da',
          pointBorderColor    : '#ced4da',
          pointBackgroundColor: '#ced4da',
          fill                : false
        
        }]
    },
    options: {
      maintainAspectRatio: false,
      tooltips           : {
        mode     : mode,
        intersect: intersect
      },
      hover              : {
        mode     : mode,
        intersect: intersect
      },
      legend             : {
        display: false
      },
      scales             : {
        yAxes: [{
     
          gridLines: {
            display      : true,
            lineWidth    : '4px',
            color        : 'rgba(0, 0, 0, .2)',
            zeroLineColor: 'transparent'
          },
          ticks    : $.extend({
            beginAtZero : false,
            suggestedMax: 100
          }, ticksStyle)
        }],
        xAxes: [{
          display  : true,
          gridLines: {
            display: false
          },
          ticks    : ticksStyle
        }]
      }
    }
  })

})

    
    ///////////////////another chart

    var url = '{{URL::to("dashboard/chart")}}';
    
    //Highcharts.getJSON('https://demo-live-data.highcharts.com/aapl-ohlcv.json', function (data) {


      Highcharts.getJSON(url, function (data) {
        console.log( data);
        console.log( Date.parse(data[0]['created_at']));
// split the data set into ohlc and volume
var ohlc = [],
  volume = [],
  dataLength = data.length,
  
  // set the allowed units for data grouping
  groupingUnits = [[
    'week',             // unit name
    [1]               // allowed multiples
  ], [
    'month',
    [1, 2, 3, 4, 6]
  ]],

  i = 1;
var tt=15228;
for (i; i < dataLength; i += 1) {
  ohlc.push([
    Date.parse(data[i]['created_at']), // the date
    parseFloat(data[i]['opn']) , // open
    parseFloat(data[i]['mx']) , // high
    parseFloat(data[i]['mn']) , // low
    parseFloat(data[i]['cls'])  // close
    
  ]);

  volume.push([
   // Date.parse(data[i]['created_at']), // the date
   // parseFloat(data[i]['mx']) // the volume
  ]);
}


// create the chart
Highcharts.stockChart('container', {

  rangeSelector: {
    selected: 1
  },

  title: {
    text: 'AAPL Historical'
  },

  yAxis: [{
    labels: {
      align: 'right',
      x: -3
    },
    title: {
      text: 'Gold'
    },
    height: '60%',
    lineWidth: 2,
    resize: {
      enabled: true
    }
  }, {
    labels: {
      align: 'right',
      x: -3
    },
    title: {
      text: 'Volume'
    },
    top: '65%',
    height: '35%',
    offset: 0,
    lineWidth: 2
  }],

  tooltip: {
    split: true
  },

  series: [{
    type: 'candlestick',
    name: 'AAPL',
    data: ohlc,
    dataGrouping: {
      units: groupingUnits
    }
  }, {
    type: 'column',
    name: 'Volume',
    data: volume,
    yAxis: 1,
    dataGrouping: {
      units: groupingUnits
    }
  }

]
});
});
    
    </script>
@endsection

@push('scripts')



@endpush
