<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Voodh | Admin</title>
    <base href=""></base>
    <link rel="stylesheet" href="{{ url('public/admin_assets/css/bootstrap.min.css')}}">
    <link href="{{ url('public/admin_assets/css/fontawesome-all.css')}}" rel="stylesheet">
    <link href="{{ url('public/admin_assets/css/custom.css')}}" rel="stylesheet">
    <link rel="icon" type="image/png" href="{{ url('/public/assets/images/icons/fav-icon.png') }}">
    <link href="https://fonts.googleapis.com/css?family=Raleway:400,500,600,700,800,900" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900" rel="stylesheet"> 
    <link href="https://fonts.googleapis.com/css?family=Ubuntu:400,500,700" rel="stylesheet">
    <link href="{{ url('public/admin_assets/css/jQuery-plugin-progressbar.css')}}" rel="stylesheet">
    <link href="{{ url('public/admin_assets/css/select2.min.css')}}" rel="stylesheet">
    <link href="{{ url('public/admin_assets/css/custom_css_by_developer.css')}}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ url('public/admin_assets/css/dataTables.bootstrap.css')}}" media="all" />
    <script src="{{ url('/public/admin_assets/js/jsapi.js')}}"></script>
    <link href="{{ url('public/admin_assets/css/jquery.datetimepicker.css')}}" rel="stylesheet">
    <link href="{{ url('public/admin_assets/css/fSelect.css')}}" rel="stylesheet">
    <!-- JQ Js -->
    <script src="{{ url('/public/admin_assets/js/jquery-3.3.1.min.js') }}"></script>
    <style type="text/css">
        .error_validate{
            color: red;
        }

         .topic-name input,
          .topic-name textarea{
            width: 100%;
            font-size: 14px;
            padding: 0 8px;
          }
          
    </style>
</head>
<body>
<header class="header-main">
    <div class="container-fluid p-0">
        <nav class="navbar navbar-expand-lg navbar-light p-0">

            <a class="navbar-brand" href="javascript:;">
              <img src="{{ url('/public/admin_assets/images/other/img_logo.png')}}"><span>Voodh Admin</span>
            </a>
            <div class=" navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto ">
                  <li class="nav-item">
                    <a id="toggle-sidebar" class="colleps-icon" href="#">
                      <img src="{{ url('/public/admin_assets/images/icons/collapse-02.png')}}" alt="menu">
                    </a>
                      <span class="dashboard-heading">Dashboard</span>
                  </li>
                </ul>
                 <ul class="navbar-nav ml-auto">
                   
                    <li class="nav-item dropdown notification-dropdown">
                      <a class="nav-link dropdown-toggle for-bedge" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <img src="{{ url('/public/admin_assets/images/icons/notification.png')}}" alt="Notification">
                        <span class="badge badge-pill badge-warning" id="unread_count_show"></span>
                      </a>
                      <div class="dropdown-menu notification" aria-labelledby="navbarDropdown">
                        <ul>
                          <li class="not-head">
                            <h6 class="dropdown-header m-0 text-uppercase"><span class="grey darken-2">Notifications</span></h6>

                          </li>
                          <li class="not-body scrollable-container w-100">
                            <div class="media-list" id="unread_list_show">
                              <!-- HTML Append from Ajax  -->
                            </div>
                          </li>
                          <li class="not-foot"><a class="dropdown-item text-muted text-center" href="{{ url('notification-list') }}">Read all notifications</a></li>
                        </ul>
                      </div>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    
                                {{ ucfirst(Session::get('staff_name')) }}

                        @php 

                          $admin_image = Session::get('staff_profile_image'); 

                        @endphp

                        @if($admin_image != '')

                             <img src="{{ url('public/uploads/admin/staff_images')}}/{{ $admin_image }}" class="img-fluid" alt="User Pic">

                        @else

                          <img src="{{ url('public/admin_assets/icon_default_user.png')}}" class="img-fluid" alt="User Pic">

                        @endif

                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ url('staff-view-profile') }}">Profile</a>
                            <a class="dropdown-item" href="{{ url('change-pass') }}">Change Password</a>
                           
                           <!--  @if(Auth::guard('admin')->user()->staff_type_id==1)
                             <a class="dropdown-item" href="{{ url('role-asign-management') }}">Role Management</a>
                             @endif -->


                              <a class="dropdown-item" href="{{ route('adminlogout') }}">Logout</a>
                        </div>
                    </li>
                  
                </ul>
            </div>
        </nav>
    </div>
</header>
