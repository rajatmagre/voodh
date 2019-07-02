@if(Session::has('error'))
<div class="row">
	<div class="col-md-12">
	<p class="alert alert-danger">{{Session::get('error')}}</p>
	</div>
</div>
@endif