<!DOCTYPE html>
<html lang="en" data-textdirection="ltr" class="loading">
  <head>
    @include('admin.layouts.css_links')
    <title>Altitude Gym</title>
  </head>
  <body data-open="click" data-menu="vertical-menu" data-col="2-columns" class="vertical-layout vertical-menu 2-columns  fixed-navbar">
    @include('admin.layouts.nav')
    @include('admin.layouts.main_menu')
     <div class="app-content content container-fluid">
      <div class="content-wrapper">
        <div class="content-header row">
           @include('admin.inc.message')
        </div>
        <div class="content-body"><!-- stats -->
<div class="row">
  <div class="col-xl-12 col-lg-12">
  <div class="row">
    <div class="col-xs-8">
<div class="media bg-light-green bg-lighten-2 white">

                <div class="card-body text-xs-center">
                        <div class="media-left bg-light-green bg-lighten-2 bg-darken-2 p-2 media-middle">
                            <i class="icon-smile font-large-2 white"></i>
                        </div>
                        <div class="media-body p-2">
                            <h4>WELCOME TO ALTITUDE GYM!</h4>
                            <span>Monday-Friday 6:00am-10:00pm</span><br>
                            <span>Saturday 8:00am-10:00pm</span>
                        </div>
                        <div class="media-right bg-light-green bg-lighten-2 bg-darken-2 p-2 media-middle">
                            <i class="icon-smile font-large-2 white"></i>
                        </div>
                    </div>
                </div>
      <div class="card-group">
        <div class="card">
            <!-- <img class="card-img-top" src="../../assets/images/2.jpg" alt="exp"> -->          
            <div class="card-block">

                    <div class="media">
                        <div class="media-body danger text-xs-left">
                             <h3 class="danger" >@if(count($exp_date)==0)
                        {{"0"}}
                        @else
                        @foreach($exp_date as $exp_dates)
                        {{$exp_dates -> expi}}
                        @endforeach
                        @endif</h3>
                            <span>Expiring Memberships</span>
                        </div>
                        <div class="media-right media-middle">
                            <i class="icon-alert danger font-large-3 float-xs-right"></i>
                        </div>
                        <progress class="progress progress-sm progress-danger mt-1 mb-0" value="1035" max="1035"></progress>
                    </div>
                </div>
        </div>
@foreach ($mems as $member)
        <div class="card">
            <!-- <img class="card-img-top" src="../../assets/images/2.jpg" alt="mem"> -->
                <div class="card-block">
                    <div class="media">
                        <div class="media-body teal text-xs-left">
                            <h3 class="teal">{{$member -> status}}</h3>
                            <span>Members</span>
                        </div>
                        <div class="media-right media-middle">
                            <i class="icon-user4 teal font-large-3 float-xs-right"></i>
                        </div>
                        <progress class="progress progress-sm progress-teal mt-1 mb-0" value="1035" max="1035"></progress>
                    </div>
                </div>      
        </div>
  </div>
  @endforeach
  @foreach ($active_members as $active_member)
    <div class ="card-group">
        <div class="card bg-white">
            <!-- <img class="card-img-top" src="../../assets/images/2.jpg" alt="act"> -->
                <div class="card-block">
                    <div class="media">
                        <div class="media-body green text-xs-left">
                            <h3 class="green">{{$active_member -> status}}</h3>
                            <span>Active Members</span>
                        </div>
                        <div class="media-right media-middle">
                            <i class="icon-diagram green font-large-3 float-xs-right"></i>
                        </div>
                      <progress class="progress progress-sm progress-green mt-1 mb-0" value="1035" max="1035"></progress>                        
                    </div>
                </div>
         @endforeach   
        </div>
        @foreach ($daysdiffs as $daydiffs)
        <div class="card">
            <!-- <img class="card-img-top" src="../../assets/images/2.jpg" alt="date"> -->
                <div class="card-block">
                    <div class="media">
                        <div class="media-body cyan text-xs-left">
                            <h3 class="cyan">{{$daydiffs -> new}}
                          
                              </h3>
                            <span>New Members </span>
                        </div>
                        
                        <div class="media-right media-middle">
                            <i class="icon-android-people cyan font-large-3 float-xs-right"></i>
                        </div>
                    <progress class="progress progress-sm progress-cyan mt-1 mb-0" value="150" max="150"></progress>                        

                    </div>
                </div>
        </div>
    </div>
    @endforeach
    <div class ="card-group">
        <div class="card">
            <!-- <img class="card-img-top" src="../../assets/images/2.jpg" alt="act"> -->
                <div class="card-block">
                    <div class="media">
                        <div class="media-body blue-grey text-xs-left">
                            <h3 class="blue-grey">Member Log</h3>

                            <span><a href="/log"> View...</a></span> 
                        </div>
                        <div class="media-right media-middle">
                            <i class="icon-book blue-grey font-large-3 float-xs-right"></i>
                        </div>
                        <progress class="progress progress-sm progress-blue-grey mt-1 mb-0" value="1035" max="1035"></progress>
                    </div>
                </div>
            
        </div>
        <div class="card">
            <!-- <img class="card-img-top" src="../../assets/images/2.jpg" alt="date"> -->
                <div class="card-block">
                    <div class="media">
                        <div class="media-body orange text-xs-left">
                            <h3 class="orange">Gamification Policies</h3>
                            <a href="/gamification"> View... </a> 
                        </div>
                        <div class="media-right media-middle">
                            <i class="icon-ios-help-outline orange font-large-3 float-xs-right">
                            
                            </i>
                        </div>
                        <progress class="progress progress-sm progress-orange mt-1 mb-0" value="1035" max="1035"></progress>
                    </div>
                </div>
        </div>
    </div>
    <div class ="card-group">
        <div class="card bg-white">
            <!-- <img class="card-img-top" src="../../assets/images/2.jpg" alt="act"> -->
                <div class="card-block">
                    <div class="media">
                        <div class="media-body yellow text-xs-left">
                            <h3 class="yellow ">Gym Policy</h3>
                            <span> <a href="/policies"> View.. </a> </span>
                           
                        </div>
                        <div class="media-right media-middle">
                            <i class="icon-information yellow font-large-3 float-xs-right"></i>
                        </div>   
                        <progress class="progress progress-sm progress-yellow mt-1 mb-0" value="1035" max="1035"></progress>                    
                    </div>
                </div>
            
        </div>
        <div class="card">
            <!-- <img class="card-img-top" src="../../assets/images/2.jpg" alt="date"> -->
                <div class="card-block">
                    <div class="media">
                        <div class="media-body text-xs-left">
                            <h3 class="black">{{date('F j,Y')}}</h3>
                            <span>Date</span>
                        </div>
                        <div class="media-right media-middle">
                            <i class="icon-calendar3 font-large-3 float-xs-right"></i>
                        </div>
                        <progress class="progress progress-sm progress-black mt-1 mb-0" value="1035" max="1035"></progress>
                    </div>
                </div>
        </div>
    </div>
        </div>
