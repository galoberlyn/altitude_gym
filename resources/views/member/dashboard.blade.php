
<!DOCTYPE html>
<html lang="en" data-textdirection="ltr" class="loading">
  @include('member.layouts.head')
    <title>Dashboard</title>
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

  <div style="width: 100%; height: 20px; border-bottom: 1px solid grey; text-align: center">
      <span style="font-size: 20px; background-color: #F3F5F6; padding: 0 15px;">My Data</span>
    </div><br>
    <div class="row">
    <div class="col-xs-12">
   

  <div class="row">
    <div class="col-xs-12">
      <div class="card-group">
        <div class="card">
                <div class="card-block">                                   
                    <div class="media">
                        <div class="media-body red text-xs-left">
                            <h3 class="red"> Level
                              @foreach ($user_lvl as $lvl)
                                  {{ $lvl->level .", ". $lvl->category }}
                              @endforeach
                            </h3>
                            <!-- <span>90% Experience Points Till Level 4</span> -->
                        </div>
                        <div class="media-right media-middle">
                            <img src="memimg/joystick.png">
                        </div>
                        <!-- value=exp, max=base_point -->
                        <progress class="progress progress-sm progress-teal mt-1 mb-0" value="{{$lvl->exp}}" max="{{$lvl->base_point}}"></progress>
                        <span class='red'>
                          <?php
                              $lvl->exp;
                              $total = $lvl->base_point - $lvl->exp;
                              echo $total ." experience points till level ";
                              echo $lvl->level+(1);
                          ?>
                         
                       </span>
                       
                    </div>
                </div>

            
        </div>
        <div class="card">
            <!-- <img class="card-img-top" src="../../assets/images/2.jpg" alt="mem"> -->
                <div class="card-block">
                    <div class="media">
                        <div class="media-body cyan text-xs-left">
                        <img class="centerimg" src="memimg/medal.png"><br>
                        <i class="icon-star-full teal font-large-3 float-xs-right"></i>
                            <h3 class="teal">Achievements</h3>
                            <span>

                              @foreach ($user_achievement as $achieve)
                                {{ $achieve->id }}
                              @endforeach
                              Total Achievements
                            </span>
                        </div>
                        
                    </div>
                </div>      
        </div>
  </div>
  <div class="card-group">
        <div class="card">
                <div class="card-block">
                    <div class="media">
                        <div class="media-body grey text-xs-left">
                            <h3 class="grey" style="font-size: 60px">{{$lvl->exp}}</h3>
                            <span>Points Earned</span>
                        </div>
                        <div class="media-right media-middle">
                            <i class="icon-smile font-large-3 float-xs-right"></i>
                        </div>
                        
                    </div>
                </div>

            
        </div>
        <div class="card">
            <!-- <img class="card-img-top" src="../../assets/images/2.jpg" alt="mem"> -->
                <div class="card-block">
                    <div class="media">
                        <div class="media-body cyan text-xs-left">
                            <h3 class="teal" style="font-size: 60px">TWO</h3>
                            <span>Goals in progress, Let's Go!</span>
                        </div>
                        <div class="media-right media-middle">
                            <i class="icon-diagram teal font-large-3 float-xs-right"></i>
                        </div>
                      
                    </div>
                </div>      
        </div>
  </div>
    <div class ="card-group">
        <div class="card bg-white">
            <!-- <img class="card-img-top" src="../../assets/images/2.jpg" alt="act"> -->
                <div class="card-block">
                    <div class="media">
                        <div class="media-body green text-xs-left">

                            <h3 class="green" style="font-size: 60px;">

                              @foreach($daysdiff as $diff)
                                {{ abs($diff->daysdiff) }} 
                              @endforeach

                              <span style="font-size: 32px;">DAY/S</span></h3>
                            <span>Member since {{$diff->since}}</span>
                        </div>
                        <div class="media-right media-middle">
                            <i class="icon-diagram green font-large-3 float-xs-right"></i>
                        </div>
                                    
                    </div>
                </div>
            
        </div>
        <div class="card">
            <!-- <img class="card-img-top" src="../../assets/images/2.jpg" alt="date"> -->
                <div class="card-block">
                    <div class="media">
                        <div class="media-body cyan text-xs-left">
                            <h3 class="cyan" style="font-size: 60px;">
                          @foreach($exp_date as $expiration)
                              @if($expiration->exp_date<=0)
                                  {{ "EXPIRED" }}
                              @else
                                  {{ $expiration->exp_date }}
                                  <span style="font-size: 32px;">DAYS</span>
                              @endif
                          @endforeach
                            </h3><span>Till Renewal</span>
                        </div>
                        <div class="media-right media-middle">
                            <i class="icon-ios-list-outline cyan font-large-3 float-xs-right"></i>
                        </div>
               
                </div>
            </div>
        </div>
    </div>
    <div class ="card-group">
        <div class="card bg-white">
            <!-- <img class="card-img-top" src="../../assets/images/2.jpg" alt="act"> -->
                <div class="card-block">
                    <div class="media">
                        <div class="media-body purple text-xs-left">
                            <h3 class="purple" style="font-size: 50px;">Leg Workout</h3>
                            <span>Your workout for today</span>
                        </div>
                        <div class="media-right media-middle">
                           <!--  <i class="icon-diagram green font-large-3 float-xs-right"></i> -->
                           <img src="memimg/athlete.png">
                        </div>
                                    
                    </div>
                </div>
            
        </div>
        <div class="card">
            <!-- <img class="card-img-top" src="../../assets/images/2.jpg" alt="date"> -->
                <div class="card-block">
                    <div class="media">
                        <div class="media-body black text-xs-left">
                            <h3 class="black" style="font-size: 40px;">{{ $date_today }}</h3>
                            <span>Date Today</span>
                        </div>
                        <div class="media-right media-middle">
                            <!-- <i class="icon-ios-list-outline cyan font-large-3 float-xs-right"></i> -->
                            <img src="memimg/calendar.png">
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
