@extends('layouts.app_admin')
@section('content')
<!-- sidebar-wrapper  -->
<main class="page-content">
    <div class="container-fluid">
      <div class="breadcrumb1">
        <ul>
          <li><a href="{{ url('admin-dashboard') }}">Dashboard ></a></li>
          <li>Staff Type List</li>
        </ul>
      </div>
      <!-- Breadcumb End -->
      <div class="form-wrapper2">
        <div class="add-field1">
           <div class="row">
              <div class="col-md-12">
                 <div class="text-right form-btn">
                    <a href="{{ url('/add-staff-type') }}" class="common-btn active rem-m">Add Staff Type</a>
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
                       <th>Staff Type</th>
                       <th>Status</th>
                       <th>Created At</th>
                       <th>Created By</th>
                       <th>Action</th>
                    </tr>
                 </thead>
                 <tbody>
                  <?php $i = 1; ?>
                  @foreach($staff_type as $each_val)

                    @if($each_val->staff_type_id!=1)
                    <tr>
                       <td>{{ $i }}</td>
                       <td>{{ ucfirst($each_val->staff_type_name) }}</td>
                       <td>{{ ucfirst($each_val->staff_type_status) }}</td>
                       <td>{{ $each_val->created_at }}</td>

                       <td>{{ ucfirst($each_val['AdminName']['staff_name']) }}</td>
                       <td>
                          <ul class="delete-btn">
                             <li><a href="{{ url('/edit-staff-type/'.base64_encode($each_val->staff_type_id)) }}"><i style="color:#0055a6" class="far fa-edit"></i></a></li>
                             <li><a href="{{ url('/delete-staff-type/'.base64_encode($each_val->staff_type_id)) }}" onclick="javascript:return confirm('Are you sure to delete it?')"><i style="color:#ff0000" class="fas fa-trash-alt"></i></a></li>
                          </ul>
                       </td>
                    </tr>
                     <?php $i++; ?>
                    @endif
                 
                  @endforeach
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
<!--for last table and searching & shorting table ,add one css and two js file -->
<script type="text/javascript" src="public/admin_assets/js/jquery.dataTables.js"></script>
<script type="text/javascript" src="public/admin_assets/js/dataTables.bootstrap.js"></script>
<script>
   $(document).ready(function() {
     $('#example').DataTable();
   });
</script>
@endsection
<!-- Footer -->