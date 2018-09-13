<!DOCTYPE html>
<html lang="en" data-textdirection="ltr" class="loading">
  <head>
    @include('member.layouts.head')
    <title>Profile Information</title>
    
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
    @foreach($user_det as $det)

    
    <!-- start private -->
    <div class="row">
        
    <div class="col-md-1"></div>
    
    <div class="col-md-10">
       
       <div class="card">
            <div class="card-body">
                <div class="media">
                    <div class="p-3  text-xs-center media-left">
                      @foreach($dp as $avat)
                        <img src="/uploads/avatars/{{$avat->avatar}}" style="width:150px; height:150px; border-radius: 50%;">
                        @endforeach
                    </div>
                    <div class="p-2 media-body">
                        @foreach($user_det as $det2)  
                        <h1 class="orange">{{$det2->name}}</h1>
                        @endforeach  
                        @foreach ($user_lvl as $lvlz) 
                        <h3 class="amber">Level {{$lvlz->slevel}}</h3>
                        <progress class="progress progress-striped" value="{{$lvlz->exp}}" max="{{$lvlz->base_point}}" style="height: 20px;"></progress>
                        @endforeach
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
    
    <div class="col-md-1"></div>
    
    </div>
    <!-- end private -->
  
    @endforeach



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
