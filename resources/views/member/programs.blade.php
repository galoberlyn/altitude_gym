<!DOCTYPE html>
<html lang="en" data-textdirection="ltr" class="loading">
       @include('member.layouts.head')
       <link rel="stylesheet" type="text/css" href="custom_css/workout.css">
       <link rel="stylesheet" type="text/css" href="custom_css/mdb.css">
    <title>Programs</title>
    
  <body data-open="click" data-menu="vertical-menu" data-col="2-columns" class="vertical-layout vertical-menu 2-columns  fixed-navbar">

    @include('member.layouts.nav')      
    @include('member.layouts.main_menu') 

    
    <div class="app-content content container-fluid">
      <div class="content-wrapper">
        <div class="content-header row">
        </div>
        <div class="content-body"><!-- stats --> 
   
    <div class="row">
    <div class="col-xs-12">
      @include('member.layouts.notification')
      <a style="font-size: 1.5em;" class='' href="/myworkout"> <i style="font-size: 1.5em;" class="icon-arrow-left3"> </i> Back </a>
     <h1 class='text-xs-center'> All Programs </h1>
 <section class="new-deal">
         
		 <div class="col-xl-12 col-lg-12">
   
     <div class="row">
   <!-- buttons -->
   @foreach($programs_type as $types)
   

<div class="col-xl-3 col-md-6 col-sm-12">
      <div class="card">
        <div class="card-body">
          <div class="card-block text-xs-center">
            <h2 class="card-title">{{$types->type}}</h2>
            
            <a data-toggle="modal" data-target="#{{$types->type}}" class="btn btn-outline-deep-orange">View Workouts</a>
          </div>
        </div>
      </div>
    </div>


    @endforeach

       
       <!--Chest Modal -->
@foreach($programs_type as $types2)
<div class="modal fade" id="{{$types2->type}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title" id="exampleModalLabel">{{$types2->type}} Workouts</h2>
                
            </div>
            <div class="modal-body">
              
               <table class="table table-striped">
                <thead>
                      <th> Workout </th>
                      <th> Sets </th>
                      <th> Reps </th>
                </thead>

                  @foreach($programs as $prog)
                    @if($prog->type == $types2->type)
                <tbody>
                      <td> {{$prog->workout_name}} </td>
                      <td> {{$prog->sets}} </td>
                      <td> {{$prog->reps}} </td>
                </tbody>
                    @endif
                  @endforeach

               </table>
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
@endforeach
       
       

       
       
     </div>
   </div>
        </section>
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
