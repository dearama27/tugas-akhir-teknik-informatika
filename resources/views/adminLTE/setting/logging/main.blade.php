@extends('adminLTE.setting.layout')


@section('setting-title')
    Security
@endsection

@section('setting-body')
    <table class="table table-stripped">
        <thead>
            <th>No</th>
            <th>Log</th>
        </thead>
        <tbody>
            @foreach ($log as $key => $item)
                @php
                    $item = str_replace([
                        "{",
                        "}"
                    ],[
                        "{",
                        "}</code>"
                    ],$item);

                    $item = str_replace([
                        "local.INFO",
                        "local.ERROR"
                    ],[
                        "<span class='badge badge-info'>Info</span><code> ",
                        "<span class='badge badge-danger'>Error</span><code> ",
                    ],$item);

                    // $item = preg_replace('/\[(.*)\]/', "<code>$1</code>", $item);
                @endphp
                @if ($item != '')
                    <tr>
                        <td>{{$key+1}}</td>
                        <td>{!! $item !!}</td>
                    </tr>
                @endif
            @endforeach
        </tbody>
    </table>
@endsection

@section('setting-footer')
<div class="btn-group">
    <button type="button" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> Clear Log</button>
</div>
@endsection


@push('styles')
<!-- DataTables -->
<link rel="stylesheet" href="/theme/plugins/datatables-bs4/css/dataTables.bootstrap4.css">
@endpush

@push('scripts')
<!-- DataTables -->
<script src="/theme/plugins/datatables/jquery.dataTables.js"></script>
<script src="/theme/plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
<script>
    $('table').DataTable({
      "paging": true,
      "responsive": true,
      "lengthChange": false,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false,
    });

</script>
@endpush
