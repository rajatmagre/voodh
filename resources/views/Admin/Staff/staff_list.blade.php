@extends('layouts.app_admin')
@section('content')
<!-- sidebar-wrapper  -->
<main class="page-content">
  <div class="container-fluid">
    <div class="breadcrumb1">
       <ul>
            <li><a href="{{ url('/admin-dashboard') }}">Dashboard ></a></li>
            <li><a href="{{ url('/staff-list') }}">Staff List ></a></li>
            
       </ul>
    </div>
    <!-- Breadcumb End -->
    <div class="form-wrapper2">
      <div class="add-field1">
         <div class="row">
            <div class="col-md-12">
               <div class="text-right form-btn">
                  <a href="{{ url('/add-staff') }}" class="common-btn active rem-m">Add Staff</a>
               </div>
            </div>
         </div>
      </div>
      <div class="form-wrapper1">
        <div class="region-list">
          @include('Admin.session_message.success')
          @include('Admin.session_message.error')
          <table id="example" class="table table-striped table-bordered" style="width:100%">
            <thead>
              <tr>
                 <th>S. No.</th>
                 <th>Name</th>
                 <th>Type</th>
                 <th>Code</th>
                 <th>Mobile.</th>
                 <th>Created At</th>
                 <th>Created By</th>
                 <th>Action</th>
              </tr>
            </thead>
            <tbody>
            @php $i = 1 @endphp
            @if(!empty($all_staff_details) && count($all_staff_details)>0)
              @foreach($all_staff_details as $each_val)
              <tr>
                 <td>{{ $i }}</td>
                 <td>{{ ucfirst($each_val->staff_name) }}</td>
                 <td>{{ ucfirst($each_val->staff_type_name) }}</td>
                 <td>{{ $each_val->staff_employee_id }}</td>
                 <td>{{ $each_val->staff_contact_no }}</td>
                 <td>{{ $each_val->created_at }}</td>
                 <td>{{ get_staff_log_details($each_val->created_by) }}</td>
                  <td>
                    <ul class="delete-btn">
                      <li><a href="{{ url('edit-staff/'.base64_encode($each_val->id)) }}"><i style="color:#0055a6" class="far fa-edit"></i></a></li>
                      <li><a href="javascript:;" data-toggle="modal" data-target="#myModal-delete{{ $i }}" ><i style="color:#ff0000" class="fas fa-trash-alt"></i></a></li>
                    </ul>
                  </td>
              </tr>
                <!-- Delete Modal -->
                <div id="myModal-delete{{ $i }}" class="modal fade myModal-delet" role="dialog">
                   <div class="modal-dialog">
                      <!-- Modal content-->
                      <div class="modal-content">
                          <div class="modal-header">
                            <h4 class="modal-title">Heads up!</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                          </div>

                          <div class="modal-body">
                            <form>
                                
                            </form>
                          </div>

                          <div class="modal-footer">
                            <button type="button" class="btn-comman-borderd" data-dismiss="modal">Cancel</button>
                            <button type="button" class="common-btn active rem-m">Ok</button>
                          </div>
                      </div>
                   </div>
                </div>

                @php $i++; @endphp
                @endforeach
              @endif
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
  <!-- container fluid -->
</main>
<!-- page-content" -->
</div>
<!-- page-wrapper -->
<script type="text/javascript" src="{{ url('/public/admin_assets/js/jquery.dataTables.js') }}"></script>
<script type="text/javascript" src="{{ url('/public/admin_assets/js/dataTables.bootstrap.js') }}"></script>
<script>
   $(document).ready(function() {
     $('#example').DataTable();
   });

   var id;
   function delete_staff(id)
   {
      window.location.href="{{ url('delete-staff') }}/"+id;
   }
</script>
@endsection
<!-- Footer -->