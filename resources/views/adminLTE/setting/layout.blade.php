@extends('adminLTE.layout')

@push('title')
    Settings
@endpush

@section('content')

<div class="row">
    <div class="col-md-3">
        <div class="card">
            <div class="card-header">
              <h3 class="card-title">General</h3>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="card-body p-0">
              <ul class="nav nav-pills flex-column">
                <li class="nav-item">
                  <a href="{{route('setting.account')}}" class="nav-link">
                    <i class="fas fa-user"></i> Account
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{route('setting.security')}}" class="nav-link">
                    <i class="fas fa-lock"></i> Security
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{route('setting.appearance')}}" class="nav-link">
                    <i class="fas fa-paint-brush"></i>  Appearance
                  </a>
                </li>
                <li class="nav-item">
                  <a href="#" class="nav-link">
                    <i class="fas fa-bell"></i> Notifications
                    <span class="badge bg-warning float-right">65</span>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="#" class="nav-link">
                    <i class="fas fa-history"></i> Log Activity
                  </a>
                </li>
              </ul>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->

        <div class="card">
            <div class="card-header">
              <h3 class="card-title">Application</h3>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="card-body p-0">
              <ul class="nav nav-pills flex-column">
                <li class="nav-item">
                  <a href="{{route('setting.logging')}}" class="nav-link">
                    <i class="fas fa-history"></i> Logging
                  </a>
                </li>
              </ul>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <div class="col-md-9">
        <div class="card card-primary card-outline">
            <div class="card-header">
                <h3 class="card-title">@yield('setting-title')</h3>

                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                    </button>
                </div>
            </div>
            <div class="card-body">
                @yield('setting-body')
            </div>
            <div class="card-footer">
                @yield('setting-footer')
            </div>
        </div> {{-- End Card --}}
    </div>
</div>

@endsection
