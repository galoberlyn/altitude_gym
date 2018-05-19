<!DOCTYPE html>
<html lang="en" data-textdirection="ltr" class="loading">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="Robust admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities.">
    <meta name="keywords" content="admin template, robust admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="PIXINVENT">
    <link rel="apple-touch-icon" sizes="60x60" href="../../../app-assets/images/ico/apple-icon-60.png">
    <link rel="apple-touch-icon" sizes="76x76" href="../../app-assets/images/ico/apple-icon-76.png">
    <link rel="apple-touch-icon" sizes="120x120" href="../../app-assets/images/ico/apple-icon-120.png">
    <link rel="apple-touch-icon" sizes="152x152" href="../../app-assets/images/ico/apple-icon-152.png">
    <link rel="shortcut icon" type="image/x-icon" href="../../app-assets/images/ico/favicon.ico">
    <link rel="shortcut icon" type="image/png" href="../../app-assets/images/ico/favicon-32.png">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-touch-fullscreen" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="default">
    <!-- BEGIN VENDOR CSS-->
    <link rel="stylesheet" type="text/css" href="../../../app-assets/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="../../../css/app.css">
    <!-- font icons-->
    <link rel="stylesheet" type="text/css" href="../../../app-assets/fonts/icomoon.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/fonts/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/extensions/pace.css">
    <!-- END VENDOR CSS-->
    <!-- BEGIN ROBUST CSS-->
    <link rel="stylesheet" type="text/css" href="../../../app-assets/css/bootstrap-extended.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/css/app.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/css/colors.css">
    <!-- END ROBUST CSS-->
    <!-- BEGIN Page Level CSS-->
    <link rel="stylesheet" type="text/css" href="../../../app-assets/css/core/menu/menu-types/vertical-menu.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/css/core/menu/menu-types/vertical-overlay-menu.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/css/core/colors/palette-gradient.css">
    <!-- END Page Level CSS-->
    <!-- BEGIN Custom CSS-->
    <link rel="stylesheet" type="text/css" href="../../../assets/css/style.css">
    <!-- END Custom CSS-->
    <title>Altitude Gym | Award Badge</title>
  </head>
  <body data-open="click" data-menu="vertical-menu" data-col="2-columns" class="vertical-layout vertical-menu 2-columns  fixed-navbar">
   
    @include('admin.layouts.nav')
    @include('admin.layouts.main_menu')
    <div class="app-content content container-fluid">
      <div class="content-wrapper">
        <div class="content-header row">
		             @include('admin.inc.message')
          <div class="content-header-right breadcrumbs-right breadcrumbs-top col-md-12 col-xs-12">
            <div>
        <a class=" float-xs-right" href = "/assign_badge/{{$badge_id}}"><i class="icon-arrow-left"></i>  Back</a>
            </div>
          </div>
        </div>
        <div class="content-body"><!-- Description -->
    <div class="content-body">
          {{ csrf_field() }}
<section id="description col-md-6" class="card">
    <div class="card-body collapse in">
        <div class="card-block">
        <h4 class= "blue-grey text-xs-center"><i class="icon-trophy"></i>Awarding badge {{strtoupper($badge_name)}} to {{$first_name}} {{$last_name}}<i class="icon-trophy"></i></h4>
        <h5>Member's previously owned badges:</h5>
        <table class = "table table-bordered table-striped table-success">
          <tr>
            <th>Date Achieved</th>
            <th>Badge Name</th>
          </tr>
          @foreach($badges as $badge)
            <tr>
              <td>
                {{$badge->date_achieved}}
              </td>
              <td>
                @if ($badge->badge_id == $badge_id)
                <div class = 'hidden'>
                {{$got_badge = 1}}
              </div>
                @endif
                {{strtoupper($badge->badge_name)}}
            </tr>
          @endforeach
        </table>
        {!! Form::open ([ 'action' => 'AdminAssignBadgeController@store', 'method' => 'POST']) !!}
        <div class="form-group">
            <div class="position-relative has-icon-left">
              {{Form::text('badge_id', $badge_id, ['class' => 'hidden form-control round border-success', 'placeholder' => "The user's nickname"])}}
              {{Form::text('user_id', $user_id, ['class' => 'hidden form-control round border-success', 'placeholder' => "The user's nickname"])}}
              @if ($got_badge == 1)
              <center><h5 class= "danger">This badge has been earned!</h5></center>
              @else
              <center>{{Form::submit('Submit', ['class'=>'btn btn-primary'])}}</center>
              @endif
              <div class="form-control-position">
              </div>
            </div>
        </div>
        {!! Form::close() !!} 
          
          </div>
    </div>
        
</section>

<!--/ Description -->


        </div>
      </div>
    </div>
</div>
</div>
    <script src="../../../app-assets/js/core/libraries/jquery.min.js" type="text/javascript"></script>
    <script src="../../../app-assets/vendors/js/ui/tether.min.js" type="text/javascript"></script>
    <script src="../../../app-assets/js/core/libraries/bootstrap.min.js" type="text/javascript"></script>
    <script src="../../../app-assets/vendors/js/ui/perfect-scrollbar.jquery.min.js" type="text/javascript"></script>
    <script src="../../../app-assets/vendors/js/ui/unison.min.js" type="text/javascript"></script>
    <script src="../../../app-assets/vendors/js/ui/blockUI.min.js" type="text/javascript"></script>
    <script src="../../../app-assets/vendors/js/ui/jquery.matchHeight-min.js" type="text/javascript"></script>
    <script src="../../../app-assets/vendors/js/ui/screenfull.min.js" type="text/javascript"></script>
    <script src="../../../app-assets/vendors/js/extensions/pace.min.js" type="text/javascript"></script>
    <!-- BEGIN VENDOR JS-->
    <!-- BEGIN PAGE VENDOR JS-->
    <script src="../../../app-assets/vendors/js/charts/chart.min.js" type="text/javascript"></script>
    <!-- END PAGE VENDOR JS-->
    <!-- BEGIN ROBUST JS-->
    <script src="../../../app-assets/js/core/app-menu.js" type="text/javascript"></script>
    <script src="../../../app-assets/js/core/app.js" type="text/javascript"></script>
    <!-- END ROBUST JS-->
    <!-- BEGIN PAGE LEVEL JS-->
    <script src="../../../app-assets/js/scripts/pages/dashboard-lite.js" type="text/javascript"></script>
    <!-- END PAGE LEVEL JS-->
	<br><br><br>
    <footer class="footer footer-static footer-light navbar-border">
      <p class="clearfix text-muted text-sm-center mb-0 px-2"><span class="float-md-center d-xs-block d-md-inline-block">Copyright  &copy; 2018 <b>ALTITUDEGYM</b> </a>, All rights reserved. </span></p>
    </footer>
  </body>
</html>