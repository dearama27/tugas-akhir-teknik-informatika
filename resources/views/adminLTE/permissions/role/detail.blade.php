@extends('adminLTE.layout')

@push('title')
  @lang('permissions_role.text_detail_title')
@endpush

@section('content')
@section('content')

<form method="post" id="set_persmission_form" action="{{route('permissions.role.set')}}">
  @csrf
  <input type="hidden" name="role_id" value="{{$role->id}}" />
  <!-- Default box -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">{{ $role->name }}</h3>

            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                    <i class="fas fa-minus"></i>
                </button>

                <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
                    <i class="fas fa-times"></i>
                </button>
            </div>

        </div>

        <div class="card-body">
            <table class="table">
                <thead>
                    <tr>
                        <th style="width: 20px">No</th>
                        <th style="width: 200px">Menu</th>
                        @foreach ($actions as $item)
                          <th class="text-center" style="width: 100px">{{$item['name']}}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    @php
                        $no = 1;
                    @endphp
                    @foreach ($menus as $item)
                        <tr>
                            <td class="pt-4">{{$no++}}</td>
                            <td>
                                {{$item->title}}<br/>
                                <small>{{$item->url}}</small>
                            </td>
                            @foreach ($actions as $act)
                              <td class="pt-4 text-center">

                                @if(in_array($act['supfix'], json_decode($item->actions) ?? []))
                                    <input type="checkbox" id="{{$item->id}}_{{$act['supfix']}}" data-id="{{$item->id}}" name="action[{{$item->id}}][{{$act['supfix']}}][]" value="{{$act['supfix']}}" {{Role::getAction($role->id, $item->id, $act['supfix']) ? 'checked':''}} />
                                @endif
                              </td>
                            @endforeach
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- /.card-body -->

        <div class="card-footer">
          <div class="btn-group">
              <a class="btn btn-secondary" href="{{ $base }}"><i class="fa fa-arrow-left"></i> @lang('general.back')</a>
              {{-- <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button> --}}
          </div>
        </div>
    </div>
    <!-- /.card -->
</form>
@endsection

@push('styles')
<!-- Toastr -->
<link rel="stylesheet" href="/theme/plugins/toastr/toastr.min.css">
@endpush

@push('scripts')
<!-- Toastr -->
<script src="/theme/plugins/toastr/toastr.min.js"></script>

<script src="/theme/plugins/chart.js/Chart.min.js"></script>
<script>
$(function () {
  'use strict'
  var ticksStyle = {
    fontColor: '#495057',
    fontStyle: 'bold'
  }

  var mode           = 'index'
  var intersect      = true

  var $visitorsChart = $('#visitors-chart')
  var visitorsChart  = new Chart($visitorsChart, {
    data   : {
      labels  : ['18th', '20th', '22nd', '24th', '26th', '28th', '30th'],
      datasets: [{
        type                : 'line',
        data                : [100, 120, 170, 167, 180, 177, 160],
        backgroundColor     : 'transparent',
        borderColor         : '#007bff',
        pointBorderColor    : '#007bff',
        pointBackgroundColor: '#007bff',
        fill                : false
        // pointHoverBackgroundColor: '#007bff',
        // pointHoverBorderColor    : '#007bff'
      },
        {
          type                : 'line',
          data                : [60, 80, 70, 67, 80, 77, 100],
          backgroundColor     : 'tansparent',
          borderColor         : '#ced4da',
          pointBorderColor    : '#ced4da',
          pointBackgroundColor: '#ced4da',
          fill                : false
          // pointHoverBackgroundColor: '#ced4da',
          // pointHoverBorderColor    : '#ced4da'
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
          // display: false,
          gridLines: {
            display      : true,
            lineWidth    : '4px',
            color        : 'rgba(0, 0, 0, .2)',
            zeroLineColor: 'transparent'
          },
          ticks    : $.extend({
            beginAtZero : true,
            suggestedMax: 200
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
</script>
<script>
$("input[type='checkbox']").change(function() {

    let status = $(this).is(':checked');

    route = '{{route('permissions.role.set')}}';
    let menu_id = $(this).data('id');
    let action = $(this).val();
    status = status ? "create":"delete";

    axios.post(`${route}?status=${status}&menu_id=${menu_id}&action=${action}&role_id={{$role->id}}`).then(res => {
        if(res.data.status) {
            toastr.success(`${res.data.message}`)
        } else {
            toastr.warning(`${res.data.message}`)
        }
    })
})
</script>

@endpush
