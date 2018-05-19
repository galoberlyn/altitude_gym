@if(count($errors) > 0)
	@foreach($errors->all() as $error)
		<div class = "alert alert-danger">
			<h5><center>{{$error}}</center></h5>
		</div>
	@endforeach
@endif

@if(session('success'))
	<div class = "alert alert-success">
		<h5><center>{{session('success')}}</center></h5>
	</div>
@endif

@if(session('error'))
	<div class = "alert alert-danger">
		<h5><center>{{session('error')}}</center></h5>
	</div>
@endif