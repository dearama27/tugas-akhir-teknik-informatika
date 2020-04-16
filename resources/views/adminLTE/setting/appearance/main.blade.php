@extends('adminLTE.setting.layout')


@section('setting-title')
@lang('setting.txt_appearance')
@endsection

@section('setting-body')
<form class="">
    <div class="form-group row">
        <label for="theme" class="col-md-3">Theme</label>
        <select type="text" name="theme" id="theme" class="form-control col-md-9" placeholder="">
            <option>- @lang("global.text_select_chose") -</option>
            @foreach ($themes as $item)
                <option value="{{$item}}">{{$item}}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group row">
        <label for="theme" class="col-md-3">Theme Config</label>
        <textarea class="form-control col-md-9" rows="5"></textarea>
    </div>
</form>
@endsection

@section('setting-footer')
<div class="btn-group">
    {{-- <a class="btn btn-secondary" href="{{ $base }}"><i class="fa fa-arrow-left"></i> Kembali</a> --}}
    <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
</div>
@endsection
@push('styles')
<!-- Bootstrap Select -->
<link rel="stylesheet" href="/theme/plugins/bootstrap-select-1.13.9/dist/css/bootstrap-select.min.css">

@endpush
@push('scripts')

<!-- Bootstrap Select -->
<script src="/theme/plugins/bootstrap-select-1.13.9/dist/js/bootstrap-select.min.js"></script>

<script>
    $('select').selectpicker();
</script>

@endpush