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
            <div class="col-sm-12 col-md-12">
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
    @elseif(session('earned'))

      @include('member.layouts.earned')

    @endif

    @if(session('not_rendered'))

      @include('member.layouts.no_points')
      
    @endif

    @if (session('finished'))
   
      @include('member.layouts.finished')
      
    @endif

    @if(session('wala'))

      @include('member.layouts.wala')

    @endif
<div class="row">
  <div class="col-sm-6">
    <div class="card-group">
        <div class="card">
          
                <div class="card-block">
                    <div class="media">
                        <div class="media-body cyan text-xs-left">
                        <i class="icon-happy orange font-large-3 float-xs-right"></i>
                            <h3 class="teal">Maybe you need to look for the programs list first before deciding what to play!</h3><br><br>
                            <span class="col-xs-13"><a href="/programs_mem" class="btn btn-info">View All Workouts</a></span>
                        </div>
                        
                    </div>
                </div>      
        </div>
  </div>
</div>
@foreach($user_lvl as $lvl)
@endforeach
 <div class="col-sm-6">
      <div class="card-group">
          <div class="card">
                  <div class="card-block">                                   
                      <div class="media">
  <h3 class="teal"> See the Badges for more information </h3> <br><br>
 <h1 class="text-xs-center"><a class="lime" href="/gamified"> Badges <i class="icon-star-half"></i></a></h1> <br><br>
                        
                      </div>
                  </div>
          </div>
      </div>
    </div>

</div>

  <div class="row">
    <div class="col-sm-12">

    @if(count($check_program) != 0 )
    @include("member.workout_checklist")
  @else
    
 <br>
  <!-- image 1 -->
  <div class="col-md-12">
    <div>
           <a data-toggle="modal" data-target="#createdProgs">
          <div class="card bg-info">
                  <div class="card-block">                                   
                      <div class="media text-xs-center">
                         <h1 class="white"> Choose a Program </h1>
                      </div>
                  </div>
          </div>
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
         <div class="text-center">

          <button data-toggle="modal" data-target="#beginner" value="beginner" class="btn btn-info btn-block"> Beginner Program </button>
          <br>

            <button data-toggle="modal" data-target="#intermediate" value="intermediate" class="btn btn-danger btn-block"> Intermediate Program</button>
          <br>
          <button data-toggle="modal" data-target="#custom" value="cutom" class="btn btn-warning btn-block"> Custom Program</button>
         
         </div>
        </div>
        
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          
          
        </div>
      </div>
      
    </div>
  </div>
  
  <!-- customize own workout -->
<!-- <div class="col-md-6">
    <div>
        <a class="button" data-toggle="modal" data-target="#customize">
        <img class="mx-auto d-block img-fluid work w3-round-medium img-responsive" src="custom_image/workout2.jpg" alt="">
        </a>
    </div>
  </div>
 -->   

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

<!-- MODAL FOR Custom type program -->
    <div class="modal fade   footer-to-bottom" id="custom" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="icon-cross"></i></button>
                      <h2 class="modal-title text-xs-center">Choose Your Custom Program!</h2>

                </div>
                <div class="modal-body">
                  <!-- big tabs nalang -->
                        
                <div class="">
                 @include('member.layouts.custom_workout')
                    </div>
               
                    <!-- end -->
                </div>
                <div class="modal-footer">
   
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>



        </div>
      </div>
    </div>

   @include("member.layouts.custom_workout2")

   <!-- MODAL FOR Customize program -->
    <div class="modal fade   footer-to-bottom" id="customize" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="icon-cross"></i></button>
                      <h2 class="modal-title text-xs-center">Create Your Own Program</h2>

                </div>
                <div class="modal-body">
                  <!-- big tabs nalang -->
                        
                <div class="">
                 @include('member.layouts.customize')
                    </div>
               
                    <!-- end -->
                </div>
                <div class="modal-footer">
   
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
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

 <script>
 $('#exp_modal').modal({
        show: true
    });
  $('#level_modal').modal({
        show: true
    });
  $('#confirm_modal').modal({
        show: true
    });

   $('#wala').modal({
        show: true
    });
  </script>    

<script>
  var x = document.getElementsByClassName('check_custom');
  var y = document.getElementsByClassName('check_custom1');
  var z = document.getElementsByClassName('check_custom2');
  
function twin(){

  for(var i=0; i<=x.length; i++){

    if(x[i].checked){
      y[i].checked = true;
      z[i].checked = true;
    }else{
      y[i].checked = false;
      z[i].checked = false;
    }

  }
 
}
</script>
  </body>
</html>
