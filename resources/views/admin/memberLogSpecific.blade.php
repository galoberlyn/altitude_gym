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
<div class="row">
<div class="content-header-left col-md-6 col-xs-12 mb-1">
          </div>
        <div class="content-header-right breadcrumbs-right breadcrumbs-top col-md-6 col-xs-12">
            <div class="">
            <a class=" float-xs-right" href = '/log_archive'><i class="icon-arrow-left"></i>  Back</a>
            </div>
          </div>
    <div class="col-xl-12 col-lg-12">
        <div class="card">
            <div class="card">
            <div class="card-header table-inverse">
                <h4 class="card-title"><i class="icon-ios-list"></i>Member log for {{$selected_date}}</h4>
                <a class="heading-elements-toggle"><i class="icon-ellipsis font-medium-3"></i></a>
                <div class="heading-elements">
                    <ul class="list-inline mb-0">
                        <li><a data-action="expand"><i class="icon-expand2"></i></a></li>
                    </ul>
                </div>
            </div>
            <div class="card-body">
                <div class="">       
                   <div class="dropdown">
            <form action="/find_date" method="GET">
                {{ csrf_field() }}
                <span class="float-xs-right">
                    
                    <input type="text" name="year" placeholder="Year"></input>
                    <select name="month">
                        <option value = "01">01</option><option value = "02">02</option><option value = "03">03</option><option value = "04">04</option>
                        <option value = "05">05</option><option value = "06">06</option><option value = "07">07</option><option value = "08">08</option>
                        <option value = "09">09</option><option value = "10">10</option><option value = "11">11</option><option value = "12">12</option>
                    </select>
                    <select name="day">
                        <option value = "01">01</option><option value = "02">02</option><option value = "03">03</option><option value = "04">04</option>
                        <option value = "05">05</option><option value = "06">06</option><option value = "07">07</option><option value = "08">08</option>
                        <option value = "09">09</option><option value = "10">10</option><option value = "11">11</option><option value = "12">12</option>
                        <option value = "13">13</option><option value = "14">14</option><option value = "15">15</option><option value = "16">16</option>
                        <option value = "17">17</option><option value = "18">18</option><option value = "19">19</option><option value = "20">20</option>
                        <option value = "21">21</option><option value = "22">22</option><option value = "23">23</option><option value = "24">24</option>
                        <option value = "25">25</option><option value = "26">26</option><option value = "27">27</option><option value = "28">28</option>
                        <option value = "29">29</option><option value = "30">30</option><option value = "31">31</option>
                    </select>
                   <button type="submit" role="button" class="btn-group btn-group-xs btn-link"><span style="font-size:25px;" class="icon-ios-search-strong"></span></button>
                </span>
            </form>
                
                    </div>   
                <form action="/search_log_spec/{{$selected_date}}" method="GET">
                {{ csrf_field() }}
                <span class="float-xs-right">
                  <input type="text" name="search" placeholder="Search.."></input>
                  <button type="submit" role="button" class="btn-group btn-group-xs btn-link"><span style="font-size:25px;" class="icon-ios-search-strong"></span></button>
                </span>
                </form>                                
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
                            @if($user->date_recorded == $selected_date) 
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
            <div class="text-center">
                {{$users ->links()}}
            </div>
        </div>
    </div>
    </div>
    </div>
    </div>
    </div>
    </div>

    @include('admin.layouts.scripts')   
<br>	
<br>	
<br>	
<br>	
    <footer class="footer footer-static footer-light navbar-border">
      <p class="clearfix text-muted text-sm-center mb-0 px-2"><span class="float-md-center d-xs-block d-md-inline-block">Copyright  &copy; 2018 <b>ALTITUDEGYM</b> </a>, All rights reserved. </span></p>
    </footer>
  </body>
</html>