<!DOCTYPE html>
<html lang="en" data-textdirection="ltr" class="loading">
       @include('member.layouts.head')

       <link rel="stylesheet" type="text/css" href="custom_css/workout.css">
    <title>My Workout</title>
    
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
    <div class="row">
    <div class="col-xs-12">
      @include('member.layouts.notification')
      <!-- SUCCESS PAG NAG WORKOUT NA SYA -->
        @if (session('success'))
        <div class="container">
        <div class="row">
            <div class="col-sm-6 col-md-6">
                <div class="alert alert-success">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                        ×</button>
                   <span class="glyphicon glyphicon-ok"></span> <strong>Success</strong>
                    <hr class="message-inner-separator">
                    <p>
                        Let's demolish some goals, goodluck buddy!</p>
                </div>
            </div>
            </div>
          </div>
    @endif
  <div class="row">
    <div class="col-xs-12">
      <div class="card-group">

        <div class="card card-outline-danger text-center">
    
                <div class="card-block">
                    <div class="media">
                        <div class="media-body cyan text-xs-left">
                        <i class="icon-happy teal font-large-3 float-xs-right"></i>
                            <h3 class="teal">Maybe you need to look for the programs list first before deciding what to play! :)</h3><br>
                            <span class="col-xs-13"><a href="/programs" class="btn btn-info">View All Workouts</a></span>
                        </div>
                        
                    </div>
                </div>      
        </div>
  </div>
    @if(count($check_program) != 0 )
    @include("member.workout_checklist")
  @else
    
  <h1 class="text-xs-center"> Choose Type of Workout </h1><br>
  <!-- image 1 -->
  <div class="col-md-6">
    <div>
        <a class="button" data-toggle="modal" data-target="#createdProgs">
        <img class="work w3-round-medium img-responsive" src="custom_image/workout1.jpg" alt="">
        </a>
    </div>
  </div>
  
  <!-- Created Programs Modal-->
  
  <div class="modal fade" id="createdProgs" role="dialog">
    <div class="modal-dialog modal-sm">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Choose the category</h4>
        </div>
        <div class="modal-body">
         <div class=" text-center">

          <button data-toggle="modal" data-target="#beginner" value="beginner" class="btn btn-info btn-block"> Beginner </button>
          <br>

            <button data-toggle="modal" data-target="#intermediate" value="intermediate" class="btn btn-danger btn-block"> Intermediate </button>
         
         </div>
        </div>
        
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          
          
        </div>
      </div>
      
    </div>
  </div>
  
  <!-- image 2 -->
<div class="col-md-6">
    <div>
        <a class="button" data-toggle="modal" data-target="#myModalFullscreen2">
        <img class="work w3-round-medium img-responsive" src="custom_image/workout2.jpg" alt="">
        </a>
    </div>
  </div>
   

    <!-- MODAL FOR BEGINNER -->
      <!-- Eto yung section ng customize own form dapat to -->
    <!-- /.container --> 
    <div class="modal fade   footer-to-bottom" id="beginner" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="icon-cross"></i></button>
                      <h2 class="modal-title text-xs-center">Welcome to the Beginner Program!</h2>

                </div>
                <div class="modal-body">
                  <!-- big tabs nalang -->
                        
                <div class="">
                    @include('member.layouts.beginner_workout')
                    </div>
               
                    <!-- end -->
                </div>
                <div class="modal-footer">
                  <div id="center_button">
                   <form action="/myworkout" onsubmit="return confirm('Are you ready to begin this program?');" method="POST">
                    {{csrf_field()}}

                    <button type="submit" name="program_chooser" value="beginner" type="submit" class="btn btn-lg btn-success btn-block">Start Program!</button>
                    
                  </form>
                  </div>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->

        <!-- MODAL FOR INTERMEDIATE PROGRAM -->
      <!-- Eto yung section ng customize own form dapat to -->
    <!-- /.container --> 
    <div class="modal fade  footer-to-bottom" id="intermediate" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="icon-cross"></i></button>
                      <h4 class="modal-title text-xs-center"> Welcome to Intermediate Program</h4>

                </div>
                <div class="modal-body">
                    @include('member.layouts.intermediate_workout')
                </div>
                <div class="modal-footer">
                    <div id="center_button">
                   <form action="/myworkout" onsubmit="return confirm('Are you ready to begin this program?');" method="POST">
                    {{csrf_field()}}
                     <button type="submit" name="program_chooser" value="intermediate" type="submit" class="btn btn-lg btn-success btn-block">Start Program!</button>
                  </form>
                  </div>

                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->



        </div>
      </div>
    </div>
@endif
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
    <script> $('head').append('<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">'); </script>
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
   //end script for progress bar

   // script for marking boxes
      function markAll(){

          var day1 = document.getElementsByClassName("day1");

          if(day1[0].checked==true){
            for(var i=0; i<day1.length; i++){
              day1[i].checked = false;
            }
          }else{
            for(var i=0; i<day1.length; i++){
              day1[i].checked = true;
            }
          }
      }

      function markAll2(){

          var day2 = document.getElementsByClassName("day2");

          if(day2[0].checked==true){
            for(var i=0; i<day2.length; i++){
              day1[i].checked = false;
            }
          }else{
            for(var i=0; i<day2.length; i++){
              day2[i].checked = true;
            }
          }
      }

      function markAll3(){

          var day3 = document.getElementsByClassName("day3");

          if(day3[0].checked==true){
            for(var i=0; i<day3.length; i++){
              day3[i].checked = false;
            }
          }else{
            for(var i=0; i<day3.length; i++){
              day3[i].checked = true;
            }
          }
      }

      function markAll4(){

          var day4 = document.getElementsByClassName("day4");

          if(day4[0].checked==true){
            for(var i=0; i<day4.length; i++){
              day4[i].checked = false;
            }
          }else{
            for(var i=0; i<day4.length; i++){
              day4[i].checked = true;
            }
          }
      }

      function markAll5(){

          var day5 = document.getElementsByClassName("day5");

          if(day5[0].checked==true){
            for(var i=0; i<day5.length; i++){
              day5[i].checked = false;
            }
          }else{
            for(var i=0; i<day5.length; i++){
              day5[i].checked = true;
            }
          }
      }


    </script> 
    
  </body>
</html>
