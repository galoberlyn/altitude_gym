<!DOCTYPE html>
<html lang="en" data-textdirection="ltr" class="loading">
       @include('member.layouts.head')
       <link rel="stylesheet" type="text/css" href="custom_css/workout.css">
       <link rel="stylesheet" type="text/css" href="custom_css/mdb.css">
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
    <div class="col-xs-12">
      @include('member.layouts.notification')
      <a style="font-size: 1.5em;" class='' href="/myworkout"> <i style="font-size: 1.5em;" class="icon-arrow-left3"> </i> Back </a>
     <h1 class='text-xs-center'> Workouts </h1>
 <section class="new-deal">
         
		 <div class="col-xl-12 col-lg-12">
   
     <div class="row">
   
   <div class="col-md-4">
           <div class="view hm-zoom">
            <img src="custom_image/chest1.fw.png" class="img-fluid " alt="">
        <div class="mask flex-center">
        <button class="btn btn-warning btn-lg" data-toggle="modal" data-target="#chestWorkouts">View</button>   
        </div>
            </div>
       </div>
       
       <!--Chest Modal -->
<div class="modal fade" id="chestWorkouts" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title" id="exampleModalLabel">Chest Workouts</h2>
                
            </div>
            <div class="modal-body">
              
               <h3 class="list-group-item-heading">Beginner</h3>
                <ul class="list-group">
                @foreach ($chestWoutsB as $chestWB)
                    <li class="list-group-item">
								<span class="tag tag-success tag-pill float-xs-right">{{$chestWB->sets}} Sets</span>
								<span class="tag tag-primary tag-pill float-xs-right">{{$chestWB->reps}} Reps</span>
								{{$chestWB->workout_name}}
							</li>
							@endforeach
						</ul>
              
              <br>
               <h3 class="list-group-item-heading">Intermediate</h3>
                <ul class="list-group">
                @foreach ($chestWoutsI as $chestWI)
                <li class="list-group-item">
								<span class="tag tag-success tag-pill float-xs-right">{{$chestWI->sets}} Sets</span>
								<span class="tag tag-primary tag-pill float-xs-right">{{$chestWI->reps}} Reps</span>
								{{$chestWI->workout_name}}
							</li>
								@endforeach
                
						</ul>
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
       
       
       
       <div class="col-md-4">
           <div class="view hm-zoom">
            <img src="custom_image/abs.fw.png" class="img-fluid " alt="">
        <div class="mask flex-center">
        <button class="btn mr-1 mb-1 btn-warning btn-lg " data-toggle="modal" data-target="#absWorkouts">View</button>   
        </div>
</div>
       </div>
       
       <!--Abs Modal -->
<div class="modal fade" id="absWorkouts" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title" id="exampleModalLabel">Abs Workouts</h2>
                
            </div>
            <div class="modal-body">
              
               <h3 class="list-group-item-heading">Beginner</h3>
                <ul class="list-group">
                @foreach ($absWoutsB as $absWB)
                    <li class="list-group-item">
								<span class="tag tag-success tag-pill float-xs-right">{{$absWB->sets}} Sets</span>
								<span class="tag tag-primary tag-pill float-xs-right">{{$absWB->reps}} Reps</span>
								{{$absWB->workout_name}}
							</li>
							@endforeach
						</ul>
              
              <br>
               <h3 class="list-group-item-heading">Intermediate</h3>
                <ul class="list-group">
                @foreach ($chestWoutsI as $chestWI)
                <li class="list-group-item">
								<span class="tag tag-success tag-pill float-xs-right">{{$chestWI->sets}} Sets</span>
								<span class="tag tag-primary tag-pill float-xs-right">{{$chestWI->reps}} Reps</span>
								{{$chestWI->workout_name}}
							</li>
								@endforeach
                
						</ul>
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
       
       
       <div class="col-md-4">
           <div class="view hm-zoom">
            <img src="custom_image/legs.fw.png" class="img-fluid " alt="">
        <div class="mask flex-center">
        <button class="btn mr-1 mb-1 btn-warning btn-lg" data-toggle="modal" data-target="#legsWorkouts">View</button>        
        </div>
</div>
      
      <!--Legs Modal -->
<div class="modal fade" id="legsWorkouts" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title" id="exampleModalLabel">Legs Workouts</h2>
                
            </div>
            <div class="modal-body">
              
               <h3 class="list-group-item-heading">Beginner</h3>
                <ul class="list-group">
                @foreach ($legsWoutsB as $legsWB)
                    <li class="list-group-item">
								<span class="tag tag-success tag-pill float-xs-right">{{$legsWB->sets}} Sets</span>
								<span class="tag tag-primary tag-pill float-xs-right">{{$legsWB->reps}} Reps</span>
								{{$legsWB->workout_name}}
							</li>
							@endforeach
						</ul>
              
              <br>
               <h3 class="list-group-item-heading">Intermediate</h3>
                <ul class="list-group">
                @foreach ($legsWoutsI as $legsWI)
                <li class="list-group-item">
								<span class="tag tag-success tag-pill float-xs-right">{{$legsWI->sets}} Sets</span>
								<span class="tag tag-primary tag-pill float-xs-right">{{$legsWI->reps}} Reps</span>
								{{$legsWI->workout_name}}
							</li>
								@endforeach
                
						</ul>
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
      
       </div>
     </div>
     <br>
     <div class="row">
   
   <div class="col-md-4">
           <div class="view hm-zoom">
            <img src="custom_image/biceps.fw.png" class="img-fluid " alt="">
        <div class="mask flex-center">
        <button class="btn btn-warning btn-lg " data-toggle="modal" data-target="#bicepsWorkouts">View</button>   
        </div>
