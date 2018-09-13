<!DOCTYPE html>
<html lang="en" data-textdirection="ltr" class="loading"> @include('member.layouts.head')
<title>Welcome to Altitude</title>

<body data-open="click" data-menu="vertical-menu" data-col="2-columns" class="vertical-layout vertical-menu 2-columns  fixed-navbar"> @include('member.layouts.nav') @include('member.layouts.main_menu')
    <div class="app-content content container-fluid">
        <div class="content-wrapper">
            <div class="content-header row"> </div>
            <div class="content-body">
                <!-- stats -->
                <div class="row">
                    <div class="col-xl-12 col-lg-12"> @include('member.layouts.notification')
                         @if(session('not_rendered'))

                          @include('member.layouts.badge')
                          
                        @endif
                        <!-- Modal -->
                        <div class="modal fade text-xs-left" id="addGoalModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
                                        <label class="modal-title text-text-bold-600" id="myModalLabel33" style="font-size: 20px;"> Add Goal Get Ready to Demolish these goals!</label>
                                    </div>
                                    <form action="/mygoals" method="POST"> {{ csrf_field() }}
                                        <div class="modal-body">
                                            <label>Goal Title </label>
                                            <div class="form-group">
                                                <input name="goal_title" type="text" placeholder="Title" class="form-control"> </div>
                                            <label>Goal </label>
                                            <div class="form-group">
                                                <textarea name="goal_description" class="form-control" rows="5" id="comment"></textarea>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <input type="reset" class="btn btn-outline-secondary btn-lg" data-dismiss="modal" value="Close">
                                            <input name="form_create" type="submit" class="btn btn-outline-success btn-lg" value="Save"> </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                 <img src="memimg/banner.fw.png" alt="" style="width:100%;height:auto"> </div>
                        </div>
                        <!--/ stats -->
                        <!--/ project charts -->
                    </div>
                </div>
                <!--/ project charts -->
                <!-- Recent invoice with Statistics -->
                <script>
                    $scope.getStyle = function () {
                        var numberOfItems = $scope.tree.length;
                        return {
                            width: 200 * numberOfItems + 'px'
                            , overflowX: 'auto'
                        }
                    }
                </script>
               
                <br>
                <div class="row match-height">
                    <div class="col-xl-3 col-md-6 col-sm-12" style="margin-right:-1%">
                        <div class="card border-yellow" style="height: 440px;">
                            <div class="card-body">
                                <div class="card-block">
                                    <h2 class="card-title text-xs-center yellow">Wall of Fame <i class="icon-android-star-half"></i></h3>
                                    <p class="card-text text-xs-center">All Time Leaders</p>
                                </div>
                                <ul class="list-group list-group-flush">
                                  @foreach($all_time as  $key => $lahat)

                                    <li class="list-group-item"> <span class="tag tag-default tag-pill bg-primary float-xs-right">{{$lahat->total_exp}}pts</span>
                                    <span class="avatar">
                              <img src="../../uploads/avatars/{{ strtolower($lahat -> avatar) }}" alt="{{$lahat -> avatar}}"></img>
                              </span>
                               {{$lahat->first_name}} </li>

                               
                                   
                         
                                  @endforeach
                                </ul>
                                <div class="card-block"> <a href="/leaderboard" class="card-link">See more</a> </div>
                            </div>
                        </div>
                    </div>
                    <div class="row match-height">
                        <div class="col-xl-3 col-lg-6 col-xs-12">
                            <div class="card bg-lime">
                                <div class="card-body">
                                    <div class="card-block">
                                        <div class="media">
                                            <div class="media-body text-xs-center">
                                                <h2 class="white">My Finished Programs</h2> <i class="icon-bullseye white font-large-5 "></i>
                                                <br>
                                                <a href="/done_progs" class="btn btn-lime ">View Finished Programs</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-xl-3 col-lg-6 col-xs-12">
                            <div class="card bg-teal">
                                <div class="card-body">
                                    <div class="card-block">
                                        <div class="media">
                                            <div class="media-body text-xs-center">
                                                <h2 class="white">Total Points</h2> 
                                                @foreach($user_lvl as $usr)
                                                <h1 class="white" style="font-size:5em;">{{$usr->total_exp}}</h1>
                                                @endforeach
                                                <br>
                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-xl-3 col-lg-6 col-xs-12">
                            <div class="card bg-pink">
                                <div class="card-body">
                                    <div class="card-block">
                                        <div class="media">
                                            <div class="media-body text-xs-center">
                                                <h2 class="white">Experience Points</h2> 
                                                @foreach($user_lvl as $usr1)
                                                <h1 class="white" style="font-size:5em;">{{$usr->exp}}</h1>
                                                @endforeach
                                                <br>
                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="col-xl-3 col-lg-6 col-xs-12">
                            <div class="card border-info">
                                <div class="card-body">
                                    <div class="card-block">
                                        <div class="media">
                                            <div class="media-body text-xs-left">
                                                <h3 class="indigo">
                                                  @foreach ($user_lvl as $lvl)
                                                      Level {{ $lvl->slevel .", ". $lvl->scat }}
                                                </h3>
                                                <progress class="progress progress-striped progress-indigo" value="{{$lvl->exp}}" max="{{$lvl->base_point}}"></progress>
                                                <h6 class="indigo">
                                                  @endforeach
                                                  @foreach($user_lvl as $lvl1)
                                                 <?php
                                                      $lvl->exp;
                                                      $total = $lvl1->base_point - $lvl->exp;
                                                      echo $total ." exp points till level ";
                                                      echo $lvl1->slevel+(1);
                                                  ?>
                                                  @endforeach
                                                </h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
