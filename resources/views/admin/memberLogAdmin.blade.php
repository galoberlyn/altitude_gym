<!DOCTYPE html>
<html lang="en" data-textdirection="ltr" class="loading">
  <head>
    @include('admin.layouts.css_links')
	 <title>Altitude Gym | Member Log</title>
  </head>
  <body data-open="click" data-menu="vertical-menu" data-col="2-columns" class="vertical-layout vertical-menu 2-columns  fixed-navbar">
    @include('admin.layouts.nav')
    @include('admin.layouts.main_menu')
    <div class="app-content content container-fluid">
      <div class="content-wrapper">
        <div class="content-header row">
        </div>
        <div class="content-body">
@include('admin.layouts.app-stats')
</div>
<div class="row">
    <div class="col-xl-12 col-lg-12">
        <div class="card">
            <div class="card">
             <div class="card-header table-inverse">
                <h4 class="card-title"><i class="icon-ios-list"></i>Member Log for {{date('F j, Y')}}</h3></h4>
                <a class="heading-elements-toggle"><i class="icon-ellipsis font-medium-3"></i></a>
                <div class="heading-elements">
                    <ul class="list-inline mb-0">
                        <a class="white" href="/log_archive">See Archive</a>
                        <li><a data-action="expand"><i class="icon-expand2"></i></a></li>
                    </ul>
                </div>
            </div>
             <div class="card-body">
                <div class="">       
                   <div class="dropdown">


                <form action="/search_log_today" method="GET">
                {{ csrf_field() }}
                <span class="float-xs-right">
                  <input type="text" name="search" placeholder="Search.."></input>
                  <button type="submit" role="button" class="btn-group btn-group-xs btn-link"><span style="font-size:25px;" class="icon-ios-search-strong"></span></button>
                </span>
                </form>
  </div>                                   
                </div>
                <div class="table-responsive">
                    
                @if(count($users) > 0)
                  <table class="table table-hover mb-0">
                        <thead style="background-color:#C2DFFF">
                            <tr>
                                <th>Member Name    <i class="icon-pencil2"></i></th>
                                <th>Time In    <i class="icon-clock3"></th>
                                <th>Time Out    <i class="icon-clock22"></th> 
                            </tr>
                        </thead>
                        <tbody>
                                @foreach ($users as $user)
                  @if($user->date_recorded == date('Y-m-d')) 
                                        <tr>
                                            <td class="text-truncate"><span class="avatar">
                              <img src="../../uploads/avatars/{{ strtolower($user -> avatar) }}" alt="{{$user -> avatar}}"></img>
                              </span>{{$user->first_name}} {{$user->last_name}}</td>
                                            <td class="text-truncate">{{$user->time_in}}</td>
                                            <td class="text-truncate">{{$user->time_out}}</td>
                                        </tr>
                  @endif
                  
                                @endforeach
                </tbody>
                    </table>
                @else
                    <p>No members have logged in on this day</p>
                @endif

                </div>
            </div>
        </div>
    </div>
    </div>
</div>
    </div>
    </div>
    @include('admin.layouts.scripts')    
    <footer class="footer footer-static footer-light navbar-border">
      <p class="clearfix text-muted text-sm-center mb-0 px-2"><span class="float-md-center d-xs-block d-md-inline-block">Copyright  &copy; 2018 <b>ALTITUDEGYM</b> </a>, All rights reserved. </span></p>
    </footer>
  </body>
</html>