</div>
       </div>
       
       <!--Biceps Modal -->
<div class="modal fade" id="bicepsWorkouts" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title" id="exampleModalLabel">Biceps Workouts</h2>
                
            </div>
            <div class="modal-body">
               <h3 class="list-group-item-heading">Beginner</h3>
                <ul class="list-group">
                @foreach ($bicepsWoutsB as $bicepsWB)
                    <li class="list-group-item">
								<span class="tag tag-success tag-pill float-xs-right">{{$bicepsWB->sets}} Sets</span>
								<span class="tag tag-primary tag-pill float-xs-right">{{$bicepsWB->reps}} Reps</span>
								{{$bicepsWB->workout_name}}
							</li>
							@endforeach
						</ul>
              
              <br>
               <h3 class="list-group-item-heading">Intermediate</h3>
                <ul class="list-group">
                @foreach ($bicepsWoutsI as $bicepsWI)
                <li class="list-group-item">
								<span class="tag tag-success tag-pill float-xs-right">{{$bicepsWI->sets}} Sets</span>
								<span class="tag tag-primary tag-pill float-xs-right">{{$bicepsWI->reps}} Reps</span>
								{{$bicepsWI->workout_name}}
							</li>
								@endforeach
                
						</ul>
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
       
       <div class="col-md-4">
           <div class="view hm-zoom">
            <img src="custom_image/shoulders.fw.png" class="img-fluid " alt="">
        <div class="mask flex-center">
        <button class="btn mr-1 mb-1 btn-warning btn-lg" data-toggle="modal" data-target="#shoulderWorkouts">View</button>   
        </div>
</div>
       </div>
       
       <!--Shoulders Modal -->
<div class="modal fade" id="shoulderWorkouts" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title" id="exampleModalLabel">Shoulders Workouts</h2>
                
            </div>
            <div class="modal-body">
               <h3 class="list-group-item-heading">Beginner</h3>
                <ul class="list-group">
                @foreach ($shoulderWoutsB as $shoulderWB)
                    <li class="list-group-item">
								<span class="tag tag-success tag-pill float-xs-right">{{$shoulderWB->sets}} Sets</span>
								<span class="tag tag-primary tag-pill float-xs-right">{{$shoulderWB->reps}} Reps</span>
								{{$shoulderWB->workout_name}}
							</li>
							@endforeach
						</ul>
              
              <br>
               <h3 class="list-group-item-heading">Intermediate</h3>
                <ul class="list-group">
                @foreach ($shoulderWoutsI as $shoulderWI)
                <li class="list-group-item">
								<span class="tag tag-success tag-pill float-xs-right">{{$shoulderWI->sets}} Sets</span>
								<span class="tag tag-primary tag-pill float-xs-right">{{$shoulderWI->reps}} Reps</span>
								{{$shoulderWI->workout_name}}
							</li>
								@endforeach
                
						</ul>
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
       
       <div class="col-md-4">
           <div class="view hm-zoom">
            <img src="custom_image/triceps.fw.png" class="img-fluid " alt="">
        <div class="mask flex-center">
        <button class="btn mr-1 mb-1 btn-warning btn-lg" data-toggle="modal" data-target="#tricepsWorkouts">View</button>        
        </div>
</div>
       </div>
       
       <!--Triceps Modal -->
<div class="modal fade" id="tricepsWorkouts" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title" id="exampleModalLabel">Triceps Workouts</h2>
                
            </div>
            <div class="modal-body">
               <h3 class="list-group-item-heading">Beginner</h3>
                <ul class="list-group">
                @foreach ($tricepsWoutsB as $tricepsWB)
                    <li class="list-group-item">
								<span class="tag tag-success tag-pill float-xs-right">{{$tricepsWB->sets}} Sets</span>
								<span class="tag tag-primary tag-pill float-xs-right">{{$tricepsWB->reps}} Reps</span>
								{{$tricepsWB->workout_name}}
							</li>
							@endforeach
						</ul>
              
              <br>
               <h3 class="list-group-item-heading">Intermediate</h3>
                <ul class="list-group">
                @foreach ($tricepsWoutsI as $tricepsWI)
                <li class="list-group-item">
								<span class="tag tag-success tag-pill float-xs-right">{{$tricepsWI->sets}} Sets</span>
								<span class="tag tag-primary tag-pill float-xs-right">{{$tricepsWI->reps}} Reps</span>
								{{$tricepsWI->workout_name}}
							</li>
								@endforeach
                
						</ul>
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
       
       
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
