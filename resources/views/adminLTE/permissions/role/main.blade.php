@extends('adminLTE.layout')
@push('page-name')
@lang('permissions_role.text_title')
@endpush
@push('title')
@lang('permissions_role.text_title')
@endpush

@section('content')
<div class="row">
  <div class="col-12">
    <div class="card card-primary card-outline">
      <div class="card-header">

        <div class="btn-group">
          <a href="{{$base}}/form" class="btn btn-primary btn-sm float-left">
            <i class="fa fa-plus"></i> @lang('permissions_role.text_form_add')
          </a>
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
      <div class="card-body p-0">
        <div class="table-responsive">
          <table class="table table-striped">
            <thead>
              <tr>
                <th style="width: 10px">#</th>
                <th>@lang('permissions_role.text_name')</th>
                {{-- <th>@lang('permissions_role.text_description')</th> --}}
                <th style="width: 200px">@lang('permissions_role.text_description')</th>
                <th style="width: 150px">@lang('permissions_role.text_status')</th>
                <th style="width: 200px">Action</th>
              </tr>
            </thead>
            @if (!count($roles))
            <tr>
              <td colspan="7" class="text-center">@lang('general.not_found')</td>
            </tr>
            @endif
            <tbody>
              @php
              $no = 1;
              @endphp
              @foreach ($roles as $role)

              <tr>
                <td>{{ $no }}</td>
                <td>{{$role->name}}</td>
                {{-- <td>
                    {{ strip_tags( html_entity_decode($role->description) ) }}
                </td> --}}
                <td>
                  {!! $role->description !!}
                </td>
                <td>
                  @if(!$role->deleted_at)
                  <span class="badge bg-success">Aktif</span>
                  @else
                  <span class="badge bg-danger">Deleted</span>
                  @endif
                </td>
                <td>
                  <a href="{{route('role.detail', $role->uuid)}}" class="btn btn-primary btn-xs text-white"><i
                      class="fas fa-lock"></i> Permission</a>
                  <a href="{{route('role.edit', $role->uuid)}}" class="btn btn-success btn-xs text-white"><i
                      class="fas fa-pencil-alt"></i></a>
                  @if($role->deleted_at)
                  <button class="btn btn-success btn-xs text-white restore" data-id="{{$role->uuid}}"><i
                      class="fas fa-sync-alt"></i> Restore</button>
                  @else
                  <button class="btn btn-danger btn-xs text-white delete" data-id="{{$role->uuid}}"><i
                      class="fas fa-trash"></i></button>
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
      </div>
      <!-- /.card-body -->
      <div class="card-footer clearfix" @if(!$roles->total()) hidden @endif>
        <div class="float-left">
          Total Result : {{$roles->total()}}
        </div>
        <div class="float-right">
          {{$roles->links()}}
        </div>
        <div class="clearfix"></div>
      </div>
      <!-- /.card-footer -->
    </div>
  </div>
</div>

{{-- <div id="laradata"></div> --}}
@endsection


@push('styles')
<!-- Toastr -->
<link rel="stylesheet" href="/theme/plugins/toastr/toastr.min.css">
@endpush

@push('scripts')
<!-- Toastr -->
<script src="/theme/plugins/toastr/toastr.min.js"></script>
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
</script>
@endpush