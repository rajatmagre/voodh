@extends('layouts.app_admin')
@section('content')
<!-- sidebar-wrapper  -->
<main class="page-content">
   <div class="container-fluid">
      <div class="breadcrumb1">
         <ul>
            <li><a href="{{ url('/admin-dashboard') }}">Dashboard ></a></li>
            <li><a href="{{ url('/category-list') }}">Category List ></a></li>
            <li>Add Category</li>
         </ul>
      </div>
      <!-- Breadcumb End -->
      <div class="form-wrapper add-field">
        @include('Admin.session_message.error')
         <form id="category-form" action="" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
              <div class="col-md-4">
                <label for="pname">Category Name</label>
              </div>
              <div class="col-md-8">            
                 <input type="text" class="form-control" id="cat_name" placeholder="Enter Category name." name="cat_name" data-rule-required="true" data-msg-required="Enter Category name." value="{{ old('cat_name') }}">
                @if ($errors->has('cat_name'))
                  <span for="cat_name" class="error_validate">{{ $errors->first('cat_name')}}</span>
                @endif
              </div>
            </div>
            <div class="row">
               <div class="col-md-4">
                  <label for="parent_cat_id">Parent Category</label>
               </div>
               <div class="col-md-8">
                  <div class="select-box">
                      <select class="select2" name="parent_cat_id" id="parent_cat_id" >
                        <option value="">Select Parent Category</option>
                        @if(!empty($all_parent_cats) && count($all_parent_cats) > 0)
                          @foreach($all_parent_cats as $each_val)
                            <option value="{{ $each_val->cat_id }}" <?php if(old('cat_id')==$each_val->cat_id){ echo "Seleted";}?>>{{ $each_val->cat_name }}</option>
                          @endforeach
                        @endif
                      </select>
                      <span for="parent_cat_id" class="error_validate"></span>
                      @if ($errors->has('parent_cat_id'))
                        <span for="parent_cat_id" class="error_validate">{{ $errors->first('parent_cat_id')}}</span>
                      @endif
                  </div>
               </div>
            </div>

            <div class="row">
               <div class="col-md-4">
                  <label for="db">Category Image</label>
               </div>
                <div class="col-md-8 browse-file-section">
                  <input type="file" name="cat_image" class="file" style="visibility: hidden;position: absolute;">
                  <div class="input-group col-xs-12">
                    <input type="text" class="form-control" readonly placeholder="Upload Image">
                    <span class="input-group-btn">
                      <button class="browse btn btn-primary input-lg" type="button"><i class="fa fa-upload" aria-hidden="true"></i> Browse</button>
                    </span>
                  </div>
                  <span for="cat_image" class="error_validate"></span>
                  @if ($errors->has('cat_image'))
                    <span for="cat_image" class="error_validate">{{ $errors->first('cat_image') }}</span>
                  @endif
                </div>
            </div>

            <div class="row">
              <div class="col-md-4">
                <label for="cat_status">Category Status</label>
              </div>
              <div class="col-md-8">
                <div class="select-box">
                  <select class="select2" name="cat_status" id="cat_status" data-rule-required="true" data-msg-required="Please Select staff status.">
                    <option value="">Select Category Status</option>
                    <option value="active" <?php if(old('staff_station_id')=="active"){ echo "Seleted";}?>>Active</option>
                    <option value="inactive" <?php if(old('staff_station_id')=="inactive"){ echo "Seleted";}?>>Inactive</option>
                  </select>
                  <span for="cat_status" class="error_validate"></span>
                  @if ($errors->has('cat_status'))
                    <span for="cat_status" class="error_validate">{{ $errors->first('cat_status')}}</span>
                  @endif
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-9 offset-md-3">
                <div class="text-center form-btn">
                  <button type="submit" id="add_category_btn" class="common-btn active">Add</button>
                  <a href="{{ url('/category-list') }}" class="common-btn">Cancel</a>
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
    $('#category-form').validate({
         onfocusout: function(element) {
             this.element(element);
         },
         errorClass: 'error_validate',
         errorElement:'span',
         highlight: function(element, errorClass) {
            $(element).removeClass(errorClass);
         },
         submitHandler: function (form) { 
            $('#add_category_btn').attr('disabled','disabled');
           form.submit();
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