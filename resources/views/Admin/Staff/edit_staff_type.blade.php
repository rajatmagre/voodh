@extends('layouts.app_admin')
@section('content')
<!-- sidebar-wrapper  -->
<main class="page-content">
  <div class="container-fluid">
    <div class="breadcrumb1">
      <ul>
        <li><a href="{{ url('admin-dashboard') }}">Dashboard ></a></li>
        <li><a href="{{ url('staff-type-list') }}">Staff Type List ></a></li>
        <li>Edit Staff Type</li>
      </ul>
    </div>
    <!-- Breadcumb End -->
    <div class="form-wrapper add-field">
    @include('Admin.session_message.error')
      <form id="staff-type-form" action="" method="POST">
        @csrf
        <div class="row">
           <div class="col-md-4">
              <label for="pname">Staff Type Name</label>
           </div>
           <div class="col-md-8">           
              <input type="text" class="form-control" id="staff_type_name" placeholder="Enter satff type." name="staff_type_name" data-rule-required="true" data-msg-required="Please enter satff type." onkeypress="return lettersOnly(event);" value="<?php if (!empty($edit_staff_type[0]['staff_type_name'])){ echo $edit_staff_type[0]['staff_type_name'];} ?>">
              @if ($errors->has('staff_type_name'))
                <span for="staff_type_name" class="error_validate">{{ $errors->first('staff_type_name') }}</span>
              @endif
           </div>
        </div>
        <div class="row">
           <div class="col-md-4">
              <label for="pstatus">Status</label>
           </div>
            <div class="col-md-8">
              <div class="select-box">
                <select class="select2" name="staff_type_status" id="staff_type_status" data-rule-required="true" data-msg-required="Please select status.">
                  <option value="active" <?php if (!empty($edit_staff_type[0]['staff_type_status'])){ if ($edit_staff_type[0]['staff_type_status'] == "active") { ?> selected <?php }} ?> >Active</option>
                        <option value="inactive" <?php if (!empty($edit_staff_type[0]['staff_type_status'])){ if ($edit_staff_type[0]['staff_type_status'] == "inactive") { ?> selected <?php }} ?>>Inactive</option>
                </select>
                <span for="staff_type_status" class="error_validate"></span>
              </div>
            </div>
        </div>
        <div class="row">
           <div class="col-md-9 offset-md-3">
              <div class="text-center form-btn">
                 <button type="submit" class="common-btn active">Update</button>
                 <a href="{{ url('/staff-type-list') }}" class="common-btn">Cancel</a>
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
       $('#staff-type-form').validate({
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
</script>

@endsection
<!-- Footer -->