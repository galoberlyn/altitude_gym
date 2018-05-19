<!DOCTYPE html>
<html lang="en" data-textdirection="ltr" class="loading">
       @include('member.layouts.head')

       <link rel="stylesheet" type="text/css" href="custom_css/workout.css">
         <link rel="stylesheet" type="text/css" href="../../assets/css/style.css">
       
    <title>My Transactions and Logs</title>
    
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

      @foreach($transac as $transactions)
              <div class="col-xl-4 col-lg-6 col-xs-12">
                            <div class="card bg-teal">
                                <div class="card-body">
                                    <div class="card-block">
                                        <div class="media">
                                            <div class="media-body text-xs-center">
                                                <h2 class="white">Member Status</h2> 
                                                
                                                <h3 class="white">{{$transactions->status}}</h3>
                                                
                                                <br>
                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-xl-4 col-lg-6 col-xs-12">
                            <div class="card bg-pink">
                                <div class="card-body">
                                    <div class="card-block">
                                        <div class="media">
                                            <div class="media-body text-xs-center">
                                                <h2 class="white">Payment Status</h2> 
                                                <h3 class="white">{{$transactions->payment_status}}</h3>
                                                <br>
                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-4 col-lg-6 col-xs-12">
                            <div class="card bg-orange">
                                <div class="card-body">
                                    <div class="card-block">
                                        <div class="media">
                                            <div class="media-body text-xs-center">
                                                <h2 class="white">Subscription</h2> 
                                                <h3 class="white">{{$transactions->subscription}}</h3>
                                                <br>
                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-6 col-lg-6 col-xs-12">
                            <div class="card bg-lime">
                                <div class="card-body">
                                    <div class="card-block">
                                        <div class="media">
                                            <div class="media-body text-xs-center">
                                                <h2 class="white">Expiration Date</h2> 
                                                <h3 class="white">{{$transactions->date}}</h3>
                                                <br>
                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-xs-12">
                            <div class="card bg-blue">
                                <div class="card-body">
                                    <div class="card-block">
                                        <div class="media">
                                            <div class="media-body text-xs-center">
                                                @if(count($exp_date_locker)===0)
                                                <h2 class="white"> Your locker subscription <br>is not available</h2>

                                                @else
                                                @foreach($exp_date_locker as $lock)
                                                <h2 class="white">Locker Status: locker number {{$lock->locker_number}}</h2> 
                                                <h3 class="white">{{$lock->exp_locker}} days till expiration</h3>
                                                @endforeach
                                                @endif
                                                <br>
                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

        @endforeach

        <table id="myTable" class="table table-stripped tablesorter table-hover">
            <thead style="background-color:#D3D3D3">
                <tr>
                <th> Time in </th>
                <th> Time out </th>
                <th> Date </th>
            </tr>
            </thead>

            <tbody>
                @foreach($times as $time)
                <tr>
                <td> {{$time->time_in}} </td>
                <td> {{$time->time_out}} </td>
                <td> {{$time->wewdate}} </td>
            </tr>
                @endforeach
            </tbody>
        </table>
         <div class="text-xs-center">
            {{ $times->render("pagination::bootstrap-4") }}
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
        <script src="../../app-assets/js/core/jquery-latest.js" type="text/javascript"></script>
    <script src="../../app-assets/js/core/jquery.tablesorter.js" type="text/javascript"></script>
    <!-- END PAGE LEVEL JS-->
    <script> $('head').append('<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">'); </script>
     <script type="text/javascript">
    $(document).ready(function() 
    { 
        $("#myTable").tablesorter(); 
    } 
); 
    </script>
    </body>
    </html>