@extends('adminLTE.layout')
@push('page-name')
{{$pageName}}
@endpush

@push('title')
@lang('user.text_form_add')
@endpush

@section('content')

<div class="row">
  <div class="col-md-12">
    <div class="card card-primary card-outline">
      <!-- form start -->
      <form role="form" method="POST" action="{{route('users.store')}}">
        @csrf

        <input type="hidden" name="id" value="{{isset($data) ? $data->id:''}}" />
        
        <div class="card-body">
          <h4>@lang('user.text_form_title')</h4>
          <div class="row">

            <div class="form-group col-md-6">
              <label for="name">@lang('user.text_fullname')</label>
              <input autocomplete="off" name="name" type="name" class="form-control" id="name" placeholder="" value="{{isset($data) ? $data->name:''}}">
            </div>

            <div class="form-group col-md-6">
              <label for="phone">@lang('user.text_phone')</label>
              <input autocomplete="off" name="phone" type="phone" class="form-control" id="phone" placeholder="" value="{{isset($data) ? $data->phone:''}}">
            </div>

            <div class="form-group col-md-6">
              <label for="email">@lang('user.text_email')</label>
              <input autocomplete="off" name="email" type="email" class="form-control" id="email" placeholder="" value="{{isset($data) ? $data->email:''}}">
            </div>

            <div class="form-group col-md-6">
              <label for="password">@lang('user.text_password')</label>
              <input autocomplete="off" name="password" type="password" class="form-control" id="password" placeholder="">
            </div>

            <div class="form-group col-md-6">
              <label for="role">@lang('user.text_role')</label>
              <select name="role" type="role" class="form-control" id="role" placeholder="">
                <option>- Pilih -</option>
                @foreach ($roles as $item)
                  <option {{isset($data) ? ($data->permissions_role_id == $item->id ? 'selected':''):''}} value="{{$item->id}}">{{$item->name}}</option>
                @endforeach
              </select>
            </div>

          </div>

        </div>
        <!-- /.card-body -->

        <div class="card-footer">
          <div class="btn-group">
            <a class="btn btn-secondary" href="{{ $base }}"><i class="fa fa-arrow-left"></i> @lang('general.back')</a>
            <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> @lang('general.save')</button>
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
