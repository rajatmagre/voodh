@extends('layouts.app_admin')
@section('content')
<!-- sidebar-wrapper  -->
  <main class="page-content">
    <div class="container-fluid"> 
      <div class="breadcrumb1">
      	<ul>
      		<li><a href="#">Dashboard ></a></li>
      		<li><a href="#">CMS ></a></li>
      		<li> Admin Menu List</li>
      	</ul>
      </div>
      <!-- Breadcumb End -->
      <div class="form-wrapper2">
      	<form>
          <div class="add-field1">
      		  <div class="row">
    			   <div class="col-md-12">
    				  <div class="text-right form-btn">
		    			 <a href="{{ url('add-side-menu') }}" class="common-btn active rem-m">Add Admin Menu</a>
    				  </div>
    			   </div>
    		    </div>
          </div>
         <div class="form-wrapper1">

          @include('Admin.session_message.success')
          @include('Admin.session_message.error')

    			<div class="region-list">
    				<table id="example" class="table table-striped table-bordered" style="width:100%">
    			        <thead>
    			            <tr>
    			             <th>S. No.</th>
            			      <th>Menu Name</th>
        								<th>Menu Parent</th>
        								<th>Add URL</th>
        								<th>Listing URL</th>
        								<th>Menu Image</th>
            			      <th>Created At</th>
        								<th>Created By</th>
    			              <th>Action</th>
    			            </tr>
    			        </thead>
    			        <tbody>

                    @if(!empty($all_menus) && count($all_menus)>0)

                      @php $j=1; @endphp
                      @foreach($all_menus as $each_menu)
    			            <tr>
    			                <td>{{ $j }}</td>
    			                <td>{{ $each_menu->menu_name}}</td>
          							
          								<td>{{ get_menu_name($each_menu->menu_parent_id) }}</td>
          								<td>{{ $each_menu->menu_add_url}}</td>
          								<td>{{ $each_menu->menu_list_url }}</td>
          								<td>
                            <?php
                            if (!empty($each_menu->menu_icon_image)) { ?>
                            <img src="{{ url('public/uploads/admin/menu_icons/')}}/{{$each_menu->menu_icon_image}}" width="20" height="20" />
                            <?php }  ?>
                          </td>
    			                <td>@php $create_date=date('d F Y h:i A', strtotime($each_menu->created_at)); @endphp {{ $create_date }}</td>
								          <td>{{ get_staff_log_details($each_menu->created_by) }}</td>
    			                <td>
    			                	<ul class="delete-btn">
                              <li><a href="{{ url('edit-menu') }}/{{ base64_encode($each_menu->menu_id) }}"><i style="color:#0055a6" class="far fa-edit"></i></a></li>
                              <li><a href="javascript:void(0);" data-target="#myModal-delet{{$j}}" data-toggle="modal"><i style="color:#ff0000" class="fas fa-trash-alt"></i></a></li>
                            </ul>
    			                </td>
    			            </tr>

                      


                       <div id="myModal-delet{{$j}}" class="modal fade myModal-delet" role="dialog">
                          <div class="modal-dialog">

                            <!-- Modal content-->
                            <div class="modal-content">
                              <div class="modal-header">
                                
                                <h4 class="modal-title">Heads up!</h4>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                              </div>
                              <div class="modal-body">
                                <p>Are you sure you want to delete this?</p>
                              </div>
                              <div class="modal-footer">
                                 <button type="button" class="btn-comman-borderd" data-dismiss="modal">Cancel</button>
                                <button type="button" class="common-btn active rem-m" data-dismiss="modal"  onclick="delete_menu('{{ base64_encode($each_menu->menu_id) }}');" >Ok</button>
                              </div>
                            </div>

                          </div>
                      </div>

                      @php $j++; @endphp
                      @endforeach

                      @endif
    			            
    			        </tbody>
    		       	</table>
    			   </div>
    		  </div>
    	</form>
      </div>
    </div> <!-- container fluid -->
  </main>



 

  <script type="text/javascript" src="public/admin_assets/js/jquery.dataTables.js"></script>
<script type="text/javascript" src="public/admin_assets/js/dataTables.bootstrap.js"></script>
<script>
 $(document).ready(function() {
     $('#example').DataTable();
   });

  var menu_idd;
 function delete_menu(menu_idd)
 {

  
    window.location.href="{{ url('delete-menu') }}/"+menu_idd;
 }
</script>
  @endsection
