\<!DOCTYPE html>
<html lang="en" data-textdirection="ltr" class="loading">
@include('member.layouts.head')
<title>My Badges</title>

<body data-open="click" data-menu="vertical-menu" data-col="2-columns" class="vertical-layout vertical-menu 2-columns  fixed-navbar">

    @include('member.layouts.nav') @foreach($name_result as $username) {{ $username->name }} @endforeach @include('member.layouts.main_menu')

    <div class="app-content content container-fluid">
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <div class="content-body">
                <!-- stats -->



                @include('member.layouts.notification')
                
<!--                MY ACHIEVEMENTS START-->
               
                <div class="row text-xs-center">
                    <div class="col-md-12">
                        <h1 class="purple" style="font-size:3em;">My Achievements <i class="icon-ribbon-b purple font-large-2 "></i></h1>
                      <br>   
                    </div>
                </div>
                <div class="row match-height">

    
                
   <!-- img na locked.png if not yet achieved, card bg-grey bg-lighten-1 -> sa card mismo  -->
   @foreach($user_badge as $ubadge)
    <div class="col-xl-4 col-lg-6 col-xs-12">
        <div class="card bg-success bg-lighten-4">
            <div class="card-body">
                <div class="media">
                    <div class="p-3  text-xs-center media-left">
                        <img src="/badges/{{$ubadge->badge_name}}.png" alt="" style="height:73px;width:61px;" align="left">
                    </div>
                    <div class="p-2 media-body text-xs-left">
                        <h2>{{$ubadge->badge_name}}</h2>
                        <h5>{{$ubadge->badge_description}} </h5>
                        <h6>{{$ubadge->date}}</h6>
                                            
                    </div>
                </div>
            </div>
        </div>
    </div> 
    @endforeach
    
  @foreach($all_badge as $all)  
  <div class="col-xl-4 col-lg-6 col-xs-12">
        <div class="card bg-grey bg-lighten-1">
            <div class="card-body">
                <div class="media">
                    <div class="p-3  text-xs-center media-left">
                        <img src="/badges/{{$all->badge_name}}.png" alt="" style="height:73px;width:61px; filter: grayscale(100%);" align="left">
                    </div>
                    <div class="p-2 media-body text-xs-left">
                        <h2>{{$all->badge_name}}</h2>
                        <h5>{{$all->badge_description}} </h5>
                        <h6 class="black"> Locked <i class="icon-android-lock"></i></h6>
                                            
                    </div>
                </div>
            </div>
        </div>
    </div>        
  @endforeach
             
          
  </div>
                
<!--                MY ACHIEVEMENTS END-->

                <!--/ stats -->
                <!--/ project charts -->
                <!--/ project charts -->
                <!-- Recent invoice with Statistics -->



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
