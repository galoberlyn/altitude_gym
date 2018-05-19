<!DOCTYPE html>
<html lang="en" data-textdirection="ltr" class="loading">
  <head>
    @include('admin.layouts.css_links')
    <title>Altitude Gym | Expiring Memberships</title>
  </head>
  <body data-open="click" data-menu="vertical-menu" data-col="2-columns" class="vertical-layout vertical-menu 2-columns  fixed-navbar">
    @include('admin.layouts.nav')
    @include('admin.layouts.main_menu')
    <div class="app-content content container-fluid">
      <div class="content-wrapper">
        <div class="content-header row">
		</div>
		  <div class = "content-body">
            @include('admin.layouts.app-stats')
		  </div>
			
		<div class="row">
			<div class="col-xl-12 col-lg-12">
				<div class="card">
					<div class="card-header table-inverse">
						<h4 class="card-title"><i class="icon-alert"></i>Expiring Memberships for the Week</h4>
						<a class="heading-elements-toggle"><i class="icon-ellipsis font-medium-3"></i></a>
							<div class="heading-elements">
								<ul class="list-inline mb-0">
									<li><a data-action="expand"><i class="icon-expand2"></i></a></li>
								</ul>
							</div>
					</div>
				
					<div id="headingCollapse1"  class="card-header">
					  <a data-toggle="collapse" href="#collapse1" aria-expanded="false" aria-controls="collapse1" class="card-title lead collapsed">Expired Memberships</a>
					</div>
						<div id="collapse1" role="tabpanel" aria-labelledby="headingCollapse1" class="card-collapse collapse" aria-expanded="false">
						  <div class="card-body">
							<div class="card-block">
							   <table class="table table-hover">
									<thead style="background-color:#c7bedd">
										<tr>
											<th>Member ID<i class="icon-profile"></i></th>
											<th>Member Name<i class="icon-pencil2"></i></th>
											<th>Expiration Date<i class="icon-calendar3"></i></th>
											<th>Amount<i class="icon-money"></i></th>
											<th>Action<i class="icon-question-circle"></i></th>
										</tr>
									</thead>
								</thead>

									<tbody>
									  @foreach($exp_mem as $exp_mbr)
										<tr>
											<td> {{ $exp_mbr-> id_number}} </td>
											<td><span class="avatar"><img src="../../uploads/avatars/{{ strtolower($exp_mbr -> avatar) }}" alt="{{$exp_mbr -> avatar}}"></span></span> {{ $exp_mbr-> first_name}} {{ $exp_mbr-> last_name}} </td>
											<td> {{ $exp_mbr-> expiration_date}} </td>
											<td>&nbsp;&nbsp;&nbsp;&nbsp; {{ $exp_mbr-> amount}} </td>
											{!! Form::open ([ 'action' => 'AdminExpirationsController@payment', 'method' => 'POST']) !!}
												{{Form::text('user_id', $exp_mbr->user_id, ['class' => 'hidden form-control round border-success', 'placeholder' => "The user's first name"])}}
												{{Form::text('amount', $exp_mbr->amount, ['class' => 'hidden form-control round border-success', 'placeholder' => "The user's first name"])}}
												{{Form::text('subscription', $exp_mbr->subscription, ['class' => 'hidden form-control round border-success', 'placeholder' => "The user's first name"])}}
											<td>{{Form::submit('Paid', ['class'=>'btn btn-primary'])}}</td>
											{!! Form::close() !!} 
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
									<thead style="background-color:#c7bedd">
										<tr>
											<th>Member ID<i class="icon-profile"></i></th>
											<th>Member Name<i class="icon-pencil2"></i></th>
											<th>Expiration Date<i class="icon-calendar3"></i></th>
											<th>Amount<i class="icon-money"></i></th>
											<th>Action<i class="icon-question-circle"></i></th>
										</tr>
									</thead>
								
								  <tbody>
											@foreach($payments as $payment)
											<tr>
												<td>{{ $payment-> id_number}} </td>
												<td><span class="avatar"><img src="../../uploads/avatars/{{ strtolower($payment -> avatar) }}" alt="{{$payment -> avatar}}"></span> {{ $payment-> first_name}} {{ $payment-> last_name}} </td>
												<td> {{ $payment-> expiration_date}} </td>
												<td>&nbsp;&nbsp;&nbsp;&nbsp; {{ $payment-> amount}} </td>
												{!! Form::open ([ 'action' => 'AdminExpirationsController@payment', 'method' => 'POST']) !!}
												{{Form::text('user_id', $payment->user_id, ['class' => 'hidden form-control round border-success', 'placeholder' => "The user's first name"])}}
												{{Form::text('amount', $payment->amount, ['class' => 'hidden form-control round border-success', 'placeholder' => "The user's first name"])}}
												{{Form::text('subscription', $payment->subscription, ['class' => 'hidden form-control round border-success', 'placeholder' => "The user's first name"])}}
												<td>{{Form::submit('Paid', ['class'=>'btn btn-primary'])}}</td>
												{!! Form::close() !!} 
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
									<thead style="background-color:#c7bedd">
										<tr>
											<th>Member ID<i class="icon-profile"></i></th>
											<th>Member Name<i class="icon-pencil2"></i></th>
											<th>Expiration Date<i class="icon-calendar3"></i></th>
											<th>Amount<i class="icon-money"></i></th>
											<th>Action<i class="icon-question-circle"></i></th>
										</tr>
									</thead>
								
									<tbody>
									  @foreach($expiring as $expire)
										<tr>
										  <td>{{ $expire-> id_number}} </td>
										  <td><span class="avatar"><img src="../../uploads/avatars/{{ strtolower($expire -> avatar) }}" alt="{{$expire -> avatar}}"></span> {{ $expire-> first_name}} {{ $expire-> last_name}} </td>
										  <td> {{ $expire-> expiration_date}} </td>
										  <td>&nbsp;&nbsp;&nbsp;&nbsp; {{ $expire-> amount}} </td>
												{!! Form::open ([ 'action' => 'AdminExpirationsController@payment', 'method' => 'POST']) !!}
												{{Form::text('user_id', $expire->user_id, ['class' => 'hidden form-control round border-success', 'placeholder' => "The user's first name"])}}
												{{Form::text('amount', $expire->amount, ['class' => 'hidden form-control round border-success', 'placeholder' => "The user's first name"])}}
												{{Form::text('subscription', $expire->subscription, ['class' => 'hidden form-control round border-success', 'placeholder' => "The user's first name"])}}
												<td>{{Form::submit('Paid', ['class'=>'btn btn-primary'])}}</td>
												{!! Form::close() !!} 
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
										<thead style="background-color:#c7bedd">
											  <tr>
												<th>Member ID<i class="icon-profile"></i></th>
												<th>Member Name<i class="icon-pencil2"></i></th>
												<th>Expiration Date<i class="icon-calendar3"></i></th>
												<th>Amount<i class="icon-money"></i></th>
												<th>Action<i class="icon-question-circle"></i></th>
											  </tr>
											</thead>
											<tbody>
												@foreach($expired as $expire_1)
												<tr>   
													<td>{{ $expire_1-> id_number}} </td>
													<td><span class="avatar"><img src="../../uploads/avatars/{{ strtolower($expire_1 -> avatar) }}" alt="{{$expire_1 -> avatar}}"></span> {{ $expire_1-> first_name}} {{ $expire_1-> last_name}} </td>
													<td> {{ $expire_1-> expiration_date}} </td>
													<td>&nbsp;&nbsp;&nbsp;&nbsp; {{ $expire_1-> amount}} </td>
													{!! Form::open ([ 'action' => 'AdminExpirationsController@payment', 'method' => 'POST']) !!}
													{{Form::text('user_id', $expire_1->user_id, ['class' => 'hidden form-control round border-success', 'placeholder' => "The user's first name"])}}
													{{Form::text('amount', $expire_1->amount, ['class' => 'hidden form-control round border-success', 'placeholder' => "The user's first name"])}}
													{{Form::text('subscription', $expire_1->subscription, ['class' => 'hidden form-control round border-success', 'placeholder' => "The user's first name"])}}
													<td>{{Form::submit('Paid', ['class'=>'btn btn-primary'])}}</td>
													{!! Form::close() !!} 
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
										<thead style="background-color:#c7bedd">
										  <tr>
											<th>Member ID<i class="icon-profile"></i></th>
											<th>Member Name<i class="icon-pencil2"></i></th>
											<th>Expiration Date<i class="icon-calendar3"></i></th>
											<th>Amount<i class="icon-money"></i></th>
											<th>Action<i class="icon-question-circle"></i></th>
										  </tr>
										</thead>
										<tbody>
											@foreach($exp as $expire_2)
												<tr>   
													<td>{{ $expire_2-> id_number}} </td>
													<td><span class="avatar"><img src="../../uploads/avatars/{{ strtolower($expire_2 -> avatar) }}" alt="{{$expire_2 -> avatar}}"></span> {{ $expire_2-> first_name}} {{ $expire_2-> last_name}} </td>
													<td> {{ $expire_2-> expiration_date}} </td>
													<td>&nbsp;&nbsp;&nbsp;&nbsp; {{ $expire_2-> amount}} </td>
													{!! Form::open ([ 'action' => 'AdminExpirationsController@payment', 'method' => 'POST']) !!}
													{{Form::text('user_id', $expire_2->user_id, ['class' => 'hidden form-control round border-success', 'placeholder' => "The user's first name"])}}
													{{Form::text('amount', $expire_2->amount, ['class' => 'hidden form-control round border-success', 'placeholder' => "The user's first name"])}}
													{{Form::text('subscription', $expire_2->subscription, ['class' => 'hidden form-control round border-success', 'placeholder' => "The user's first name"])}}
													<td>{{Form::submit('Paid', ['class'=>'btn btn-primary'])}}</td>
													{!! Form::close() !!}
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
										<thead style="background-color:#c7bedd">
										  <tr>
											<th>Member ID<i class="icon-profile"></i></th>
											<th>Member Name<i class="icon-pencil2"></i></th>
											<th>Expiration Date<i class="icon-calendar3"></i></th>
											<th>Amount<i class="icon-money"></i></th>
											<th>Action<i class="icon-question-circle"></i></th>
										  </tr>
										</thead>
										<tbody>
											@foreach($exp_mem5 as $expire_5)
											<tr>
												<td> {{ $expire_5-> id_number}} </td>
												<td><span class="avatar"><img src="../../uploads/avatars/{{ strtolower($expire_5 -> avatar) }}" alt="{{$expire_5 -> avatar}}"></span> {{ $expire_5-> first_name}} {{ $expire_5-> last_name}} </td>
												<td> {{ $expire_5-> expiration_date}} </td>
												<td>&nbsp;&nbsp;&nbsp;&nbsp; {{ $expire_5-> amount}} </td>
													{!! Form::open ([ 'action' => 'AdminExpirationsController@payment', 'method' => 'POST']) !!}
													{{Form::text('user_id', $expire_5->user_id, ['class' => 'hidden form-control round border-success', 'placeholder' => "The user's first name"])}}
													{{Form::text('amount', $expire_5->amount, ['class' => 'hidden form-control round border-success', 'placeholder' => "The user's first name"])}}
													{{Form::text('subscription', $expire_5->subscription, ['class' => 'hidden form-control round border-success', 'placeholder' => "The user's first name"])}}
													<td>{{Form::submit('Paid', ['class'=>'btn btn-primary'])}}</td>
													{!! Form::close() !!}
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
										<thead style="background-color:#c7bedd">
										  <tr>
											<th>Member ID<i class="icon-profile"></i></th>
											<th>Member Name<i class="icon-pencil2"></i></th>
											<th>Expiration Date<i class="icon-calendar3"></i></th>
											<th>Amount<i class="icon-money"></i></th>
											<th>Action<i class="icon-question-circle"></i></th>
										  </tr>
										</thead>
										<tbody>
											@foreach($exp_mem6 as $expire_6)
											<tr>
												<td>{{ $expire_6-> id_number}} </td>
												<td><span class="avatar"><img src="../../uploads/avatars/{{ strtolower($expire_6 -> avatar) }}" alt="{{$expire_6 -> avatar}}"></span> {{ $expire_6-> first_name}} {{ $expire_6-> last_name}} </td>
												<td> {{ $expire_6-> expiration_date}} </td>
												<td>&nbsp;&nbsp;&nbsp;&nbsp; {{ $expire_6-> amount}} </td>
													{!! Form::open ([ 'action' => 'AdminExpirationsController@payment', 'method' => 'POST']) !!}
													{{Form::text('user_id', $expire_6->user_id, ['class' => 'hidden form-control round border-success', 'placeholder' => "The user's first name"])}}
													{{Form::text('amount', $expire_6->amount, ['class' => 'hidden form-control round border-success', 'placeholder' => "The user's first name"])}}
													{{Form::text('subscription', $expire_6->subscription, ['class' => 'hidden form-control round border-success', 'placeholder' => "The user's first name"])}}
													<td>{{Form::submit('Paid', ['class'=>'btn btn-primary'])}}</td>
													{!! Form::close() !!}
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
										<thead style="background-color:#c7bedd">
										  <tr>
											<th>Member ID<i class="icon-profile"></i></th>
											<th>Member Name<i class="icon-pencil2"></i></th>
											<th>Expiration Date<i class="icon-calendar3"></i></th>
											<th>Amount<i class="icon-money"></i></th>
											<th>Action<i class="icon-question-circle"></i></th>
										  </tr>
										</thead>
										<tbody>
											@foreach($exp_mem7 as $expire_7)
											<tr>
												<td>{{ $expire_7-> id_number}} </td>
												<td><span class="avatar"><img src="../../uploads/avatars/{{ strtolower($expire_7 -> avatar) }}" alt="{{$expire_7 -> avatar}}"></span> {{ $expire_7-> first_name}} {{ $expire_7-> last_name}} </td>
												<td> {{ $expire_7-> expiration_date}} </td>
												<td>&nbsp;&nbsp;&nbsp;&nbsp; {{ $expire_7-> amount}} </td>
													{!! Form::open ([ 'action' => 'AdminExpirationsController@payment', 'method' => 'POST']) !!}
													{{Form::text('user_id', $expire_7->user_id, ['class' => 'hidden form-control round border-success', 'placeholder' => "The user's first name"])}}
													{{Form::text('amount', $expire_7->amount, ['class' => 'hidden form-control round border-success', 'placeholder' => "The user's first name"])}}
													{{Form::text('subscription', $expire_7->subscription, ['class' => 'hidden form-control round border-success', 'placeholder' => "The user's first name"])}}
													<td>{{Form::submit('Paid', ['class'=>'btn btn-primary'])}}</td>
													{!! Form::close() !!}
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