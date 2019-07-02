@extends('layouts.app_admin')

  @section('content')
  <!-- sidebar-wrapper  -->
  <main class="page-content course_page">
    <div class="container-fluid"> 
      <div class="breadcrumb1">
        <ul>
          <li><a href="{{ url('admin-dashboard') }}">Dashboard ></a></li>
          <li><a href="{{ url('designation-list') }}">Designation List ></a></li>
          @if(Request::segment('2') != '')
          <li>Edit Staff Designation</li>
          @else
          <li>Add Staff Designation</li>
          @endif
        </ul>
      </div>

      <!-- Breadcumb End -->
      <div class="form-wrapper add-field">
        @if(isset($designation))
        <form action="{{ url('edit-designation/'.base64_encode($designation->designation_id)) }}" method="post">
        @else
        <form action="" id="add_designation" method="post" class="deg_form">
        @endif
          {{ csrf_field() }}
          <div class="row">
            <div class="col-md-4">
              <label for="pname">Designation Name (English)<span class="maditory_star">*</span></label>
            </div>
            <div class="col-md-8">
                         
              <input type="text" class="form-control" data-rule-required="true"  id="pname" placeholder="Enter Designation Name." data-msg-required="Enter designation name (English)." name="designation_name" @if(isset($designation)) value="{{ $designation->designation_name}}" @endif value="{{ old('designation_name')}}" onchange="get_my_hindi_text(this.value);">
              @if ($errors->has('designation_name'))
                <span for="pname" class="error_validate" style="display:block;">
                  {{ $errors->first('designation_name') }}
                </span>
              @endif
            </div>
          </div>

          <div class="row loader_div_element">
             <div class="col-md-8 offset-md-4">
                <img src="{{url('/public/admin_assets/images/admin_loader.gif')}}" style="width:50px;height:50px;"><span>Please wait we are translating your text..</span>
             </div>
          </div>

          <div class="row">
            <div class="col-md-4">
              <label for="pname">Designation Name (Hindi)<span class="maditory_star">*</span></label>
            </div>
            <div class="col-md-8">                         
              <input type="text" class="form-control" data-rule-required="true"  id="designation_name_hn" placeholder="Enter Designation Name"  data-msg-required="Enter designation name (Hindi)."  name="designation_name_hn" @if(isset($designation)) value="{{ $designation->designation_name_hn}}" @endif value="{{ old('designation_name_hn')}}">
              @if ($errors->has('designation_name_hn'))
                <span for="designation_name_hn" class="error_validate" style="display:block;">
                  {{ $errors->first('designation_name_hn') }}
                </span>
              @endif
            </div>
          </div>
      
       <div class="row">
            <div class="col-md-4">
            <label for="pstatus">Status<span class="maditory_star">*</span></label>
          </div>
          <div class="col-md-8">
            @if ($errors->has('designation_status'))
               <span class="help-block">
               <strong>{{ $errors->first('designation_status') }}</strong>
               </span>
             @endif
            <div class="select-box">
              <select required class="select2" name="designation_status"   data-rule-required="true" data-msg-required="Please Select designation status." id="dropdown1">
                <option selected value="">Select Designation Status</option>
                @if(isset($designation))
                  <option @if($designation->designation_status=='active') selected @endif 
                   @if(old('designation_status')=='active') selected @endif value="active">Active</option>
                  <option @if($designation->designation_status=='inactive') selected @endif 
                    @if(old('designation_status')=='inactive') selected @endif value="inactive">Inactive {{ old('designation_status')}}</option>
                @else
                  <option value="active">Active</option>
                  <option value="inactive">Inactive</option>
                @endif

              </select>
              <span for="dropdown1" class="error_validate"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-9 offset-md-3">
            <div class="text-center form-btn">
              @if(isset($designation))
              <button id="page_sub_btn" class="common-btn active">Update</button>
              @else
              <button id="page_sub_btn" class="common-btn active">Add</button>
              @endif
              <a href="{{ url('designation-list') }}" class="common-btn">Cancel</a>
             </div>
          </div>
        </div>
      </form>
      </div>
    </div> <!-- container fluid -->
  </main>
  <!-- page-content" -->
</div>
<!-- page-wrapper -->

<script src="{{ url('/public/admin_assets/developer_validate/jquery.validate.min.js')}}"></script>
<script src="{{ url('/public/admin_assets/developer_validate/custom_validate.js')}}"></script>
<script type="text/javascript">
   
     $('#add_designation').validate({
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


    /******For Convert In Hindi Text Start*********/

    function get_my_hindi_text(get_text){

        if(get_text != ''){

            $("#designation_name_hn").attr("disabled","disabled");

            $('.loader_div_element').css('display','block');

          $.ajax({
              
                type:'POST',
               
                url:'{{url("/hindi-translate-method1")}}',
               
                data:{ get_english_text : get_text, "_token" : '<?php echo csrf_token() ?>' },
              
                success:function(data) {
                  
                    $("#designation_name_hn").val(data);
                    $(".loader_div_element").css('display','none');
                    $("#designation_name_hn").removeAttr("disabled");
                }
            });
        }   
    }
     
    // Load the Google Transliterate API
     
      google.load("elements", "1", {
           
           packages: "transliteration"
         
        });

      function onLoad() {
       
          var options = {
              sourceLanguage:
                google.elements.transliteration.LanguageCode.ENGLISH,
              destinationLanguage:
                [google.elements.transliteration.LanguageCode.HINDI],
              shortcutKey: 'ctrl+g',
              transliterationEnabled: true
          };

          var control = new google.elements.transliteration.TransliterationControl(options);

          control.makeTransliteratable(['designation_name_hn']);

          // control.makeTransliteratable(['course_description_hn']);
     
      }
      google.setOnLoadCallback(onLoad);

    /************ END *********/
 
  </script>

@endsection
<!-- Footer -->

