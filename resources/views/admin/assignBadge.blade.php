<!DOCTYPE html>
<html lang="en" data-textdirection="ltr" class="loading">
  <head>
    @include('admin.layouts.css_links')
    <title>Altitude Gym | Award Badge {{$badge_name}}</title>
  </head>
  <body data-open="click" data-menu="vertical-menu" data-col="2-columns" class="vertical-layout vertical-menu 2-columns  fixed-navbar">
    @include('admin.layouts.nav')
    @include('admin.layouts.main_menu')
   <div class="app-content content container-fluid">
      <div class="content-wrapper">
        <div class="content-header row">
        </div>
       <div class="content-body">
</div>
<div class="row">
    <div class="col-xl-12 col-lg-12">
				      @include('admin.inc.message')
        <div class="card">
            <div class="card">
             <div class="card-header table-inverse">
                <h4 class="card-title"><i class="icon-trophy"></i>Award Badge {{$badge_name}}</h4>
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

                <form action="/search_assign_badge/{{$badge_id}}" method="GET">
                {{ csrf_field() }}
                <span class="float-xs-right">
                  <input type="text" name="search" placeholder="Search.."></input>
                  <button type="submit" role="button" class="btn-group btn-group-xs btn-link"><span style="font-size:25px;" class="icon-ios-search-strong"></span></button>
                </span>
                </form>
      </div>                                   
                </div>
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead style="background-color:#D3D3D3">
                            <tr>
                                <th>Member Name<i class="icon-person"></i></th>                       
                                <th>Earned Badges<i class="icon-trophy"></i></th>                          
                                <th>Award Badge<i class="icon-question-circle"></i></th>                          
                            </tr>
                        </thead>

                     <tbody class="table-hover">
                        <form action="/members" method="POST">
                        {{ csrf_field() }}
                          @foreach ($earned as $ww)
                            <tr>
                            <input hidden value="remover" name="rem">
                              <td class="text-truncate"><span class="avatar"><img src="../../uploads/avatars/{{ strtolower($ww -> avatar) }}" alt="{{$ww-> avatar}}"></img></span>  {!! $ww -> first_name." ".$ww -> last_name !!}</td>
							 <td class="">@foreach(explode(',', $ww -> earnbg) as $img) 
							 <span class="avatar"><img src="../badges/{{ strtolower($img) }}.png" alt="{{$ww->earnbg}}" data-toggle="tooltip" title="{{strtoupper($img)}}"></span>@endforeach</td>
							<td style = "padding:10px;"><a class = "btn btn-info" href = "{{$badge_id}}/award/{{$ww->user_id}}">Award {{$badge_name}}</a></td>
                            </tr>
                              @endforeach  
                            </form>
                        </tbody>
                    </table>
                </div>
                 <div class="text-center">
                  {{$member->links()}}
                </div>
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
    @include('admin.layouts.scripts')    
    <!-- END PAGE LEVEL JS-->
  </body>
</html>
