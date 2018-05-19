<!DOCTYPE html>
<html lang="en" data-textdirection="views" class="loading">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="Robust admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities.">
    <meta name="keywords" content="admin template, robust admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="PIXINVENT">
    <title>Altitude Gym</title>
    <link rel="apple-touch-icon" sizes="60x60" href="../../app-assets/images/ico/apple-icon-60.png">
    <link rel="apple-touch-icon" sizes="76x76" href="../../app-assets/images/ico/apple-icon-76.png">
    <link rel="apple-touch-icon" sizes="120x120" href="../../app-assets/images/ico/apple-icon-120.png">
    <link rel="apple-touch-icon" sizes="152x152" href="../../app-assets/images/ico/apple-icon-152.png">
    <link rel="shortcut icon" type="image/x-icon" href="../../app-assets/images/ico/favicon.ico">
    <link rel="shortcut icon" type="image/png" href="../../app-assets/images/ico/favicon-32.png">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-touch-fullscreen" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="default">
    <!-- BEGIN VENDOR CSS-->
    <link rel="stylesheet" type="text/css" href="../../app-assets/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="../../css/app.css">
    <!-- font icons-->
    <link rel="stylesheet" type="text/css" href="../../app-assets/fonts/icomoon.css">
    <link rel="stylesheet" type="text/css" href="../../app-assets/fonts/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" type="text/css" href="../../app-assets/vendors/css/extensions/pace.css">
    <!-- END VENDOR CSS-->
    <!-- BEGIN ROBUST CSS-->
    <link rel="stylesheet" type="text/css" href="../../app-assets/css/bootstrap-extended.css">
    <link rel="stylesheet" type="text/css" href="../../app-assets/css/app.css">
    <link rel="stylesheet" type="text/css" href="../../app-assets/css/colors.css">
    <!-- END ROBUST CSS-->
    <!-- BEGIN Page Level CSS-->
    <link rel="stylesheet" type="text/css" href="../../app-assets/css/core/menu/menu-types/vertical-menu.css">
    <link rel="stylesheet" type="text/css" href="../../app-assets/css/core/menu/menu-types/vertical-overlay-menu.css">
    <link rel="stylesheet" type="text/css" href="../../app-assets/css/core/colors/palette-gradient.css">
    <!-- END Page Level CSS-->
    <!-- BEGIN Custom CSS-->
    <link rel="stylesheet" type="text/css" href="../../assets/css/style.css">
    <!-- END Custom CSS-->
	<style>
	.shadow {
		  -moz-box-shadow:    2px 2px 2px 2px #ADD8E6;
		  -webkit-box-shadow: 2px 2px 2px 2px #ADD8E6;
		  box-shadow:         2px 2px 2px 2px #ADD8E6;
		}
	</style>
  </head>
<script>
		function date_time(id){
        date = new Date;
        year = date.getFullYear();
        month = date.getMonth();
        months = new Array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');
        d = date.getDate();
        day = date.getDay();
        days = new Array('Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday');
        h = date.getHours();
        if(h<10)
        {
                h = "0"+h;
        }
        m = date.getMinutes();
        if(m<10)
        {
                m = "0"+m;
        }
        s = date.getSeconds();
        if(s<10)
        {
                s = "0"+s;
        }
        result = ''+days[day]+' '+months[month]+' '+d+', '+year+' '+h+':'+m+':'+s;
        document.getElementById(id).innerHTML = result;
        setTimeout('date_time("'+id+'");','1000');
        return true;
		}
		</script>

