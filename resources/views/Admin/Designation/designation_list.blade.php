@extends('layouts.app_admin')

  @section('content')
  <!-- sidebar-wrapper  -->
  <main class="page-content">
    <div class="container-fluid"> 
      <div class="breadcrumb1">
        <ul>
          <li><a href="{{ url('admin-dashboard') }}">Dashboard ></a></li>
          <li>Staff Designation List</li>
        </ul>
      </div>
      <!-- Breadcumb End -->
      <div class="form-wrapper2">
        <form>
          <div class="add-field1">
            <div class="row">
             <div class="col-md-12">
              <div class="text-right form-btn">
               <a href="{{ url('add-designation') }}" class="common-btn active rem-m">Add Designation</a>
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
                          <th>Designation Name</th>
                          <th>Created At</th>
                          <th>Created By</th>
                          <th>Action</th>
                      </tr>
                  </thead>
                  <tbody>
                    @forelse($designation_list as $des)
                      <tr>
                          <td>{{ $loop->iteration }}</td>
                          <td>{{ ucwords($des->designation_name) }}</td>
                          <td>{{ $des->created_at }}</td>
                          <td>{{ ucfirst($des->user_details->staff_name) }}</td>
                          <td>
                            <ul class="delete-btn">
                              <li><a href="{{ url('edit-designation/'.base64_encode($des->designation_id)) }}"><i style="color:#0055a6" class="far fa-edit"></i></a></li>
                              {{-- <li><a onclick="return confirm('Are you sure!')" href="{{ url('delete-designation/'.$des->designation_id) }}"><i style="color:#ff0000" class="fas fa-trash-alt"></i></a></li> --}}
                              <li><a href="javascript:void(0);" data-target="#myModal-delet{{$loop->iteration}}" data-toggle="modal"><i style="color:#ff0000" class="fas fa-trash-alt"></i></a></li>
                            </ul>
                          </td>
                      </tr>
                      <div id="myModal-delet{{$loop->iteration}}" class="modal fade myModal-delet" role="dialog">
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
                                    <button type="button" class="common-btn active rem-m" data-dismiss="modal"  onclick="delete_station('{{ base64_encode($des->designation_id) }}');" >Ok</button>
                                  </div>
                                </div>

                              </div>
                          </div>
                    @empty
                      <tr>
                          <td colspan="5">No record Found</td>
                          
                      </tr>
                    @endforelse
                  </tbody>
                </table>
             </div>
          </div>
      </form>
      </div>
    </div> <!-- container fluid -->
  </main>
  <!-- page-content" -->
</div>
<!-- page-wrapper -->

<script src="public/admin_assets/developer_validate/jquery.validate.min.js"></script>
<script src="public/admin_assets/developer_validate/custom_validate.js"></script>
<script type="text/javascript">
    $('#add-page-form').validate({
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
  <script type="text/javascript" src="public/admin_assets/js/jquery.dataTables.js"></script>
<script type="text/javascript" src="public/admin_assets/js/dataTables.bootstrap.js"></script>
<script>
    $(document).ready(function() {
      $('#example').DataTable();
    });

function delete_station(id)
 {
    window.location.href="{{ url('delete-designation') }}/"+id;
 }
</script>

@endsection
<!-- Footer -->

