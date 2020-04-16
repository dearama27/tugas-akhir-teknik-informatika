@extends('adminLTE.layout')

@push('title')
@lang('permissions_menu.text_form_add')
@endpush

@section('content')
@php
    $act = isset($data) ? json_decode($data->actions):[];
    // dd($act);
@endphp
<div class="row">
  <div class="col-md-12">
    <div class="card card-primary card-outline">
      <!-- form start -->
      <form role="form" method="POST" action="{{$base}}/form">
        @csrf
        <input type="hidden" name="id" value="{{isset($data) ? $data->id:''}}" />

        <div class="card-body">
            <h4>@lang('permissions_menu.text_form_title')</h4>

            <div class="row">
                <div class="col-md-8">
                    <div class="row">
                        <div class="form-group col-md-6">
                        <label for="title">@lang('permissions_menu.text_name')</label>
                            <input autocomplete="off" name="title" type="title" class="form-control" id="title" placeholder="" value="{{isset($data) ? $data->title:''}}">
                        </div>

                        <div class="form-group col-md-6">
                        <label for="route_name">@lang('permissions_menu.text_route_name')</label>
                        <select data-live-search="true" name="route_name" type="route_name" class="form-control" id="route_name" placeholder="" data-size=10>
                          <option value="">- Select -</option>
                            @foreach ($routes as $item)
                            @if (preg_match("/(.*).index/", $item['name']))
                              @if (isset($data) && ($item['name'] == $data->route_name))
                                  <option selected data-uri="{{$item['uri']}}" value="{{$item['name']}}">{{$item['name']}}</option>
                              @else
                                  <option data-uri="{{$item['uri']}}" value="{{$item['name']}}">{{$item['name']}}</option>
                              @endif 
                            @endif
                            @endforeach
                        </select>
                        </div>

                        <div class="form-group col-md-6">
                        <label for="url">@lang('permissions_menu.text_link')</label>
                        <input autocomplete="off" name="url" type="text" class="form-control" id="url" placeholder="" value="{{isset($data) ? $data->url:''}}">
                        </div>

                        <div class="form-group col-md-6">
                        <label for="icon">@lang('permissions_menu.text_icon')</label>
                        <select class="form-control" id="icon" name="icon" data-live-search="true"  data-size="10">
                            <option value="">- Select -</option>
                            @foreach ($fontawesome as $item)
                            <option data-icon="{{$item}}" value="{{$item}}">{{$item}}</option>
                          @endforeach
                        </select>
                        {{-- <input autocomplete="off" name="icon" type="text" class="form-control" id="icon" placeholder="" value="{{isset($data) ? $data->icon:''}}"> --}}
                        </div>

                        <div class="form-group col-md-12">
                        <label for="description">@lang('permissions_menu.text_description')</label>
                        <textarea autocomplete="off" name="description" type="description" class="form-control" id="description" placeholder="">{{isset($data) ? $data->description:''}}</textarea>
                        </div>

                        <div class="form-group col-md-6">
                        <label for="parent_id">@lang('permissions_menu.text_parent')</label>
                        <select name="parent_id" type="parent_id" class="form-control" id="parent_id" placeholder="">
                            <option value="0">- is Parent -</option>
                            @foreach ($menus as $item)
                                @if (isset($data) && $item['id'] == $data->parent_id)
                                    <option selected data-uri="{{$item['id']}}" value="{{$item['id']}}">{{$item['title']}}</option>
                                @else
                                    <option data-uri="{{$item['id']}}" value="{{$item['id']}}">{{$item['title']}}</option>
                                @endif
                            @endforeach
                        </select>
                        </div>

                        {{-- <div class="form-group col-md-6">
                        <label for="status">@lang('permissions_menu.text_status')</label>
                        <select required name="status" type="status" class="form-control" id="status" placeholder="">
                            <option value="">- Pilih -</option>
                            <option value="1">Aktif</option>
                            <option value="0">Non-Aktif</option>
                        </select>
                        </div> --}}

                    </div>
                </div>
                <div class="col-md-4">
                    <label class="d-block">Have Action ?</label>

                    <div class="form-group">
                        @foreach ($actions as $item)
                            <div class="custom-control custom-checkbox">
                                <input {{in_array($item->supfix, $act ?? []) ? "checked":""}} class="custom-control-input" name="actions[]" type="checkbox" id="input_{{$item->supfix}}" value="{{$item->supfix}}">
                                <label for="input_{{$item->supfix}}" class="custom-control-label">{{$item->name}}</label>
                            </div>
                        @endforeach
                    </div>

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
  });

  $("#route_name").change(function() {
    let url = $(this).find(':selected').data('uri');
    $('#url').val('/'+url);
  })
</script>
@endpush

@push('styles')
<!-- summernote -->
<link rel="stylesheet" href="/theme/plugins/summernote/summernote-bs4.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/css/bootstrap-select.min.css">

@endpush
