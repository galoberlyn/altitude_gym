<!DOCTYPE html>
<html lang="en" data-textdirection="ltr" class="loading">
  <head>
    @include('admin.layouts.css_links')
    <title>Altitude Gym | Show Member</title>
  </head>
  <body data-open="click" data-menu="vertical-menu" data-col="2-columns" class="vertical-layout vertical-menu 2-columns  fixed-navbar">
    @include('admin.layouts.nav') @include('admin.layouts.main_menu')
    <div class="app-content content container-fluid">
        <div class="content-body"><!-- Description -->
          {{ csrf_field() }}
<section id="description" class="card">
    <div class="card-body collapse in">
			<a class=" float-xs-right" href = '/members'><i class="icon-arrow-left"></i>  Back to Member List</a>
        <div class="card-block">
        <div class="content-header row text-xs-center blue-grey">
           @include('admin.inc.message')
            <h2 class="content-header-title"><i class="icon-ios-person"></i>Member Information for {{$member->first_name}} {{$member->last_name}}<i class="icon-ios-person"></i></h2>
			@if($member->rfid_number == 0 || $member->rfid_number == null)
            <h4>    ID Number: {{$member->id_number}}</h4><h4>    RFID Number: None Yet</h4>
			@else
			<h4>    ID Number: {{$member->id_number}}</h4><h4>    RFID Number: {{$member->rfid_number}}</h4>	
			@endif
          </div>
            <div class="tab-content px-1 pt-1">
              <div role="tabpanel" class="tab-pane active" id="tab1" aria-expanded="true" aria-labelledby="base-tab1">
              <div class="col-md-6 col-sm-12">
                <form class="form-horizontal">
                           <h4><i class="icon-profile"></i>Details</h4>
                          <table class = "table-bordered table-striped table-info" width = 100%>
                            <tr>
                              <td style = "padding:5px"><b>Avatar</b></td>
                              <td style = "padding:5px"><img src="../../uploads/avatars/{{ strtolower($member -> avatar) }}" alt="{{$member -> avatar}}"></img></td>
                            </tr>
                            <tr>
                              <td style = "padding:5px"><b>Username</b></td>
                              <td style = "padding:5px">{{$member->username}}</td>
                            </tr>
                            <tr>
                              <td style = "padding:5px"><b>First name</b></td>
                              <td style = "padding:5px">{{$member->first_name}}</td>
                            </tr>
                            <tr>
                              <td style = "padding:5px"><b>Last name</b></td>
                              <td style = "padding:5px">{{$member->last_name}}</td>
                            </tr>
                            <tr>
                              <td style = "padding:5px"><b>Last name</b></td>
                              <td style = "padding:5px">{{$member->middle_initial}}</td>
                            </tr>
                            <tr>
                              <td style = "padding:5px"><b>Sex</b></td>
                              <td style = "padding:5px">{{$member->sex}}</td>
                            </tr>
                            <tr>
                              <td style = "padding:5px"><b>Birthdate</b></td>
                              <td style = "padding:5px">{{$member->birthdate}}</td>
                            </tr>
                            <tr>
                              <td style = "padding:5px"><b>Address</b></td>
                              <td style = "padding:5px">{{$member->address}}</td>
                            </tr>
                            <tr>
                              <td style = "padding:5px"><b>Contact number</b></td>
                              <td style = "padding:5px">{{$member->contact_no}}</td>
                            </tr>
                            <tr>
                              <td style = "padding:5px"><b>Civil status</b></td>
                              <td style = "padding:5px">{{$member->civil_status}}</td>
                            </tr>
                            <tr>
                              <td style = "padding:5px"><b>Email address</b></td>
                              <td style = "padding:5px">{{$member->email_address}}</td>
                            </tr>
                            <tr>
                              <td style = "padding:5px"><b>Occupation</b></td>
                              <td style = "padding:5px">{{$member->occupation}}</td>
                            </tr>
                            <tr>
                              <td style = "padding:5px"><b>School or workplace</b></td>
                              <td style = "padding:5px">{{$member->school_workplace}}</td>
                            </tr>
                            <tr>
                              <td style = "padding:5px"><b>Has used a gym before?</b></td>
                              <td style = "padding:5px">{{$member->used_gym}}</td>
                            </tr>
                            <tr>
                              <td style = "padding:5px"><b>Medical condition</b></td>
                              <td style = "padding:5px">{{$member->medical_condition}}</td>
                            </tr>
                            <tr>
                              <td style = "padding:5px"><b>Emergency contact</b></td>
                              <td style = "padding:5px">{{$member->emergency_contact}}</td>
                            </tr>
                            <tr>
                              <td style = "padding:5px"><b>Emergency number</b></td>
                              <td style = "padding:5px">{{$member->emergency_no}}</td>
                            </tr>
                            <tr>
                              <td style = "padding:5px"><b>Profile status</b></td>
                              <td style = "padding:5px">{{$member->profile_status}}</td>
                            </tr>
                            </table>
            <br>
              <a href="/members/{{$member->id}}/change_pw" class="btn btn-danger">Reset password</a>

             </div>
                            
              <div class="col-md-6 col-sm-12">
                <form class="form-horizontal">
                            <h4><i class="icon-file-zip"></i>Subscription Records</h4>
                            @if(count($records) > 0)
                            <table class = "table-bordered table-hover table-striped table-warning" width = 100%>
                              <thead>
                                <tr>
                                  <th style = "padding:5px">Subscription</th>
                                  <th style = "padding:5px">Amount</th>
                                  <th style = "padding:5px">Date of subscription</th>
                                  <th style = "padding:5px">Expiration date</th>
                                  <th style = "padding:5px">Status</th>
                                </tr> 
                              </thead>
                              <tbody>
                              @foreach ($records as $record)
                                <tr>
                                  <td style = "padding:5px">{{$record->subscription}}</td>
                                  <td style = "padding:5px">{{$record->amount}}</td>
                                  <td style = "padding:5px">{{$record->date_subscription}}</td>
                                  <td style = "padding:5px">{{$record->expiration_date}}</td>
								  @if ($record->payment_status == 'paid')
                                  <td style = "padding:5px"  class = "success">{{$record->payment_status}}</td>
								  @else
								  <td style = "padding:5px"  class = "danger">{{$record->payment_status}}</td>
								  @endif
                                </tr>
                              @endforeach
                            </tr>
                            </table>
                            @else
                            <i>No subscription records yet.</i><br/>
                            @endif
                            <br>
                            
							<h4><i class="icon-lock"></i>Locker Rent Records</h4>
                            <h5>Current subscription</h5>
                            @if(count($current_locker) > 0)
                            <table class = "table-hover table-striped table-bordered table-success" width = 100%>
                              <thead>
                                <tr>
                                  <th style = "padding:5px">Locker number</th>
                                  <th style = "padding:5px">Date subscription</th>
                                  <th style = "padding:5px">Date expiry</th>
                                  <th style = "padding:5px">Amount</th>
                                </tr> 
                              </thead>
                              <tbody>
                              @foreach ($current_locker as $c)
                                <tr>
                                  <td style = "padding:5px">{{$c->locker_number}}</td>
                                  <td style = "padding:5px">{{$c->date_subscription}}</td>
                                  <td style = "padding:5px">{{$c->date_expiry}}</td>
                                  <td style = "padding:5px">{{$c->amount}}</td>
                                </tr>
                              @endforeach
                            </table>
                            @else
                            The member is not currently renting a locker.<br/><br/>
                            @endif

                            <h5>Rent history</h5><i>(Includes the current subscription)</i><br>
                            @if(count($lockers) > 0)
                            <table class = "table-hover table-striped table-bordered table-danger" width = 100%>
                              <thead>
                                <tr>
								  <th style = "padding:5px">Locker number</th>
                                  <th style = "padding:5px">Payment date</th>
                                  <th style = "padding:5px">Amount</th>
                                </tr> 
                              </thead>
                              <tbody>
                              @foreach ($lockers as $locker)
                                <tr>
								  <td style = "padding:5px">{{$locker->locker_number}}</td>
                                  <td style = "padding:5px">{{$locker->payment_date}}</td>
                                  <td style = "padding:5px">{{$locker->amount}}</td>
                                </tr>
                              @endforeach
                            </table>
                            @else
                            <i>The member has no rent history yet.</i>
                            @endif


                            </fieldset>
                            </form>
              </div>
             
            </div>
             {!! Form::close() !!} 
          
          </div>
    </div>
        
</section>

<!--/ Description -->


        </div>
      </div>
    </div>

    @include('admin.layouts.scripts') 
    <footer class="footer footer-static footer-light navbar-border">
      <p class="clearfix text-muted text-sm-center mb-0 px-2"><span class="float-md-center d-xs-block d-md-inline-block">Copyright  &copy; 2018 <b>ALTITUDEGYM</b> </a>, All rights reserved. </span></p>
    </footer>
  </body>
</html>