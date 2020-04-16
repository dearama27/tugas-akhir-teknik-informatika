@extends('adminLTE.layout')

@push('title')
Profile
@endpush
@push('page-name')
Profile
@endpush

@php
$user = Auth::user();
@endphp

@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3">


                <!-- Profile Image -->
                <div class="card card-primary card-outline">
                    <div class="card-body box-profile">
                        <div style="overflow:hidden; width: 100px;" class="m-auto text-center">
                            <div class="pl-2 pr-2  label-upload-avatar" style="">Upload Avatar</div>
                            <img class="profile-user-img img-fluid img-circle" src="{{avatar_image($user)}}"
                                alt="User profile picture">
                        </div>

                        <h3 class="profile-username text-center">{{$user->name}}</h3>

                        <p class="text-muted text-center">{{$user->role->name}}</p>

                        <ul class="list-group list-group-unbordered mb-3">
                            <li class="list-group-item">
                                {{-- <b>Followers</b> <a class="float-right">1,322</a> --}}
                                <b class="d-block">Phone</b>
                                <small>{{$user->phone}}</small>
                            </li>
                            <li class="list-group-item">
                                <b class="d-block">Email</b>
                                <small>{{$user->email}}</small>
                            </li>
                            <li class="list-group-item">
                                <b class="d-block">Registred</b>
                                <small>{{is_null($user->created_at) ? '-':$user->created_at}}</small>
                            </li>
                        </ul>

                        <a href="#" class="btn btn-primary btn-block"><b>Follow</b></a>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->


                <!-- About Me Box -->
                <div class="card card-primary card-outline d-none d-md-block">
                    <div class="card-header">
                        <h3 class="card-title">About Me</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <strong><i class="fas fa-book mr-1"></i> Education</strong>

                        <p class="text-muted">
                            B.S. in Computer Science from the University of Tennessee at Knoxville
                        </p>

                        <hr>

                        <strong><i class="fas fa-map-marker-alt mr-1"></i> Location</strong>

                        <p class="text-muted">Malibu, California</p>

                        <hr>

                        <strong><i class="fas fa-pencil-alt mr-1"></i> Skills</strong>

                        <p class="text-muted">
                            <span class="tag tag-danger">UI Design</span>
                            <span class="tag tag-success">Coding</span>
                            <span class="tag tag-info">Javascript</span>
                            <span class="tag tag-warning">PHP</span>
                            <span class="tag tag-primary">Node.js</span>
                        </p>

                        <hr>

                        <strong><i class="far fa-file-alt mr-1"></i> Notes</strong>

                        <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam fermentum
                            enim neque.</p>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
            <div class="col-md-9">
                <div class="card card-primary card-outline">
                    <div class="card-header p-2">
                        <ul class="nav nav-pills">
                            <li class="nav-item" hidden><a class="nav-link" href="#activity"
                                    data-toggle="tab">Activity</a></li>
                            <li class="nav-item" hidden><a class="nav-link" href="#timeline"
                                    data-toggle="tab">Timeline</a></li>
                            <li class="nav-item"><a class="nav-link active" href="#notifications" data-toggle="tab"><i
                                        class="fas fa-bell"></i> Notifications</a></li>
                            <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab"><i
                                        class="fas fa-cogs"></i> Settings</a></li>
                        </ul>
                    </div><!-- /.card-header -->
                    <div class="card-body">
                        <div class="tab-content">
                            <div hidden class="tab-pane" id="activity">
                                <!-- Post -->
                                <div class="post">
                                    <div class="user-block">
                                        <img class="img-circle img-bordered-sm"
                                            src="/theme/adminlte/dist/img/user1-128x128.jpg" alt="user image">
                                        <span class="username">
                                            <a href="#">Jonathan Burke Jr.</a>
                                            <a href="#" class="float-right btn-tool"><i class="fas fa-times"></i></a>
                                        </span>
                                        <span class="description">Shared publicly - 7:30 PM today</span>
                                    </div>
                                    <!-- /.user-block -->
                                    <p>
                                        Lorem ipsum represents a long-held tradition for designers,
                                        typographers and the like. Some people hate it and argue for
                                        its demise, but others ignore the hate as they create awesome
                                        tools to help create filler text for everyone from bacon lovers
                                        to Charlie Sheen fans.
                                    </p>

                                    <p>
                                        <a href="#" class="link-black text-sm mr-2"><i class="fas fa-share mr-1"></i>
                                            Share</a>
                                        <a href="#" class="link-black text-sm"><i class="far fa-thumbs-up mr-1"></i>
                                            Like</a>
                                        <span class="float-right">
                                            <a href="#" class="link-black text-sm">
                                                <i class="far fa-comments mr-1"></i> Comments (5)
                                            </a>
                                        </span>
                                    </p>

                                    <input class="form-control form-control-sm" type="text"
                                        placeholder="Type a comment">
                                </div>
                                <!-- /.post -->

                                <!-- Post -->
                                <div class="post clearfix">
                                    <div class="user-block">
                                        <img class="img-circle img-bordered-sm"
                                            src="/theme/adminlte/dist/img/user7-128x128.jpg" alt="User Image">
                                        <span class="username">
                                            <a href="#">Sarah Ross</a>
                                            <a href="#" class="float-right btn-tool"><i class="fas fa-times"></i></a>
                                        </span>
                                        <span class="description">Sent you a message - 3 days ago</span>
                                    </div>
                                    <!-- /.user-block -->
                                    <p>
                                        Lorem ipsum represents a long-held tradition for designers,
                                        typographers and the like. Some people hate it and argue for
                                        its demise, but others ignore the hate as they create awesome
                                        tools to help create filler text for everyone from bacon lovers
                                        to Charlie Sheen fans.
                                    </p>

                                    <form class="form-horizontal">
                                        <div class="input-group input-group-sm mb-0">
                                            <input class="form-control form-control-sm" placeholder="Response">
                                            <div class="input-group-append">
                                                <button type="submit" class="btn btn-danger">Send</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <!-- /.post -->

                                <!-- Post -->
                                <div class="post">
                                    <div class="user-block">
                                        <img class="img-circle img-bordered-sm"
                                            src="/theme/adminlte/dist/img/user6-128x128.jpg" alt="User Image">
                                        <span class="username">
                                            <a href="#">Adam Jones</a>
                                            <a href="#" class="float-right btn-tool"><i class="fas fa-times"></i></a>
                                        </span>
                                        <span class="description">Posted 5 photos - 5 days ago</span>
                                    </div>
                                    <!-- /.user-block -->
                                    <div class="row mb-3">
                                        <div class="col-sm-6">
                                            <img class="img-fluid" src="/theme/adminlte/dist/img/photo1.png"
                                                alt="Photo">
                                        </div>
                                        <!-- /.col -->
                                        <div class="col-sm-6">
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <img class="img-fluid mb-3"
                                                        src="/theme/adminlte/dist/img/photo2.png" alt="Photo">
                                                    <img class="img-fluid" src="/theme/adminlte/dist/img/photo3.jpg"
                                                        alt="Photo">
                                                </div>
                                                <!-- /.col -->
                                                <div class="col-sm-6">
                                                    <img class="img-fluid mb-3"
                                                        src="/theme/adminlte/dist/img/photo4.jpg" alt="Photo">
                                                    <img class="img-fluid" src="/theme/adminlte/dist/img/photo1.png"
                                                        alt="Photo">
                                                </div>
                                                <!-- /.col -->
                                            </div>
                                            <!-- /.row -->
                                        </div>
                                        <!-- /.col -->
                                    </div>
                                    <!-- /.row -->

                                    <p>
                                        <a href="#" class="link-black text-sm mr-2"><i class="fas fa-share mr-1"></i>
                                            Share</a>
                                        <a href="#" class="link-black text-sm"><i class="far fa-thumbs-up mr-1"></i>
                                            Like</a>
                                        <span class="float-right">
                                            <a href="#" class="link-black text-sm">
                                                <i class="far fa-comments mr-1"></i> Comments (5)
                                            </a>
                                        </span>
                                    </p>

                                    <input class="form-control form-control-sm" type="text"
                                        placeholder="Type a comment">
                                </div>
                                <!-- /.post -->
                            </div>
                            <!-- /.tab-pane -->
                            <div hidden class="tab-pane" id="timeline">
                                <!-- The timeline -->
                                <div class="timeline timeline-inverse">
                                    <!-- timeline time label -->
                                    <div class="time-label">
                                        <span class="bg-danger">
                                            10 Feb. 2014
                                        </span>
                                    </div>
                                    <!-- /.timeline-label -->
                                    <!-- timeline item -->
                                    <div>
                                        <i class="fas fa-envelope bg-primary"></i>

                                        <div class="timeline-item">
                                            <span class="time"><i class="far fa-clock"></i> 12:05</span>

                                            <h3 class="timeline-header"><a href="#">Support Team</a> sent you an email
                                            </h3>

                                            <div class="timeline-body">
                                                Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles,
                                                weebly ning heekya handango imeem plugg dopplr jibjab, movity
                                                jajah plickers sifteo edmodo ifttt zimbra. Babblely odeo kaboodle
                                                quora plaxo ideeli hulu weebly balihoo...
                                            </div>
                                            <div class="timeline-footer">
                                                <a href="#" class="btn btn-primary btn-sm">Read more</a>
                                                <a href="#" class="btn btn-danger btn-sm">Delete</a>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- END timeline item -->
                                    <!-- timeline item -->
                                    <div>
                                        <i class="fas fa-user bg-info"></i>

                                        <div class="timeline-item">
                                            <span class="time"><i class="far fa-clock"></i> 5 mins ago</span>

                                            <h3 class="timeline-header border-0"><a href="#">Sarah Young</a> accepted
                                                your friend request
                                            </h3>
                                        </div>
                                    </div>
                                    <!-- END timeline item -->
                                    <!-- timeline item -->
                                    <div>
                                        <i class="fas fa-comments bg-warning"></i>

                                        <div class="timeline-item">
                                            <span class="time"><i class="far fa-clock"></i> 27 mins ago</span>

                                            <h3 class="timeline-header"><a href="#">Jay White</a> commented on your post
                                            </h3>

                                            <div class="timeline-body">
                                                Take me to your leader!
                                                Switzerland is small and neutral!
                                                We are more like Germany, ambitious and misunderstood!
                                            </div>
                                            <div class="timeline-footer">
                                                <a href="#" class="btn btn-warning btn-flat btn-sm">View comment</a>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- END timeline item -->
                                    <!-- timeline time label -->
                                    <div class="time-label">
                                        <span class="bg-success">
                                            3 Jan. 2014
                                        </span>
                                    </div>
                                    <!-- /.timeline-label -->
                                    <!-- timeline item -->
                                    <div>
                                        <i class="fas fa-camera bg-purple"></i>

                                        <div class="timeline-item">
                                            <span class="time"><i class="far fa-clock"></i> 2 days ago</span>

                                            <h3 class="timeline-header"><a href="#">Mina Lee</a> uploaded new photos
                                            </h3>

                                            <div class="timeline-body">
                                                <img src="http://placehold.it/150x100" alt="...">
                                                <img src="http://placehold.it/150x100" alt="...">
                                                <img src="http://placehold.it/150x100" alt="...">
                                                <img src="http://placehold.it/150x100" alt="...">
                                            </div>
                                        </div>
                                    </div>
                                    <!-- END timeline item -->
                                    <div>
                                        <i class="far fa-clock bg-gray"></i>
                                    </div>
                                </div>
                            </div>
                            <!-- /.tab-pane -->

                            <div class="active tab-pane" id="notifications">
                                <data></data>
                                <br>
                                <button class="btn btn-default btn-block" open-loadmore data-next-page="">
                                    <span loading class="d-none"><i class="fas fa-spinner fa-spin"></i> Loading..</span>
                                    <span loadmore>
                                        Load More
                                    </span>
                                </button>
                            </div>
                            <!-- /.tab-pane -->

                            <div class="tab-pane" id="settings">
                                <div class="avatar-wrapper">
                                    <img class="profile-pic"
                                        src="{{is_null($user->get_avatar) ? '':$user->get_avatar->url}}" />
                                    <div class="upload-button">
                                        <i class="fa fa-arrow-circle-up" aria-hidden="true"></i>
                                    </div>
                                    <input class="file-upload" type="file" accept="image/*" />
                                </div>

                                <form id="form-account" class="row">
                                    <div class="form-group col-md-6">
                                        <label for="name">@lang('user.text_fullname')</label>
                                        <input autocomplete="off" name="name" type="name" class="form-control" id="name"
                                            placeholder="" value="{{ $user->name }}">
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="phone">@lang('user.text_phone')</label>
                                        <input autocomplete="off" name="phone" type="phone" class="form-control"
                                            id="phone" placeholder="" value="{{$user->phone}}">
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="email">@lang('user.text_email')</label>
                                        <input autocomplete="off" name="email" type="email" class="form-control"
                                            id="email" placeholder="" value="{{$user->email}}">
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="password">@lang('user.text_password')</label>
                                        <input autocomplete="off" name="password" type="password" class="form-control"
                                            id="password" placeholder="********">
                                    </div>

                                    <div class="form-group col-12">
                                        <div class="row">

                                            <div class="col-md-4">
                                                @if (has_provider($user->id, 'facebook') ==0)
                                                <a href="{{route('auth.provider', ['provider' => 'facebook'])}}?page=profile"
                                                    class="btn btn-primary btn-block" type="button"><i
                                                        class="fab fa-facebook mr-2"></i>Connect to
                                                    facebook</a>
                                                @else
                                                <button class="btn btn-primary btn-block" type="button"><i
                                                        class="fab fa-facebook mr-2"></i> Facebook Connected</button>
                                                @endif
                                            </div>
                                            <div class="col-md-4">
                                                @if (has_provider($user->id, 'google') ==0)
                                                <a href="{{route('auth.provider', ['provider' => 'google'])}}?page=profile"
                                                    class="btn btn-danger btn-block" type="button"><i
                                                        class="fab fa-google mr-2"></i>Connect to
                                                    Google</a>
                                                @else
                                                <button class="btn btn-danger btn-block" type="button"><i
                                                        class="fab fa-google mr-2"></i>Google Connected</button>

                                                @endif

                                            </div>
                                            <div class="col-md-4">
                                                <button class="btn btn-secondary btn-block" type="button"><i
                                                        class="fab fa-github mr-2"></i>Connect to
                                                    Github</button>
                                            </div>
                                        </div>
                                    </div>

                                </form>

                                <button type="button" id="save-account" class="btn btn-success mt-4"
                                    style="padding-left: 30px; padding-right: 30px"><i class="fas fa-save"></i>
                                    Save</button>
                            </div>
                            <!-- /.tab-pane -->

                        </div>
                        <!-- /.tab-content -->
                    </div><!-- /.card-body -->
                </div>
                <!-- /.nav-tabs-custom -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->
