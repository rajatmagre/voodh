<option value="">Select Category</option>
	@if(!empty($all_category))
	  @foreach($all_category as $each_category)
	   <option value="{{ $each_category->cat_id }}">{{ $each_category->cat_name }}</option>
	  @endforeach
	@endif