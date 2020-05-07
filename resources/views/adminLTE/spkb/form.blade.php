@extends('adminLTE.layout')

@push('title')
Form Spkb
@endpush

@push('page-name')
Form Spkb
@endpush

@section('content')

<div class="row">
  <div class="col-md-12">
    <div class="card card-primary">
      <!-- form start -->
      <form role="form" method="POST" action="{{ route($resource.'.store') }}">
        @csrf

        <input type="hidden" name="id" value="{{isset($data) ? $data->id:''}}" />

        <div class="card-body">
          <h4>Data Spkb</h4>
          <div class="row">

            @if (isset($data))
            <!-- Date Delivery -->
            <div class="form-group col-md-6">
              <label for="date_delivery">No. SPKB <span class="text-danger">*</span></label>
              <input disabled datepicker autocomplete="off" name="date_delivery" type="text" class="form-control"
                id="date_delivery" placeholder="" value="{{isset($data) ? $data->code:''}}">
            </div>
            @endif

            <!-- Date Delivery -->
            <div class="form-group col-md-6">
              <label for="date_delivery">Date Delivery <span class="text-danger">*</span></label>
              <input datepicker autocomplete="off" name="date_delivery" type="text" class="form-control"
                id="date_delivery" placeholder="" value="{{isset($data) ? $data->date_delivery:''}}">
            </div>

            <!-- Driver Id -->
            <div class="form-group col-md-6">
              <label for="driver_id">Driver <span class="text-danger">*</span></label>
              <select selectpicker name="driver_id" id="driver_id" class="form-control" data-size="5" data-live-search="true">
                <option value="">- Pilih -</option>
                @foreach ($driver as $d)
                <option {{isset($data) && $data->driver_id == $d->id ? 'selected':''}} value="{{$d->id}}">{{$d->name}}
                </option>
                @endforeach
              </select>
              {{-- <input autocomplete="off" name="driver_id" type="text" class="form-control" id="driver_id" placeholder="" value="{{isset($data) ? $data->driver_id:''}}">
              --}}
            </div>

            <!-- Driver Id -->
            <div class="form-group col-md-6">
              <label for="pic_id">Penanggung Jawab <span class="text-danger">*</span></label>
              <select selectpicker name="pic_id" id="pic_id" class="form-control" data-size="5" data-live-search="true">
                <option value="">- Pilih -</option>
                @foreach ($dc as $dc_item)
                <option {{isset($data) && $data->pic_id == $dc_item->id ? 'selected':''}} value="{{$dc_item->id}}">{{$dc_item->name}}
                </option>
                @endforeach
              </select>
              {{-- <input autocomplete="off" name="pic_id" type="text" class="form-control" id="pic_id" placeholder="" value="{{isset($data) ? $data->pic_id:''}}">
              --}}
            </div>
            <div class="col-12">
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th style="width: 10px">#</th>
                    <th>Date Delivery</th>
                    <th>Customer</th>
                    <th>Ttl Price</th>
                    <th>Ttl Qty</th>

                    <th style="width: 80px">Status</th>
                    <th style="width: 160px">Action</th>
                  </tr>
                </thead>
                @if (!count($data->detail))
                <tr>
                  <td colspan="7" class="text-center">@lang('general.not_found')</td>
                </tr>
                @endif
                <tbody>
                  @foreach ($data->detail as $key => $detail)
                  @php
                      $item = $detail->order;
                  @endphp
                  <tr>
                    <td>{{ $key+1 }}</td>
                    <td>{{ $item->date_delivery }}</td>
                    <td>{{ $item->customer->name }}</td>
                    <td>{{ number_format($item->ttl_price) }}</td>
                    <td>{{ $item->ttl_qty }}</td>

                    <td>
                      @if(!$item->deleted_at)
                      <span class="badge bg-success">Aktif</span>
                      @else
                      <span class="badge bg-danger">Deleted</span>
                      @endif
                    </td>
                    <td>
                      @if($item->deleted_at)
                      <button class="btn btn-success btn-xs text-white restore" data-id="{{$item->id}}"><i
                          class="fas fa-sync-alt"></i> Restore</button>
                      @else
                      @if (Role::isAllow("delete"))
                      <button class="btn btn-danger btn-xs text-white delete" data-id="{{$item->id}}"><i
                          class="fas fa-trash"></i> Delete</button>
                      @endif
                      @endif
                    </td>
                  </tr>
                  @endforeach

                </tbody>
              </table>
            </div>
            <!-- Ttl Price -->
            <div class="form-group col-md-6">
              <label for="ttl_price">Ttl Price <span class="text-danger">*</span></label>
              <input readonly autocomplete="off" name="ttl_price" type="text" class="form-control" id="ttl_price"
                placeholder="" value="{{isset($data) ? number_format($data->ttl_price):''}}">
            </div>

            <!-- Ttl Qty -->
            <div class="form-group col-md-6">
              <label for="ttl_qty">Ttl Qty <span class="text-danger">*</span></label>
              <input readonly autocomplete="off" name="ttl_qty" type="number" class="form-control" id="ttl_qty" placeholder=""
                value="{{isset($data) ? $data->ttl_qty:''}}">
            </div>

          </div>

        </div>
        <!-- /.card-body -->

        <div class="card-footer">
          <div class="btn-group">
            <a class="btn btn-secondary" href="{{ route($resource.'.index') }}"><i class="fa fa-arrow-left"></i>
              Back</a>
            <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
          </div>
        </div>

      </form>
    </div>
  </div>
</div>
@endsection

@push('scripts')
<script src='{{url('')}}/theme/plugins/bootstrap-select-1.13.9/dist/js/bootstrap-select.min.js'></script>
<script src='{{url('')}}/theme/plugins/jquery-ui/jquery-ui.min.js'></script>
<script src="{{url('')}}/theme/plugins/inputmask/min/jquery.inputmask.bundle.min.js"></script>

<script>
  //Datepicker
$('[datepicker]').datepicker({dateFormat: 'yy-mm-dd'});
$('[selectpicker]').selectpicker();

$('[data-currency]').inputmask({
    'alias': 'currency',
    'groupSeparator': '.',
    'digits': 0,
    'digitsOptional': false,
    'prefix': ' Rp. ',
    'placeholder': '0'
  })
</script>
@endpush

@push('styles')
<link rel='stylesheet' href='/theme/plugins/bootstrap-select-1.13.9/dist/css/bootstrap-select.min.css' />

<link rel='stylesheet' href='{{url('')}}/theme/plugins/jquery-ui/jquery-ui.min.css' />
<link rel='stylesheet' href='{{url('')}}/theme/plugins/jquery-ui/jquery-ui.theme.min.css' />

@endpush