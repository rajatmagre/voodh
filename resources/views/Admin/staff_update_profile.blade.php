@extends('layouts.app_admin') @section('content')

<!-- sidebar-wrapper  -->
<main class="page-content">
    <div class="container-fluid">
        <div class="breadcrumb1">
            <ul>
                <li><a href="{{ url('admin-dashboard') }}">Dashboard ></a></li>
                <li>Edit Profile</li>
            </ul>
        </div>
        <!-- Breadcumb End -->
        <div class="form-wrapper add-field">
          @include('Admin.session_message.success')
          @include('Admin.session_message.error')
            <form id="staff-form" method="POST" enctype="multipart/form-data">
            @csrf
              <div class="row">
                <div class="col-md-4">
                  <label for="pname">Name</label>
                </div>
                <div class="col-md-8">
                  <input type="text" class="form-control" id="staff_name" placeholder="Enter staff name." name="staff_name" value="<?php if (!empty($edit_staff_details[0]->staff_name)) { echo $edit_staff_details[0]->staff_name; }?>">
                </div>
              </div>

                <div class="row">
                  <div class="col-md-4">
                    <label for="pstatus">Designation</label>
                  </div>
                  <div class="col-md-8">
                    <div class="select-box">
                      <select class="select2" name="" id="dropdown1" disabled>
                        <option value="<?php if (!empty($edit_staff_details[0]->designation_name)) { echo $edit_staff_details[0]->designation_name; }?>" selected ><?php if (!empty($edit_staff_details[0]->designation_name)) { echo $edit_staff_details[0]->designation_name; }?></option>
                      </select>
                    </div>
                  </div>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <label for="pstatus">Type</label>
                    </div>
                    <div class="col-md-8">
                      <div class="select-box">
                        <select class="select2" name="" id="dropdown1" disabled>
                          <option value="<?php if (!empty($edit_staff_details[0]->staff_type_name)) { echo $edit_staff_details[0]->staff_type_name; }?>" selected ><?php if (!empty($edit_staff_details[0]->staff_type_name)) { echo $edit_staff_details[0]->staff_type_name; }?></option>
                        </select>
                      </div>
                    </div>
                </div>

                <div class="row">
                  <div class="col-md-4">
                    <label for="pstatus">Station</label>
                  </div>
                  <div class="col-md-8">
                    <div class="select-box">
                      <select class="select2" name="" id="dropdown1" disabled>
                        <option value="<?php if (!empty($edit_staff_details[0]->station_name_en)) { echo $edit_staff_details[0]->station_name_en; }?>" selected ><?php if (!empty($edit_staff_details[0]->station_name_en)) { echo $edit_staff_details[0]->station_name_en; }?></option>
                      </select>
                    </div>
                  </div>
                </div>

                <div class="row">
                    <div class="col-md-4">
                      <label for="pname">Email</label>
                    </div>
                    <div class="col-md-8">
                      <input type="text" class="form-control" id="email" disabled placeholder="Enter staff email." name="email" value="<?php if (!empty($edit_staff_details[0]->email)) { echo $edit_staff_details[0]->email; }?>">
                    </div>
                </div>

                <div class="row">
                  <div class="col-md-4">
                    <label for="pname">Contact No.</label>
                  </div>
                  <div class="col-md-8">
                    <input type="text" class="form-control" id="staff_contact_no" placeholder="Please enter your contact no." name="staff_contact_no" value="<?php if (!empty($edit_staff_details[0]->staff_contact_no)) { echo $edit_staff_details[0]->staff_contact_no; }?>" data-rule-required="true" data-msg-required="Enter your contact no." data-rule-number="true" data-rule-minlength="10"  data-msg-minlength="Please Enter Minimum 10 Digits" data-rule-maxlength="10"  data-msg-maxlength="You Can't Enter More Than 10 Digits">
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-4">
                    <label for="pname">Employee Code</label>
                  </div>
                  <div class="col-md-8">
                    <input type="text" class="form-control" id="staff_employee_id" placeholder="Please enter your employee code." name="staff_employee_id" value="<?php if (!empty($edit_staff_details[0]->staff_employee_id)) { echo $edit_staff_details[0]->staff_employee_id; }?>" data-rule-required="true" data-msg-required="Enter your employee code.">
                  </div>
                </div>

                <?php if (!empty($edit_staff_details[0]->staff_profile_image)){ ?>

                  <div class="row">
                    <div class="col-md-4">
                      <label for="db">Profile Image</label>
                    </div>
                    <div class="col-md-8 browse-file-section">
                      <img src="{{ url('public/uploads/admin/staff_images/'.$edit_staff_details[0]->staff_profile_image) }}" width="150px;">
                    </div>

                    <input type="hidden" name="old_staff_image" value="<?php echo $edit_staff_details[0]->staff_profile_image;?>">
                  </div>
                <?php } ?>

                <div class="row">
                  <div class="col-md-4">
                    <label for="db">Upload New Image</label>
                  </div>
                  <div class="col-md-8 browse-file-section">
                    <input type="file" name="staff_image" class="file" style="visibility: hidden;position: absolute;" >
                    <div class="input-group col-xs-12">

                      <input type="text" class="form-control" readonly placeholder="Upload Image">

                      <span class="input-group-btn">

                        <button class="browse btn btn-primary input-lg" type="button"><i class="fa fa-upload" aria-hidden="true"></i> Browse</button>

                      </span>
                    </div>
                    <span for="banner_bck_img" class="error_validate"></span>
                    @if ($errors->has('banner_bck_img'))
                      <span for="banner_bck_img" class="error_validate">{{ $errors->first('banner_bck_img') }}</span>
                    @endif
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-4">
                    <label for="pstatus">Status</label>
                  </div>
                  <div class="col-md-8">
                    <div class="select-box">
                      <select class="select2" name="" id="dropdown1" disabled>
                        <option value="<?php if (!empty($edit_staff_details[0]->staff_status)) { echo $edit_staff_details[0]->staff_status; }?>" selected ><?php if (!empty($edit_staff_details[0]->staff_status)) { echo $edit_staff_details[0]->staff_status; }?></option>
                      </select> 
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-9 offset-md-3">
                    <div class="text-center form-btn">
                      <button type="submit" class="common-btn active">Update</button>
                      <a href="{{ url('/dashboard') }}" class="common-btn">Cancel</a>
                    </div>
                  </div>
                </div>
            </form>
        </div>
    </div>
    <!-- container fluid -->
</main>
<!-- page-content" -->
</div>
<!-- page-wrapper -->
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