<!DOCTYPE html>
<html lang="en" data-textdirection="ltr" class="loading">
  <head>
    @include('admin.layouts.css_links')
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
            <div class="content-header-left col-md-6 col-xs-12 mb-1">
          </div>
        <div class="content-header-right breadcrumbs-right breadcrumbs-top col-md-6 col-xs-12">
            <div class="">
            <a class=" float-xs-right" href = '/log'><i class="icon-arrow-left"></i>  Back</a>
            </div>
          </div>
    <div class="col-xl-12 col-lg-12">
        <div class="card">
            <div class="card">
             <div class="card-header table-inverse">
                <h4 class="card-title"><i class="icon-ios-list"></i>Member Log Archive</h4>
                <a class="heading-elements-toggle"><i class="icon-ellipsis font-medium-3"></i></a>
                <div class="heading-elements">
                    <ul class="list-inline mb-0">
                        <li><a data-action="expand"><i class="icon-expand2"></i></a></li>
                    </ul>
                </div>
            </div>
             <div class="card-body">
                <div class="card-block">       
                   <div class="dropdown">
  </div> 
            @if(count($dates) > 0)
                <div class = 'list-group col-md-12'>
                @foreach($dates as $date)
                <h4><a href = "/log/view_at_date/{{$date->date_recorded}}" class="list-group-item"><i class="icon-ios-list"></i>   {{$date->date_recorded}}</a></h4>
                @endforeach
                </div>
            @else
                <p>No member has logged in (yet)</p>
            @endif
            {{$dates->links()}}       
                </div> 

                </div>
            </div>

    
        </div>
    </div>
    </div>
    </div>
</div>
<!--End Member Table -->
        </div>
      </div>
              </div>
      </div>
      </div>
      <footer class="footer footer-static footer-light navbar-border">
      <p class="clearfix text-muted text-sm-center mb-0 px-2"><span class="float-md-center d-xs-block d-md-inline-block">Copyright  &copy; 2018 <b>ALTITUDEGYM</b> </a>, All rights reserved. </span></p>
    </footer>


    
    @include('admin.layouts.scripts')    
    <!-- END PAGE LEVEL JS-->
  </body>
</html>