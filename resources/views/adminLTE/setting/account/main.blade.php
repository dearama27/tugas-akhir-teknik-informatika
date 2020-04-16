@extends('adminLTE.setting.layout')


@section('setting-title')
Account
@endsection

@section('setting-body')
@php
$user = Auth::user();
@endphp
<div class="avatar-wrapper">
    <img class="profile-pic" src="{{is_null($user->get_avatar) ? '':$user->get_avatar->url}}" />
    <div class="upload-button">
        <i class="fa fa-arrow-circle-up" aria-hidden="true"></i>
    </div>
    <input class="file-upload" type="file" accept="image/*" />
</div>

<div class="row">
    <div class="form-group col-md-6">
        <label for="name">@lang('user.text_fullname')</label>
        <input autocomplete="off" name="name" type="name" class="form-control" id="name" placeholder=""
            value="{{ $user->name }}">
    </div>

    <div class="form-group col-md-6">
        <label for="phone">@lang('user.text_phone')</label>
        <input autocomplete="off" name="phone" type="phone" class="form-control" id="phone" placeholder=""
            value="{{$user->phone}}">
    </div>

    <div class="form-group col-md-6">
        <label for="email">@lang('user.text_email')</label>
        <input autocomplete="off" name="email" type="email" class="form-control" id="email" placeholder=""
            value="{{$user->email}}">
    </div>

    <div class="form-group col-md-6">
        <label for="password">@lang('user.text_password')</label>
        <input autocomplete="off" name="password" type="password" class="form-control" id="password"
            placeholder="********">
    </div>

    <div class="form-group col-12">
        <div class="row">
            <div class="col-md-4">
                <button class="btn btn-primary btn-block" type="button"><i class="fab fa-facebook mr-2"></i>Connect to
                    facebook</button>
            </div>
            <div class="col-md-4">
                <button class="btn btn-danger btn-block" type="button"><i class="fab fa-google mr-2"></i>Connect to
                    Google</button>
            </div>
            <div class="col-md-4">
                <button class="btn btn-secondary btn-block" type="button"><i class="fab fa-github mr-2"></i>Connect to
                    Github</button>
            </div>
        </div>
    </div>

</div>
@endsection

@section('setting-footer')
<div class="btn-group">
    {{-- <a class="btn btn-secondary" href="{{ $base }}"><i class="fa fa-arrow-left"></i> Kembali</a> --}}
    <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
</div>
@endsection

@push('styles')
    <style>
    .avatar-wrapper {
    position: relative;
    height: 150px;
    width: 150px;
    margin: 20px auto;
    border-radius: 50%;
    overflow: hidden;
    box-shadow: 1px 1px 15px -5px black;
    transition: all .3s ease;
    }
    .avatar-wrapper:hover {
    transform: scale(1.05);
    cursor: pointer;
    }
    .avatar-wrapper:hover .profile-pic {
    opacity: .5;
    }
    .avatar-wrapper .profile-pic {
    height: 100%;
    width: 100%;
    transition: all .3s ease;
    }
    .avatar-wrapper .profile-pic:after {
    font-family: "Font Awesome 5 Free";
    content: "\f007";
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    position: absolute;
    font-size: 100px;
    background: #ecf0f1;
    color: #34495e;
    text-align: center;
    }
    .avatar-wrapper .upload-button {
    position: absolute;
    top: 0;
    left: 0;
    height: 100%;
    width: 100%;
    }
    .avatar-wrapper .upload-button .fa-arrow-circle-up {
    position: absolute;
    font-size: 150px;
    top: 0px;
    left: 0px;
    text-align: center;
    opacity: 0;
    transition: all .3s ease;
    color: #34495e;
    }
    .avatar-wrapper .upload-button:hover .fa-arrow-circle-up {
    opacity: .9;
    }

    </style>
@endpush
@push('scripts')
<script>
    $(document).ready(function() {
	
    var readURL = function(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('.profile-pic').attr('src', e.target.result);
            }
    
            reader.readAsDataURL(input.files[0]);
        }
    }
   
    $(".file-upload").on('change', function(){
        readURL(this);
        var file_data = $(this).prop('files')[0];
        var form_data = new FormData();
        form_data.append('file', file_data);

        axios.post("{{route('users.upload_avatar')}}", form_data).then(res => {
            console.log(res.data)
        })
        // $.ajax({
        //     url: "{{route('users.upload_avatar')}}", // point to server-side controller method
        //     dataType: 'text', // what to expect back from the server
        //     cache: false,
        //     contentType: false,
        //     processData: false,
        //     data: form_data,
        //     type: 'post',
        //     success: function (response) {

        //     },
        //     error: function (response) {

        //     }
        // });
    });
    
    $(".upload-button").on('click', function() {
       $(".file-upload").click();
    });
});
</script>
@endpush