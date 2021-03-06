<!DOCTYPE html>
<html lang="en" data-textdirection="ltr" class="loading">
  <head>
    @include('admin.layouts.css_links')
    <title>Altitude Gym | Add Game Policies</title>
  </head>
  <body data-open="click" data-menu="vertical-menu" data-col="2-columns" class="vertical-layout vertical-menu 2-columns  fixed-navbar">
    @include('admin.layouts.nav')
    @include('admin.layouts.main_menu')
    <div class="app-content content container-fluid">
      <div class="content-wrapper">
        <div class="content-header row">
           @include('admin.inc.message')
          <div class="content-header-left col-md-6 col-xs-12 mb-1">
            <h2 class="content-header-title blue-grey"><h2 class="content-header-title teal"><i class="icon-ios-game-controller-b"></i>   Add Gamification Policy</h2>
          </div>
          <div class="content-header-right breadcrumbs-right breadcrumbs-top col-md-6 col-xs-12">
            <a class=" float-xs-right" href = '/gamification'><i class="icon-arrow-left"></i>  Back</a>
          </div>
        </div>
         </div>
        <div class="content-body">
{{ csrf_field() }}
<section id="description" class="card">
    <div class="card-body collapse in">
        <div class="card-block">
         {!! Form::open ([ 'action' => 'AdminGamePoliciesController@store', 'method' => 'POST']) !!}
            <div class="tab-content px-1 pt-1">
              <div role="tabpanel" class="tab-pane active" id="tab1" aria-expanded="true" aria-labelledby="base-tab1">
              <div class="">
                <form class="form-horizontal">
                    <fieldset>
                           <h4 class="form-section"><i class="icon-profile"></i>Details</h4>

                             <div class="form-group">
								{{Form::label('category', 'Category')}}
								<div class="position-relative has-icon-left">
								{{Form::select('category', array('Gamification' => 'Gamification'),'', ['class' => 'round border-warning'])}}
								</div>
							</div>
							
							<div class="form-group">
								{{Form::label('type', 'Type')}}
								<div class="position-relative has-icon-left">

                    {{Form::select('type', array('Point' => 'Points', 'Leveling' => 'Leveling',  'Badges' => 'Badges'), '', ['class' => 'form-control round border-success'])}}
										<div class="form-control-position">
											<i class="icon-question danger"></i>
										</div>
								</div>               
                             </div>
							 
							 <div class="form-group">
								 {{Form::label('policy_description', 'Policy description')}}
								<div class="position-relative has-icon-left">
										{{Form::text ('policy_description', '', ['class' => 'form-control round border-warning', 'placeholder' => 'Policy description'])}}
										<div class="form-control-position">
											<i class="icon-document danger"></i>
										</div>
								</div>               
                             </div>
							 {{Form::submit('Submit', ['class'=>'btn btn-primary'])}}
                            </fieldset>
                 </form>
                </div>
              </div>
             
            </div>
             {!! Form::close() !!} 
          
          </div>
    </div>
        
</section>
</div>
</div>	
    @include('admin.layouts.scripts') 
	<br>
	<br>
	<br>
	<footer class="footer footer-static footer-light navbar-border">
      <p class="clearfix text-muted text-sm-center mb-0 px-2"><span class="float-md-center d-xs-block d-md-inline-block">Copyright  &copy; 2018 <b>ALTITUDEGYM</b> </a>, All rights reserved. </span></p>

  </body>
</html>