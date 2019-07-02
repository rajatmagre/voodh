@extends('layouts.app_admin')
@section('content')
  <!-- sidebar-wrapper  -->
 <main class="page-content">
    <div class="container-fluid"> 
      <div class="breadcrumb1">
      	<ul>
      		<li><a href="#">Dashboard ></a></li>
      		<li><a href="#">CMS ></a></li>
      		<li>Add Admin Menu</li>
      	</ul>
      </div>
      <!-- Breadcumb End -->
      <div class="form-wrapper">
      	<form id="add-side-menu" name="add-side-menu" method="post" action="{{ url('add-menu-post') }}" enctype="multipart/form-data">

      		@csrf
      		<div class="row">
			    <div class="col-md-4">
			    	<label for="pname">Menu Name</label>
			    </div>
			    <div class="col-md-8">			    	
			    	<input type="text" class="form-control" id="menu_name" placeholder="Enter Menu Name" name="menu_name"  data-rule-required="true" data-msg-required="Please enter menu name." />

			    	  @if ($errors->has('menu_name'))
             		 <span for="menu_name" class="error_validate" style="display:block;">
                		{{ $errors->first('menu_name') }}
             		 </span>
            		@endif
			    </div>
    		</div>
			
			<div class="row">
				<div class="col-md-4">
				<label for="pselect">Select Parent Menu</label>
			  </div>
			  <div class="col-md-8">
				<div class="select-box">
				  <select class="select2" name="menu_parent_id" id="menu_parent_id" onchange="get_menu(this)" >
					<option value="">Select Menu</option>
          <option value="0">Parent Menu</option>

					@if(!empty($all_menus))
					  @foreach($all_menus as $each_menu)
					  <option value="{{ $each_menu->menu_id }}">{{  $each_menu->menu_name }}</option>
					  @endforeach
					@endif
					
				  </select>

				   @if ($errors->has('menu_parent_id'))
             		 <span for="menu_parent_id" class="error_validate" style="display:block;">
                		{{ $errors->first('menu_parent_id') }}
             		 </span>
            @endif
				</div>
			  </div>
			</div>

      <div class="row">
          <div class="col-md-4">
            <label for="pname">Menu List URL</label>
          </div>
          <div class="col-md-8">            
            <input type="text" class="form-control" id="menu_list_url" placeholder="Enter Menu List URL" name="menu_list_url" data-rule-required="true" data-msg-required="Please enter menu list url." value=""  />

              @if ($errors->has('menu_list_url'))
                 <span for="menu_list_url" class="error_validate" style="display:block;">
                    {{ $errors->first('menu_list_url') }}
                 </span>
                  @endif
          </div>
      </div>

      <div style="display: none;" id="image_row">
  	    <div class="row">
          <div class="col-md-4">
            <label for="db">Menu Image</label>
          </div>
          <div class="col-md-8 browse-file-section">
      			 <input type="file" name="menu_icon_image" class="file" style="visibility: hidden;position: absolute;" >
      			<div class="input-group col-xs-12">
      			  <input type="text" class="form-control" disabled placeholder="Upload Image"   >
      			  <span class="input-group-btn">
      				<button class="browse btn btn-primary input-lg" type="button"><i class="fa fa-upload" aria-hidden="true"></i> Browse</button>
      			  </span>

      			        @if($errors->has('menu_icon_image'))
                   		 <span for="pname" class="error_validate" style="display:block;">
                      		{{ $errors->first('menu_icon_image') }}
                   		 </span>
                  		@endif
      			</div>
      		</div>
        </div>
      </div>

          <div class="row">
            <div class="col-md-4">
            <label for="pstatus">Status</label>
          </div>
          <div class="col-md-8">
            <div class="select-box">
              <select class="select2" name="menu_status" id="menu_status"  data-rule-required="true" data-msg-required="Please select menu status." >
                <option value="" >Select Menu Status</option>
                <option value="active">Active</option>
                <option value="inactive">Inactive</option>
              </select>

                 @if($errors->has('menu_status'))
             		 <span for="menu_status" class="error_validate" style="display:block;">
                		{{ $errors->first('menu_status') }}
             	</span>
            	@endif
            </div>
          </div>
        </div>
    		<div class="row">
    			<div class="col-md-9 offset-md-3">
    				<div class="text-center form-btn">
		    			<button type="submit" name="submit" class="common-btn active">Add</button>
		    			<a href="{{ url('side-menu-list') }}" class="common-btn">Cancel</a>
    				 </div>
    			</div>
    		</div>
    	</form>
      </div>
    </div> <!-- container fluid -->
  </main>
  <!-- page-content" -->

</div>

<script src="public/admin_assets/developer_validate/jquery.validate.min.js"></script>
<script src="public/admin_assets/developer_validate/custom_validate.js"></script>
<script type="text/javascript">
    $('#add-side-menu').validate({
        ignore: [],
        onfocusout: function(element) {
        this.element(element);
        },
        errorClass: 'error_validate',
        errorElement:'span',
        highlight: function(element, errorClass) {
        $(element).removeClass(errorClass);
        }
    });


    $(document).on('click', '.browse', function(){
  		var file = $(this).parent().parent().parent().find('.file');
  		file.trigger('click');
  	});

	  $(document).on('change', '.file', function(){
		  $(this).parent().find('.form-control').val($(this).val().replace(/C:\\fakepath\\/i, ''));
	  });

    function get_menu(menu_data) {

      var parent_val = $(menu_data).val();
      if (parent_val == 0) {
        $("#image_row").show();
      }else{

        $("#image_row").hide();
      }

    }
 
  </script>
<!-- page-wrapper -->
@endsection