<!-- progress -->
<?php 
$workout_counter = count($workout);
?>
@if($workout_counter === 0)
<div class="col-xl-6 col-lg-6 col-xs-12">
    <div class="card border-danger">
                                <div class="card-body">
                                    <div class="card-block">
                                        <div class="media">
                                            <div class="media-body text-xs-center">
                                                <h1 class="danger">You have no workouts yet!</h1>
                                                <i class="font-large-5 icon-android-bicycle danger"></i> 
                                                                                             
                                                <br>
                                                <a href="/myworkout" class="btn btn-danger">Go to My Workout</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
    </div>
</div>
@else
<div class="col-xl-6 col-lg-6 col-xs-12">
                            <div class="card border-success">
                                <div class="card-body">
                                    <div class="card-block">
                                        <div class="media">
                                            <div class="media-body text-xs-center">
                                                <h2 class="success">Workout Progress</h2>
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
                                             

                                                
                                                <br>
                                                </div>


                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end progress  -->
@endif
                        
                        <div class="col-xl-4 col-lg-6 col-xs-12" style="margin-right:-1%">
                            <div class="card bg-warning">
                                <div class="card-body">
                                    <div class="card-block">
                                        <div class="media">
                                            <div class="media-body text-xs-center">
                                                <h2 class="white">My Achievements</h2> <i class="icon-ribbon-b white font-large-5 "></i><br> 
                                                <a href="/mybadges" class="btn btn-warning">View Achievements</a>
                                                </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-4 col-lg-6 col-xs-12" style="margin-right:-1%">
                            <div class="card bg-success">
                                <div class="card-body">
                                    <div class="card-block">
                                        <div class="media">
                                            <div class="media-body text-xs-center">
                                                <h2 class="white">Member Since</h2> <i class="icon-calendar3 white font-large-5 "></i><br> 
                                                <h3 class="white"> @foreach($daysdiff as $diff)
                                                {{$diff->since}}
                                                @endforeach </h3>
                                                </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                          <div class="col-xl-4 col-lg-6 col-xs-12" style="margin-right:-1%">
                            <div class="card bg-danger">
                                <div class="card-body">
                                    <div class="card-block">
                                        <div class="media">
                                            <div class="media-body text-xs-center">
                                                <h2 class="white">Member Status</h2> <i class="icon-info white font-large-5 "></i><br> 
                                                <h3 class="white">  
                                            @foreach($exp_date as $expiration)
                                                @if($expiration->exp_date<=0)
                                                    {{ "EXPIRED" }}
                                                @else
                                                    {{ $expiration->exp_date }}
                                                    <span>Days till Renewal</span>
                                                @endif
                                            @endforeach
                                                </h3>
                                                </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                       
      

                        
<!--
                        <div class="col-xl-3 col-lg-6 col-xs-12" style="margin-right:-1%">
                            <div class="card border-red border-lighten-3">
                                <div class="card-body">
                                    <div class="card-block">
                                        <div class="media">
                                            <div class="media-body text-xs-center">
                                                <h2 class="danger">Expired</h2> <i class="icon-android-cancel danger font-large-5 "></i>
                                                <br> </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
-->
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
    <script>
 $('#badge').modal({
        show: true
    });
</script>
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

   // script for marking boxes
      function markAll(day_value){

          var day = document.getElementsByClassName("day"+day_value);

          if(day[0].checked==true){
            for(var i=0; i<day.length; i++){
              day[i].checked = false;
            }
          }else{
            for(var i=0; i<day.length; i++){
              day[i].checked = true;
            }
          }
      }


    </script> 
</body>

</html>
