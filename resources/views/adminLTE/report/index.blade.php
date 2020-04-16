@extends('adminLTE.layout')

@push('title')
Laporan Pengiriman
@endpush
@push('page-name')
Laporan
@endpush

@section('content')
<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header">
        Filter
      </div>
      <div class="card-body">
        <form action="" class="row">
          <div class="form-group col-md-6">
            <label>Tanggal Pengiriman (Awal)</label>
            <input type="text" class="form-control" id="startDate" placeholder="Start Date">
          </div>
          <div class="form-group col-md-6">
            <label>Tanggal Pengiriman (Akhir)</label>
            <input type="text" class="form-control" id="endDate" placeholder="End Date">
          </div>
        </form>
      </div>
      <div class="card-footer">
          <button style="width: 150px" class="btn btn-primary"><i class="fa fa-eye"></i> Filter</button>
          <button style="width: 150px" class="btn btn-danger"><i class="fa fa-print"></i> Print</button>
      </div>
    </div>
    <div class="card">
      <div class="card-header">

        <span class="mt-1 float-left">Data SPKB (Surat Perintah Keluar Barang)</span>
        <!-- SEARCH FORM -->
        <form class="form-inline ml-3 float-right" action="{{route($resource.'.index')}}">
          <div class="input-group input-group-sm">
            <input style="background-color: #f2f4f6; border: none" class="form-control form-control-navbar"
              type="search" placeholder="Search" aria-label="Search" name="search" value="{{Request::get('search')}}">
            <div class="input-group-append">
              <button class="btn btn-navbar" style="background-color: #f2f4f6" type="submit">
                <i class="fas fa-search"></i>
              </button>
            </div>
          </div>
        </form>
        <div class="clearfix"></div>
      </div>
      <!-- /.card-header -->
      <div class="card-body p-0">
        <div class="table-responsive">
          <table class="table table-bordered">
            <thead>
              <tr>
                <th rowspan="2" style="vertical-align: middle; text-align: center; width: 10px">#</th>
                <th style="vertical-align: middle; text-align: center" rowspan="2">Code</th>
                <th style="vertical-align: middle; text-align: center" rowspan="2">Date Delivery</th>
                <th style="vertical-align: middle; text-align: center" rowspan="2">Driver</th>
                <th style="vertical-align: middle; text-align: center" rowspan="2">Penganggung Jawab</th>
                <th style="vertical-align: middle; text-align: center" rowspan="2">Ttl Price</th>
                <th style="vertical-align: middle; text-align: center" rowspan="2">Ttl Qty</th>
                <th style="vertical-align: middle; text-align: center" colspan="2">Actual</th>
                <th rowspan="2" style="vertical-align: middle; text-align: center; width: 160px">Action</th>
              </tr>
              <tr>
                <th>Qty</th>
                <th>Total</th>
              </tr>
            </thead>
            @if (!count($results))
            <tr>
              <td colspan="8" class="text-center">@lang('general.not_found')</td>
            </tr>
            @endif
            <tbody>
              @php
              //$no = 1;
              $no = ($results->currentPage() - 1) * $results->perPage() + 1;
              @endphp
              @foreach ($results as $item)

              <tr>
                <td>{{ $no }}</td>
                <td>{{ $item->code }}</td>
                <td>{{ $item->date_delivery }}</td>
                <td>{{ $item->user_driver->name }}</td>
                <td>{{ $item->dc->name }}</td>
                <td>{{ $item->ttl_price }}</td>
                <td>{{ $item->ttl_qty }}</td>
                <td>0</td>
                <td>0</td>

                <td>
                  @if($item->deleted_at)
                  <button class="btn btn-success btn-xs text-white restore" data-id="{{$item->id}}"><i
                      class="fas fa-sync-alt"></i> Restore</button>
                  @else
                  @if (Role::isAllow("delete"))
                  <button class="btn btn-default btn-xs" data-id="{{$item->id}}"><i
                      class="fa fa-print"></i> Print</button>
                  @endif
                  @endif
                </td>
              </tr>
              @php
              $no++;
              @endphp
              @endforeach

            </tbody>
          </table>
        </div>
      </div>
      <!-- /.card-body -->
      <div class="card-footer clearfix">
        <div class="float-left">
          Total Result : {{$results->total()}}
        </div>
        <div class="float-right">
          {{$results->links()}}
        </div>
        <div class="clearfix"></div>
      </div>
      <!-- /.card-footer -->
    </div>
  </div>
</div>
@endsection



@push('styles')
<!-- Toastr -->
<link rel="stylesheet" href="/theme/plugins/jquery-ui/jquery-ui.min.css">
<link rel="stylesheet" href="/theme/plugins/jquery-ui/jquery-ui.theme.min.css">
<link rel="stylesheet" href="/theme/plugins/toastr/toastr.min.css">
@endpush

@push('scripts')
<!-- Toastr -->
<script src="/theme/plugins/toastr/toastr.min.js"></script>
<script src="/theme/plugins/jquery-ui/jquery-ui.min.js"></script>
@if (session('status'))
<script>
  toastr.{{session('status')}}('{{session('message')}}')
</script>
@endif

<script>
  $(".delete").click(function() {
    let id = $(this).data('id');

      Swal.fire({
          title: '<strong>Are you sure?</strong>',
          type: 'question',
          html: 'Delete this data from database.',
          showCloseButton: true,
          showCancelButton: true,
          focusConfirm: false,
          confirmButtonText:
            '<i class="fa fa-check"></i> Yes',
          confirmButtonAriaLabel: 'Thumbs up, great!',
          cancelButtonText:
            '<i class="fa fa-times"></i> No',
          cancelButtonAriaLabel: 'Thumbs down'
        }).then(btn => {
          if(btn.value) {
            axios.delete(`{{route($resource.'.index')}}/${id}`).then(res => {
              if(res.data.status) {
                toastr.success(`${res.data.message}`)
                setTimeout(() => {
                  location.reload()
                }, 2000);
              }
            })
          }
        })
    });


    $(function() {

$('#startDate, #endDate').datepicker({
    beforeShow: customRange,
    dateFormat: "dd/mm/yy",
});

});

function customRange(input) {

if (input.id == 'endDate') {
  let date    = $('#startDate').val().split('/');
  var minDate = new Date(date[2], date[1]-1, date[0]);
  minDate.setDate(minDate.getDate() + 1)

  return {
      minDate: minDate
  };
}

return {}

}
</script>
@endpush