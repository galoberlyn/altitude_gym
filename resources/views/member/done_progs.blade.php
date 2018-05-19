<!DOCTYPE html>
<html lang="en" data-textdirection="ltr" class="loading">
    @include('member.layouts.head')
    <title>My Finished workouts</title>
       <link rel="stylesheet" type="text/css" href="custom_css/goals.css">
       <link rel="stylesheet" type="text/css" href="../../css/app.css">
         <link rel="stylesheet" type="text/css" href="../../assets/css/style.css">
    
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
    @include('member.layouts.notification')



<!--/ project charts -->
<!-- Recent invoice with Statistics -->
<table align="center" id="myTable" class="table table-stripped table-hover tablesorter">
  <thead style="background-color:#D3D3D3">
  <th> Program Type </th>

  <th> Program Finished Date </th>
</thead>
<tbody>
  @foreach($my_workouts as $work)
  <tr>
  <td> {{$work-> type}} </td>

  <td> {{$work-> updated_at}} </td>
  </tr>
  @endforeach
</tbody>
</table>



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
     <script type="text/javascript">
    $(document).ready(function() 
    { 
        $("#myTable").tablesorter(); 
    } 
); 
    </script>
  </body>

</html>
