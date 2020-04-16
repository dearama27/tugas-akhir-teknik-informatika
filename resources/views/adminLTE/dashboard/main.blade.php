@extends('adminLTE.layout')
@push('title')
Dashboard
@endpush

@push('page-name')
Dashboard
@endpush

@section('content')
<div class="row">
  <div class="col-md-3 col-sm-6 col-12">
    <div class="info-box">
      <span class="info-box-icon bg-info"><i class="far fa-user"></i></span>

      <div class="info-box-content">
        <span class="info-box-text">User Active</span>
        <span class="info-box-number">{{$count['users']}}</span>
      </div>
      <!-- /.info-box-content -->
    </div>
    <!-- /.info-box -->
  </div>
  <div class="col-md-3 col-sm-6 col-12">
    <div class="info-box">
      <span class="info-box-icon bg-info"><i class="fa fa-users"></i></span>

      <div class="info-box-content">
        <span class="info-box-text">Total Customer</span>
        <span class="info-box-number">{{number_format($count['customer'])}}</span>
      </div>
      <!-- /.info-box-content -->
    </div>
    <!-- /.info-box -->
  </div>
  <div class="col-md-3 col-sm-6 col-12">
    <div class="info-box">
      <span class="info-box-icon bg-info"><i class="fab fa-opencart"></i></span>

      <div class="info-box-content">
        <span class="info-box-text">Plan Order Today</span>
        <span class="info-box-number">1</span>
      </div>
      <!-- /.info-box-content -->
    </div>
    <!-- /.info-box -->
  </div>
  <div class="col-md-3 col-sm-6 col-12">
    <div class="info-box">
      <span class="info-box-icon bg-info"><i class="fas fa-truck-moving"></i></span>

      <div class="info-box-content">
        <span class="info-box-text">Delivery Today</span>
        <span class="info-box-number">1</span>
      </div>
      <!-- /.info-box-content -->
    </div>
    <!-- /.info-box -->
  </div>
</div>
<div class="row">

  <!-- /.col-md-6 -->
  <div class="col-lg-6">
    <div class="card">
      <div class="card-header border-0">
        <div class="d-flex justify-content-between">
          <h3 class="card-title">Sales Report</h3>
        </div>
      </div>
      <div class="card-body">

        <div class="position-relative mb-4">
          <canvas id="customer-order-chart" height="200"></canvas>
        </div>
      </div>
    </div>
    <!-- /.card -->
  </div>
  <!-- /.col-md-6 -->
  <!-- /.col-md-6 -->
  <div class="col-lg-6">
    <div class="card">
      <div class="card-header border-0">
        <div class="d-flex justify-content-between">
          <h3 class="card-title">Top 7 Product Sales</h3>
          <a href="{{url('report')}}">View Report</a>
        </div>
      </div>
      <div class="card-body">
        {{-- <div class="d-flex">
          <p class="d-flex flex-column">
            <span class="text-bold text-lg">Rp. 18,230k</span>
            <span>Sales Over Time</span>
          </p>
          <p class="ml-auto d-flex flex-column text-right">
            <span class="text-success">
              <i class="fas fa-arrow-up"></i> 33.1%
            </span>
            <span class="text-muted">Since last month</span>
          </p>
        </div>
        <!-- /.d-flex --> --}}

        <div class="position-relative mb-4">
          <canvas id="sales-product-chart" height="200"></canvas>
        </div>

        <div class="d-flex flex-row justify-content-end">
          <span class="mr-2">
            <i class="fas fa-square text-primary"></i>
          </span>

          <span>
            <i class="fas fa-square text-gray"></i> Last year
          </span>
        </div>
      </div>
    </div>
    <!-- /.card -->
  </div>
  <!-- /.col-md-6 -->
</div>
<!-- /.row -->
@endsection


@push('scripts')
<script src="/theme/plugins/chart.js/Chart.min.js"></script>
<script src="/theme/adminlte/dist/js/pages/dashboard3.js"></script>

<script>
  var ticksStyle = {
    fontColor: '#495057',
    fontStyle: 'bold'
  }


  var mode              = 'index'
  var intersect         = true
  var full_product_name = {!! $product_label_full !!}

  var salesProductChart  = new Chart($('#sales-product-chart'), {
    type   : 'bar',
    data   : {
      labels  : {!! $product_label !!},
      datasets: [
        {
          backgroundColor: '#007bff',
          borderColor    : '#007bff',
          data           : [1000, 2000, 3000, 2500, 2700, 2500, 3000]
        },
        {
          backgroundColor: '#ced4da',
          borderColor    : '#ced4da',
          data           : [700, 1700, 2700, 2000, 1800, 1500, 2000]
        }
      ]
    },
    options: {
      maintainAspectRatio: false,
      // tooltips           : {
      //   mode     : mode,
      //   intersect: intersect
      // },
      tooltips           : {
        callbacks: {
          title: function(tooltipItems, data) {

          return full_product_name[tooltipItems[0].index];
          }
        }
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
          // display: false,
          gridLines: {
            display      : true,
            lineWidth    : '4px',
            color        : 'rgba(0, 0, 0, .2)',
            zeroLineColor: 'transparent'
          },
          ticks    : $.extend({
            beginAtZero: true,

            // Include a dollar sign in the ticks
            callback: function (value, index, values) {
              if (value >= 1000) {
                value /= 1000
                value += 'k'
              }
              return 'Rp. ' + value
            }
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

  var salesProductChart  = new Chart($('#customer-order-chart'), {
      type   : 'bar',
      data   : {
        labels  : ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'],
        datasets: [
          {
            backgroundColor: '#007bff',
            borderColor    : '#007bff',
            data           : [1000, 2000, 3000, 2500, 2700, 2500, 3000,2000,5000,1000,1000,3000]
          }
        ]
      },
      options: {
        maintainAspectRatio: false,
        // tooltips           : {
        //   mode     : mode,
        //   intersect: intersect
        // },
        tooltips           : {
          callbacks: {
            // title: function(tooltipItems, data) {

            // return full_product_name[tooltipItems[0].index];
            // }
          }
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
            // display: false,
            gridLines: {
              display      : true,
              lineWidth    : '4px',
              color        : 'rgba(0, 0, 0, .2)',
              zeroLineColor: 'transparent'
            },
            ticks    : $.extend({
              beginAtZero: true,
  
              // Include a dollar sign in the ticks
              callback: function (value, index, values) {
                if (value >= 1000) {
                  value /= 1000
                  value += 'jt'
                }
                return 'Rp. ' + value
              }
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
</script>
@endpush