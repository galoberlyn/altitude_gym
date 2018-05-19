<!DOCTYPE html>
<html lang="en" data-textdirection="ltr" class="loading">
    @include('member.layouts.head')
    <title>My Goals</title>
    
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

  <div class="row">
      
  <div class="col-md-9">
  <div style="font-size: 3em; text-align: center;"> My Goals <i class=" red  icon-ribbon-a"></i>
  </div>
  </div>
   
   <div class="col-md-3">
      <div style="text-align: center;">
      <a data-toggle="modal" data-target="#addGoalModal"> 
      <i class="green icon-android-add-circle" style="font-size: 40px;"></i><br>
      <span class="green" style="font-size: 20px;">Add Goal </span>
      </a>
      
      
      
<!-- Modal -->
									<div class="modal fade text-xs-left" id="addGoalModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33" aria-hidden="true">
										<div class="modal-dialog" role="document">
											<div class="modal-content">
												<div class="modal-header">
													<button type="button" class="close" data-dismiss="modal" aria-label="Close">
													  <span aria-hidden="true">&times;</span>
													</button>
													<label class="modal-title text-text-bold-600" id="myModalLabel33" style="font-size: 20px;"> Add Goal Get Ready to Demolish these goals!<i class="green icon-ribbon-a"></i></label>
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
													<input name="form_create" type="submit" class="btn btn-outline-primary btn-lg" value="Save">
												  </div>
												</form>
											</div>
										</div>
									</div>
      
  </div>
   </div>
   
   
    </div>
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
  
  <div class="row">
     
     @foreach($ongoing_goals as $goals)
     <div class="col-md-3">
     <div class="card-group">
        <div class="card">
         <div class="card-header">
	                <h4 class="card-title">{{ $goals->title }}</h4>
	                <a class="heading-elements-toggle"><i class="icon-ellipsis font-medium-3"></i></a>
        <div class="heading-elements">
	                    <ul class="list-inline mb-0">
	                        <li><a data-action="close"><i class="icon-cross2"></i></a></li>
	                    </ul>
	                </div>
	            </div>
         
          <div class="card-body collapse in">
              <div class="card-block">
                  <div class="container">
                      <div class="media-body cyan text-xs-left">
                        <h5>{{ $goals->date }}</h5>
                        <h5 class="green">{{$goals->description}}</h5>
                        </div>
                        <br>
                        <form action="/mygoals" method="POST" class="form-actions center">
                          {{csrf_field()}}
                        <input name="goal_identifier" type='text' hidden value="{{$goals->id}}"> 
                        <button name="form_done" type="submit" class="btn btn-success"> Done </button>
                        </form>
                  </div>
              </div>
          </div>   
      </div>    
        </div> 
     </div>
     @endforeach
      
  </div>
  
  <hr>
  <div class="row">
  <div class="card">
				<div class="card-body">
					<div class="card-block">
						<h2 class="card-title text-xs-center">Finished Goals <i class=" green  icon-check"></i></h2>
					</div>
  @if(count($done_goals) > 0)
					<ul class="list-group list-group-flush">
					@foreach($done_goals as $done)
						<li class="list-group-item">
							{{ $done->title. ", ". $done->description. " Finished goal at ". $done->date}} 
						</li>
				    @endforeach
					</ul>
					@else
      <div class="row text-xs-center">
       <h1 class="teal">{{" No goals have been accomplished yet "}}<i class="icon-sad-outline"></i></h1>
       <br>
      </div>
       @endif
				</div>
			</div>
  </div>
      
        
        
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
