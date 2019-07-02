@extends('layouts.app_admin')
@section('content')
<!-- sidebar-wrapper  -->
<main class="page-content">
   <div class="container-fluid">
      <div class="breadcrumb1">
         <ul>
            <li><a href="{{ url('/admin-dashboard') }}">Dashboard ></a></li>
            <li><a href="{{ url('/staff-list') }}">Staff List ></a></li>
            <li>Edit Staff</li>
         </ul>
      </div>
      <!-- Breadcumb End -->
      <div class="form-wrapper add-field">
        @include('Admin.session_message.error')
         <form id="staff-form" action="" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
              <div class="col-md-4">
                <label for="pname">Staff Name</label>
              </div>
              <div class="col-md-8">            
                <input type="text" class="form-control" id="staff_name" placeholder="Enter staff name." name="staff_name" data-rule-required="true" data-msg-required="Enter staff name." value="<?php if (!empty($edit_staff_details->staff_name)) { echo $edit_staff_details->staff_name; }?>">
                @if ($errors->has('staff_name'))
                  <span for="staff_name" class="error_validate">{{ $errors->first('staff_name')}}</span>
                @endif
              </div>
            </div>
            

            <div class="row">
               <div class="col-md-4">
                  <label for="staff_type_id">Staff Type</label>
               </div>
               <div class="col-md-8">
                  <div class="select-box">
                      <select class="select2" name="staff_type_id" id="staff_type_id" data-rule-required="true" data-msg-required="Select staff type.">
                        <option value="">Select Type</option>
                        @if(!empty($all_staff_type) && count($all_staff_type) > 0)
                          @foreach($all_staff_type as $each_val)
                            <option value="{{ $each_val->staff_type_id }}" <?php if (!empty($edit_staff_details->staff_type_id)) { if ($edit_staff_details->staff_type_id == $each_val->staff_type_id) { ?> selected <?php } } ?>>{{ $each_val->staff_type_name }}</option>
                          @endforeach
                        @endif
                      </select>
                        <span for="staff_type_id" class="error_validate"></span>
                      @if ($errors->has('staff_type_id'))
                        <span for="staff_type_id" class="error_validate">{{ $errors->first('staff_type_id')}}</span>
                      @endif
                  </div>
               </div>
            </div>

            <div class="row">
               <div class="col-md-4">
                  <label for="staff_email">Staff Email</label>
               </div>
               <div class="col-md-8">            
                  <input type="text" class="form-control" id="staff_email" placeholder="Enter staff email." name="staff_email" data-rule-required="true" data-msg-required="Enter staff email." data-rule-email="true" readonly value="<?php if (!empty($edit_staff_details->email)) { echo $edit_staff_details->email; }?>">
                  @if ($errors->has('staff_email'))
                    <span for="staff_email" class="error_validate">{{ $errors->first('staff_email')}}</span>
                  @endif
               </div>
            </div>
            <div class="row">
               <div class="col-md-4">
                  <label for="staff_contact_no">Staff Contact No.</label>
               </div>
               <div class="col-md-8">            
                  <input type="text" class="form-control" id="staff_contact_no" placeholder="Enter staff contact no." name="staff_contact_no" data-rule-required="true" data-msg-required="Enter staff contact no." data-rule-number="true" data-rule-minlength="10"  data-msg-minlength="Please Enter Minimum 10 Digits" data-rule-maxlength="10"  data-msg-maxlength="You Can't Enter More Than 10 Digits" value="<?php if (!empty($edit_staff_details->staff_contact_no)) { echo $edit_staff_details->staff_contact_no; }?>">
                  @if ($errors->has('staff_contact_no'))
                    <span for="staff_contact_no" class="error_validate">{{ $errors->first('staff_contact_no')}}</span>
                  @endif
               </div>
            </div>

            <div class="row">
              <div class="col-md-4">
                <label for="staff_employee_id">Staff Employee Code</label>
              </div>
              <div class="col-md-8">            
                <input type="text" class="form-control" id="staff_employee_id" placeholder="Enter staff employee code." name="staff_employee_id" data-rule-required="true" data-msg-required="Enter staff employee code." value="<?php if (!empty($edit_staff_details->staff_employee_id)) { echo $edit_staff_details->staff_employee_id; }?>">
                @if ($errors->has('staff_employee_id'))
                  <span for="staff_employee_id" class="error_validate">{{ $errors->first('staff_employee_id')}}</span>
                @endif
              </div>
            </div>
            

            <?php if (!empty($edit_staff_details->staff_profile_image)){ ?>

              <div class="row">
                  <div class="col-md-4">
                    <label for="db">Old Staff Profile Image</label>
                  </div>
                  <div class="col-md-8 browse-file-section">
            
                  @if($edit_staff_details->staff_profile_image != '') 
                    <img src="{{ url('public/uploads/admin/staff_images/'.$edit_staff_details->staff_profile_image) }}" width="150px;">
                  @else
                    

                  @endif
                  </div>

                  <input type="hidden" name="old_staff_image" value="<?php echo $edit_staff_details->staff_profile_image;?>">
              </div>
            <?php } ?>

            <div class="row">
               <div class="col-md-4">
                  <label for="db">Staff Profile Image</label>
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
                <label for="staff_status">Staff Status</label>
              </div>
              <div class="col-md-8">
                <div class="select-box">
                  <select class="select2" name="staff_status" id="staff_status" data-rule-required="true" data-msg-required="Select staff status.">
                    <option value="">Select Staff Status</option>
                    <option value="active" <?php if (!empty($edit_staff_details->staff_status)) { if ($edit_staff_details->staff_status == 'active') { ?> selected <?php } } ?>>Active</option>
                    <option value="inactive" <?php if (!empty($edit_staff_details->staff_status)) { if ($edit_staff_details->staff_status == 'inactive') { ?> selected <?php } } ?>>Inactive</option>
                  </select>
                  <span for="staff_status" class="error_validate"></span>
                  @if ($errors->has('staff_status'))
                    <span for="staff_status" class="error_validate">{{ $errors->first('staff_status')}}</span>
                  @endif
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-9 offset-md-3">
                <div class="text-center form-btn">
                  <button type="submit" class="common-btn active">Update</button>
                  <a href="{{ url('/staff-list') }}" class="common-btn">Cancel</a>
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