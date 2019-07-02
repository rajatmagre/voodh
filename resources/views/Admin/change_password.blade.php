@extends('layouts.app_admin')

  @section('content')
  <!-- sidebar-wrapper  -->
 <main class="page-content">
    <div class="container-fluid"> 
      <div class="breadcrumb1">
        <ul>
          <li><a href="{{ route('admin-dashboard')}}">Dashboard ></a></li>
          <li><a href="#">Profile Settings ></a></li>
          <li>Change Password</li>
        </ul>
      </div>
      <!-- Breadcumb End -->
      <div class="form-wrapper add-field">

         @include('Admin.session_message.error')
         @include('Admin.session_message.success')
        
        <!--form start -->
        <form name="change_pass_form" id="change_pass_form" method="post" action="{{ route('change-pass') }}">

          @csrf
          <div class="row">
          <div class="col-md-4">
            <label for="current_password">Current Password</label>
          </div>
          <div class="col-md-8">            
            <input type="password" class="form-control" id="current_password" placeholder="Enter Current Password" name="current_password" value="" {{ old('current_password') }}  data-rule-required="true" data-msg-required="Please enter current password."/>
             @if($errors->has('current_password'))
                 <span for="current_password" class="error_validate" style="display:block;">
                    {{ $errors->first('current_password') }}
                 </span>
             @endif
          </div>
        </div>
      
        <div class="row">
          <div class="col-md-4">
            <label for="new_pass">New Password</label>
          </div>
          <div class="col-md-8">            
            <input type="password" class="form-control" id="new_pass" placeholder="Enter New Password" name="new_pass"  value="" {{ old('new_pass') }} data-rule-required="true" data-msg-required="Please enter new password." data-rule-minlength="6"  />
            @if($errors->has('new_pass'))
                 <span for="new_pass" class="error_validate" style="display:block;">
                    {{ $errors->first('new_pass') }}
                 </span>
             @endif
          </div>
        </div>
      
        <div class="row">
          <div class="col-md-4">
            <label for="repass">Re-enter New Password</label>
          </div>
          <div class="col-md-8">            
            <input type="password" class="form-control" id="repass" placeholder="Re-eneter New Password" name="repass" value="" {{ old('repass') }} data-rule-required="true" data-msg-required="Please re-enter password."  data-rule-equalto="#new_pass" />
            @if($errors->has('repass'))
                 <span for="repass" class="error_validate" style="display:block;">
                    {{ $errors->first('repass') }}
                 </span>
             @endif
          </div>
        </div>
      
        <div class="row">
          <div class="col-md-9 offset-md-3">
            <div class="text-center form-btn">
              <button type="submit" name="submit" class="common-btn active">Update</button>
              <a href="{{ route('admin-dashboard') }}" class="common-btn">Cancel</a>
             </div>
          </div>
        </div>
      </form>
      <!--form end-->

      </div>
    </div> <!-- container fluid -->
  </main>
  <!-- page-content" -->
</div>

<script src="{{ url('/public/admin_assets/developer_validate/jquery.validate.min.js')}}"></script>
<script src="{{ url('/public/admin_assets/developer_validate/custom_validate.js')}}"></script>
<script type="text/javascript">
    $('#change_pass_form').validate({
        onfocusout: function(element) {
        this.element(element);
        },
        errorClass: 'error_validate',
        errorElement:'span',
        highlight: function(element, errorClass) {
        $(element).removeClass(errorClass);

        },
        submitHandler:function(form)
        {
    
       $('#page_sub_btn').prop("disabled", true);
       form.submit();
        }
    });
 
  </script>

@endsection
<!-- Footer -->

