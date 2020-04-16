@extends('adminLTE.layout')

@push('title')
@lang('permissions_role.text_form_add')
@endpush

@section('content')
<div class="row">
  <div class="col-md-8">
    <div class="card card-primary card-outline">
      <!-- form start -->
      <form role="form" method="POST" action="{{$base}}/form">
        @csrf
        <div class="card-body">
          <h4>@lang('permissions_role.text_form_title')</h4>
          <div class="row">
            <input type="hidden" name="id" value="{{isset($data) ? $data->id:''}}"/>
            <div class="form-group col-md-12">
              <label for="name">@lang('permissions_role.text_name')</label>
              <input autocomplete="off" name="name" type="name" class="form-control" id="name" placeholder="" value="{{isset($data) ? $data->name:''}}">
            </div>

            <div class="form-group col-md-12">
              <label for="description">@lang('permissions_role.text_description')</label>
              <textarea name="description" type="description" class="form-control" id="description" placeholder="">{{isset($data) ? $data->description:''}}</textarea>
            </div>

          </div>
          
        </div>
        <!-- /.card-body -->

        <div class="card-footer">
          <div class="btn-group">
            <a class="btn btn-secondary" href="{{ $base }}"><i class="fa fa-arrow-left"></i> @lang('general.back')</a>
            @if (!(isset($data) && $data->id ==1))
              <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> @lang('general.save')</button>
            @endif
          </div>
        </div>

      </form>
    </div>
  </div>
</div>
@endsection

@push('scripts')
<!-- Summernote -->
<script src="/theme/plugins/summernote/summernote-bs4.min.js"></script>
<!-- InputMask -->
<script src="/theme/plugins/moment/moment.min.js"></script>
<script src="/theme/plugins/inputmask/min/jquery.inputmask.bundle.min.js"></script>
<!-- Bootstrap Select -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/js/bootstrap-select.min.js"></script>

<script>
  $('select').selectpicker();
  $(function () {
    // Summernote
    $('textarea').summernote({
      height: 200,
      toolbar: [
        // [groupName, [list of button]]
        ['style', ['bold', 'italic', 'underline', 'clear']],
        ['font', ['strikethrough', 'superscript', 'subscript']],
        ['fontsize', ['fontsize']],
        ['color', ['color']],
        ['para', ['ul', 'ol', 'paragraph']],
        ['height', ['height']]
      ]
    })

    $('[data-currency]').inputmask({
      'alias': 'currency',
      'groupSeparator': '.',
      'digits': 0,
      'digitsOptional': false,
      'prefix': ' Rp. ',
      'placeholder': '0'
    })
  })
</script>
@endpush

@push('styles')
<!-- summernote -->
<link rel="stylesheet" href="/theme/plugins/summernote/summernote-bs4.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/css/bootstrap-select.min.css">

@endpush