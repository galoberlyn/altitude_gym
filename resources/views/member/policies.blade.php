<!DOCTYPE html>
<html lang="en" data-textdirection="views" class="loading">
  
      @include('member.layouts.head')
    <title>Gym Policies</title>
    
  <body data-open="click" data-menu="vertical-menu" data-col="2-columns" class="vertical-layout vertical-menu 2-columns  fixed-navbar">

    @include('member.layouts.nav')   
    
    @include('member.layouts.main_menu')
   
    <div class="app-content content container-fluid">
      <div class="content-wrapper">
      	@include('member.layouts.notification')
        <div class="content-header row">
          <div class="content-header-left col-md-6 col-xs-12 mb-1">
            <h2 class="content-header-title green">Gym Policies </h2>
          </div>
          <div class="content-header-right breadcrumbs-right breadcrumbs-top col-md-6 col-xs-12">
            <div class="breadcrumb-wrapper col-xs-12">
              
            </div>
          </div>
        </div>
        
        
        <div class="content-body">
        <!-- Safety -->
<section id="description" class="card">

	<div class="col-md-6 col-sm-12">
			<div class="card">
				<div class="card-header">
					<h4 class="card-title">Policies <i class="icon-clipboard"></i></h4>
				</div>
				<div class="card-body collapse in">
					<div class="card-block">
						<div id="carousel-example-caption" class="carousel slide" data-ride="carousel">
							<ol class="carousel-indicators">
								<li data-target="#carousel-example-caption" data-slide-to="0" class="active"></li>
								<li data-target="#carousel-example-caption" data-slide-to="1"></li>
								<li data-target="#carousel-example-caption" data-slide-to="2"></li>
								<li data-target="#carousel-example-caption" data-slide-to="3"></li>
								<li data-target="#carousel-example-caption" data-slide-to="4"></li>
							</ol>
							<div class="carousel-inner" role="listbox">
								<div class="carousel-item active">
									<img src="images/carousel/smoke.jpg" alt="First slide">
									<div class="carousel-caption">
										<h3>NO SMOKING</h3>
										<p>Smoking inside the gym and its premises is strictly prohibited.</p>
										</div>
								</div>
								<div class="carousel-item">
									<img src="images/carousel/alcohol.jpg" alt="Second slide">
									<div class="carousel-caption">
										<h3>NO ALCOHOL</h3>
										<p>Clients/Members under the influence of alcohol are not allowed for workouts.</p>
									</div>
								</div>
								<div class="carousel-item">
									<img src="images/carousel/denim.jpg" alt="Third slide">
									<div class="carousel-caption">
										<h3>NO DENIM OR MAONG</h3>
										<p>Denim or maong pants or shorts are not allowed inside the gym and its premises.</p>
									</div>
								</div>
								<div class="carousel-item">
									<img src="images/carousel/sandals.jpg" alt="Fourth slide">
									<div class="carousel-caption">
										<h3>NO SLIPPER OR SANDALS</h3>
										<p>Slippers or sandals are not allowed for workouts.</p>
									</div>
								</div>
								<div class="carousel-item">
									<img src="../../images/carousel/pay.jpg" alt="Fifth slide">
									<div class="carousel-caption">
										<h3>MONTHLY FEES</h3>
										<p>Monthly fees are not refundable, transferable, and must be paid on time.</p>
										</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				
				<div class="card-body collapse in">
        <div class="card-block">
            <div class="card-text">
                <ul class="list-group">
					@foreach ($gymPolicies as $gPolicy)
					<li class="list-group-item">{{$gPolicy->policy_description}}</li>
					@endforeach
                </ul>
            </div>
        </div>
    </div>
				
			</div>
		</div>
   
   <div class="col-md-6 col-sm-12">
			<div class="card">
				<div class="card-header">
					<h4 class="card-title">Safety <i class="icon-medkit"></i></h4>
				</div>
				<div class="card-body collapse in">
					<div class="card-block">
						<div id="carousel-example-caption" class="carousel slide" data-ride="carousel">
							<ol class="carousel-indicators">
								<li data-target="#carousel-example-caption" data-slide-to="0" class="active"></li>
								<li data-target="#carousel-example-caption" data-slide-to="1"></li>
								<li data-target="#carousel-example-caption" data-slide-to="2"></li>
								<li data-target="#carousel-example-caption" data-slide-to="3"></li>
								<li data-target="#carousel-example-caption" data-slide-to="4"></li>
							</ol>
							<div class="carousel-inner" role="listbox">
								<div class="carousel-item active">
									<img src="../../images/carousel/warmup.jpg" alt="First slide">
									<div class="carousel-caption">
										<h3>WARM UP</h3>
										<p>Warm up properly to avoid injury.</p>
									</div>
								</div>
								<div class="carousel-item">
									<img src="../../images/carousel/weights.jpg" alt="Second slide">
									<div class="carousel-caption">
										<h3>AVOID EGO-LIFTING</h3>
										<p>Lift poundages you can safely handle.</p>
									</div>
								</div>
								<div class="carousel-item">
									<img src="../../images/carousel/help.jpg" alt="Third slide">
									<div class="carousel-caption">
										<h3>ASK FOR ASSISTANCE</h3>
										<p>Ask for assistance when needed.</p>
									</div>
								</div>
								<div class="carousel-item">
									<img src="../../images/carousel/return.jpg" alt="Third slide">
									<div class="carousel-caption">
										<h3>RETURN EQUIPMENT</h3>
										<p>All weights and equipment must be returned back in place after use.</p>
									</div>
								</div>
								<div class="carousel-item">
									<img src="../../images/carousel/safety.jpg" alt="Fourth slide">
									<div class="carousel-caption">
										<h3>THINK SAFETY</h3>
										<p>THINK SAFETY: Exercise with caution. Your safety and others’ welfare are of prime importance.</p>
									</div>
								</div>
								<div class="carousel-item">
									<img src="../../images/carousel/dropping.jpg" alt="Fifth slide">
									<div class="carousel-caption">
										<h3>HANDLE EQUIPMENT PROPERLY</h3>
										<p>Handle equipment and weights properly to prevent injury. E.g. dropping of dumbbells of weights.</p>
										</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				
				<div class="card-body collapse in">
        <div class="card-block">
            <div class="card-text">
                <ul class="list-group">
					@foreach ($safetyPolicies as $sPolicy)
                    <li class="list-group-item">{{$sPolicy->policy_description}}</li>
					@endforeach
                </ul>
            </div>
        </div>
    </div>
				
			</div>
		</div>
		
   <div class="col-md-6 col-sm-12">
			<div class="card">
				<div class="card-header">
					<h4 class="card-title">Courtesy <i class="icon-happy-outline"></i></h4>
				</div>
				<div class="card-body collapse in">
					<div class="card-block">
						<div id="carousel-example-caption" class="carousel slide" data-ride="carousel">
							<ol class="carousel-indicators">
								<li data-target="#carousel-example-caption" data-slide-to="0" class="active"></li>
								<li data-target="#carousel-example-caption" data-slide-to="1"></li>
								<li data-target="#carousel-example-caption" data-slide-to="2"></li>
								<li data-target="#carousel-example-caption" data-slide-to="3"></li>
								<li data-target="#carousel-example-caption" data-slide-to="4"></li>
							</ol>
							<div class="carousel-inner" role="listbox">
								<div class="carousel-item active">
									<img src="../../images/carousel/attire.jpg" alt="First slide">
									<div class="carousel-caption">
										<h3>PROPER ATTIRE</h3>
										<p>Always wear the proper attire while training in the gym. I.e: Rubber shoes, T-shirt, Short Pants/Jogging Pants</p>
										</div>
								</div>
								<div class="carousel-item">
									<img src="../../images/carousel/towels.jpg" alt="Second slide">
									<div class="carousel-caption">
										<h3>BRING TOWELS</h3>
										<p>Bring your towels for hygienic purposes.</p>
									</div>
								</div>
								<div class="carousel-item">
									<img src="../../images/carousel/respect.jpg" alt="Third slide">
									<div class="carousel-caption">
										<h3>RESPECT</h3>
										<p>Each member must respect the rights of other gym members.</p>
									</div>
								</div>
								<div class="carousel-item">
									<img src="../../images/carousel/secure.jpg" alt="Fourth slide">
									<div class="carousel-caption">
										<h3>SECURE BELONGINGS</h3>
										<p>Always secure and care for your personal belongings at all times.</p>
									</div>
								</div>
								<div class="carousel-item">
									<img src="../../images/carousel/home.jpg" alt="Fifth slide">
									<div class="carousel-caption">
										<h3>BRING HOME</h3>
										<p>Bring home your work-out clothes and rubber shoes or avail for a locker instead.</p>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				
				<div class="card-body collapse in">
        <div class="card-block">
            <div class="card-text">
                <ul class="list-group">
					@foreach ($courtesyPolicies as $cPolicy)
                    <li class="list-group-item">{{$cPolicy->policy_description}}</li>
					@endforeach
                </ul>
            </div>
        </div>
    </div>
				
			</div>
		</div>
    
