@extends('adminLTE.layout')

@push('page-name')
Files
@endpush

@push('title')
Files
@endpush

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card card-primary card-outline">
            <div class="card-header">

                @if (Role::isAllow("insert"))
                <div class="btn-group">
                    <button class="btn btn-primary btn-sm float-left" data-toggle="modal" data-target="#upload-modal">
                        <i class="fa fa-upload"></i> Upload
                    </button>
                    <button class="btn btn-primary btn-sm float-left" data-toggle="modal" data-target="#create-folder">
                        <i class="fa fa-plus"></i> Create Folder
                    </button>
                </div>
                @endif

                <!-- SEARCH FORM -->
                <form class="form-inline ml-3 float-right" action="{{route($resource.'.index')}}">
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
                                <th>Filename</th>
                                <th style="width: 100px">Size</th>
                                <th style="width: 80px">Status</th>
                                <th style="width: 160px"></th>
                            </tr>
                        </thead>
                        @if (!count($results))
                        <tr>
                            <td colspan="5" class="text-center">@lang('general.not_found')</td>
                        </tr>
                        @endif
                        <tbody>
                            @php
                            $no = 1;
                            @endphp
                            @foreach ($results as $item)

                            <tr>
                                <td>{{ $no }}</td>
                                <td>{{ $item->original_name }}</td>
                                <td>{{ round($item->size/1024, 2) }}Kb</td>
                                <td>
                                    @if(!$item->deleted_at)
                                    <span class="badge bg-success">Aktif</span>
                                    @else
                                    <span class="badge bg-danger">Deleted</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{route($resource.'.edit', $item->id)}}"
                                        class="btn btn-primary btn-xs text-white"><i class="fas fa-pencil-alt"></i>
                                        Edit</a>
                                    @if($item->deleted_at)
                                    <button class="btn btn-success btn-xs text-white restore" data-id="{{$item->id}}"><i
                                            class="fas fa-sync-alt"></i> Restore</button>
                                    @else
                                    @if (Role::isAllow("delete"))
                                    <button class="btn btn-danger btn-xs text-white delete" data-id="{{$item->id}}"><i
                                            class="fas fa-trash"></i> Delete</button>
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
                    Total Result : {{$results->count()}}
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

<!-- Modal -->
<div class="modal fade" id="upload-modal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Upload Files</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="upload-files" class="dropzone"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="create-folder" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Create Folder</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
            </div>
            <div class="modal-body">
                <form action="">
                    <div class="form-group">
                        <label for="name">Name <span class="text-danger">*</span></label>
                        <input autocomplete="off" type="text" class="form-control" name="name" id="name">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">@lang('general.back')</button>
                <button type="button" class="btn btn-primary">@lang('general.save')</button>
            </div>
        </div>
    </div>
</div>
<template hidden>
    <div id="template" class="file-row">
        <!-- This is used as the file preview template -->
        <div style="width: 80px; float: left; max-height: 100px; overflow:hidden">
            <span class="preview"><img style="width: 100%" data-dz-thumbnail /></span>
        </div>
        <div style="width:220px; float: left">
            <div class="pl-3">
                <p class="name" data-dz-name></p>
                <strong class="error text-danger" data-dz-errormessage></strong>
                <p class="size" data-dz-size></p>
                <div class="btn-group dz-btn-group">
                    {{-- <button data-dz-remove class="btn btn-warning btn-sm cancel">
                        <i class="glyphicon glyphicon-ban-circle"></i>
                        <span>Cancel</span>
                    </button> --}}
                    <button data-dz-remove class="btn btn-danger btn-sm delete">
                        <i class="glyphicon glyphicon-trash"></i>
                        <span><i class="fa fa-trash"></i></span>
                    </button>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100"
            aria-valuenow="0">
            <div class="progress-bar progress-bar-success" style="width:0%;" data-dz-uploadprogress></div>
        </div>
    </div>
</template>
@endsection



@push('styles')
<!-- Toastr -->
<link rel="stylesheet" href="/theme/plugins/toastr/toastr.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/basic.min.css">
{{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/overlayscrollbars/1.10.3/css/OverlayScrollbars.min.css" integrity="sha256-pkJRL+LZNw26HU21yhQ7dq3WvhAWdOD1tildYMve+kI=" crossorigin="anonymous" /> --}}
<style>
    #preview-container {
        position: fixed;
        z-index: 10000;
        bottom: 10px;
        right: 10px;
        width: 330px;
        overflow-y: scroll;
        max-height: 500px;
    }
    .dz-btn-group {
        position: absolute;
        top: 5px;
        right: 5px;
    }
    .file-row {
        margin-bottom: 10px;
        background: white;
        border: 1px solid #EEE;
        border-radius: 10px;
        overflow: hidden;
    }
    .progress {
        height: 5px;
    }
</style>
@endpush

@push('scripts')
<!-- Toastr -->
<script src="/theme/plugins/toastr/toastr.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.js"></script>
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/overlayscrollbars/1.10.3/js/jquery.overlayScrollbars.min.js" integrity="sha256-tuiqRu0+T8St8iILGYhLhgMs2iCLPG0HVJCIPm4uduE=" crossorigin="anonymous"></script> --}}
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
    $('body').append('<div id="preview-container"></div>');

    Dropzone.autoDiscover = false;

    var myDropzone = new Dropzone("body", {
        url: '{{route("files.store")}}',
        previewsContainer: '#preview-container',
        previewTemplate: $('template').html()
    });

    myDropzone.on('sending', (file, xhr, formData) => {
        console.log(file)
        formData.append("filename", file.name);  
        formData.append("filesize", file.size);  
        formData.append("_token", "{{csrf_token()}}");  
        $("#preview-container").overlayScrollbars({
                  sizeAutoCapable: true,
                  scrollbars: {
                    autoHide: 'l',
                    clickScrolling: true
                  }
                });
    })
</script>
@endpush