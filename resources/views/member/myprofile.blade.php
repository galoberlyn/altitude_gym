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
    
    <div class="col-xl-4 col-lg-6 col-xs-12" style="margin-right:-1%">
        <div class="card" >
        <div class="card-header text-xs-center">
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
            <p class="card-text"><span class="warning"> Basic Info: </span> 
            @foreach($profile as $profiles)
            {{$profiles->age.", ". $profiles->civil_status.", ".$profiles->sex.", ".$profiles->occupation }}</p>
            @endforeach

          </div>
          
              <ul class="list-group list-group-flush">
            <li class="list-group-item"><span class="warning"> Address: </span>{{ $profiles->address }}</li>
            <li class="list-group-item"><span class="warning"> Email: </span>{{ $profiles->email_address}}</li>
            <li class="list-group-item"><span class="warning"> Contact no: </span>{{ $profiles->contact_no}}</li>
            <li class="list-group-item"><span class="warning"> School/Work: </span>{{ $profiles->school_workplace}}</li>
            <li class="list-group-item"><span class="warning"> Used gym before: </span> {{ $profiles->used_gym}}</li>
            <li class="list-group-item"><span class="warning"> Emergency: </span>{{ $profiles->emergency_contact.", ". $profiles->emergency_no}}</li>
            <li class="list-group-item"><span class="warning"> Privacy: </span>{{ $profiles->profile_status}}</li>
          </ul>    
        </div>
          <div class="card-block text-xs-center">
            <a href="/editprofile" class="btn btn-warning card-link">Edit Profile</a>
            <!-- <a href="#" class="card-link">Another link</a> -->
    </div>
</div>
    </div>
    
    <div class="row match-height">
    
    <div class="col-xl-4 col-lg-6 col-xs-12">
        <div class="card">
<div class="card-header text-xs-center">

    <h3 class="teal">
        Level @foreach ($user_lvl as $lvl) {{ $lvl->slevel .", ". $lvl->scat }} @endforeach
    </h3>
</div>
            <div class="card-body">
                <div class="card-block">
                    <div class="media">
                        <div class="media-body text-xs-center">
                          @foreach ($user_lvl as $lvl1)
                             <h3>{{$lvl1->total_exp." total Experience Points"}}</h3>
                            <progress class="progress progress-sm progress-teal mt-1 mb-0" style="height: 30px;" value="{{$lvl1->exp}}" max="{{$lvl1->base_point}}"></progress>
                          @endforeach

                        </div><br><br><br>
                        <div class="text-xs-center">
                       <h3 class="danger"> Transaction Information </h3>
                       <a  href='/member_transactions' class="btn btn-danger"> <i class="icon-arrow-right"> </i> </a>                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-xl-4 col-lg-6 col-xs-12">
        <div class="card border-orange">
           <div class="card-header text-xs-center">
               <h3 class="orange"> Current Goal/s </h3>
           </div>
            <div class="card-body">
                <div class="card-block">
                    <div class="media body text-xs-center">
                        <div class="media-body text-xs-left">
                            <ul class="list-group">
                              @foreach($current_goals as $goals)
                              <li class="list-group-item">{{$goals->goal_title}}</li>
                              @endforeach
                              
                            </ul>
                             <div class="text-xs-center">
                              <a href="/mygoals" class="btn btn warning"> Go to My Goals </a>
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
    
    <div class="col-xl-8 col-lg-6 col-xs-12">
                            <div class="card border-success">
                               <div class="card-header text-xs-center">
                                   <h3 class="success">Workout Progress</h3>
                               </div>
                                <div class="card-body">
                                    <div class="card-block">
                                        <div class="media">
                                          @if(count($user_workout)=== 0)

                                           <div class="col-xs-12 text-xs-center">
                                                    <h1 class="lime"> You haven't started a workout </h1>
                                            </div>

                                          @else

                                            @foreach($user_workout as $uwork_day)

                                                <div class="col-xs-2 col-xs-2 col-xs-2 text-xs-center">
                                                        <label class="text-xs-center">
                                                        <input {{ $uwork_day->point_status == 'rendered' ? 'checked disabled' : 'disabled'}} 
                                                        class="checker"  type="checkbox" autocomplete="off"> Day {{$uwork_day->day}}</label>
                                                </div>
                                                @endforeach <br>
                                                <div class="text-xs-center teal lead"> 
                                                 <progress id="dayprogress" class="progress progress-striped progress-indigo mt-1 mb-0" value="" max="100"></progress>
                                                 <span id="dayprogress_text">  </span> % complete  
                                                 </div>

                                          @endif

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
    
    <div class="col-xl-8 col-lg-6 col-xs-12">
                            
        <div class="card">
           <div class="card-header text-xs-center">
               <h3 class="blue">Achievements</h3>
           </div>
            <div class="card-body">
                <div class="card-block">
                    <div class="media">
                        <div class="media-body text-xs-center">
                            @foreach($user_achievement as $badge)
                            <div class="col-md-4">
                            <img src="/badges/{{$badge->badge_name}}.png" alt="" style="height:93px;width:81px;">
                            <h6>{{$badge->badge_name}}</h6>
                            </div>
                            @endforeach
                            
                            
                            
                            
                            
                        </div>
                    </div>
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
        <script type="text/javascript">
      window.onload = function(){
        var count = 0;
        var checked = 0;

        function countBoxes() { 
          count = $("input[type='checkbox']").length;
          console.log(count);
        }

        countBoxes();
        $(":checkbox").click(countBoxes);

        function countChecked() {
        checked = $("input:checked").length;
        
        var percentage = parseInt(((checked / count) * 100),10);
        
        document.getElementById("dayprogress").value=percentage;
        document.getElementById("dayprogress_text").innerHTML=percentage;
        document.getElementById("dayprogress_text_form").value=percentage;

       }
      
      countChecked();
      $(":checkbox").click(countChecked);
        
   }
   //end script for progress bar /workout_checklist
 </script>
  </body>
</html>
