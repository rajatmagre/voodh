@extends('layouts.app_admin')
@section('content')
<!-- sidebar-wrapper  -->
<main class="page-content">
   <div class="container-fluid">
      <div class="breadcrumb1">
         <ul>
            <li><a href="{{ url('/admin-dashboard') }}">Dashboard ></a></li>
            <li><a href="{{ url('/product-list') }}">Product List ></a></li>
            <li>Add Product</li>
         </ul>
      </div>
      <!-- Breadcumb End -->
      <div class="form-wrapper add-field">
        @include('Admin.session_message.error')
         <form id="product-form" action="" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
              <div class="col-md-4">
                <label for="pname">Product Name</label>
              </div>
              <div class="col-md-8">            
                 <input type="text" class="form-control" id="product_name" placeholder="Enter Product name." name="product_name" data-rule-required="true" data-msg-required="Enter Product name." value="{{ old('product_name') }}">
                @if ($errors->has('product_name'))
                  <span for="product_name" class="error_validate">{{ $errors->first('product_name')}}</span>
                @endif
              </div>
            </div>
            <div class="row">
               <div class="col-md-4">
                  <label for="main_category">Main Category</label>
               </div>
               <div class="col-md-8">
                  <div class="select-box">
                      <select class="select2" name="main_category" id="main_category" onchange="load_sub_cat(this.value);">
                        <option value="">Select Parent Category</option>
                        @if(!empty($all_parent_cats) && count($all_parent_cats) > 0)
                          @foreach($all_parent_cats as $each_val)
                            <option value="{{ $each_val->cat_id }}" <?php if(old('cat_id')==$each_val->cat_id){ echo "Seleted";}?>>{{ $each_val->cat_name }}</option>
                          @endforeach
                        @endif
                      </select>
                      <span for="main_category" class="error_validate"></span>
                      @if ($errors->has('main_category'))
                        <span for="main_category" class="error_validate">{{ $errors->first('main_category')}}</span>
                      @endif
                  </div>
               </div>
            </div>
            <div class="row" id="sub_cat_div" style="display: none;">
                <div class="col-md-4">
                    <label for="sub_cat">Sub Category</label>
                </div>
                <div class="col-md-8">
                    <div class="select-box">
                        <select class="select2" name="sub_cat" id="sub_cat" onchange="load_resub_cat(this.value);">
                            
                        </select>
                        <span for="sub_cat" class="error_validate"></span>
                        @if ($errors->has('sub_cat'))
                        <span for="sub_cat" class="error_validate">{{ $errors->first('sub_cat')}}</span>
                        @endif
                    </div>
                </div>
            </div>
            <div class="row" id="resub_cat_div" style="display: none;">
                <div class="col-md-4">
                  <label for="resub_cat">Resub Category</label>
                </div>
                <div class="col-md-8">
                  <div class="select-box">
                      <select class="select2" name="resub_cat" id="resub_cat" >
                        
                      </select>
                      <span for="resub_cat" class="error_validate"></span>
                      @if ($errors->has('resub_cat'))
                        <span for="resub_cat" class="error_validate">{{ $errors->first('resub_cat')}}</span>
                      @endif
                  </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <label for="product_price">Product Price</label>
                </div>
                <div class="col-md-8">            
                    <input type="text" class="form-control" id="product_price" placeholder="Enter Product price." name="product_price" data-rule-number="true" data-rule-required="true" data-msg-required="Enter Product price." value="{{ old('product_price') }}">
                    @if ($errors->has('product_price'))
                      <span for="product_price" class="error_validate">{{ $errors->first('product_price')}}</span>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <label for="discount_price">Product Discount Price</label>
                </div>
                <div class="col-md-8">            
                    <input type="text" class="form-control" id="discount_price" placeholder="Enter Product price." name="discount_price" data-rule-required="true" data-rule-number="true" data-msg-required="Enter Product price." value="{{ old('discount_price') }}">
                    @if ($errors->has('discount_price'))
                      <span for="discount_price" class="error_validate">{{ $errors->first('discount_price')}}</span>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <label for="product_des">Product Description</label>
                </div>
                <div class="col-md-8">          
                    <textarea rows="4" class="form-control" id="product_des" placeholder="Enter Product description." name="product_des" data-rule-required="true" data-msg-required="Enter Product description.">{{ old('product_des') }}</textarea>
                    @if ($errors->has('product_des'))
                      <span for="product_des" class="error_validate">{{ $errors->first('product_des')}}</span>
                    @endif
                </div>
            </div>
            <div class="row">
               <div class="col-md-4">
                  <label for="db">Product Main Image</label>
               </div>
                <div class="col-md-8 browse-file-section">
                  <input type="file" name="product_main_image" class="file" style="visibility: hidden;position: absolute;" multiple="multiple">
                  <div class="input-group col-xs-12">
                    <input type="text" class="form-control" readonly placeholder="Upload Image">
                    <span class="input-group-btn">
                      <button class="browse btn btn-primary input-lg" type="button"><i class="fa fa-upload" aria-hidden="true"></i> Browse</button>
                    </span>
                  </div>
                  <span for="product_main_image" class="error_validate"></span>
                  @if ($errors->has('product_main_image'))
                    <span for="product_main_image" class="error_validate">{{ $errors->first('product_main_image') }}</span>
                  @endif
                </div>
            </div>
            <div class="row">
               <div class="col-md-4">
                  <label for="db">Product Images</label>
               </div>
                <div class="col-md-8 browse-file-section">
                  <input type="file" name="product_image[]" class="file" style="visibility: hidden;position: absolute;" multiple="multiple">
                  <div class="input-group col-xs-12">
                    <input type="text" class="form-control" readonly placeholder="Upload Image">
                    <span class="input-group-btn">
                      <button class="browse btn btn-primary input-lg" type="button"><i class="fa fa-upload" aria-hidden="true"></i> Browse</button>
                    </span>
                  </div>
                  <span for="product_image" class="error_validate"></span>
                  @if ($errors->has('product_image'))
                    <span for="product_image" class="error_validate">{{ $errors->first('product_image') }}</span>
                  @endif
                </div>
            </div>

            <div class="row">
              <div class="col-md-4">
                <label for="product_status">Product Status</label>
              </div>
              <div class="col-md-8">
                <div class="select-box">
                  <select class="select2" name="product_status" id="product_status" data-rule-required="true" data-msg-required="Please Select product status.">
                    <option value="">Select Product Status</option>
                    <option value="active">Active</option>
                    <option value="inactive">Inactive</option>
                  </select>
                  <span for="product_status" class="error_validate"></span>
                  @if ($errors->has('product_status'))
                    <span for="product_status" class="error_validate">{{ $errors->first('product_status')}}</span>
                  @endif
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-9 offset-md-3">
                <div class="text-center form-btn">
                  <button type="submit" id="add_product_btn" class="common-btn active">Add</button>
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
            $('#add_product_btn').attr('disabled','disabled');
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
    var cat_id;
    function load_sub_cat(cat_id)
    {
        $.ajax({

            url: "{{ route('get-sub-cat') }}", 
            type:'post',
            data:{'cat_id':cat_id,'_token':'<?php echo csrf_token() ?>'},
            success: function(result){

                $('#sub_cat').html(result);
                $('#sub_cat_div').show('slow');

            
            }

        });

    }
    var subcat_id;
    function load_resub_cat(subcat_id)
    {
        $.ajax({

            url: "{{ route('get-sub-cat') }}", 
            type:'post',
            data:{'cat_id':subcat_id,'_token':'<?php echo csrf_token() ?>'},
            success: function(result){

                $('#resub_cat').html(result);
                $('#resub_cat_div').show('slow');
            
            }

        });

    }
</script>

@endsection
<!-- Footer -->