@endsection

@push('styles')
<link rel="stylesheet" href="/theme/plugins/toastr/toastr.min.css">

<style>
    .card-body.bg-primary:hover {
        background: white !important;
        color: #272529 !important;
        cursor: pointer;
    }

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

    .label-upload-avatar {
        opacity: 0.4;
        top: 60px;
        width: 94px;
        border-radius: 3px;
        margin: 3px;
        background: rgba(0, 0, 0, 0.6);
        color: white;
        font-size: 10px;
        position: absolute;
    }
    .label-upload-avatar:hover {
        cursor: pointer;
        opacity: 1;
        top: 50px;
        border-radius: 20px;
        font-size: 14px;
    }
</style>
@endpush

@push('scripts')
<script src="/theme/plugins/toastr/toastr.min.js"></script>

<script>
    $(".label-upload-avatar").click(function() {
        $('.file-upload').trigger("click")
    })

    let html = `
        <div class="card profile-notification {bg}" style="cursor: pointer" data-id={id}>
            <div class="card-body p-2 ">
                <div class="float-left" style="width: 70px; margin-left:15px;">
                    <img class="rounded-circle" style="width:50px" src="{image}" />
                </div>
                <div class="float: left" style="left: 85px; position: absolute">
                    <span class="dropdown-item-title">{title}</span>
                    </br>
                    <small>{time}</small>
                </div>
            </div>
        </div>
    `;

    $('[open-loadmore]').click(function() {
        $("[loadmore]").toggleClass('d-none');
        $("[loading]") .toggleClass('d-none');

        load_notification(5, $(this).data('nextPage'));

    });

    load_notification(5,null);

    function load_notification(paginate, nextpage=null) {
        let url = (nextpage == null) ? '{{route("notification")}}?paginate='+paginate:nextpage+'&paginate='+paginate;

        axios.post(url).then(res => {
            $('.notification-item,.notification-divider').remove()

            if(nextpage == null) {
                $("#notifications data").html('');
            }

            if(res.data.notifications.next_page_url == null) {
                $("[open-loadmore]").toggleClass('d-none');
            } else {
                $("[open-loadmore]").data('nextPage', res.data.notifications.next_page_url);
            }

            res.data.notifications.data.forEach(i => {
                let val = i.data;

                let output = html
                                .replace('{title}', val.title)
                                .replace('{image}', val.image != '' ? val.image:'/data/images/default.png')
                                .replace('{time}', timeSince(new Date(i.created_at)))
                                .replace('{id}', i.id);

                if(i.read_at == null) {
                    output = output.replace('{bg}', 'bg-primary')
                } else {
                    output = output.replace('{bg}', '')
                }

                $("#notifications data").append(output);
            })
        })
    }

    $(document).on('click', '.profile-notification', function() {
        $(this).removeClass('bg-primary');
        axios.post('{{route("notification_read")}}', {
            id: $(this).data('id')
        }).then(res => {
            
        })
    })
</script>
<script>
    $(document).ready(function() {
  
    var readURL = function(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
  
            reader.onload = function (e) {
                $('.profile-pic,.profile-user-img,.user-image').attr('src', e.target.result);
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
            if(res.data.status) { 
                toastr.success(res.data.message)
            } else {
                toastr.error(res.data.message)
            }
        })
    });
    
    $(".upload-button").on('click', function() {
       $(".file-upload").click();
    });

    $('#save-account').click(function() {
        let form = $("#form-account").serializeArray();
        let form_data = new FormData();
        form.forEach(i => form_data.append(i.name, i.value));
        axios.post('{{route("users.create")}}?json=true', form_data).then(res => {
            let response = res.data;
        })
    })
  });

</script>
@endpush