@extends('layouts.app_admin') @section('content')

<!-- sidebar-wrapper  -->
  <main class="page-content">
    <div class="container-fluid"> 
      <div class="breadcrumb1">
        <ul>
          <li><a href="{{ url('dashboard') }}">Dashboard ></a></li>
          <li><a href="#">Profile</a></li>
          <li>View Profile</li>
        </ul>
      </div>
      <!-- Breadcumb End -->
      <div class="">
        <div class="basic-info-sec">
          <h3 class="subTitle black-clr m-bottom-20 p-left-15">Profile Information</h3>
            <div class="row">
              <div class="form-group col-sm-6">
                <label for="pass">Profile Image</label>
                <?php if (!empty($view_staff_details[0]->staff_profile_image)) {
                ?>
                  <p><img src="{{ url('public/uploads/admin/staff_images/'.$view_staff_details[0]->staff_profile_image) }}" width="120px;"></p>
                <?php }else{
                  ?>
                  <p><img src="{{ url('public/front_assets/icon_default_user.png' )}}" width="150px;"></p>
                <?php } ?>
              </div>
              <div class="form-group col-sm-6">
                  <label for="fname">Full Name</label>
                  <p><?php if (!empty($view_staff_details[0]->staff_name)) { echo $view_staff_details[0]->staff_name; }?></p>
              </div>
              <div class="form-group col-sm-6">
                <label for="email">Designation</label>
                <p><?php if (!empty($view_staff_details[0]->designation_name)) { echo $view_staff_details[0]->designation_name; }?></p>
              </div>
              <div class="form-group col-sm-6">
                <label for="userid">Type</label>
                <p><?php if (!empty($view_staff_details[0]->staff_type_name)) { echo $view_staff_details[0]->staff_type_name; }?></p>
              </div>
              <div class="form-group col-sm-6">
                <label for="pass">Station</label>
                <p><?php if (!empty($view_staff_details[0]->station_name_en)) { echo $view_staff_details[0]->station_name_en; }else{ echo "N/A"; }?></p>
              </div>
              <div class="form-group col-sm-6">
                  <label for="fname">Email</label>
                  <p><?php if (!empty($view_staff_details[0]->email)) { echo $view_staff_details[0]->email; }?></p>
              </div>
              <div class="form-group col-sm-6">
                <label for="email">Contact No.</label>
                <p><?php if (!empty($view_staff_details[0]->staff_contact_no)) { echo $view_staff_details[0]->staff_contact_no; }?></p>
              </div>
              <div class="form-group col-sm-6">
                <label for="userid">Employee Code</label>
                <p><?php if (!empty($view_staff_details[0]->staff_employee_id)) { echo $view_staff_details[0]->staff_employee_id; }?></p>
              </div>

              <div class="form-group col-sm-6">
                <label for="pass">Status</label>
                <p><?php if (!empty($view_staff_details[0]->staff_status)) { echo $view_staff_details[0]->staff_status; }?></p>
              </div>

            </div>
        </div><!-- section end -->

      </div>
    </div> <!-- container fluid -->
  </main>
  <!-- page-content" -->
</div>

<script src="{{ url('/public/admin_assets/developer_validate/jquery.validate.min.js')}}"></script>
<script src="{{ url('/public/admin_assets/developer_validate/custom_validate.js')}}"></script>
<script type="text/javascript">
  $(document).ready(function (){
    $('#staff-form').validate({
         onfocusout: function(element) {
             this.element(element);
         },
         errorClass: 'error_validate',
         errorElement:'span',
         highlight: function(element, errorClass) {
            $(element).removeClass(errorClass);
         }
    });
  });

  $(document).on('click', '.browse', function(){
    var file = $(this).parent().parent().parent().find('.file');
    file.trigger('click');
  });
  $(document).on('change', '.file', function(){
    $(this).parent().find('.form-control').val($(this).val().replace(/C:\\fakepath\\/i,''));
  }); 
</script>
@endsection
<!-- Footer -->