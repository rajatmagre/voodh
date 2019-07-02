@extends('layouts.app_admin')

  @section('content')
   <main class="page-content">
    <div class="container-fluid"> 
      <div class="breadcrumb1">
        <ul>
          <li><a href="{{ url('admin-dashboard') }}">Dashboard ></a></li>
          <li>Authorities List</li>
        </ul>
      </div>
      <!-- Breadcumb End -->
      <div class="form-wrapper2">
        <p class="alert alert-danger">You have no permission to perform this activity.</p>
      </div>
    </div> <!-- container fluid -->
  </main>
  <!-- page-content" -->
</div>
<!-- page-wrapper -->
  
  @endsection