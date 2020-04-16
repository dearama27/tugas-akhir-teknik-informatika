@extends('adminLTE.layout')
@push('page-name')
{{$pageName}}
@endpush

@push('title')
@lang('user.text_title')
@endpush

@section('content')
<div class="row">
  <div class="col-12">
    <div class="card card-primary card-outline">
      <div class="card-header">

        @if (Role::isAllow("create"))
            <div class="btn-group">
            <a href="{{route('users.create')}}" class="btn btn-primary btn-sm float-left">
                <i class="fa fa-plus"></i> @lang('user.create')
            </a>
            </div>
        @endif
        <!-- SEARCH FORM -->
        <form class="form-inline ml-3 float-right" action="{{route('users.index')}}">
          <div class="input-group input-group-sm">
            <input style="background-color: #f2f4f6; border: none" class="form-control form-control-navbar"
              type="search" placeholder="Search" aria-label="Search" name="search">
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
                    <th>@lang('user.text_fullname')</th>
                    {{-- <th>@lang('user.text_description')</th> --}}
                    <th style="width: 200px">@lang('user.text_email')</th>
                    <th style="width: 200px">Role</th>
                    <th style="width: 100px">@lang('user.text_status')</th>
                    <th style="width: 160px">Action</th>
                  </tr>
                </thead>
                @if (!count($users))
                <tr>
                  <td colspan="7" class="text-center">@lang('global.text_not_found')</td>
                </tr>
                @endif
                <tbody>
                  @php
                  $no = 1;
                  @endphp
                  @foreach ($users as $user)

                  <tr>
                    <td>{{ $no }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->role->name }}</td>
                    <td>
                      @if(!$user->deleted_at)
                        <span class="badge bg-success">Aktif</span>
                      @else
                        <span class="badge bg-danger">Deleted</span>
                      @endif
                    </td>
                    <td>
                        <a href="{{route('users.edit', $user->uuid)}}" class="btn btn-primary btn-xs text-white"><i class="fas fa-pencil-alt"></i> Edit</a>
                        @if($user->deleted_at)
                        <button class="btn btn-success btn-xs text-white restore" data-id="{{$user->uuid}}"><i class="fas fa-sync-alt"></i> Restore</button>
                        @else
                          @if (Role::isAllow("delete"))
                          <button class="btn btn-danger btn-xs text-white delete" data-id="{{$user->uuid}}"><i class="fas fa-trash"></i> Delete</button>
                          @endif
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
      <div class="card-footer clearfix">
        <div class="float-left">
            Total Result : {{$users->count()}}
        </div>
        <div class="float-right">
            {{$users->links()}}
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
            axios.delete(`{{route('users.index')}}/${id}`).then(res => {
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
