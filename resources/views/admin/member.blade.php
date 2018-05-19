<!DOCTYPE html>
<html lang="en" data-textdirection="ltr" class="loading">
  <head>
    @include('admin.layouts.css_links')
	 <title>Altitude Gym | Member List</title>
  </head>
  
<body data-open="click" data-menu="vertical-menu" data-col="2-columns" class="vertical-layout vertical-menu 2-columns  fixed-navbar">
    @include('admin.layouts.nav')
    @include('admin.layouts.main_menu')
    <div class="app-content content container-fluid">
      <div class="content-wrapper">
        <div class="content-header row">
        </div>
        <div class="content-body">
@include('admin.layouts.app-stats')
</div>

<div class="row">
    <div class="col-xl-12 col-lg-12">
        <div class="card">
            <div class="card">
            <div class="card-header table-inverse">
                <h4 class="card-title"><i class="icon-ios-list-outline"></i>Member List</h4>
                <a class="heading-elements-toggle"><i class="icon-ellipsis font-medium-3"></i></a>

                <div class="heading-elements">
                    <ul class="list-inline mb-0">
                       
                        <li><a data-action="expand"><i class="icon-expand2"></i></a></li>
                    </ul>
                </div>
            </div>
			
             <div class="card-body">
				 <div class="card-block">     
					<div class="dropdown">
					<span class="float-xs-left">
						<form action="/sort" method="GET">
						{{ csrf_field() }}
							<span class="float-xs-right">
								<select onchange="this.form.submit()" type="text" name="sort" class="form-control">
									<option value="" selected>Choose Filter: </option>
									<option value="ASC">Ascending</option>
									<option value="DESC">Descending</option>
								</select>
							</span>
						</form>
					</span>

			<form action="/search" method="GET">
			{{ csrf_field() }}
			<span class="float-xs-right">
