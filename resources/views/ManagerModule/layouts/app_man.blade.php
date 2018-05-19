<!DOCTYPE html>
<html lang="en" data-textdirection="views" class="loading">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
  <meta name="description" content="Robust admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities.">
  <meta name="keywords" content="admin template, robust admin template, dashboard template, flat admin template, responsive admin template, web app">
  <meta name="author" content="PIXINVENT">
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
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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
  <!-- BEGIN Custom CSS-->
  <link rel="stylesheet" type="text/css" href="../../custom_css/style.css">
  <link rel="stylesheet" type="text/css" href="css/customized.css">
  <!-- END Custom CSS-->
  <link rel="stylesheet" type="text/css" href="../jquery.metadata.js">
  <link rel="stylesheet" type="text/css" href="../jquery.tablesorter.min.js">
 
</head>
<body data-open="click" data-menu="vertical-menu" data-col="2-columns" class="vertical-layout vertical-menu 2-columns  fixed-navbar">
  @if(session('error_password'))
  @include('ManagerModule.layouts.error')
  @endif

  <!-- navbar-fixed-top-->
  <nav class="header-navbar navbar navbar-with-menu navbar-fixed-top navbar-semi-dark navbar-shadow">
    <div class="navbar-wrapper">
      <div class="navbar-header">
        <ul class="nav navbar-nav">
          <li class="nav-item mobile-menu hidden-md-up float-xs-left"><a class="nav-link nav-menu-main menu-toggle hidden-xs"><i class="icon-menu5 font-large-1"></i></a></li>
          <li class="nav-item"><a href="/dashboard_m" class="navbar-brand nav-link"><img alt="branding logo" src="/memimg/altilogo.png" data-expand="/memimg/altilogo.png" data-collapse="/memimg/Altismall.png" class="brand-logo"></a></li>
          <li class="nav-item hidden-md-up float-xs-right"><a data-toggle="collapse" data-target="#navbar-mobile" class="nav-link open-navbar-container"><i class="icon-ellipsis pe-2x icon-icon-rotate-right-right"></i></a></li>
        </ul>
      </div>
      <div class="navbar-container content container-fluid">
        <div id="navbar-mobile" class="collapse navbar-toggleable-sm">
          <ul class="nav navbar-nav">
            <li class="nav-item hidden-sm-down"><a class="nav-link nav-menu-main menu-toggle hidden-xs"><i class="icon-menu5">         </i></a></li>
          </ul>
          <ul class="nav navbar-nav float-xs-right">
            <li class="dropdown dropdown-notification nav-item"><a href="#" data-toggle="dropdown" class="nav-link nav-link-label"><i class="ficon icon-bell4"></i><span class="tag tag-pill tag-default tag-danger tag-default tag-up">{{$notification -> count()}}</span></a>
                            <ul class="dropdown-menu dropdown-menu-media dropdown-menu-right">
                <li class="dropdown-menu-header">
                  <h6 class="dropdown-header m-0"><span class="grey darken-2">Notifications</span><span class="notification-tag tag tag-default tag-danger float-xs-right m-0">{{$notification -> count()}} New</span></h6>
                </li>
                <li class="list-group scrollable-container">
                  @foreach ($notification as $message)
                <a href="javascript:void(0)" class="list-group-item">
                  <div class="media">
                    <div class="media-left valign-middle"><i class="icon-user1 icon-bg-circle bg-cyan"></i></div>
                    <div class="media-body">
                      <h6 class="media-heading">{{$message->first_name}} {{$message-> last_name}}</h6>
                      <p class="notification-text font-small-3 text-muted">{{$message->message}}</p>
                      @if ($message-> notification_type == 'confirmation')
                      <form action="/read_conf" method="POST">
                      {{ csrf_field() }}
                      <input name="snd" id="snd" hidden value="{{$message -> id}}"> 
                      <button class="btn grey btn-outline-secondary" type="submit" name="read_conf"> View</button>
                      </form>
                      <!-- <button  onclick="window.location.href='/confirmation'"> View</button>  -->
                      @else
                      <form action="/read_at" method="POST">
                      {{ csrf_field() }} 
                      <input name="send" id="send" hidden value="{{$message -> id}}"> 
                      <button class="btn grey btn-outline-secondary" type="submit" name="read_at"> View</button>
                      </form> 
                      @endif

                        <small>
                        {{ $message-> created_at }}
                        </small>

                        
                      </div>
                    </div>
                    </a>
                    @endforeach
                  </li>
                    <!-- <a href="javascript:void(0)" class="list-group-item"></a> -->
                  <form action="/read_all" method="POST">
                  <li class="dropdown-menu-footer">
                  <a href="#" class="dropdown-item text-muted text-xs-center">
                  
                  {{ csrf_field() }}
                  
                      <button class="btn grey btn-outline-secondary" type="submit" name="read_all"> Read all notification</button>
                  
                  </a>
                  </li>
                  </form>
                </ul>
              </li>

              <li class="dropdown dropdown-user nav-item"><a href="#" data-toggle="dropdown" class="dropdown-toggle nav-link dropdown-user-link"><span class="avatar avatar-online"><img src="../../uploads/avatars/default.jpg" alt="avatar"><i></i></span><span class="user-name">Manager</span></a>
                <div class="dropdown-menu dropdown-menu-right">                  <a href="" data-toggle="modal" data-target="#changePw" class="dropdown-item"><i class="icon-lock4"></i> Change Password </a>
                  <div class="dropdown-divider"></div>
                  <a href="{{ route('logout') }}" onclick="event.preventDefault();
                  document.getElementById('logout-form').submit();" class="dropdown-item"><i class="icon-power3"></i> Logout
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                  {{ csrf_field() }}
                  <!-- end -->
                </form>
              </div>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </nav>

  <!--Change Password Modal-->
  <div class="container">
    <!-- Modal -->
    <div class="modal fade" id="changePw" role="dialog">
      <div class="modal-dialog modal-sm">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Change Password <i class="icon-lock4"></i></h4>
          </div>
          <div class="modal-body">
            <form class="form" method="POST" action="/changer_m">
              {{ csrf_field()}}
              <div class="form-body">
                <div class="form-group">

                  <div class="form-group">
                    <label for="newPassConfirm">Old Password</label>
                    <input type="password" id="newPassConfirm" class="form-control" required placeholder="Old Password" name="oldpw">
                  </div>

                  <label for="newPass">New Password</label>
                  <input type="password" id="newPass" class="form-control" required placeholder="New Password" name="newpw">
                </div>
                
                <div class="form-group">
                  <label for="newPassConfirm">Confirm New Password</label>
                  <input type="password" id="newPassConfirm" class="form-control" required placeholder="Confirm New Password" name="confnewpw">
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <div class="form-actions">
                <button type="button" class="btn btn-warning mr-1">
                  <i class="icon-cross2"></i> Cancel
                </button>
                <button type="submit" class="btn btn-primary">
                  <i class="icon-check2"></i> Save
                </button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!--Change PW Modal End-->

  <!-- ////////////////////////////////////////////////////////////////////////////-->


  <!-- main menu-->
  <div data-scroll-to-active="true" class="main-menu menu-fixed menu-dark menu-accordion menu-shadow">
    <!-- main menu content-->
    <div class="main-menu-content">
      <ul id="main-menu-navigation" data-menu="menu-navigation" class="navigation navigation-main">
        <li class=" nav-item"><a href="/dashboard_m"><i class="icon-home3"></i><span data-i18n="nav.dash.main" class="menu-title">Dashboard</span></a>
        </li>
        <li class=" nav-item"><a href="/addMember"><i class="icon-android-person-add"></i><span data-i18n="nav.page_layouts.main" class="menu-title">Add Member</span></a>
        </li>   
        <li class=" nav-item"><a href="/addBadge"><i class="icon-shield"></i><span data-i18n="nav.page_layouts.main" class="menu-title">Add Badge</span></a>
        </li>
        <li class=" nav-item"><a href="/memberLog"><i class="icon-ios-list"></i><span data-i18n="nav.page_layouts.main" class="menu-title">Member Log</span></a>
        </li>
        <li class=" nav-item"><a href="/memberList"><i class="icon-ios-list-outline"></i><span data-i18n="nav.page_layouts.main" class="menu-title">Member List</span></a>
        </li>
        <li class=" nav-item"><a href="/expiringMembership"><i class="icon-alert"></i><span data-i18n="nav.page_layouts.main" class="menu-title">Expiring Memberships</span></a>
        </li>
        <li class=" nav-item"><a href="/expiringLockerSubscription"><i class="icon-briefcase2"></i><span data-i18n="nav.page_layouts.main" class="menu-title">Expiring Locker Subscription</span></a>
        </li>
        <li class=" nav-item"><a href="/gamificationPolicies"><i class="icon-ios-game-controller-b"></i><span data-i18n="nav.advance_cards.main" class="menu-title">Gamification Policies</span></a>
        </li>
        <li class=" nav-item"><a href="/gymPolicies"><i class="icon-ios-medkit"></i><span data-i18n="nav.advance_cards.main" class="menu-title">Gym Policies</span></a>
        </li>
        <li class=" nav-item"><a href="/managerNotification"><i class="icon-bell2"></i><span data-i18n="nav.advance_cards.main" class="menu-title">Manager Notifications</span></a>
        </li>
      </ul>
    </div>
  </div>
  <!-- / main menu-->

  <div class="app-content content container-fluid">
    <div class="content-wrapper">
      <div class="content-header row">
      </div>
      <div class="content-body"><!-- stats -->
        <div class="row">
          <div class="col-xl-3 col-lg-6 col-xs-12">
            <div class="card">
              <div class="card-body">
                <div class="card-block">
                  <div class="media">

                    <div class="media-body text-xs-left">

                     <h3 class="danger">@if(count($exp_date)==0)
                       {{"0"}}
                       @else
                       @foreach ($exp_date as $exp_dates)

                       @endforeach
                       {{$exp_dates -> expi}}
                       @endif</h3>
                       <span>Expiring Memberships</span>
                     </div>

                     <div class="media-right media-middle">
                       <i class="icon-bag2 pink font-large-1 float-xs-right"></i>
                     </div>
                   </div>

                 </div>
               </div>
             </div>
           </div>

           @foreach ($member as $members)
           <div class="col-xl-3 col-lg-6 col-xs-12">
            <div class="card">
              <div class="card-body">
                <div class="card-block">
                  <div class="media">
                    <div class="media-body text-xs-left">
                      <h3 class="teal">{{$members -> status}}</h3>
                      <span>Members</span>
                    </div>
                    <div class="media-right media-middle">
                      <i class="icon-user1 teal font-large-2 float-xs-right"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            @endforeach
            @foreach ($active_members as $active_member)
          </div>
          <div class="col-xl-3 col-lg-6 col-xs-12">
            <div class="card">
              <div class="card-body">
                <div class="card-block">
                  <div class="media">
                    <div class="media-body text-xs-left">
                      <h3 class="deep-orange">{{$active_member -> status}}</h3>
                      <span>Active Members</span>
                    </div>
                    <div class="media-right media-middle">
                      <i class="icon-diagram deep-orange font-large-2 float-xs-right"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          @endforeach
          <div class="col-xl-3 col-lg-6 col-xs-12">
            <div class="card">
              <div class="card-body">
                <div class="card-block">
                  <div class="media">
                    <div class="media-body text-xs-left">
                      <h3 class="cyan">
                        {{ date('Y-m-d') }}</h3>
                        <span>Date</span>
                      </div>
                      <div class="media-right media-middle">
                        <i class="icon-ios-calendar-outline cyan font-large-2 float-xs-right"></i>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!--/ stats -->
          <!--/ project charts -->

        </div>
        <!-- ////////////////////////////////////////////////////////////////////////////-->
        @yield('content')
      </div>
    </div>

    <footer class="footer footer-static footer-light navbar-border">
      <p class="clearfix text-muted text-sm-center mb-0 px-2"><span class="float-md-center d-xs-block d-md-inline-block">Copyright  &copy; 2018 <b>ALTITUDEGYM</b> </a>, All rights reserved. </span></p>
    </footer>

    <!-- BEGIN VENDOR JS-->
    <script src="../../app-assets/js/core/libraries/jquery.min.js" type="text/javascript"></script>
    <script src="../../app-assets/vendors/js/ui/tether.min.js" type="text/javascript"></script>
    <script src="../../app-assets/js/core/libraries/bootstrap.min.js" type="text/javascript"></script>
    <script>
      $('.carousel').carousel({
        interval: 4000
      })
    </script>
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
      $('#error_modal').modal({
        show:true
      });
    </script>
    <script type="text/javascript">
    $(document).ready(function() 
    { 
        $("#myTable").tablesorter(); 
    } 
); 
    </script>
  </body>
  </html>

