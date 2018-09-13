<!DOCTYPE html>
<html lang="en" data-textdirection="ltr" class="loading">
 
  @include('member.layouts.head')
   
    <title>Gamification  Policies</title>
    
  <body data-open="click" data-menu="vertical-menu" data-col="2-columns" class="vertical-layout vertical-menu 2-columns  fixed-navbar">

    @include('member.layouts.nav')      
    
    @include('member.layouts.main_menu') 


    
    <div class="app-content content container-fluid">
      <div class="content-wrapper">
        <div class="content-header row">
        </div>
        <div class="content-body"><!-- stats -->
        
 <div class="row">
    <div class="col-xl-8 col-xs-12">
      @include('member.layouts.notification')
        <div class="card">
           
           <div class="card-header">
               <h2 class="green card-title">Gamification Policies</h2>
           </div>
           
            <div class="card-body">
                <div class="card-block">

                    <div class="media">
    
                            <ul class="list-group list-group-flush">
								@foreach ($gamepoli as $game)
								<li class="list-group-item">{{$game->policy_description}}</li>
								@endforeach
							</ul>
                            
                        </div>
                        <div class="card-header">
                        <h3 class="blue">Leveling-Up</h3>
                            
                        </div>
             <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="bg-teal bg-lighten-4">
                            <tr>
                                <th>Level</th>
                                <th>Category</th>
                                <th>Base Point</th>
                              
                                                    
                            </tr>
                        </thead>
                        <tbody>
							@foreach($points as $pts)
								<tr>
									<td>{{$pts->level}}</td>
									<td>{{$pts->category}} </td>
									<td>{{$pts->base_point}}</td>
								
							
								</tr>
							@endforeach
                        </tbody>
                    </table>
                </div>

                    </div>        
                       
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-xs-12">
        <div class="card" style="width: 23rem;">  
          <div class="card-block">
            <div class="row match-height">
      <div class="mb-1 text-xs-center"> 
        <h4>Gym Achievements <i class="icon-ribbon-b"></i></h4>
        <p>How achievements are gained</p>
      </div>
      <div id="accordionWrapa1" role="tablist" aria-expanded="true"> 
        <div class="card">

          @foreach($badges as $badge)
          <div id="heading{{$badge->id}}"  class="card-header">
            <a data-toggle="collapse" data-parent="#accordionWrapa1" href="#accordion{{$badge->id}}" aria-expanded="false" aria-controls="accordion2" class="card-title lead collapsed red">{{$badge->badge_name}}</a>
          </div>
          <div id="accordion{{$badge->id}}" role="tabpanel" aria-labelledby="heading{{$badge->id}}" class="card-collapse collapse" aria-expanded="true">
            <div class="card-body">
              <div class="card-block">
              <div class="row">
               <img src="../badges/{{$badge->badge_name}}.png" style="width:120px;height:150px;" class="mx-auto d-block">
              </div>
               <div class="row">
               <p class="text-xs-center">    
                {{$badge->badge_description}}  
               </p>
               </div>
              </div>
            </div>
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