<!--/ stats -->
<!--/ project charts -->
<div class="row">
    <div class="col-md-4 col-xl-4 col-lg-4">
            <div class="card">
                        <div id="carousel-interval" class="carousel slide" data-ride="carousel">
                            <ol class="carousel-indicators">
                                <li data-target="#carousel-example-caption" data-slide-to="0" class="active"></li>
                                <li data-target="#carousel-example-caption" data-slide-to="1"></li>
                                <li data-target="#carousel-example-caption" data-slide-to="2"></li>
                                <li data-target="#carousel-example-caption" data-slide-to="3"></li>
                            </ol>
                            <div class="carousel-inner" role="listbox">
                                                             <div class="carousel-item active">
                                     <div class="card-header bg-info card-inverse">
                                        <h5 class="card-title">Top 10 Beginners for the Week</h5>
                                        <a class="heading-elements-toggle"><i class="icon-ellipsis font-medium-3"></i></a>
                                    <div class="heading-elements">
                                            <span class="avatar">
                                                <img src="../../uploads/leaderboard/gray_t.png" alt="avatar">
                                            </span>
                                        </div>
                                    </div>
                                    
                                    <div class="card-body">
                                        <div class="list-group">
                                                        @if(count($beginner) > 0)
                                        @foreach($beginner as $beginners)
                                        <a href="#" class="list-group-item list-group-item-action media">
                                            <div class="media-left">
                                                <img class="media-object rounded-circle" src="../../uploads/avatars/{{ strtolower($beginners -> avatar) }}" alt="{{$beginners -> avatar}}" style="width: 36px;height: 36px;">
                                            </div>
                                            <div class="media-body">
                                                <span class="list-group-item-heading">{{$beginners->Name}}</span><br>
                                                <span class="list-group-item-text blue-grey">{{$beginners->exp}} points</span>
                                            </div>
                                             <div class="media-right">
                                                <span class="tag tag-default tag-pill bg-info float-xs-right" style="width: 48px; height: 25px;"><h6>lvl {{$beginners->level}}</h6></span>
                                            </div>
                                        </a>
                                        @endforeach
                                                                                @else
                         
                         <p class = "text-justify">No Top Beginner for the Week</p>
                @endif  
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="carousel-item">
                                    <div class="card-header bg-success card-inverse">
                                        <h5 class="card-title">Top 10 Intermediates for the Week</h5>
                                        <a class="heading-elements-toggle"><i class="icon-ellipsis font-medium-3"></i></a>
                                    <div class="heading-elements">
                                            <span class="avatar">
                                                <img src="../../uploads/leaderboard/green_t.png" alt="avatar">
                                            </span>
                                        </div>
                                    </div>
                                    
                                    <div class="card-body">
                                        <div class="list-group">
                                                        @if(count($intermediate) > 0)
                                        @foreach($intermediate as $intermediates)
                                       
                                        <a href="#" class="list-group-item list-group-item-action media">
                                            <div class="media-left">
                                                <img class="media-object rounded-circle" src="../../uploads/avatars/{{ strtolower($intermediates -> avatar) }}" alt="{{$intermediates -> avatar}}" style="width: 36px; height: 36px;">
                                            </div>
                                            <div class="media-body">
                                                <span class="list-group-item-heading">{{$intermediates->Name}}</span><br>
                                                <span class="list-group-item-text blue-grey">{{$intermediates->exp}} points</span>
                                            </div>
                                             <div class="media-right">
                                                <span class="tag tag-default tag-pill bg-success float-xs-right" style="width: 48px; height: 25px;"><h6>lvl {{$intermediates->level}}</h6></span>
                                            </div>
                                        </a>
                                        @endforeach
                                                                                @else
                         
                         <p class = "text-justify">No Top Intermediates for the Week</p>
                @endif  
                                        </div>
                                    </div>
                                
                                </div>
                                
								 <div class="carousel-item">
                                    <div class="card-header bg-warning card-inverse">
                                        <h5 class="card-title">Top 10 Advance for the Week</h5>
                                        <a class="heading-elements-toggle"><i class="icon-ellipsis font-medium-3"></i></a>
                                    <div class="heading-elements">
                                            <span class="avatar">
                                                <img src="../../uploads/leaderboard/purple_t.png" alt="avatar">
                                            </span>
                                        </div>
                                    </div>
                                    
                                    <div class="card-body">
                                        <div class="list-group">
                                                        @if(count($advance) > 0)
                                        @foreach($advance as $advances)
                                        <a href="#" class="list-group-item list-group-item-action media">
                                            <div class="media-left">
                                                <img class="media-object rounded-circle" src="../../uploads/avatars/{{ strtolower($advances -> avatar) }}" alt="{{$advances -> avatar}}" style="width: 36px; height: 36px;">
                                            </div>
                                            <div class="media-body">
                                                <span class="list-group-item-heading">{{$advances->Name}}</span><br>
                                                <span class="list-group-item-text blue-grey">{{$advances->exp}} points</span>
                                            </div>
                                             <div class="media-right">
                                                <span class="tag tag-default tag-pill bg-warning float-xs-right" style="width:48px; height: 25px;"><h6>lvl {{$advances->level}}</h6></span>
                                            </div>
                                        </a>
                                        @endforeach
                                                                                @else
                         
                         <p class = "text-justify">No Top Advance for the Week</p>
                @endif  
                                        </div>
                                    </div>
                                
                                </div>
                                
                                <div class="carousel-item">
                                    <div class="card-header bg-primary card-inverse">
                                        <h5 class="card-title">Top 10 Most Awarded Badges</h5>
                                        <a class="heading-elements-toggle"><i class="icon-ellipsis font-medium-3"></i></a>
                                    <div class="heading-elements">
                                            <span class="avatar">
                                                <img src="../../uploads/leaderboard/yellow_t.png" alt="avatar">
                                            </span>
                                        </div>
                                    </div>
                                    
                                    <div class="card-body">
                                        <div class="list-group">
                                                        @if(count($recentaward) > 0)
                                        @foreach($recentaward as $recentawards)
                                        <a href="#" class="list-group-item list-group-item-action media">
                                            <div class="media-left">
                                                <img class="media-object rounded-circle" src="../../uploads/avatars/{{ strtolower($recentawards -> avatar) }}" alt="{{$recentawards -> avatar}}" style="width: 36px;height: 36px;">
                                            </div>
                                            <div class="media-body">
                                                <span class="list-group-item-heading">{{$recentawards->Name}}</span><br>
                                                <span class="list-group-item-text blue-grey">{{$recentawards->badge}} badge/s</span>
                                            </div>
                                             <div class="media-right">
                                                <span class="tag tag-default tag-pill bg-primary float-xs-right" style="width: 48px; height: 25px;"><h6>lvl {{$recentawards->level}}</h6></span>
                                            </div>
                                        </a>
                                        @endforeach
                                        @else
                         
                         <p class = "text-justify">No Top Most Awarded Badges</p>
                @endif  
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <a class="" href="#carousel-interval" role="button" data-slide="prev">

                            </a>
                            <a class="" href="#carousel-interval" role="button" data-slide="next">
                            </a>
                        </div>
                    </div>
  </div>
</div>
<!--/ project charts -->
<!-- Recent invoice with Statistics -->



        </div>
      </div>
    </div>
       </div>
      </div>
    </div>
    <!-- ////////////////////////////////////////////////////////////////////////////-->
     <footer class="footer footer-static footer-light navbar-border">
      <p class="clearfix text-muted text-sm-center mb-0 px-2"><span class="float-md-center d-xs-block d-md-inline-block">Copyright  &copy; 2018 <b>ALTITUDEGYM</b> </a>, All rights reserved. </span></p>
    </footer>
    @include('admin.layouts.scripts') 
  </body>
</html>