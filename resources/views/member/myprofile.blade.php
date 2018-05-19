<!DOCTYPE html>
<html lang="en" data-textdirection="ltr" class="loading">
  <head>
    @include('member.layouts.head')
    <title>My Profile</title>
    
  <body data-open="click" data-menu="vertical-menu" data-col="2-columns" class="vertical-layout vertical-menu 2-columns  fixed-navbar">

  @include('member.layouts.nav')      

  @include('member.layouts.main_menu')
             
              @foreach($name_result as $username)
                      {{ $username->name }}
                @endforeach

   
   
   
    <div class="app-content content container-fluid">
      <div class="content-wrapper">
      @include('member.layouts.notification')
        <div class="content-header row">
        </div>
        <div class="content-body"><!-- stats -->
 <div class="row">
    <div class="col-xl-4 col-lg-6 col-xs-12">
        <div class="card" >
        <div class="card-header">
				<h4 class="card-title">{{ $username->name }}'s Profile</h4>
				</div>
        <!-- start profpic -->
        
        <div class="card-body">
            <div class="card-block">
            @foreach($dp as $pic)
          @endforeach
            <img src="/uploads/avatars/{{ $pic->avatar }}" style="width:150px; height:150px border-radius=50%; " class="mx-auto d-block card-img-top">
            </div>
            
            <div class="card-block">
            <h4 class="card-title">{{ $username->name }}</h4>
            <p class="card-text">
            @foreach($profile as $profiles)
            {{$profiles->age.", ". $profiles->civil_status.", ".$profiles->sex.", ".$profiles->occupation }}</p>
            @endforeach

          </div>
          
              <ul class="list-group list-group-flush">
            <li class="list-group-item"> Height: 5"9, Weight: 68kg </li> 
            <li class="list-group-item">{{ $profiles->address }}</li>
            <li class="list-group-item">{{ $profiles->email_address}}</li>
            <li class="list-group-item">{{ $profiles->contact_no}}</li>
            <li class="list-group-item">{{ $profiles->school_workplace}}</li>
            <li class="list-group-item">Used gym before: {{ $profiles->used_gym}}</li>
            <li class="list-group-item">{{ $profiles->emergency_contact.", ". $profiles->emergency_no}}</li>
            <li class="list-group-item">{{ $profiles->profile_status}}</li>
          </ul>    
        </div>
          <div class="card-block text-xs-center">
            <a href="/editprofile" class="btn btn-primary card-link">Edit Profile</a>
            <!-- <a href="#" class="card-link">Another link</a> -->
    </div>
</div>
    </div>
    <div class="col-xl-8 col-lg-6 col-xs-12">
        <div class="card">
            <div class="card-body">
                <div class="card-block">
                    <div class="media">
                        <div class="media-body text-xs-left">
                            <h3 class="teal">
                            Level 
                              @foreach ($user_lvl as $lvl)
                                  {{ $lvl->level .", ". $lvl->category }}
                              @endforeach
                            </h3>
                             <span>{{$lvl->exp." Experience Points"}}</span>
                            <progress class="progress progress-sm progress-teal mt-1 mb-0" value="{{$lvl->exp}}" max="{{$lvl->base_point}}"></progress>
                            <h3 class="teal"> Current Goal/s </h3>
                            <ul>
                              <li>Finish beginner workout</li>
                              <li> Lose 2kg </li>
                              <li> Gain another badge </li>
                              <li> Follow the diet plan </li>
                            </ul>
                            <h3 class="teal"> Workout for the day</h3>
                            <p> Legs, Shoulders </p>
                            
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
    <div class="col-xl-8 col-lg-6 col-xs-12">
        <div class="card">
            <div class="card-body">
                <div class="card-block">
                    <div class="media">
                        <div class="media-body text-xs-left">
                            <h3 class="teal">Achievements</h3><hr> PENDING PERO NASA DB NA TO
                            <ul>
                              <li> sample </li>
                              <li> sample2 </li>
                            </ul>
                            
                        </div>
                        <div>
                            
                            <img src="../../assets/images/sample.fw.png" alt="Lights">
                            
                           
                        </div>
                    </div>
                </div>
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
