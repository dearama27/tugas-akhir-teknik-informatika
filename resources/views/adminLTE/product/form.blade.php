@extends('adminLTE.layout')

@push('title')
Form Product
@endpush

@push('page-name')
Form Product
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
          <h4>Data Product</h4>
          <div class="row">


            <!-- Name -->
            <div class="form-group col-md-12">
              <label for="name">Name <span class="text-danger">*</span></label>
              <input autocomplete="off" name="name" type="text" class="form-control" id="name" placeholder="" value="{{isset($data) ? $data->name:''}}">
            </div>
            
            <!-- Harga -->
            <div class="form-group col-md-12">
              <label for="harga">Harga <span class="text-danger">*</span></label>
              <input autocomplete="off" name="harga" type="number" class="form-control" id="harga" placeholder="" value="{{isset($data) ? $data->harga:''}}">
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

<script>

</script>
@endpush

@push('styles')

@endpush
