<!DOCTYPE html>
<html lang="en" data-textdirection="ltr" class="loading">
@include('member.layouts.head')
    <title>Notifications</title>
    
    <body data-open="click" data-menu="vertical-menu" data-col="2-columns" class="vertical-layout vertical-menu 2-columns  fixed-navbar">

    @include('member.layouts.nav')
    @include('member.layouts.main_menu')
    
    <div class="app-content content container-fluid">
      <div class="content-wrapper">
        <div class="content-header row">
        </div>
        <div class="content-body"><!-- stats -->
 <div class="row">
    <div class="col-xl-8 col-lg-6 col-xs-12">
        <div class="card">
            <div class="card-body">
                <div class="card-block">
                    <div class="media">
                        <div class="media-body text-xs-left">
                            <h3 class="teal">Your Notifications from the System</h3>
                            <hr>
                            <ul class="list-group">
              <?php 
              $notif_counter1 = count($notify_system);
              $notif_counter2 = count($notify_manager);
              $notif_counter3 = count($notify_admin);
              ?>
              @if($notif_counter1 === 0)
                <a href="#" class="list-group-item list-group-item-action">
                      <div class="media-left">
                          <img class="media-object rounded-circle" src="../../app-assets/images/portrait/small/avatar-s-3.png" alt="Generic placeholder image" style="width: 35px;height: 35px;" />
                      </div>
                      <div class="media-body">
                    <h5 class="media-heading">No available notifications</h5>
                    
                  </div>    
                </a>
              @else
                @foreach($notify_system as $system)              
  							<a href="#" class="list-group-item list-group-item-action">
                      <div class="media-left">
                          <img class="media-object rounded-circle" src="../../app-assets/images/portrait/small/avatar-s-3.png" alt="Generic placeholder image" style="width: 35px;height: 35px;" />
                      </div>
                      <div class="media-body">
                    <h5 class="media-heading">{{$system->sender}} </h5>
                    <small>{{$system->message}}</small>
                    <small> {{$system->date}} </small>
                  </div>    
                </a>
                @endforeach
              @endif
							
						
							
						</ul>
            <div class="text-xs-center">
            {{ $notify_system->render("pagination::bootstrap-4") }}
          </div>
                        </div>
                        <div>
                       <!--        <i class="icon-user1 teal font-large-2 "></i>
                              <i class="icon-android-compass red font-large-2"></i>
                              <i class="icon-android-checkmark-circle blue font-large-2 "></i>
                              <i class="icon-android-bicycle orange font-large-2 "></i>
                              <i class="icon-ios-flower green font-large-2 "></i>
                              <i class="icon-android-contacts teal font-large-2 "></i>
                              <i class="icon-bug pink font-large-2 "></i> -->
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="card">
            <div class="card-body">
                <div class="card-block">
                    <div class="media">
                        <div class="media-body text-xs-left">
                            <h3 class="orange">Your Notifications from Admin</h3>
                            <hr>
                            <ul class="list-group">
                            
							 @if($notif_counter3 === 0)
                <a href="#" class="list-group-item list-group-item-action">
                      <div class="media-left">
                          <img class="media-object rounded-circle" src="../../app-assets/images/portrait/small/avatar-s-3.png" alt="Generic placeholder image" style="width: 35px;height: 35px;" />
                      </div>
                      <div class="media-body">
                    <h5 class="media-heading">No available notifications</h5>
                    
                  </div>    
                </a>
              @else
                @foreach($notify_admin as $system)              
                <a href="#" class="list-group-item list-group-item-action">
                      <div class="media-left">
                          <img class="media-object rounded-circle" src="../../app-assets/images/portrait/small/avatar-s-3.png" alt="Generic placeholder image" style="width: 35px;height: 35px;" />
                      </div>
                      <div class="media-body">
                    <h5 class="media-heading">{{$system->sender}} </h5>
                    <small>{{$system->message}}</small>
                    <small> {{$system->date}} </small>
                  </div>    
                </a>
                @endforeach
              @endif
							
						</ul>
             <div class="text-xs-center">
            {{ $notify_admin->render("pagination::bootstrap-4") }}
          </div>
                        </div>
                        <div>
                       <!--        <i class="icon-user1 teal font-large-2 "></i>
                              <i class="icon-android-compass red font-large-2"></i>
                              <i class="icon-android-checkmark-circle blue font-large-2 "></i>
                              <i class="icon-android-bicycle orange font-large-2 "></i>
                              <i class="icon-ios-flower green font-large-2 "></i>
                              <i class="icon-android-contacts teal font-large-2 "></i>
                              <i class="icon-bug pink font-large-2 "></i> -->
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="card">
            <div class="card-body">
                <div class="card-block">
                    <div class="media">
                        <div class="media-body text-xs-left">
                            <h3 class="lime">Your Notifications from Manager</h3>
                            <hr>
                            <ul class="list-group">
                            
							 @if($notif_counter2 === 0)
                <a href="#" class="list-group-item list-group-item-action">
                      <div class="media-left">
                          <img class="media-object rounded-circle" src="../../app-assets/images/portrait/small/avatar-s-3.png" alt="Generic placeholder image" style="width: 35px;height: 35px;" />
                      </div>
                      <div class="media-body">
                    <h5 class="media-heading">No available notifications</h5>
                    
                  </div>    
                </a>
              @else
                @foreach($notify_manager as $system)              
                <a href="#" class="list-group-item list-group-item-action">
                      <div class="media-left">
                          <img class="media-object rounded-circle" src="../../app-assets/images/portrait/small/avatar-s-3.png" alt="Generic placeholder image" style="width: 35px;height: 35px;" />
                      </div>
                      <div class="media-body">
                    <h5 class="media-heading">Manager </h5>
                    <small>{{$system->message}}</small>
                    <small> {{$system->date}} </small>
                  </div>    
                </a>
                @endforeach
              @endif
              
            </ul>
             <div class="text-xs-center">
            {{ $notify_admin->render("pagination::bootstrap-4") }}
          </div>
                        </div>
                        <div>
                       <!--        <i class="icon-user1 teal font-large-2 "></i>
                              <i class="icon-android-compass red font-large-2"></i>
                              <i class="icon-android-checkmark-circle blue font-large-2 "></i>
                              <i class="icon-android-bicycle orange font-large-2 "></i>
                              <i class="icon-ios-flower green font-large-2 "></i>
                              <i class="icon-android-contacts teal font-large-2 "></i>
                              <i class="icon-bug pink font-large-2 "></i> -->
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
    
    
     <div class="col-xl-4 col-lg-6 col-xs-12">
        <div class="card">
         <div class="card-body">
             <div class="card-block">
                  <h4>Some of Altitude's Members<i class="icon-android-people"></i></h4>
                  <hr>
                  
                  @foreach($random_people as $random)
                  <div class="text-xs-center">
                  <img class="media-object mx-auto d-block rounded-circle" src="/uploads/avatars/{{$random->avatar}}" alt="Generic placeholder image" style="width: 100px;height: 100px;" />
                  <h3>{{$random->first_name." ". $random->last_name}}</h3>
                  <a class="warning" href="/viewprofile/{{$random->idko}}">View Badges</a>
                  </div>
                  <hr>
                  @endforeach
                  
                  
                  
             </div>
         </div>  
    </div>
 
    
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
