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
      <form role="form" method="POST" action="{{ route($resource.'.store') }}" >
        @csrf

        <input type="hidden" name="id" value="{{isset($data) ? $data->id:''}}" />
        
        <div class="card-body">
          <h4>Data Spkb</h4>
          <div class="row">


            <!-- Date Delivery -->
            <div class="form-group col-md-12">
              <label for="date_delivery">Date Delivery <span class="text-danger">*</span></label>
              <input datepicker autocomplete="off" name="date_delivery" type="text" class="form-control" id="date_delivery" placeholder="" value="{{isset($data) ? $data->date_delivery:''}}">
            </div>

            <!-- Driver Id -->
            <div class="form-group col-md-12">
              <label for="driver_id">Driver <span class="text-danger">*</span></label>
              <input autocomplete="off" name="driver_id" type="text" class="form-control" id="driver_id" placeholder="" value="{{isset($data) ? $data->driver_id:''}}">
            </div>
            
            <!-- Ttl Order -->
            <div class="form-group col-md-12">
              <label for="ttl_order">Ttl Order <span class="text-danger">*</span></label>
              <input autocomplete="off" name="ttl_order" type="number" class="form-control" id="ttl_order" placeholder="" value="{{isset($data) ? $data->ttl_order:''}}">
            </div>
            
            <!-- Ttl Price -->
            <div class="form-group col-md-12">
              <label for="ttl_price">Ttl Price <span class="text-danger">*</span></label>
              <input autocomplete="off" name="ttl_price" type="number" class="form-control" id="ttl_price" placeholder="" value="{{isset($data) ? $data->ttl_price:''}}">
            </div>
            
            <!-- Ttl Qty -->
            <div class="form-group col-md-12">
              <label for="ttl_qty">Ttl Qty <span class="text-danger">*</span></label>
              <input autocomplete="off" name="ttl_qty" type="number" class="form-control" id="ttl_qty" placeholder="" value="{{isset($data) ? $data->ttl_qty:''}}">
            </div>
            

          </div>

        </div>
        <!-- /.card-body -->

        <div class="card-footer">
          <div class="btn-group">
            <a class="btn btn-secondary" href="{{ route($resource.'.index') }}"><i class="fa fa-arrow-left"></i> Back</a>
            <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
          </div>
        </div>

      </form>
    </div>
  </div>
</div>
@endsection

@push('scripts')
<script src='/theme/adminlte/plugins/jquery-ui/jquery-ui.min.js'></script>

<script>
//Datepicker
$('[datepicker]').datepicker({dateFormat: 'yy-mm-dd'});


</script>
@endpush

@push('styles')
<link rel='stylesheet' href='/theme/adminlte/plugins/jquery-ui/jquery-ui.min.css' />
<link rel='stylesheet' href='/theme/adminlte/plugins/jquery-ui/jquery-ui.theme.min.css' />

@endpush
