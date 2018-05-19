<!DOCTYPE html>
<html lang="en" data-textdirection="ltr" class="loading">
  <head>
    @include('admin.layouts.css_links')
    <title>Altitude Gym | Add Gamification Policy</title>
  </head>
  <body data-open="click" data-menu="vertical-menu" data-col="2-columns" class="vertical-layout vertical-menu 2-columns  fixed-navbar">
    @include('admin.layouts.nav')
    @include('admin.layouts.main_menu')
    <div class="app-content content container-fluid">
      <div class="content-wrapper">
        <div class="content-header row">
           @include('admin.inc.message')
          <div class="content-header-left col-md-6 col-xs-12 mb-1">
            <h2 class="content-header-title teal"><i class="icon-ios-game-controller-b"></i>   Gamification Policies</h2>
          </div>
          <div class="content-header-right breadcrumbs-right breadcrumbs-top col-md-6 col-xs-12">
            <div class="">
			<a class="btn btn-primary float-xs-right" href = 'gamification/create'>Add Gamification Policy</a>
            </div>
          </div>
        </div>
        <div class="content-body"><!-- stats -->
 <div class="row">
		
    <div class="col-xl-5 col-lg-5 col-xs-12">
        <div class="card">
            <div class="card-body">
                <div class="card-block">
                    <div class="media">
                        <div class="media-body text-xs-left">
                            
                            <ul>
								@foreach ($gamepoli as $game)
								<li>{!! nl2br(e($game->policy_description)) !!}
								<a href = "/gamification/{{$game->id}}/edit" class = "btn btn-default"><i class="icon-pencil"></i><sup>Edit</sup>
								</a></li>
								@endforeach
							</ul>
                            
                            
                        </div>
                        <div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
     </div>
		<div class="col-md-7 col-sm-12">
			<div class="card">

				<div class="card-body collapse in">
					<div class="">
						                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="bg-teal bg-lighten-4">
                            <tr>
								<th>Category  <i class="icon-trophy3"></th>
                                <th>Level  <i class="icon-long-arrow-up"></i></th>
                                <th>Base Point  <i class="icon-point-up"></th>                                
                            </tr>
                        </thead>
                        <tbody>
							@foreach($points as $pts)
								<tr>
									<td>{{ucwords($pts->category)}}</td>
									<td>{{$pts->level}}</td>
									<td>{{$pts->base_point}}</td>
								</tr>
							@endforeach
                        </tbody>
                    </table>
                </div>
					</div>
				</div>
			</div>
			
			<div class="card" style="background-image: url(../../memimg/frame1.jpg);">

				<div class="card-body collapse in">
					<div class="card-block">
							<div class="card-block">
						<div id="carousel-example-caption" class="carousel slide" data-ride="carousel">
							<ol class="carousel-indicators">
								<li data-target="#carousel-example-caption" data-slide-to="0" class="active"></li>
								<li data-target="#carousel-example-caption" data-slide-to="1"></li>
								<li data-target="#carousel-example-caption" data-slide-to="2"></li>
							</ol>
							<div class="carousel-inner" role="listbox" >
								<div class="carousel-item active" >
									<img src="../../gym/gym1.jpg" style="height: 320px; width: 600px;"  alt="First slide">
									<div class="carousel-caption">
										</div>
								</div>
								<div class="carousel-item">
									<img src="../../gym/equip.jpg" style="height: 320px; width: 600px;" alt="Second slide">
									<div class="carousel-caption">
									</div>
								</div>
								<div class="carousel-item">
									<img src="../../gym/lockers.jpg" style="height: 320px; width: 600px;" alt="Third slide">
									<div class="carousel-caption">
									</div>
								</div>
							</div>
						</div>
					</div>         
					</div>
				</div>
			</div>
		</div>
        

      </div>
    </div>
    <!-- ////////////////////////////////////////////////////////////////////////////-->



<!--/ End Safety -->






        </div>
      </div>
    </div>
     <footer class="footer footer-static footer-light navbar-border">
      <p class="clearfix text-muted text-sm-center mb-0 px-2"><span class="float-md-center d-xs-block d-md-inline-block">Copyright  &copy; 2018 <b>ALTITUDEGYM</b> </a>, All rights reserved. </span></p>
    </footer>
    @include('admin.layouts.scripts') 
  </body>
</html>