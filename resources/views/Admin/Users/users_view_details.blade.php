@extends('layouts.app_admin') @section('content')
<!-- sidebar-wrapper  -->
  <main class="page-content">
    <div class="container-fluid"> 
      <div class="breadcrumb1">
        <ul>
          <li><a href="{{ url('dashboard') }}">Dashboard ></a></li>
          <li><a href="#">Users</a></li>
          <li>View Details</li>
        </ul>
      </div>
      <!-- Breadcumb End -->
      <div class="">
        <div class="basic-info-sec">
          <h3 class="subTitle black-clr m-bottom-20 p-left-15">Users Details</h3>
            <div class="row">
              <div class="form-group col-sm-6">
                <label for="pass">User Image</label>
                <?php if (!empty($view_user_details->user_image)) {

                ?>
                  <p><img src="{{ url('public/uploads/user/'.$view_user_details->user_image) }}" width="120px;"></p>
                <?php }else{
                  ?>
                  <p><img src="{{ url('public/uploads/icon_default_user.png' )}}" width="120px;"></p>
                <?php } ?>
              </div>
              <div class="form-group col-sm-6">
                  <label for="fname">Full Name</label>
                  <p><?php if (!empty($view_user_details->first_name)) { echo @$view_user_details->first_name.' '.@$view_user_details->last_name; }?></p>
              </div>              
              
              <div class="form-group col-sm-6">
                <label for="userid">Type</label>
                <p><?php if (!empty($view_user_details->user_type)) { echo @$view_user_details->user_type; }?></p>
              </div>
              
              <div class="form-group col-sm-6">
                  <label for="fname">Email</label>
                  <p><?php if (!empty($view_user_details->email)) { echo @$view_user_details->email; }?></p>
              </div>

              <div class="form-group col-sm-6">
                <label for="email">Contact No.</label>
                <p><?php if (!empty($view_user_details->phone_no)) { echo @$view_user_details->phone_no; }?></p>
              </div>

              <div class="form-group col-sm-6">
                <label for="userid">Language</label>
                <p><?php if (!empty($view_user_details->language)) { echo @$view_user_details->language; }?></p>
              </div>

              <div class="form-group col-sm-6">
                <label for="userid">Permanent Address</label>
                <p><?php if (!empty($view_user_details->permanent_address)) { echo @$view_user_details->permanent_address; }?></p>
              </div>

              <div class="form-group col-sm-6">
                <label for="userid">Current Address</label>
                <p><?php if (!empty($view_user_details->current_address)) { echo @$view_user_details->current_address; }?></p>
              </div>

              <div class="form-group col-sm-6">
                <label for="userid">Register Date</label>
                <p><?php if (!empty($view_user_details->created_at)) { echo @$view_user_details->created_at; }?></p>
              </div>

              <div class="form-group col-sm-6">
                <label for="pass">Status</label>
                <p><?php if (!empty($view_user_details->status)) { echo @$view_user_details->status; }?></p>
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