<button type="button" class="btn btn-primary float-xs-left" data-toggle="modal" data-target=".addlocker" style="margin-right: 25px;">Add Locker</button>
<input type="text" name="search" placeholder="Search.."></input>
<button type="submit" role="button" class="btn-group btn-group-xs btn-link"><span style="font-size:25px;" class="icon-ios-search-strong"></span></button>
							</span>                
						</form>
					</div>                                   
                </div>
				
                <div class="table-responsive">
                    <table id="myTable" class="tablesorter table table-hover mb-0">
      
                        <thead style="background-color:#D3D3D3">
                            <tr>
                                <th>Member Name</i></th>    
                                <th>Username</i></th>
                                <th>Locker Number</th>
                                <th>Show Payments</th>
                                <th>Edit Member</th>
                                <th>Assign Locker</th>
                                <th>Unassign Locker</th>
                            </tr>
                        </thead>
                        <tbody class="table-hover">
                          @foreach ($member as $members)
                         <form action="/locker" method="POST">
                        {{ csrf_field() }}
                            <tr>
                              <td> <span class="avatar">
                              <img src="../../uploads/avatars/{{ strtolower($members -> avatar) }}" alt="{{$members-> avatar}}"></img>
                              </span>   {!! $members -> first_name." ".$members -> last_name !!}</td>
                              <td>{{$members -> username}}</td>
                              <td>
                              @if( $members -> locker_number == null )
                                <i style="color:#d3d3d3">n/a</i>
                              @else
                                {{$members -> locker_number}}
                              @endif
                              </td>
                              <td>
                                <a href="/members/{{$members -> id}}" class = "btn btn-primary">Show Payments</a>
                              </td>
                              <td>
                                <a href="/members/{{$members -> id}}/edit" class = "btn btn-primary">Edit Member</a>
                              </td>

                              @if( $members -> locker_number == null )

                              <td><button type="button" class="btn btn-primary" data-toggle="modal" data-target=".assignlocker{{$members -> user_id}}">Assign Locker</button></td>

                              @else

                              <td><button type="button" class="btn btn-primary disabled" disabled="disabled" data-toggle="modal" data-target=".assignlocker{{$members -> user_id}}">Assign Locker</button></td>

                              @endif

                              <td>

                              @if( $members -> locker_number == null )
                              <button class="btn btn-danger disabled" disabled="disabled" style="color:white">Remove</a></td>
                              @else
                              <button onclick="return confirm('Unassign locker {{$members -> locker_number}} to {{$members -> first_name}}?')" type="submit" name="available" class="btn btn-danger" value="{{$members -> user_id}}">Remove</button></td>
                              @endif
                        </form>
                          
        <div class="modal fade assignlocker{{$members -> user_id}}" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                            <div class="modal-dialog1 modal-dialog1">
                              <div class="modal-content">
                                    <div class="modal-header">

                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    
                                    <h4 class="modal-title">Assign Locker</h4>

                                  </div>
                                  <div class="row">
                                  
                                   
                                  @foreach($admin_distinct as $a_distinct)
                                  <div class="col-md-6" style="margin-left: -0.6%;">

                                   <h1 style="margin-left: 15px;">{{$a_distinct->locker_set}}</h1>
                                   
                                  
                                  @foreach ($memLocker as $memL)
                                   @if(strpos($memL->locker_number, $a_distinct->locker_set) === 0)
                                  <div class="col-sm-2" style="margin-bottom: 5px;">
                                 <form action="/members_a" method="POST">
                                      {{ csrf_field() }}
                                  
                                    @if ($memL -> status == 'unavailable')
                                    
                                    <a href="#" class="btn btn-sq btn-danger disabled">
                                      <i class="icon-lock"></i></i><br/>
                                      {{$memL -> locker_number}}<br>
                                      {{$memL -> first_name}}{{$memL -> last_name}}<br><br>
                                      <span class="avatar">
                              <!-- <img src="../../uploads/avatars/{{ strtolower($memL -> avatar) }}" alt="{{$memL -> avatar}}"></img> -->
                              <img src="../../uploads/avatars/{{ strtolower($memL -> avatar)}}">
                              </span>
                                      
                                    </a>

                                    @else
                                     
                                   
                                    <button onclick="return confirm('Assign locker {{$memL -> locker_number}} to {{$members -> first_name}}?')"  class="btn btn-sq btn-success" type="submit" name="assign">
                                      <i class="icon-unlock-alt"></i><br/>
                                       <input name="identifier" id="identifier" hidden value="{{$members -> user_id}}"> 
                                      <input name="lockers" id="lockers" hidden value="{{$memL -> locker_number}}">{{$memL -> locker_number}}

                                    </button>
                                     
                                    @endif
                                  </form> 
                                    </div> 
                                    @endif
                                    
                                    @endforeach
                                </div>
                                @endforeach
                                <!-- end md -->
                                      
                                      </div>                              
                          @endforeach
                              </div>
                            </div>
                          </div>     


                          <div class="modal fade addlocker" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-sm">
                              <div class="modal-content">
                                    <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h3 class="modal-title">Add Locker</h3>
                                  </div>
                                  <form action="/add_locker" method="POST">
                                      {{ csrf_field() }} 
                                  <p>*maximum lockers per set is 30</p>
                                  <center>
                                  <b>Set:</b> <br><input type="text" name="set_a"><br>
                                  <p>ex. E</p>

                                  <b>Number of lockers:</b> <br><input type="text" name="lock_number"><br>
                                  <p>ex. 30</p>
                                  </center>
                                  <div class="modal-footer">
                                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                  <button type="submit" name="addlock" class="btn btn-success">Add</button>
                                </div>
                                </form>                                        

                              </div>
                            </div>
                          </div>  

                        </tbody>
                    </table>
                </div>

                <div class="text-xs-center">
                  {{$member ->links()}}
                </div>
            </div>
        </div>
    </div>
  </div>
</div>
    </div>
<!--End Member Table -->
        </div>
      </div>
    <!-- ////////////////////////////////////////////////////////////////////////////-->

<footer class="footer footer-static footer-light navbar-border">
      <p class="clearfix text-muted text-sm-center mb-0 px-2"><span class="float-md-center d-xs-block d-md-inline-block">Copyright  &copy; 2018 <b>ALTITUDEGYM</b> </a>, All rights reserved. </span></p>
    </footer>
    
    <!-- BEGIN VENDOR JS-->
    
    @include('admin.layouts.scripts')    
    <!-- END PAGE LEVEL JS-->
    <script type="text/javascript">
    $(document).ready(function() 
        { 
            $("#myTable").tablesorter(); 
        } 
    ); 
    </script>
  </body>
</html>
