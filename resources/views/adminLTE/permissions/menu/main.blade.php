@extends('adminLTE.layout')
@push('page-name')
@lang('permissions_menu.text_title')
@endpush
@push('title')
@lang('permissions_menu.text_title')
@endpush

@section('content')
<div class="row">
  <div class="col-12">
    <div class="card card-primary card-outline">
      <div class="card-header">

        <div class="btn-group">
          <a href="{{route('menu.create')}}" class="btn btn-primary btn-sm float-left">
            <i class="fa fa-plus"></i> @lang('permissions_menu.text_form_add')
          </a>
          <button type="button" class="btn btn-default btn-sm float-left" id="sortable">
            <div id="label-sortable">
              <i class="fa fa-sort"></i> Sortable Menu
            </div>
            <div id="label-listed" class="d-none">
              <i class="fa fa-list"></i> List Menu
            </div>
          </button>
        </div>

        <!-- SEARCH FORM -->
        <form class="form-inline ml-3 float-right">
          <div class="input-group input-group-sm">
            <input style="background-color: #f2f4f6; border: none" class="form-control form-control-navbar"
              type="search" placeholder="Search" aria-label="Search">
            <div class="input-group-append">
              <button class="btn btn-navbar" style="background-color: #f2f4f6" type="submit">
                <i class="fas fa-search"></i>
              </button>
            </div>
          </div>
        </form>

        <div class="clearfix"></div>
      </div>
      <!-- /.card-header -->
      <div class="card-body p-0" style="display: block" id="tablemenu">
        <table class="table table-striped">
          <thead>
            <tr>
              <th style="width: 10px">#</th>
              <th style="width: 200px">@lang('permissions_menu.text_name')</th>
              <th style="width: 200px">@lang('permissions_menu.text_route_name')</th>
              <th style="width: 200px">@lang('permissions_menu.text_link')</th>
              <th style="width: 50px">@lang('permissions_menu.text_icon')</th>
              {{-- <th style="width: 200px">@lang('permissions_menu.text_last_update')</th> --}}
              <th style="width: 100px">@lang('permissions_menu.text_status')</th>
              <th style="width: 160px">Action</th>
            </tr>
          </thead>
          @if (!count($menus))
          <tr>
            <td colspan="7" class="text-center">@lang('general.not_found')</td>
          </tr>
          @endif
          <tbody>
            @php
            $no = 1;
            @endphp
            @foreach ($menus as $menu)

            <tr title="Last update: {{ $menu->updated_at }}">
              <td>{{ $no }}</td>
              <td>{{$menu->title}}</td>
              <td>{{$menu->route_name}}</td>
              <td>{{$menu->url}}</td>
              <td><i class="{{ $menu->icon }}"></i></td>
              {{-- <td>{{ $menu->updated_at }}</td> --}}
              <td>
                @if(!$menu->deleted_at)
                <span class="badge bg-success">Aktif</span>
                @else
                <span class="badge bg-danger">Deleted</span>
                @endif
              </td>
              <td>
                <a href="{{$base}}/form/{{$menu->uuid}}" class="btn btn-primary btn-xs text-white"><i
                    class="fas fa-search"></i> Detail</a>
                @if($menu->deleted_at)
                <button class="btn btn-success btn-xs text-white restore" data-id="{{$menu->uuid}}"><i
                    class="fas fa-sync-alt"></i> Restore</button>
                @else
                <button class="btn btn-danger btn-xs text-white delete" data-id="{{$menu->uuid}}"><i
                    class="fas fa-trash"></i> Delete</button>
                @endif
              </td>
            </tr>
            @php
            $no++;
            @endphp
            @endforeach

          </tbody>
        </table>
      </div>
      <!-- /.card-body -->
      <div class="card-body" style="display: none" id="treemenu">
        <div class="dd">
          <ol class="dd-list">
            {!! $recursive !!}
            {{-- <li class="dd-item" data-id="1">
              <div class="dd-handle">Item 1</div>
            </li>
            <li class="dd-item" data-id="2">
              <div class="dd-handle">Item 2</div>
            </li>
            <li class="dd-item" data-id="3">
              <div class="dd-handle">Item 3</div>
              <ol class="dd-list">
                <li class="dd-item" data-id="4">
                  <div class="dd-handle">Item 4</div>
                </li>
                <li class="dd-item" data-id="5">
                  <div class="dd-handle">Item 5</div>
                </li>
              </ol>
            </li> --}}
          </ol>
        </div>

        <div class="mt-3">
          <button type="button" id="save-nestable-menu" class="btn btn-primary btn-sm"><i class="fas fa-save"></i> Save</button>
        </div>
      </div>
      <div class="card-footer">
        Total {{ $menus->count() }}
      </div>
    </div>
  </div>
</div>

{{-- <div id="laradata"></div> --}}
@endsection


@push('styles')
<!-- Toastr -->
<link rel="stylesheet" href="/theme/plugins/toastr/toastr.min.css">
<link rel="stylesheet" href="/theme/plugins/jquery.nestable.css" />

@endpush

@push('scripts')
<!-- Toastr -->
<script src="/theme/plugins/toastr/toastr.min.js"></script>
<script src="/theme/plugins/jquery.nestable.js"></script>
@if (session('status'))
<script>
  toastr.{{session('status')}}('{{session('message')}}')
</script>
@endif

<script>
  $(".delete").click(function() {
    let id = $(this).data('id');

      Swal.fire({
          title: '<strong>Anda Yakin?</strong>',
          type: 'question',
          html: 'Hapus data ini.',
          showCloseButton: true,
          showCancelButton: true,
          focusConfirm: false,
          confirmButtonText:
            '<i class="fa fa-check"></i> Yakin',
          confirmButtonAriaLabel: 'Thumbs up, great!',
          cancelButtonText:
            '<i class="fa fa-times"></i> Batal',
          cancelButtonAriaLabel: 'Thumbs down'
        }).then(btn => {
          if(btn.value) {
            axios.delete(`{{$base}}/${id}`).then(res => {
              if(res.data.status) {
                toastr.success(`${res.data.message}`)
                setTimeout(() => {
                  location.reload()
                }, 2000);
              }
            })
          }
        })
    });
    $("#sortable").click(function() {
      $("#treemenu").slideToggle()
      $("#tablemenu").slideToggle()
      $('#label-sortable').toggleClass('d-none');
      $('#label-listed').toggleClass('d-none');
      $(this).focus();
    })
    $('.dd').nestable({ /* config options */ });

    function format(data, parent_id=0) {
    var json = [];
    data.forEach((i, dex) => {
        let item = {}
        item.order = dex+1;
        if(i.children != undefined) {
            item.id = i.id
            item.parent_id = parent_id
            json.push(item)
            let de = format(i.children, i.id)
//             console.log(de)
            json = json.concat(de)
        } else {
            item.id = i.id
            item.parent_id = parent_id
            json.push(item)
        }
    })
    return json
    }
    $('#save-nestable-menu').click(function() {
      let data = format($('.dd').nestable('serialize'));
      axios.patch(`{{route('menu.patch')}}`, {data: data}).then(res => {
        console.log(res.data);
        if(res.data.status == 'success') {
          toastr.success(`${res.data.message}<br/><small>please wait..</small>`)
          setTimeout(() => {
            location.reload()
          }, 1500);
        } else {
          toastr.error(`${res.data.message}`)
        }
      })
    })
</script>
@endpush