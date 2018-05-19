<!DOCTYPE html>
<html lang="en" data-textdirection="ltr" class="loading">
  <head>
    @include('admin.layouts.css_links')
    <title>Altitude Gym | Expiring Locker Subscription</title>
  </head>
  <body data-open="click" data-menu="vertical-menu" data-col="2-columns" class="vertical-layout vertical-menu 2-columns  fixed-navbar">
    @include('admin.layouts.nav')
    @include('admin.layouts.main_menu')
    <div class="app-content content container-fluid">
      <div class="content-wrapper">
        <div class="content-header row">
			@include('admin.inc.message')
		</div>
		  <div class = "content-body">
            @include('admin.layouts.app-stats')
		  </div>
			
		<div class="row">

			


			<div class="col-xl-12 col-lg-12">
				<div class="card">
					<div class="card-header table-inverse">
						<h4 class="card-title"><i class="icon-lock"></i>Expiring Locker Subscriptions for the Week</h4>
						<a class="heading-elements-toggle"><i class="icon-ellipsis font-medium-3"></i></a>
							<div class="heading-elements">
								<ul class="list-inline mb-0">
									<li><a data-action="expand"><i class="icon-expand2"></i></a></li>
								</ul>
							</div>
					</div>
				
					<div id="headingCollapse1"  class="card-header">
					  <a data-toggle="collapse" href="#collapse1" aria-expanded="false" aria-controls="collapse1" class="card-title lead collapsed">Expired Locker Subscriptions</a>
					</div>
						<div id="collapse1" role="tabpanel" aria-labelledby="headingCollapse1" class="card-collapse collapse" aria-expanded="false">
						  <div class="card-body">
							<div class="card-block">
							   <table class="table table-hover">
								<thead style="background-color: #FF9999">
								  <tr>
									<th>Member ID     <i class="icon-pencil2"></i></th>
									<th>Member     <i class="icon-pencil"></i></th>
									<th>Locker Number     <i class="icon-lock"></th>
									<th>Expiration Date     <i class="icon-cross"></i></th>
								  </tr>
								</thead>

								<tbody>
								  @foreach($exp_lock as $locker)
											<tr>
												<td> {{ $locker-> id_number}} </td>
												<td><span class="avatar"><img src="../../uploads/avatars/{{ strtolower($locker -> avatar) }}" alt="{{$locker -> avatar}}"> {{ $locker-> first_name}} {{ $locker-> last_name}} </td>
												<td>{{ $locker-> locker_number}} </td>
												<td> {{ $locker-> date_expiry}} </td>
											</tr>
								  @endforeach
								</tbody>
							  </table>
							</div>
						  </div>
					  </div>
				

					<div id="headingCollapse2"  class="card-header">             
					  <a data-toggle="collapse" href="#collapse2" aria-expanded="false" aria-controls="collapse2" class="card-title lead collapsed">{{date('F j,Y')}}</a>
					</div>
						<div id="collapse2" role="tabpanel" aria-labelledby="headingCollapse2" class="card-collapse collapse" aria-expanded="false">
						  <div class="card-body">
							<div class="card-block">
							   <table class="table table-hover">
								<thead style="background-color: #FF9999">
								  <tr>
									<th>Member ID     <i class="icon-pencil2"></i></th>
									<th>Member     <i class="icon-pencil"></i></th>
									<th>Locker Number     <i class="icon-lock"></th>
									<th>Expiration Date     <i class="icon-cross"></i></th>
								  </tr>
								</thead>
								
								  <tbody>
									@foreach($exp_lock1 as $lock1)
										  <tr>
											  <td> {{ $lock1-> id_number}} </td>
											  <td><span class="avatar"><img src="../../uploads/avatars/{{ strtolower($lock1 -> avatar) }}" alt="{{$lock1 -> avatar}}"></span> {{ $lock1-> first_name}} {{ $lock1-> last_name}} </td>
											  <td> {{ $lock1-> locker_number}} </td>
											  <td> {{ $lock1-> date_expiry}} </td>
										  </tr>
									@endforeach
								   </tbody>
							  </table>
							</div>
						  </div>         
						</div>
						
						<div id="headingCollapse3"  class="card-header">
						  <a data-toggle="collapse" href="#collapse3" aria-expanded="false" aria-controls="collapse3" class="card-title lead collapsed"> {{date('F j,Y', strtotime('+ 1 day'))}}</a>
						</div>
							<div id="collapse3" role="tabpanel" aria-labelledby="headingCollapse3" class="card-collapse collapse" aria-expanded="false">
							  <div class="card-body">
								<div class="card-block">
								  <table class="table table-hover">
									<thead style="background-color: #FF9999">
									  <tr>
										<th>Member ID     <i class="icon-pencil2"></i></th>
										<th>Member     <i class="icon-pencil"></i></th>
										<th>Locker Number     <i class="icon-lock"></th>
										<th>Expiration Date     <i class="icon-cross"></i></th>
									  </tr>
									</thead>
								
									<tbody>
										@foreach($exp_lock2 as $lock2)
									  <tr>
										  <td>{{ $lock2-> id_number}} </td>
										  <td><span class="avatar"><img src="../../uploads/avatars/{{ strtolower($lock2 -> avatar) }}" alt="{{$lock2 -> avatar}}"></span> {{ $lock2-> first_name}} {{ $lock2-> last_name}} </td>
										  <td> {{ $lock2-> locker_number}} </td>
										  <td> {{ $lock2-> date_expiry}} </td>
									  </tr>
										@endforeach
									</tbody>
								  </table>
								</div>  
							  </div>
							</div>
							
							<div id="headingCollapse4"  class="card-header">
								<a data-toggle="collapse" href="#collapse4" aria-expanded="false" aria-controls="collapse4" class="card-title lead collapsed"> {{date('F j,Y', strtotime('+ 2 day'))}}</a>
								</div>
								<div id="collapse4" role="tabpanel" aria-labelledby="headingCollapse4" class="card-collapse collapse" aria-expanded="false">
								  <div class="card-body">
									<div class="card-block">
									  <table class="table table-hover">
										<thead style="background-color: #FF9999">
										  <tr>
											<th>Member ID     <i class="icon-pencil2"></i></th>
											<th>Member     <i class="icon-pencil"></i></th>
											<th>Locker Number     <i class="icon-lock"></th>
											<th>Expiration Date     <i class="icon-cross"></i></th>
										  </tr>
										</thead>
										<tbody>
											@foreach($exp_lock3 as $lock3)
										  <tr>
											  <td> {{ $lock3-> id_number}} </td>
											  <td><span class="avatar"><img src="../../uploads/avatars/{{ strtolower($lock3 -> avatar) }}" alt="{{$lock3 -> avatar}}"></span> {{ $lock3-> first_name}} {{ $lock3-> last_name}} </td>
											  <td> {{ $lock3-> locker_number}} </td>
											  <td> {{ $lock3-> date_expiry}} </td>
										  </tr>
											@endforeach
										</tbody>
									  </table>
									</div>
								  </div>
								</div>
	
								<div id="headingCollapse5"  class="card-header">
								  <a data-toggle="collapse" href="#collapse5" aria-expanded="false" aria-controls="collapse5" class="card-title lead collapsed">{{date('F j,Y', strtotime('+ 3 day'))}}</a>
								</div>
								<div id="collapse5" role="tabpanel" aria-labelledby="headingCollapse5" class="card-collapse collapse" aria-expanded="false">
								  <div class="card-body">
									<div class="card-block">
									  <table class="table table-hover">
										<thead style="background-color: #FF9999">
										  <tr>
											<th>Member ID     <i class="icon-pencil2"></i></th>
											<th>Member     <i class="icon-pencil"></i></th>
											<th>Locker Number     <i class="icon-lock"></th>
											<th>Expiration Date     <i class="icon-cross"></i></th>
										  </tr>
										</thead>
										<tbody>
										@foreach($exp_lock4 as $lock4)
										  <tr>
											  <td>{{ $lock4-> id_number}} </td>
											  <td><span class="avatar"><img src="../../uploads/avatars/{{ strtolower($lock4 -> avatar) }}" alt="{{$lock4 -> avatar}}"></span> {{ $lock4-> first_name}} {{ $lock4-> last_name}} </td>
											  <td> {{ $lock4-> locker_number}} </td>
											  <td> {{ $lock4-> date_expiry}} </td>
										  </tr>
										  @endforeach
										</tbody>
									  </table>
									</div>
								  </div>
								</div>
								
								<div id="headingCollapse6"  class="card-header">
								  <a data-toggle="collapse" href="#collapse6" aria-expanded="false" aria-controls="collapse6" class="card-title lead collapsed">{{date('F j,Y', strtotime('+ 4 day'))}}</a>
								</div>
								<div id="collapse6" role="tabpanel" aria-labelledby="headingCollapse6" class="card-collapse collapse" aria-expanded="false">
								  <div class="card-body">
									<div class="card-block">
									  <table class="table table-hover">
										<thead style="background-color: #FF9999">
										  <tr>
											<th>Member ID     <i class="icon-pencil2"></i></th>
											<th>Member     <i class="icon-pencil"></i></th>
											<th>Locker Number     <i class="icon-lock"></th>
											<th>Expiration Date     <i class="icon-cross"></i></th>
										  </tr>
										</thead>
										<tbody>
										@foreach($exp_lock5 as $lock5)
										  <tr>
											  <td>{{ $lock5-> id_number}} </td>
											  <td><span class="avatar"><img src="../../uploads/avatars/{{ strtolower($lock5 -> avatar) }}" alt="{{$lock5 -> avatar}}"></span> {{ $lock5-> first_name}} {{ $lock5-> last_name}} </td>
											  <td> {{ $lock5-> locker_number}} </td>
											  <td> {{ $lock5-> date_expiry}} </td>
										  </tr>
										  @endforeach
										</tbody>
									  </table>
									</div>
								  </div>
								</div>
								
								<div id="headingCollapse7"  class="card-header">
								  <a data-toggle="collapse" href="#collapse7" aria-expanded="false" aria-controls="collapse7" class="card-title lead collapsed">{{date('F j,Y', strtotime('+ 5 day'))}}</a>
								</div>
								<div id="collapse7" role="tabpanel" aria-labelledby="headingCollapse7" class="card-collapse collapse" aria-expanded="false">
								  <div class="card-body">
									<div class="card-block">
									  <table class="table table-hover">
										<thead style="background-color: #FF9999">
										  <tr>
											<th>Member ID     <i class="icon-pencil2"></i></th>
											<th>Member     <i class="icon-pencil"></i></th>
											<th>Locker Number     <i class="icon-lock"></th>
											<th>Expiration Date     <i class="icon-cross"></i></th>
										  </tr>
										</thead>
										<tbody>
										@foreach($exp_lock6 as $lock6)
										  <tr>
											  <td>{{ $lock6-> id_number}} </td>
											  <td><span class="avatar"><img src="../../uploads/avatars/{{ strtolower($lock6 -> avatar) }}" alt="{{$lock6 -> avatar}}"></span> {{ $lock6-> first_name}} {{ $lock6-> last_name}} </td>
											  <td> {{ $lock6-> locker_number}} </td>
											  <td> {{ $lock6-> date_expiry}} </td>
										  </tr>
										  @endforeach
										</tbody>
									  </table>
									</div>
								  </div>
								</div>
								
								<div id="headingCollapse8"  class="card-header">
								  <a data-toggle="collapse" href="#collapse8" aria-expanded="false" aria-controls="collapse8" class="card-title lead collapsed">{{date('F j,Y', strtotime('+ 6 day'))}}</a>
								</div>
								<div id="collapse8" role="tabpanel" aria-labelledby="headingCollapse8" class="card-collapse collapse" aria-expanded="false">
								  <div class="card-body">
									<div class="card-block">
									  <table class="table table-hover">
										<thead style="background-color: #FF9999">
										  <tr>
											<th>Member ID     <i class="icon-pencil2"></i></th>
											<th>Member     <i class="icon-pencil"></i></th>
											<th>Locker Number     <i class="icon-lock"></th>
											<th>Expiration Date     <i class="icon-cross"></i></th>
										  </tr>
										</thead>
										<tbody>
										@foreach($exp_lock7 as $lock7)
										  <tr>
											  <td>{{ $lock7-> id_number}} </td>
											  <td><span class="avatar"><img src="../../uploads/avatars/{{ strtolower($lock7 -> avatar) }}" alt="{{$lock7 -> avatar}}"></span> {{ $lock7-> first_name}} {{ $lock7-> last_name}} </td>
											  <td> {{ $lock7-> locker_number}} </td>
											  <td> {{ $lock7-> date_expiry}} </td>
										  </tr>
										  @endforeach
										</tbody>
									  </table>
									</div>
								  </div>
								</div>
		
		</div>
		</div>
			
			
		</div>
	  </div>
	</div>
	
    <footer class="footer footer-static footer-light navbar-border">
      <p class="clearfix text-muted text-sm-center mb-0 px-2"><span class="float-md-center d-xs-block d-md-inline-block">Copyright  &copy; 2018 <b>ALTITUDEGYM</b> </a>, All rights reserved. </span></p>
    </footer>
    @include('admin.layouts.scripts')    
    <!-- END PAGE LEVEL JS-->
  </body>

</html>