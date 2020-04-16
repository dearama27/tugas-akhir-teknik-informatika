@extends('adminLTE.layout')

@push('title')
Form Distribution Center
@endpush
@push('page-name')
Distribution Center
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
          <h4>Data Distribution Center</h4>
          <div class="row">

            
            <!-- Harga -->
            <div class="form-group col-md-12">
              <label for="dc_code">DC Code <span class="text-danger">*</span></label>
              <input required autocomplete="off" name="dc_code" class="form-control" id="dc_code" placeholder="" value="{{isset($data) ? $data->dc_code:''}}">
            </div>
            

            <!-- Name -->
            <div class="form-group col-md-12">
              <label for="name">Name <span class="text-danger">*</span></label>
              <input required autocomplete="off" name="name" type="text" class="form-control" id="name" placeholder="" value="{{isset($data) ? $data->name:''}}">
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