</section>


<!--/ End Safety -->
        </div>
      </div>
    </div>
    <!-- ////////////////////////////////////////////////////////////////////////////-->

    <!-- BEGIN VENDOR JS-->
    <script src="../../js/core/libraries/jquery.min.js" type="text/javascript"></script>
    <script src="../../vendors/js/ui/tether.min.js" type="text/javascript"></script>
    <script src="../../js/core/libraries/bootstrap.min.js" type="text/javascript"></script>
    <script src="../../vendors/js/ui/perfect-scrollbar.jquery.min.js" type="text/javascript"></script>
    <script src="../../vendors/js/ui/unison.min.js" type="text/javascript"></script>
    <script src="../../vendors/js/ui/blockUI.min.js" type="text/javascript"></script>
    <script src="../../vendors/js/ui/jquery.matchHeight-min.js" type="text/javascript"></script>
    <script src="../../vendors/js/ui/screenfull.min.js" type="text/javascript"></script>
    <script src="../../vendors/js/extensions/pace.min.js" type="text/javascript"></script>
    <!-- BEGIN VENDOR JS-->
    <!-- BEGIN PAGE VENDOR JS-->
    <script src="../../vendors/js/ui/prism.min.js" type="text/javascript"></script>
    <!-- END PAGE VENDOR JS-->
    <!-- BEGIN ROBUST JS-->
    <script src="../../js/core/app-menu.js" type="text/javascript"></script>
    <script src="../../js/core/app.js" type="text/javascript"></script>
    <!-- END ROBUST JS-->
    <!-- BEGIN PAGE LEVEL JS-->
    <!-- END PAGE LEVEL JS-->
  </body>
</html>