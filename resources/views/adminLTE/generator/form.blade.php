@extends('adminLTE.layout')
@push('page-name')
Form App Scaffolding
@endpush

@push('title')
Form App Scaffolding
@endpush

@section('content')

<div class="row">
  <div class="col-md-12">
    <div class="card card-primary card-outline">
      <!-- form start -->
      <form role="form" method="POST" action="{{route('generator.store')}}">
        @csrf

        <input type="hidden" name="id" value="{{isset($data->id) ?? ''}}" />

        <div class="card-body">
          <div class="row">

            <div class="form-group col-md-6">
              <label for="name">Name</label>
              <input autocomplete="off" name="name" id="name" class="form-control"
                value="{{isset($data) ? $data->name:''}}">
              <small>Recomended: <i>CamelCase</i></small>
            </div>

            <div class="form-group col-md-6">
              <label for="name">Controller Name</label>
              <input readonly name="" type="text" class="form-control" id="controller_name"
                value="{{isset($data) ? $data->controller_name:''}}">
            </div>

            <div class="form-group col-md-6">
              <label for="name">Model Name</label>
              <input readonly name="" type="text" class="form-control" id="model_name"
                value="{{isset($data) ? $data->model_name:''}}">
            </div>

            <div class="form-group col-md-6">
              <label for="name">View Directory</label>
              <input readonly name="" type="text" class="form-control" id="view_directory"
                value="{{isset($data) ? $data->name:''}}">
            </div>

            <div class="form-group col-md-6">
              <label for="name">Route Prefix</label>
              <input readonly name="" type="text" class="form-control" id="route_prefix"
                value="{{isset($data) ? $data->name:''}}">
            </div>

          </div>
          <button type="button" id="add-row" class="btn btn-primary btn-sm mt-2 mb-2"><i class="fas fa-plus"></i>
            Add</button>
          <table class="table table-bordered" id="table-column">
            <thead>
              <tr>
                <th width="150px">Column Name</th>
                <th width="100px">Type</th>
                <th width="100px">Form As</th>
                <th width="150px">Relation</th>
                <th width="50px"></th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td scope="row">
                  <input type="text" class="form-control" name="columns[][name]">
                </td>
                <td>
                  <select data-size=5 data-live-search=true name="columns[][type]" id="">
                    <option value="">None</option>
                    <option value="foreignId">foreignId</option>
                    <option value="unsignedBigInteger">unsignedBigInteger</option>
                    <option value="bigIncrements">bigIncrements</option>
                    <option value="bigInteger">bigInteger</option>
                    <option value="binary">binary</option>
                    <option value="boolean">boolean</option>
                    <option value="char">char</option>
                    <option value="date">date</option>
                    <option value="dateTime">dateTime</option>
                    <option value="dateTimeTz">dateTimeTz</option>
                    <option value="decimal">decimal</option>
                    <option value="double">double</option>
                    <option value="enum">enum</option>
                    <option value="float">float</option>
                    <option value="geometry">geometry</option>
                    <option value="geometryCollection">geometryCollection</option>
                    <option value="increments">increments</option>
                    <option value="integer">integer</option>
                    <option value="ipAddress">ipAddress</option>
                    <option value="json">json</option>
                    <option value="jsonb">jsonb</option>
                    <option value="lineString">lineString</option>
                    <option value="longText">longText</option>
                    <option value="macAddress">macAddress</option>
                    <option value="mediumIncrements">mediumIncrements</option>
                    <option value="mediumInteger">mediumInteger</option>
                    <option value="mediumText">mediumText</option>
                    <option value="morphs">morphs</option>
                    <option value="uuidMorphs">uuidMorphs</option>
                    <option value="multiLineString">multiLineString</option>
                    <option value="multiPoint">multiPoint</option>
                    <option value="multiPolygon">multiPolygon</option>
                    <option value="nullableMorphs">nullableMorphs</option>
                    <option value="nullableUuidMorphs">nullableUuidMorphs</option>
                    <option value="nullableTimestamps">nullableTimestamps</option>
                    <option value="point">point</option>
                    <option value="polygon">polygon</option>
                    <option value="rememberToken">rememberToken</option>
                    <option value="set">set</option>
                    <option value="smallIncrements">smallIncrements</option>
                    <option value="smallInteger">smallInteger</option>
                    <option value="softDeletes">softDeletes</option>
                    <option value="softDeletesTz">softDeletesTz</option>
                    <option value="string">string</option>
                    <option value="text">text</option>
                    <option value="time">time</option>
                    <option value="timeTz">timeTz</option>
                    <option value="timestamp">timestamp</option>
                    <option value="timestampTz">timestampTz</option>
                    <option value="timestamps">timestamps</option>
                    <option value="timestampsTz">timestampsTz</option>
                    <option value="tinyIncrements">tinyIncrements</option>
                    <option value="tinyInteger">tinyInteger</option>
                    <option value="unsignedBigInteger">unsignedBigInteger</option>
                    <option value="unsignedDecimal">unsignedDecimal</option>
                    <option value="unsignedInteger">unsignedInteger</option>
                    <option value="unsignedMediumInteger">unsignedMediumInteger</option>
                    <option value="unsignedSmallInteger">unsignedSmallInteger</option>
                    <option value="unsignedTinyInteger">unsignedTinyInteger</option>
                    <option value="uuid">uuid</option>
                    <option value="year">year</option>
                  </select>
                </td>
                <td>
                  <select name="columns[][form_as]" id="">
                    <option value="">None</option>
                    <option value="upload">Upload</option>
                  </select>
                </td>
                <td>
                  <input placeholder="ClassName" type="text" class="form-control" name="columns[][relation]">
                </td>
                <td>
                  <button type="button" class="btn btn-danger btn-sm del-row"><i class="fas fa-trash"></i></button>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
        <!-- /.card-body -->

        <div class="card-footer">
          <div class="btn-group">
            <a class="btn btn-secondary" href="{{ route('generator.index') }}"><i class="fa fa-arrow-left"></i>
              @lang('general.back')</a>
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

  let html = `
      <tr>
        <td scope="row">
          <input type="text" class="form-control" name="columns[][name]">
        </td>
        <td>
          <select data-size=5 data-live-search=true name="columns[][type]" id="">
            <option value="">None</option>
            <option value="foreignId">foreignId</option>
            <option value="unsignedBigInteger">unsignedBigInteger</option>
            <option value="bigIncrements">bigIncrements</option>
            <option value="bigInteger">bigInteger</option>
            <option value="binary">binary</option>
            <option value="boolean">boolean</option>
            <option value="char">char</option>
            <option value="date">date</option>
            <option value="dateTime">dateTime</option>
            <option value="dateTimeTz">dateTimeTz</option>
            <option value="decimal">decimal</option>
            <option value="double">double</option>
            <option value="enum">enum</option>
            <option value="float">float</option>
            <option value="geometry">geometry</option>
            <option value="geometryCollection">geometryCollection</option>
            <option value="increments">increments</option>
            <option value="integer">integer</option>
            <option value="ipAddress">ipAddress</option>
            <option value="json">json</option>
            <option value="jsonb">jsonb</option>
            <option value="lineString">lineString</option>
            <option value="longText">longText</option>
            <option value="macAddress">macAddress</option>
            <option value="mediumIncrements">mediumIncrements</option>
            <option value="mediumInteger">mediumInteger</option>
            <option value="mediumText">mediumText</option>
            <option value="morphs">morphs</option>
            <option value="uuidMorphs">uuidMorphs</option>
            <option value="multiLineString">multiLineString</option>
            <option value="multiPoint">multiPoint</option>
            <option value="multiPolygon">multiPolygon</option>
            <option value="nullableMorphs">nullableMorphs</option>
            <option value="nullableUuidMorphs">nullableUuidMorphs</option>
            <option value="nullableTimestamps">nullableTimestamps</option>
            <option value="point">point</option>
            <option value="polygon">polygon</option>
            <option value="rememberToken">rememberToken</option>
            <option value="set">set</option>
            <option value="smallIncrements">smallIncrements</option>
            <option value="smallInteger">smallInteger</option>
            <option value="softDeletes">softDeletes</option>
            <option value="softDeletesTz">softDeletesTz</option>
            <option value="string">string</option>
            <option value="text">text</option>
            <option value="time">time</option>
            <option value="timeTz">timeTz</option>
            <option value="timestamp">timestamp</option>
            <option value="timestampTz">timestampTz</option>
            <option value="timestamps">timestamps</option>
            <option value="timestampsTz">timestampsTz</option>
            <option value="tinyIncrements">tinyIncrements</option>
            <option value="tinyInteger">tinyInteger</option>
            <option value="unsignedBigInteger">unsignedBigInteger</option>
            <option value="unsignedDecimal">unsignedDecimal</option>
            <option value="unsignedInteger">unsignedInteger</option>
            <option value="unsignedMediumInteger">unsignedMediumInteger</option>
            <option value="unsignedSmallInteger">unsignedSmallInteger</option>
            <option value="unsignedTinyInteger">unsignedTinyInteger</option>
            <option value="uuid">uuid</option>
            <option value="year">year</option>
          </select>
        </td>
        <td>
          <select name="columns[][form_as]" id="">
            <option value="">None</option>
            <option value="upload">Upload</option>
          </select>
        </td>
        <td>
          <input placeholder="ClassName" type="text" class="form-control" name="columns[][relation]">
        </td>
        <td>
          <button type="button" class="btn btn-danger btn-sm del-row"><i class="fas fa-trash"></i></button>
        </td>
      </tr>
  `;
  $('#add-row').click(function() {
    let table = $('#table-column tbody');

    table.append(html);
    $('select').selectpicker();
  })
  $(document).on('click', '.del-row', function() {
    let length =  $('#table-column tbody').find('tr').length;

    if(length > 1) {
      let row    = $(this).closest('tr');
      row.remove();
    }
  })

  function camelize(str) {
    return str.replace(/(?:^\w|[A-Z]|\b\w)/g, function(word, index) {
      return index === 0 ? word.toUpperCase() : word.toUpperCase();
    }).replace(/\s+/g, '');
  }

  $('#name').keyup(function() {
    let name       = $(this).val();
    let controller = camelize(name)+"Controller";
    let model      = camelize(name);
    let route      = name.toLowerCase().replace(' ', '_');

    $('#controller_name').val(controller);
    $('#model_name').val(model);
    $('#view_directory').val(route);
    $('#route_prefix').val(route);
  });
</script>
@endpush

@push('styles')
<!-- summernote -->
<link rel="stylesheet" href="/theme/plugins/summernote/summernote-bs4.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/css/bootstrap-select.min.css">

@endpush