<body style="background-image:  url(rfidimgs/bg-2.jpg)" class="bg-full-screen-image blank-page">
<div class="app-content content container-fluid">
      <div class="content-wrapper">
        <div class="content-header row">
        </div>
        <div class="content-body">
		<section class="flexbox-container">
    <div class="col-md-4 offset-md-4 col-xs-10 offset-xs-1 box-shadow-3 p-0">
        <div class="card border-grey border-lighten-3 px-1 py-1 m-0">
            <div class="card-header no-border">
                <div class="card-title text-xs-center">
                    <img src="../../app-assets/Alti.png" style="width:15%;" alt="branding logo">
                </div>
                <h2 class="card-subtitle line-on-side text-muted text-xs-center pt-2"><span>Altitude Gym</span></h2>
            </div>
            <div class="card-body collapse in">
                <div class="text-xs-center">
						@foreach($data as $d)
								@if (($d -> expiration_date) ==  date('Y-m-d'))
									<div class="alert-danger alert-icon-right round text-xs-center">
											<h6>Your Membership is Already Expired!!<br> Please Renew Membership</h6>
									</div>
								@endif
								
								@if (3 >= $d ->diff && $d ->diff > 0)
									<div class="alert-warning alert-icon-right round text-xs-center">
											<h6>Your Membership is Almost Expiring!!<br> You have {{$d -> diff}} days before expiration</h6>
									</div>
								@endif
                   <img src="/uploads/avatars/{{ $d->avatar }}" class="rounded-circle  height-100" alt="Card image">
                </div>
                <h3 class="card-subtitle line-on-side text-muted text-xs-center mx-2 my-1"><span id="date_time"><script type="text/javascript">window.onload = date_time('date_time');</script></span></h3>
                <div class="card-block">
						<h2 class="text-xs-center">{{$d -> first_name}} {{$d -> last_name}}</h2>
						<h3 class="text-xs-center">Time in: <?php echo date('H:i:s', time())?></h3>
					@endforeach
                </div>
				
				<div class="text-xs-center">
						@foreach($query as $e)
								@if (($e -> expiration_date) ==  date('Y-m-d'))
									<div class="alert-danger alert-icon-right round text-xs-center">
											<h6>Your Membership is Already Expired!!<br> Please Renew Membership</h6>
									</div>
								@endif
								
								@if (3 >= $e ->diff && $e ->diff > 0)
									<div class="alert-warning alert-icon-right round text-xs-center">
											<h6>Your Membership is Almost Expiring!!<br> You have {{$e -> diff}} days before expiration</h6>
									</div>
								@endif
                   <img src="/uploads/avatars/{{ $e->avatar }}" class="rounded-circle  height-100" alt="Card image">
                </div>
                <h3 class="card-subtitle line-on-side text-muted text-xs-center mx-2 my-1"><span id="date_time"><script type="text/javascript">window.onload = date_time('date_time');</script></span></h3>
                <div class="card-block">
						<h2 class="text-xs-center">{{$e -> first_name}} {{$e -> last_name}}</h2>
						<h3 class="text-xs-center">Time out: <?php echo date('H:i:s', time())?></h3>
					@endforeach
                </div>
				
				<div class = "col-xs-6">
                <h5 class="card-subtitle line-on-side text-muted text-xs-center mx-2 my-1"><span>Time in</span></h5>
				</div>
				
				<div class = "col-xs-6">
                <h5 class="card-subtitle line-on-side text-muted text-xs-center mx-2 my-1"><span>Time out</span></h5>
				</div>
				
                <div class="card-block">
					<form class="form-horizontal" action="/details" method="POST">
                        {{ csrf_field() }}
                        <div class="form-group col-xs-6">
                                <fieldset class="form-group position-relative has-icon-left mb-0">
                                    <input class="form-control shadow" id="timeout" name= "timein" placeholder="Password or ID No." type="password" value="" />
                                        <div class="form-control-position">
                                            <i class="icon-head"></i>
                                        </div>
                                </fieldset>
                        </div>
						
						<div class="form-group col-xs-6">
                                <fieldset class="form-group position-relative has-icon-left mb-0">
                                    <input class="form-control shadow" id="timeout" name= "timeout" placeholder="Password or ID No." type="password" value=""/>
                                        <div class="form-control-position">
                                            <i class="icon-head"></i>
                                        </div>
                                </fieldset>
                        </div>
						<br><br><br>
								@if ($errors->any())
									<div class="alert-danger text-xs-center">
										@foreach ($errors->all() as $error)
											<p>{{ $error }}</p>
										@endforeach
										</div>
								@endif
							
                            <center>
                                <button type="submit" name= "login" class="btn btn-red btn-md">
                                   Enter
                                <i class="icon-unlock2"></i></button>
							</center>
                    </form>
							
                </div>
            </div>
        </div>
    </div>
</section>
</div>
</div>
</div>
	
   <script src="../../app-assets/js/core/libraries/bootstrap.min.js" type="text/javascript"></script>
    <script src="../../js/app.js" type="text/javascript"></script>
    <script src="../../app-assets/js/core/libraries/jquery.min.js" type="text/javascript"></script>
    <script src="../../app-assets/vendors/js/ui/tether.min.js" type="text/javascript"></script>
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
