<div class="page-wrapper chiller-theme toggled">

  <nav id="sidebar" class="sidebar-wrapper">
    <div class="sidebar-content">
      <div class="sidebar-header">
        <div class="user-pic">

            @php  $admin_image = Session::get('staff_profile_image'); @endphp

            @if($admin_image != '')

                 <img src="{{ url('public/uploads/admin/staff_images')}}/{{ $admin_image }}" class="img-fluid" alt="User Pic">

            @else
              <img src="{{ url('public/admin_assets/icon_default_user.png')}}" class="img-fluid" alt="User Pic">

            @endif

        </div>
        <div class="user-info">
          <span class="user-name">{{ ucfirst(Session::get('staff_name')) }}</span>
          <span class="user-role"></span>
          <a href="{{ url('staff-update-profile/')}}" class="btn-default btn-update-profile">Update Profile</a>
        </div>
      </div>
      <!-- sidebar-header  -->
      <div class="sidebar-menu">
        <ul>
          @php 
            $admin_menu=menu_text_admin(0,'',0);
            echo $admin_menu;
          @endphp
        </ul>
      </div>
      <!-- sidebar-menu  -->
    </div>
  </nav>
