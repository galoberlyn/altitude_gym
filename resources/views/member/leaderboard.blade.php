<!DOCTYPE html>
<html lang="en" data-textdirection="ltr" class="loading">
    @include('member.layouts.head')
       <link rel="stylesheet" type="text/css" href="custom_css/leaderboard_member.css">

    <title>Leaderboard</title>
    
  <body data-open="click" data-menu="vertical-menu" data-col="2-columns" class="vertical-layout vertical-menu 2-columns  fixed-navbar">

    @include('member.layouts.nav')      
                   
                @foreach($name_result as $username)
                      {{ $username->name }}
                @endforeach

    @include('member.layouts.main_menu')    
  
    <div class="app-content content container-fluid">
      <div class="content-wrapper">
        <div class="content-header row">
        </div>
        <div class="content-body"><!-- stats -->



     @include('member.layouts.notification')
  <div class="row">
    <div class="col-xs-8">

     <div class="card">
     <div class="card-header">
          
						<h2 class="card-title">Gym Leaders</h2>
						<div class="heading-elements">
                  <form action="/leaderboard" method="POST">
                  {{ csrf_field() }}  
                  <select name="category" onchange="this.form.submit()" class="form-control"> 
                    <option value="" selected disabled hidden>Choose leaderboard filters</option> 
                    <option value="beginner"> All Time Beginner </option>
                    <option value="intermediate"> All Time Intermediate </option>
                    <option value="expert"> All time Advanced </option>
                    <option value="badges"> Most Earned Badges </option>
                    <option value="exp"> Most Earned Experience Points </option>
                  </select>
                  </form>

					</div>
     </div>
     <br>
     
				<div class="card-body">
					
					<ul class="list-group list-group-flush">
           
        
      
          
                

          @foreach($all_time_index as $key => $all)
						<li class="list-group-item">
							<div class="media">
                        <div class="media-body red text-xs-left">
                  
                     
                            <h3 class="red">@if($key == 0) <i class="icon-fire3 font-large"></i> @endif {{$key+1}} {{$all ->Name." " }}   <span class="h6"><a class="warning" href="/viewprofile/{{$all->id}}"> View Badges </a></span> </h3> 
                            <span> Level: {{$all->level}}, {{$all->total_exp}}pts total</span><br>
                            

               
                            
                            
                        </div>
                        <div class="media-right media-middle">
                      <!--       <i class="icon-smile font-large-3 float-xs-right"></i> -->
                            <img src="/uploads/avatars/{{$all->avatar}}" height="70px" width="70px">
                        </div>
                       

                    </div>
         
						</li>
            @endforeach

       
           <!--    <h1 class="teal text-xs-center">{{" No users made it to the leaderboards "}}</h1> -->
       
					</ul>

				</div>
			</div>
     
</div>

<div class="col-md-4">
    <div class="card" >
       <div class="card-header">
        @foreach($myown as $own)
           <h3 class="orange">My Stats</h3>
           <br>
           <h4 class="teal">{{$own->exp}} Total Points</h4>
           <br>
           <!-- <h4 class="red">Catch up to the leader!</h4> -->
       </div>
            <div class="card-body">
            <div class="card-block">
            <img src="/uploads/avatars/{{$own->avatar}}" style="width:150px; height:150px border-radius=50%; " class="mx-auto d-block card-img-top">
            </div>
            
            <div class="card-block">
            <h4 class="card-title">{{$username->name}}</h4>

          </div>
          
              <ul class="list-group list-group-flush">
            <li class="list-group-item"> <h4>My Level: {{$own->level}}</h4> </li> 
            
            <li class="list-group-item h4">My Experience Points: {{$own->exp}}</li>
          </ul>    
        </div>
          <div class="card-block text-xs-center">
            <a href="/editprofile" class="btn btn-primary card-link">Edit Profile</a>
            <!-- <a href="#" class="card-link">Another link</a> -->
        @endforeach
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
