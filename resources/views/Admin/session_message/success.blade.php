@if(Session::has('success'))
 <div class="row">
	<div class="col-md-12">
	<p class="alert alert-success">{{Session::get('success')}}</p>
	</div>
</div>
@endif