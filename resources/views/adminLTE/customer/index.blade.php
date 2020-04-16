@extends('adminLTE.layout')

@push('title')
    Customer
@endpush
@push('page-name')
Customer
@endpush

@section('content')
<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header">

        @if (Role::isAllow("insert"))
            <div class="btn-group">
            <a href="{{route($resource.'.create')}}" class="btn btn-primary btn-sm float-left">
                <i class="fa fa-plus"></i> Create
            </a>
            </div>
        @endif
        <!-- SEARCH FORM -->
        <form class="form-inline ml-3 float-right" action="{{route($resource.'.index')}}">
          <div class="input-group input-group-sm">
            <input style="background-color: #f2f4f6; border: none" class="form-control form-control-navbar"
              type="search" placeholder="Search" aria-label="Search" name="search" value="{{Request::get('search')}}">
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
          <div class="table-scroll">
              <table class="table table-striped" style="width: 1200px">
                <thead>
                  <tr>
                    <th style="width: 10px">#</th>
										<th style="width: 300px">Data Customer</th>
										{{-- <th>Address</th>
										<th>Customer Code</th> --}}
										<th>Distribution Center</th>
										<th>Mobile Phone</th>
										<th>Koordinat</th>
										<th>Join At</th>
                    <th style="width: 160px">Action</th>
                  </tr>
                </thead>
                @if (!count($results))
                <tr>
                  <td colspan="10" class="text-center">@lang('general.not_found')</td>
                </tr>
                @endif
                <tbody>
                  @php
                  //$no = 1;
                  $no = ($results->currentPage() - 1) * $results->perPage() + 1;
                  @endphp
                  @foreach ($results as $item)

                  <tr>
                    <td style="vertical-align: middle">{{ $no }}</td>
										<td style="vertical-align: middle">
                      {{-- <small>{{ $item->customer_code }}</small><br/> --}}
                      {{ $item->name }}<br/>
                      <small>{{ $item->address }}</small><br/>
                    </td>
										{{-- <td style="vertical-align: middle">{{ $item->address }}</td> --}}
										<td style="vertical-align: middle">{{ $item->dc->name }}</td>
										<td style="vertical-align: middle">{{ $item->mobile_phone }}</td>
										<td style="vertical-align: middle" title="{{ $item->lat }},{{ $item->lng }}">
                      <button class="btn btn-default copy" data-copy="{{ $item->lat }},{{ $item->lng }}" type="button">Copy</button>
                      <button class="btn btn-primary open-gmaps" data-coordinate="{{ $item->lat }},{{ $item->lng }}"  type="button">Open</button>
                    </td>

										<td style="vertical-align: middle">{{ $item->join_at }}</td>

                    <td style="vertical-align: middle">
                        <a href="{{route($resource.'.edit', $item->id)}}" class="btn btn-primary btn-xs text-white"><i class="fas fa-pencil-alt"></i> Edit</a>
                        @if($item->deleted_at)
                        <button class="btn btn-success btn-xs text-white restore" data-id="{{$item->id}}"><i class="fas fa-sync-alt"></i> Restore</button>
                        @else
                          @if (Role::isAllow("delete"))
                          <button class="btn btn-danger btn-xs text-white delete" data-id="{{$item->id}}"><i class="fas fa-trash"></i> Delete</button>
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
            Total Result : {{$results->total()}}
        </div>
        <div class="float-right">
            {{$results->links()}}
        </div>
        <div class="clearfix"></div>
      </div>
      <!-- /.card-footer -->
    </div>
  </div>
</div>
@endsection



@push('styles')
<!-- Toastr -->
<link rel="stylesheet" href="{{url('')}}/theme/plugins/toastr/toastr.min.css">
@endpush

@push('scripts')
<!-- Toastr -->
<script src="{{url('')}}/theme/plugins/toastr/toastr.min.js"></script>
@if (session('status'))
<script>
  toastr.{{session('status')}}('{{session('message')}}')
</script>
@endif

<script>
  $(".delete").click(function() {
    let id = $(this).data('id');

      Swal.fire({
          title: '<strong>Are you sure?</strong>',
          type: 'question',
          html: 'Delete this data from database.',
          showCloseButton: true,
          showCancelButton: true,
          focusConfirm: false,
          confirmButtonText:
            '<i class="fa fa-check"></i> Yes',
          confirmButtonAriaLabel: 'Thumbs up, great!',
          cancelButtonText:
            '<i class="fa fa-times"></i> No',
          cancelButtonAriaLabel: 'Thumbs down'
        }).then(btn => {
          if(btn.value) {
            axios.delete(`{{route($resource.'.index')}}/${id}`).then(res => {
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

    $('.copy').click(function() {
    let data = $(this).data('copy');
    copyTextToClipboard(data);
    toastr.success('Data koordinat di copy Ke clipboard<br/>Ctrl+v untuk paste');
})

$('.open-gmaps').click(function() {

  let url = 'https://www.google.com/maps/place/';
  let data = $(this).data('coordinate');

  window.open(`${url}${data}`, '_blank')
})
</script>
@endpush
