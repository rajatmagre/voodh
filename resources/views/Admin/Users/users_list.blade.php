@extends('layouts.app_admin')
@section('content')
<!-- sidebar-wrapper  -->
<main class="page-content">
  <div class="container-fluid">
    <div class="breadcrumb1">
       <ul>
            <li><a href="{{ url('/admin-dashboard') }}">Dashboard ></a></li>
            <li><a href="{{ url('/users-list') }}">Users List ></a></li>
            
       </ul>
    </div>
    <!-- Breadcumb End -->
    <div class="form-wrapper2">
      <!-- <div class="add-field1">
         <div class="row">
            <div class="col-md-12">
               <div class="text-right form-btn">
                  <a href="{{ url('/add-staff') }}" class="common-btn active rem-m">Add Staff</a>
               </div>
            </div>
         </div>
      </div> -->
      <div class="form-wrapper1">
        <div class="region-list">
          @include('Admin.session_message.success')
          @include('Admin.session_message.error')
          <table id="example" class="table table-striped table-bordered" style="width:100%">
            <thead>
              <tr>
                 <th>S. No.</th>
                 <th>Name</th>
                 <th>Contact No.</th>
                 <th>Blood Group</th>
                 <th>Total Unit</th>
                 <th>Type</th>
                 <th>Email</th>
                 <th>Image</th>
                 <th>Created At</th>
                 <th>Action</th>
              </tr>
            </thead>
            <tbody>
            @forelse($all_users_details as $each_val)
              <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ ucwords($each_val->first_name.' '.$each_val->last_name) }}</td>
                <td>{{ $each_val->phone_no }}</td>
                <td>{{ $each_val->blood_group }}</td>
                <td>dsdf</td>
                <td>{{ $each_val->user_type }}</td>
                <td>{{ $each_val->email }}</td>
                <td>
                  <?php
                  if (!empty($each_val->user_image)) {

                    $user_image = 'public/uploads/user/'.$each_val->user_image;
                  }else{

                    $user_image = 'public/uploads/icon_default_user.png';
                  }
                  ?>
                  <img src="{{ url($user_image) }}" width="100px;">
                </td>
                <td>{{ $each_val->created_at }}</td>
                <td>
                  <ul class="delete-btn">
                    <li><a href="{{ url('users-view-details/'.base64_encode($each_val->user_id)) }}"><i style="color:#0055a6" class="fas hide-pass fa-eye" title="View Details"></i></a></li>
                    <li><a target="_blank" href="{{ url('user-accident-details/'.base64_encode($each_val->user_id)) }}"><i style="color:#0055a6"  title="View Accident Details" class="fas fa-ambulance"></i></a></li>

                    <li><a href="{{ url('user-rating-list/'.base64_encode($each_val->user_id)) }}" title="User Rewarts List" ><i style="color:#0055a6" class="far fa-star"></i></a></li>
                  </ul>
                </td>
              </tr>
              <!-- Delete Modal -->
              <div id="myModal-delete{{ $loop->iteration }}" class="modal fade myModal-delet" role="dialog">
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
                          <button type="button" class="common-btn active rem-m" onclick="delete_staff('{{ base64_encode($each_val->user_id) }}')" >Ok</button>
                        </div>
                    </div>
                 </div>
              </div>
            @empty
              <tr>
                <td colspan="5">No record Found.</td>
              </tr>
            @endforelse
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