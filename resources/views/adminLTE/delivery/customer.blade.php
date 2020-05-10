@extends('adminLTE.layout')

@push('title')
Data Customer SPKB
@endpush

@push('page-name')
Data Customer SPKB
@endpush

@section('content')

<div class="row">
  <div class="col-md-12">
    <div class="card card-primary">
      <div class="card-body">
        <div class="row">

          <div class="form-group col-md-6">
            <label for="">Code SPKB</label>
            <input type="text" class="form-control" value="{{$data->code}}" readonly />
          </div>

          <div class="form-group col-md-6">
            <label for="">Tanggal Pengiriman</label>
            <input type="text" class="form-control" value="{{gmdate('d M Y', strtotime($data->date_delivery))}}" readonly />
          </div>

        </div>
      </div>
    </div>
    <div class="card card-primary">
      <div class="table-scroll">
        <table class="table table-striped">
          <thead>
            <tr>
              <th style="width: 10px">#</th>
              <th style="width: 300px">Data Customer</th>
              <th style="width: 200px">Mobile Phone</th>

              <th style="width: 200px">Join At</th>
  
              <th style="width: 80px">Status</th>
              <th >Ket.</th>
            </tr>
          </thead>
          @if (!count($detail))
          <tr>
            <td colspan="10" class="text-center">@lang('general.not_found')</td>
          </tr>
          @endif
          <tbody>
            @foreach ($detail as $no => $res)
            @php
                $item = $res->order->customer;
            @endphp
            <tr>
              <td style="vertical-align: middle">{{ $no+1 }}</td>
              <td style="vertical-align: middle">
                <a href="?order_id={{$res->order_id}}">
                  <small>{{ $item->customer_code }}</small><br />
                  {{ $item->name }}<br />
                  <small>{{ $item->address }}</small><br />
                </a>
              </td>
              <td style="vertical-align: middle">{{ $item->mobile_phone }}</td>
  
              <td style="vertical-align: middle">{{ $item->join_at }}</>
  
              <td style="vertical-align: middle">
                @if(!$res->delivery_status)
                <span class="badge bg-warning">Belum Dikirim</span>
                @elseif($res->delivery_status == 1)
                <span class="badge bg-success">Terkirim</span>
                @else
                <span class="badge bg-danger">Dibatalkan</span>
                @endif
              </td>

              <td style="vertical-align: middle">{{ $res->keterangan ?? '-' }}</td>

            </tr>
            @php
            $no++;
            @endphp
            @endforeach
  
          </tbody>
        </table>

        <div class="card-footer">
          <div class="btn-group">
          <a class="btn btn-secondary" href="{{route('delivery.index')}}"><i class="fa fa-arrow-left"></i>
              Back</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@push('scripts')
<script src='{{url('')}}/theme/plugins/jquery-ui/jquery-ui.min.js'></script>
<script src="{{url('')}}/theme/plugins/inputmask/min/jquery.inputmask.bundle.min.js"></script>
<script src="/theme/plugins/toastr/toastr.min.js"></script>

<script>
  //Datepicker
$('[datepicker]').datepicker({dateFormat: 'yy-mm-dd'});

$('[data-currency]').inputmask({
    'alias': 'currency',
    'groupSeparator': '.',
    'digits': 0,
    'digitsOptional': false,
    'prefix': ' Rp. ',
    'placeholder': '0'
  });


  $('.copy').click(function() {
    let data = $(this).data('copy');
    copyTextToClipboard(data);
    toastr.success('Data koordinat di copy Ke clipboard<br/>Ctrl+v untuk paste');
  })

  $('.open-gmaps').click(function() {

let url = 'https://www.google.com/maps/place/';
let data = $(this).data('coordinate');

window.open(`${url}${data}`, '_blank')
})
</script>
@endpush

@push('styles')
<link rel='stylesheet' href='{{url('')}}/theme/plugins/jquery-ui/jquery-ui.min.css' />
<link rel='stylesheet' href='{{url('')}}/theme/plugins/jquery-ui/jquery-ui.theme.min.css' />
<link rel="stylesheet" href="/theme/plugins/toastr/toastr.min.css">

@endpush