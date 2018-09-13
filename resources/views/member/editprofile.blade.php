<!DOCTYPE html>
<html lang="en" data-textdirection="ltr" class="loading">
    
    @include('member.layouts.head')
    <title>Edit Profile</title>
    
  <body data-open="click" data-menu="vertical-menu" data-col="2-columns" class="vertical-layout vertical-menu 2-columns  fixed-navbar">
    
    @include('member.layouts.nav')
    
    @include('member.layouts.main_menu')

             @foreach($name_result as $username)
            @endforeach
              
    @include('member.layouts.notification')
    
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
	
    <div class="app-content content container-fluid">
      <div class="content-wrapper">
        <div class="content-header row">
        </div>
        <div class="content-body"><!-- stats -->
        <section class="flexbox-container">
        <div class="col-md-12">
            <div class="card">
               <div class="card-header">
					<h4 class="card-title" id="basic-layout-form">Edit Profile</h4>
					<a class="heading-elements-toggle"><i class="icon-ellipsis font-medium-3"></i></a>
				</div>
                <div class="card-body collapse in">
                <div class="card-block">
                   <div class="container">
            <form class="form-horizontal" role="form" enctype="multipart/form-data" action="/editprofile" method="POST">
              {{ csrf_field() }}
                        <div class="form-body">
                            <div class="row">
                               
                                <div class="col-md-4">
                                <h3>{{ $username->name }}</h3>
										<div class="form-group">
				@foreach($dp as $pic)
          @endforeach
          
            <img src="/uploads/avatars/{{ $pic->avatar }}" style="width:200px; height:200px; border-radius:50%; margin-right:25px;">
                <p class="text-xs">    
                Update profile image
               </p>
                <input type="file" name="avatar">
                <input type="hidden" name="_token" value="{{ csrf_token() }}"><br>
               <!--  <input type="submit" class="pull-right btn btn-sm btn-primary"> -->
										</div>
									</div>
                            </div>
                            
                                <h3>Personal info</h3>
                            
        @foreach($details as $user_details)
        @endforeach
									    
									    
							    		    <div class="row">
							    		    <div class="form-group">
									<div class="col-md-3">
									        <label class="control-label">First Name</label>
									    </div>
                           
                                       <div class="col-md-6">     
                                        <input name="first_name" class="form-control" type="text" value="{{$user_details->first_name}}">   
                                       </div>
									</div>
                                      
							    		    </div>
                                      
                                      <div class="row">
                                          <div class="form-group">
                                              <div class="col-md-3">
                                                  <label for="">Last Name</label>
                                              </div>
                                              
                                              <div class="col-md-6">
                                                  <input name="last_name" class="form-control" type="text" value="{{$user_details->last_name}}">
                                              </div>
                                          </div>
                                      </div>
                                      
                                      <div class="row">
                                          <div class="form-group">
                                              <div class="col-md-3">
                                                  <label for="">Middle Initial</label>
                                              </div>
                                              
                                              <div class="col-md-6">
                                                  <input name="middle_initial" maxlenght="1" class="form-control" type="text" value="{{$user_details->middle_initial}}">
                                              </div>
                                          </div>
                                      </div>
                                      
                                      <div class="row">
                                          <div class="form-group">
                                              <div class="col-md-3">
                                                  <label for="">Company/School</label>
                                              </div>
                                              
                                              <div class="col-md-6">
                                                  <input name="school_workplace" class="form-control" type="text" value="{{$user_details->school_workplace}}">
                                              </div>
                                          </div>
                                      </div>
                                      
                                      <div class="row">
                                          <div class="form-group">
                                              <div class="col-md-3">
                                                  <label for="">Address</label>
                                              </div>
                                              
                                              <div class="col-md-6">
                                                  <input name="address" class="form-control" type="text" value="{{$user_details->address}}">
                                              </div>
                                          </div>
                                      </div>
                                      
                                      <div class="row">
                                          <div class="form-group">
                                              <div class="col-md-3">
                                                  <label for="">Email</label>
                                              </div>
                                              
                                              <div class="col-md-6">
                                                  <input name="email_address" class="form-control" type="email" value="{{$user_details->email_address}}">
                                              </div>
                                          </div>
                                      </div>
                                      
                                      <div class="row">
                                          <div class="form-group">
                                              <div class="col-md-3">
                                                  <label for="">Height</label>
                                              </div>
                                              
                                              <div class="col-md-6">
                                                  <input name="height" class="form-control" type="text" value="Pending">
                                              </div>
                                          </div>
                                      </div>
                                      
                                      <div class="row">
                                          <div class="form-group">
                                              <div class="col-md-3">
                                                  <label for="">Weight</label>
                                              </div>
                                              
                                              <div class="col-md-6">
                                                  <input name="weight" class="form-control" type="text" value="Pending">
                                              </div>
                                          </div>
                                      </div>
                                      
                                      <div class="row">
                                          <div class="form-group">
                                              <div class="col-md-3">
                                                  <label for="">Occupation</label>
                                              </div>
                                              
                                              <div class="col-md-6">
                                                  <input name="occupation" class="form-control" type="text" value="{{$user_details->occupation}}">
                                              </div>
                                          </div>
                                      </div>
                                      
                                      <div class="row">
                                          <div class="form-group">
                                              <div class="col-md-3">
                                                  <label for="">Contact</label>
                                              </div>
                                              
                                              <div class="col-md-6">
                                                  <input name="contact_no" class="form-control" type="text" value="{{$user_details->contact_no}}">
                                              </div>
                                          </div>
                                      </div>
                                      
                                      <div class="row">
                                          <div class="form-group">
                                              <div class="col-md-3">
                                                  <label for="">Contact Person</label>
                                              </div>
                                              
                                              <div class="col-md-6">
                                                  <input name="emergency_contact" class="form-control" type="text" value="{{$user_details->emergency_contact}}">
                                              </div>
                                          </div>
                                      </div>
                                      
                                      <div class="row">
                                          <div class="form-group">
                                              <div class="col-md-3">
                                                  <label for="">Contact Person No.</label>
                                              </div>
                                              
                                              <div class="col-md-6">
                                                  <input name="emergency_no" class="form-control" type="text" value="{{$user_details->emergency_no}}">
                                              </div>
                                          </div>
                                      </div>
                                      
                                      <div class="row">
                                          <div class="form-group">
                                              <div class="col-md-3">
                                                  <label for="">Privacy</label>
                                              </div>
                                              
                                              <div class="col-md-6">
                                                  <div class="ui-select">
                <select id="user_time_zone" class="form-control" name="profile_status">
                  <option value="{{$user_details->profile_status}}">My profile Status: {{$user_details->profile_status}} </option>
                  <option value="Public">Public Profile</option>
                  <option value="Private">Private Profile</option>
                </select>
              </div>
                                              </div>
                                          </div>
                                      </div>
                                      
                                      <div class="row">
                                          <div class="form-group">
                                              <div class="col-md-3">
                                                  <label for="">Used a gym before?</label>
                                              </div>
                                              
                                              <div class="col-md-6">
                                                  <div class="ui-select" name="used_gym">
                <select id="user_time_zone" class="form-control">
                  <option value="Yes">Yes</option>
                  <option value="No">No</option>
                </select>
              </div>
                                             
                                             <div class="row">
                                                 <div class="form-group">
                                                     <div class="col-md-8">
              <input type="submit" class="btn btn-primary" value="Save Changes">
              <span></span>
              <input type="reset" class="btn btn-default" value="Cancel">
            </div>
                                                 </div>
                                             </div>
                                              </div>
                                          </div>
                                      </div>
                        </div>
                    </form>
                   </div>
                </div>
                </div>
            </div>
        </div>
        </section>
    
      </div>
    </div>
    <!-- ////////////////////////////////////////////////////////////////////////////-->


    
    <!-- BEGIN VENDOR JS-->
    <script src="../../app-assets/js/core/libraries/jquery.min.js" type="text/javascript"></script>
    <script src="../../app-assets/vendors/js/ui/tether.min.js" type="text/javascript"></script>
    <script src="../../app-assets/js/core/libraries/bootstrap.min.js" type="text/javascript"></script>
    <script src="../../app-assets/vendors/js/ui/perfect-scrollbar.jquery.min.js" type="text/javascript"></script>
    <script src="../../app-assets/vendors/js/ui/unison.min.js" type="text/javascript"></script>
    <script src="../../app-assets/vendors/js/ui/blockUI.min.js" type="text/javascript"></script>
    <script src="../../app-assets/vendors/js/ui/jquery.matchHeight-min.js" type="text/javascript"></script>
    <script src="../../app-assets/vendors/js/ui/screenfull.min.js" type="text/javascript"></script>
    <script src="../../app-assets/vendors/js/extensions/pace.min.js" type="text/javascript"></script>
    <!-- BEGIN VENDOR JS-->
    <!-- BEGIN PAGE VENDOR JS-->
    <script src="../../app-assets/vendors/js/charts/chart.min.js" type="text/javascript"></script>
    <!-- END PAGE VENDOR JS-->
    <!-- BEGIN ROBUST JS-->
    <script src="../../app-assets/js/core/app-menu.js" type="text/javascript"></script>
    <script src="../../app-assets/js/core/app.js" type="text/javascript"></script>
    <!-- END ROBUST JS-->
    <!-- BEGIN PAGE LEVEL JS-->
    <script src="../../app-assets/js/scripts/pages/dashboard-lite.js" type="text/javascript"></script>
    <!-- END PAGE LEVEL JS-->
  </body>
</html>
