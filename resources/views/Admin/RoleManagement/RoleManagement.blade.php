@extends('layouts.app_admin')
@section('content')
<!-- sidebar-wrapper  -->
<main class="page-content">
    <div class="container-fluid"> 
      <div class="breadcrumb1">
        <ul>
          <li><a href="#">Dashboard ></a></li>
          <!-- <li><a href="#">Profile Settings ></a></li> -->
          <li>Role Management</li>
        </ul>
      </div>
      <!-- Breadcumb End -->
      <div class="form-wrapper role-management-wrapper add-field">
        @include('Admin.session_message.success')
        <form action ='update-menu' method="post">
           {{ csrf_field() }}
      
      <div class="row">
          <div class="col-md-4 offset-md-1">
            <label for="pstatus">Staff</label>
            <div class="select-box">
                <select required="" class="select2"  name="staff_id" id="staff" onchange="get_avl_menu_list()">
                  <option selected="" value="">Select Staff </option>
                  @if(!empty($staff) && count($staff)>0)
                  @foreach($staff as $each_val)
                      <option value=" {{ $each_val->id }}"> {{ ucfirst($each_val->staff_name) }}</option>
                  @endforeach
                @endif
                </select>
            </div>
          </div>
      </div>

     <div id="all_avl_menus">
      
      </div>
      <div class="row">
       <div class="col-md-12">
        <div class="text-right form-btn">
           <button type="submit" class="common-btn active rem-m">Submit</button>
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
<script type="text/javascript">
  
  function get_staff_list(designation){
      $.ajax({
            url: "get-all-staff", 
            type:'post',
            data:{'designation':designation,'_token':'<?php echo csrf_token() ?>'},
            success: function(result){
              $('#staff').html(result);
             
            }

      });
  }

  /*************
  Get all  Menu list****/
   function get_avl_menu_list()
  {

    // var designation_id  = $('#designation').val();
    var staff_id        = $('#staff').val();


       $.ajax({
            url: "get-alloted-menu",
            type: 'POST',
            data: {'staff_id':staff_id,
          '_token':'<?php echo csrf_token() ?>'},
            success:function(response)
             {
                 if(response!='')
                 {  
                   $('#all_avl_menus').html(response);

                   $('input[name="menu_ids[]"]').each(function(){
                 var submenu_id=$(this).val();
               
                // if($('#sub_add'+submenu_id).prop('checked')==true && $('#sub_edit'+submenu_id).prop('checked')==true && $('#sub_list'+submenu_id).prop('checked')==true && $('#sub_delete'+submenu_id).prop('checked')==true)
                // {
                //    $('#check_sub'+submenu_id).prop("checked","checked");
                //  }

                      if($('#sub_list'+submenu_id).prop('checked')==true)
                      {
                         $('#check_sub'+submenu_id).prop("checked","checked");
                      }

           });
                 }
            }
        }); 

  }
//get-alloted-menu

function get_checked_submenu(submenu_id)
{
    if($('#check_sub'+submenu_id).prop("checked")==true)
    {

       // $('#sub_add'+submenu_id).prop('checked',true);
       //  $('#sub_edit'+submenu_id).prop('checked',true);
         $('#sub_list'+submenu_id).prop('checked',true);
          //$('#sub_delete'+submenu_id).prop('checked',true);
            
    }
    else
    {
        // $('#sub_add'+submenu_id).prop('checked',false);
        // $('#sub_edit'+submenu_id).prop('checked',false);
         $('#sub_list'+submenu_id).prop('checked',false);
         // $('#sub_delete'+submenu_id).prop('checked',false);
        
    }
}

function get_checked_parent_submenu(id) {
   if($('*[data-parent_all="'+id+'"]').prop("checked")==true)
    {
      $('*[data-parent="'+id+'"]').prop('checked',true);
      
    } else {
        $('*[data-parent="'+id+'"]').prop('checked',false);
    }
}
/***************check all*******/
  function check_all_data(obj)
{
    if(obj.prop("checked")==true)
    {
        $('.check_all').each(function(){
            $(this).prop('checked',true);
        });
    }
    else
    {
         
        $('.check_all').each(function(){
            $(this).prop('checked',false);
        });
    }
}

</script>>
@endsection
<!-- Footer -->