@extends('adminLTE.layout')

@push('title')
Form Pengiriman
@endpush

@push('page-name')
Pengiriman
@endpush

@section('content')

<div class="row">
  <div class="col-md-12">
    <div class="card card-primary">
      <!-- form start -->
      <form role="form" method="POST" action="{{ route($resource.'.store') }}?input-delivery=true">
        @csrf

        <input type="hidden" name="id" value="{{isset($order) ? $order->id:''}}" />
        <input id="delivery_status" type="hidden" name="delivery_status" value="{{isset($order) ? $order->delivery_status:0}}" />
        <input id="order_id" type="hidden" name="order_id" value="{{isset($order) ? $order->order_id:0}}" />

        <div class="card-body">
          <h4>Data Product</h4>
          <div class="row">
          </div>

          <table class="table table-bordered">
            <thead>
              <tr>
                <th style="vertical-align: middle; text-align: center" rowspan="2" style="width: 10px">#</th>
                <th style="vertical-align: middle; text-align: center" rowspan="2">Name</th>
                <th style="vertical-align: middle; text-align: center" rowspan="2">Price</th>
                <th style="vertical-align: middle; text-align: center" rowspan="2">Qty</th>
                <th style="vertical-align: middle; text-align: center" rowspan="2">Ttl. Price</th>
                <th style="vertical-align: middle; text-align: center" colspan="2">Actual</th>
              </tr>
              <tr>
                <th style="vertical-align: middle; text-align: center; width: 80px">Qty</th>
                <th style="vertical-align: middle; text-align: center; width: 200px">Ttl. Price</th>
              </tr>
            </thead>
            @if (!count($products))
            <tr>
              <td colspan="5" class="text-center">@lang('general.not_found')</td>
            </tr>
            @endif
            <tbody>
              @foreach ($products as $key => $item)
              @php
                  $prod = $item->product;
              @endphp
              <tr class="item-row">
                <td style="vertical-align: middle;" class="text-center">{{ $key+1 }}</td>
                <td style="vertical-align: middle;">{{ $prod->name }}</td>
                <td style="vertical-align: middle;" class="price" data-value="{{$item->price}}">Rp. {{ number_format($item->price) }}</td>
                <td style="vertical-align: middle;">{{ $item->qty }}</td>
                <td style="vertical-align: middle;">Rp. {{ number_format($item->qty*$item->price) }}</td>
                
                <td style="vertical-align: middle;">
                  <input type="hidden" name="product[{{$key}}][order_product_id]" class="form-control " value="{{$item->id}}"/>
                  {{-- <input type="hidden" name="product[{{$key}}][order_id]" class="form-control " value="{{$item->order_id}}"/> --}}
                  <input @if ($order->delivery_status > 0) readonly @endif  name="product[{{$key}}][actual_qty]" class="form-control actual_qty" value="{{$item->actual_qty}}"/>
                </td>

                <td style="vertical-align: middle;">
                  <input data-currency name="product[{{$key}}][actual_total]" class="form-control actual_total" value="{{$item->actual_total}}" readonly/>
                </td>

              </tr>
              @endforeach

              <tr>
                <td style="vertical-align: middle" class="text-right" colspan="5">Total Actual</td>
                <td style="vertical-align: middle"><input readonly type="text" class="form-control ttl_actual_qty" name="ttl_actual_qty" value="{{$order->order->ttl_actual_qty}}" /></td>
                <td style="vertical-align: middle"><input readonly data-currency type="text" class="form-control ttl_actual_total" name="ttl_actual_total" value="{{$order->order->ttl_actual_total}}" /></td>
            </tbody>
          </table>
        </div>
        <!-- /.card-body -->

        <div class="card-footer">
          <div class="btn-group">
            <button type="button" class="btn btn-secondary" onclick="history.back()"><i class="fa fa-arrow-left"></i>
              Back</button>
            @if ($order->delivery_status == 0)
            <button data-status="1" type="submit" class="btn btn-primary set-status"><i class="fa fa-save"></i> Save</button>
            @endif
          </div>

          @if ($order->delivery_status == 0)
          <button type="button" id="cancel-delivery" class="btn btn-warning"><i class="fa fa-redo"></i> Batalkan Pengiriman</button>
          @endif
        </div>

        <input type="text" class="keterangan" name="keterangan" hidden>

      </form>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modal-pembatalan" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Pengiriman di Batalkan</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <textarea type="text" class="form-control" id="keterangan" rows="5" placeholder="Alasan Pembatalan"></textarea>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" data-status="2"  class="btn btn-primary set-status" id="save-modal">Save</button>
      </div>
    </div>
  </div>
</div>
@endsection

@push('scripts')
<script src='{{url('')}}/theme/plugins/jquery-ui/jquery-ui.min.js'></script>
<script src="{{url('')}}/theme/plugins/inputmask/min/jquery.inputmask.bundle.min.js"></script>

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

  $('.set-status').click(function() {
    let status = $(this).data('status');
    $('#delivery_status').val(status)
  });

  $('#cancel-delivery').click(function() {
    swal.fire({
      title: "Anda yakin..?",
      text: 'Batalkan Pengiriman ini.',
      type: 'warning',
      showCancelButton: true,
      cancelButtonText: 'Tidak',
      confirmButtonText: 'Ya',
    }).then(btn => {
      if(btn.value) {

        $('#modal-pembatalan').modal('show')

        // let status = $(this).data('status');
        // $('[role="form"]')[0].submit()
      }
    })
  })

  $('#save-modal').click(function() {
      $('[role="form"]')[0].submit()
  });

  $('.actual_qty').keyup(function() {
    let tr = $(this).closest('tr');
    let price = tr.find('.price').data('value');
    let actual_qty = $(this).val();
    let actual_total = parseInt(actual_qty)*parseInt(price);

    tr.find('.actual_total').val(actual_total);
    calc()
  });


  function calc() {
      let ttl_act_qty = 0;
      let ttl_act_total = 0;
    $('.item-row').each(function() {
      let tr        = $(this);

      let act_qty   = tr.find('.actual_qty').val();
      let act_total = tr.find('.actual_total').val().replace(/\D/g, '');

      ttl_act_qty   += parseInt(act_qty);
      ttl_act_total += parseInt(act_total);

      $('.ttl_actual_qty').val(isNaN(ttl_act_qty) ? 0:ttl_act_qty);
      $('.ttl_actual_total').val(ttl_act_total);
    })

  }

  $('#keterangan').keyup(function() {
    $('.keterangan').val($(this).val());
  })
</script>
@endpush

@push('styles')
<link rel='stylesheet' href='{{url('')}}/theme/plugins/jquery-ui/jquery-ui.min.css' />
<link rel='stylesheet' href='{{url('')}}/theme/plugins/jquery-ui/jquery-ui.theme.min.css' />

@endpush