<head>
    @include('admin.layouts.css_links')
	 <title>Altitude Gym | Notifications</title>
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
    <div class="col-xl-12 col-lg-12">
 <div class="card">

            <div class="card-header table-inverse">
                <h4 class="card-title"><i class="icon-notification"></i>  Notifications</h4>
                <a class="heading-elements-toggle"><i class="icon-ellipsis font-medium-3"></i></a>

                <div class="heading-elements">
                    <ul class="list-inline mb-0">
                       
                        <li><a data-action="expand"><i class="icon-expand2"></i></a></li>
                    </ul>
                </div>
            </div>

             <div class="card-body">
                <div class="">



        <form action="/search_notif" method="GET">
                {{ csrf_field() }}
 <span class="float-xs-right">
                  <input type="text" name="search_for" placeholder="Search.."></input>
                  <button type="submit" role="button" class="btn-group btn-group-xs btn-link"><span style="font-size:25px;" class="icon-ios-search-strong"></span></button>
                </span>                </form>


 </div>                                   
                </div>
            <div class="card-body">                
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
					<thead style="background-color:#99FF99">
                            <tr>
                                <th><i class="icon-ios-person"></i>     Sender</th>
                                <th><i class="icon-mail5"></i>     Message</th>
                                <th><i class="icon-question-circle"></i>     Type</th>
                                <th><i class="icon-calendar4"></i>     Date</th>
                            </tr>
                        </thead>
                        @if(count($notif_status) > 0)
                        <tbody class="table-hover">
                          @foreach ($notif_status as $notifstat)
                          <tr>
                          <td> <span class="avatar">
                              <img src="../../uploads/avatars/{{ strtolower($notifstat -> avatar) }}" alt="{{$notifstat -> avatar}}"></img>
                              </span> {{$notifstat -> first_name}} {{$notifstat -> last_name}}   ({{$notifstat -> user_type}})</td>
                          <td>{{$notifstat -> message}}</td>
                          <td> {{$notifstat -> notification_type}}</td>
                          <td> {{$notifstat -> created_at}}</td>
                           </tr>
                          @endforeach                  


                        </tbody>
                        @else
                         
                         <td>No available data</td>
                @endif
                    </table>
                </div>
         <div class="text-xs-center">
                  {{$notif_status ->links()}}
                </div>
        </div>


        
      </div>
              
    </div>
  </div>
 
 
            </div>
            </div>


<footer class="footer footer-static footer-light navbar-border">
      <p class="clearfix text-muted text-sm-center mb-0 px-2"><span class="float-md-center d-xs-block d-md-inline-block">Copyright  &copy; 2018 <b>ALTITUDEGYM</b> </a>, All rights reserved. </span></p>
    </footer>
    
    <!-- BEGIN VENDOR JS-->
    
    @include('admin.layouts.scripts')    
    <!-- END PAGE LEVEL JS-->
  </body>
</html>
