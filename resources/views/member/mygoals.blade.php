<!DOCTYPE html>
<html lang="en" data-textdirection="ltr" class="loading">
    @include('member.layouts.head')
    <title>My Goals</title>
       <link rel="stylesheet" type="text/css" href="custom_css/goals.css">
       <link rel="stylesheet" type="text/css" href="../../css/app.css">
    
  <body data-open="click" data-menu="vertical-menu" data-col="2-columns" class="vertical-layout vertical-menu 2-columns  fixed-navbar">

    @include('member.layouts.nav')
    @include('member.layouts.main_menu')
  
    <div class="app-content content container-fluid">
      <div class="content-wrapper">
        <div class="content-header row">
        </div>
        <div class="content-body"><!-- stats -->
<div class="row">
  <div class="col-xl-12 col-lg-12">
    @include('member.layouts.notification')

 <div class="row match-height">         
    <div class="col-md-3">
      <a data-toggle="modal" data-target="#goalz"> 
      <div class="card text-xs-center">
      <i class="teal icon-clipboard2" style="font-size: 40px;"></i><br>
      <span class="teal" style="font-size: 20px;">View Finished Goals</span>
      </div>
      </a>
  </div>   

  <div class="col-md-6">
  <div class="card" style="text-align: center;">
      <h1 class="orange" style="font-size:4em;">My Goals <i class="icon-android-checkmark-circle"></i></h1>
      </div>
  </div>
  
  <div class="col-md-3">
      <a data-toggle="modal" data-target="#addGoalModal"> 
      <div class="card text-xs-center">
      <i class="green icon-android-add-circle" style="font-size: 40px;"></i><br>
      <span class="green" style="font-size: 20px;">Add Goal </span>
      </div>
      </a>
  </div>
  
  </div>
<!-- Modal -->
									<div class="modal fade text-xs-left" id="addGoalModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33" aria-hidden="true">
										<div class="modal-dialog" role="document">
											<div class="modal-content">
												<div class="modal-header">
													<button type="button" class="close" data-dismiss="modal" aria-label="Close">
													  <span aria-hidden="true">&times;</span>
													</button>
													<label class="modal-title text-text-bold-600" id="myModalLabel33" style="font-size: 20px;"> Add Goal<i class="green icon-ribbon-a"></i></label>
												</div>

												<form action="/mygoals" method="POST">
                          {{ csrf_field() }}
											  	  <div class="modal-body">
											  	  
											  	  <label>Goal Title </label>
													<div class="form-group">
														<input name="goal_title" type="text" placeholder="Title" class="form-control">
													</div>
											  	  
													<label>Goal </label>
													<div class="form-group">
														<textarea name="goal_description" class="form-control" rows="5" id="comment"></textarea>
													</div>
                                                  
                                                  

												  </div>
												  <div class="modal-footer">
													<input type="reset" class="btn btn-outline-secondary btn-lg" data-dismiss="modal" value="Close">
													<input name="form_create" type="submit" class="btn btn-outline-success btn-lg" value="Save">
												  </div>
												</form>
											</div>
										</div>
									</div>
  <!-- END MODAL -->

 <!-- Modal -->
                  <div class="modal fade text-xs-left" id="goalz" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                          <label class="modal-title text-text-bold-600" id="myModalLabel33" style="font-size: 20px;">My finished Goals<i class="green icon-ribbon-a"></i></label>
                        </div>

          
                            <div class="modal-body">
                            
                            @if(count($done_goals) === 0 )

                       <h1 class="text-xs-center"> No Goals Finished :( </h1>

                       @else

                       <div class="row">
                       @foreach($done_goals as $goalz)
                        <div class="col-xs-6">
                        <div class="card bg-lime">
                          <div class="card-body">
                            <div class="card-block text-xs-center">
                              <h2 class="card-title">{{$goalz->title}}</h2>
                              
                              <h6> {{$goalz->description}} </h6>
                            </div>
                          </div>
                        </div>
                        </div>
                    

                       @endforeach
                      </div>

                       @endif             
                                                  

                          </div>
                          <div class="modal-footer">
                          <input type="reset" class="btn btn-outline-secondary btn-lg" data-dismiss="modal" value="Close">
                          
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
  <!-- END MODAL -->
      

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <br>
    <div class="row">
    <div class="col-xs-12">
      <!-- goals -->
@if(count($ongoing_goals) === 0) 
<h1 class="lime text-xs-center"> You have no goals, create now! </h1>
@else
<form method="POST" action='/goals'>
  {{csrf_field()}}
@foreach($ongoing_goals as $goals)
<div class="container">
      <div class="col-sm-12">
        <div class="bs-calltoaction bs-calltoaction-success bg-green bg-darken-1">
                    <div class="row">
                        <div class="col-md-9 cta-contents">
                            <h1 class="cta-title">{{$goals->title}}</h1>
                            <div class="cta-desc">
                                <p>{{$goals->description}}</p>
                                <p>{{$goals->date}}</p>
                            </div>
                        </div>
                        <div class="col-md-3 cta-button">
                            <button type="submit" name="done_goal" value="{{$goals->id}}" class="btn btn-lg btn-block btn-success bg-green bg-lighten-1">Done</a>
                        </div>
                        <div class="col-md-3 cta-button">
                            <button type='submit' name="remove_goal" value="{{$goals->id}}" class="btn btn-lg btn-block btn-success bg-red bg-lighten-1">Remove</a>
                        </div>
                     </div>
                </div>
        </div>
  </div>
@endforeach
</form>
<div class="text-xs-center">
  {{$ongoing_goals->links()}}
</div>
@endif  
    <!-- end goals -->


        
        
    </div>
    </div>


    
</div>
<!--/ stats -->
<!--/ project charts -->
  </div>
</div>
<!--/ project charts -->
<!-- Recent invoice with Statistics -->



        </div>
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
