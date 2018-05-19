@extends('ManagerModule.layouts.app')
@section('content')  

    <title>Altitude Gym | Gym Policies</title>

    <div class="app-content content container-fluid">
      <div class="content-wrapper">
        <div class="content-header row">
          <div class="content-header-left col-md-6 col-xs-12 mb-1">
          </div>
          <div class="content-header-right breadcrumbs-right breadcrumbs-top col-md-6 col-xs-12">
            <div class="breadcrumb-wrapper col-xs-12">
              
            </div>
          </div>
        </div>       
        
        <div class="content-body">
        <!-- Safety -->
<section id="description" class="card">

	<div class="col-md-6">
	  
			<div class="card">
			 <div class="card card-image" style="background-image: url(../../memimg/frame1.jpg)">
				<div class="card-header">
					<center><h3 class="card-title"><b><font color="#CC3300">GYM POLICIES</font></b></h3></center>
				</div>
				</div>
				 <div class="card card-image" style="background-image: url(../../memimg/frame1.jpg);">
				<div class="card-body collapse in">
					<div class="card-block">
						<div id="carousel-example-caption" class="carousel slide" data-ride="carousel" >
							<ol class="carousel-indicators">
								<li data-target="#carousel-example-caption" data-slide-to="0" class="active"></li>
								<li data-target="#carousel-example-caption" data-slide-to="1"></li>
								<li data-target="#carousel-example-caption" data-slide-to="2"></li>
								<li data-target="#carousel-example-caption" data-slide-to="3"></li>
								<li data-target="#carousel-example-caption" data-slide-to="4"></li>
							</ol>
							<div class="carousel-inner" role="listbox">
								<div class="carousel-item active">
									<img src="../../uploads/policies/smoke.jpg" alt="First slide">
									<div class="carousel-caption">
										<h3>NO SMOKING</h3>
										<p>Smoking inside the gym and its premises is strictly prohibited.</p>
										</div>
								</div>
								<div class="carousel-item">
									<img src="../../uploads/policies/alcohol.jpg" alt="Second slide">
									<div class="carousel-caption">
										<h3>NO ALCOHOL</h3>
										<p>Clients/Members under the influence of alcohol are not allowed for workouts.</p>
									</div>
								</div>
								<div class="carousel-item">
									<img src="../../uploads/policies/denim.jpg" alt="Third slide">
									<div class="carousel-caption">
										<h3>NO DENIM OR MAONG</h3>
										<p>Denim or maong pants or shorts are not allowed inside the gym and its premises.</p>
									</div>
								</div>
								<div class="carousel-item">
									<img src="../../uploads/policies/sandals.jpg" alt="Fourth slide">
									<div class="carousel-caption">
										<h3>NO SLIPPER OR SANDALS</h3>
										<p>Slippers or sandals are not allowed for workouts.</p>
									</div>
								</div>
								<div class="carousel-item">
									<img src="../../uploads/policies/pay.jpg" alt="Fifth slide">
									<div class="carousel-caption">
										<h3>MONTHLY FEES</h3>
										<p>Monthly fees are not refundable, transferable, and must be paid on time.</p>
										</div>
								</div>
							</div>
						</div>
					</div>
				</div>
</div>


				
				<div class="card-body collapse in">
        <div class="card-block">
            <div class="card-text">
                <ul>
					@foreach ($policies2 as $ap)
					<li>{{$ap->policy_description}}</li>
					@endforeach
                </ul>
            </div>
        </div>
    </div>

				
			</div>
		</div>


		<div class="col-md-6">

<div class="card card-image" style="background-image: url(../../memimg/frame1.jpg)">
				<div class="card-header">
					<center><h3 class="card-title"><b><font color="#CC3300">FACILITIES</font></b></h3></center>
				</div>
				</div>

				<div class="card card-image" style="background-image: url(../../memimg/frame1.jpg);">
				<div class="card-body collapse in">
					<div class="card-block">
<img src="../../gym/gym1.jpg" style="height: 305px; width: 415px;">
					</div>
				</div>
				</div>

				<div class="card card-image" style="background-image: url(../../memimg/frame1.jpg);">
				<div class="card-body collapse in">
					<div class="card-block">
<img src="../../gym/equip.jpg" style="height: 300px; width: 415px;">
					</div>
				</div>
				</div>

<div class="card card-image" style="background-image: url(../../memimg/frame1.jpg);">
				<div class="card-body collapse in">
					<div class="card-block">
<img src="../../gym/lockers.jpg" style="height: 300px; width: 415px;">
					</div>
				</div>
				</div>

				
			</div>
			

   
   <div class="col-md-6">
  
			<div class="card">
 <div class="card card-image" style="background-image: url(../../memimg/frame1.jpg)">
				<div class="card-header">
					<center><h3 class="card-title"><b><font color="#CC3300">SAFETY</font></b></h3></center>
				</div>
				</div>
				<div class="card card-image" style="background-image: url(../../memimg/frame1.jpg);">
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
									<img src="../../uploads/policies/warmup.jpg" alt="First slide">
									<div class="carousel-caption">
										<h3>WARM UP</h3>
										<p>Warm up properly to avoid injury.</p>
									</div>
								</div>
								<div class="carousel-item">
									<img src="../../uploads/policies/weights.jpg" alt="Second slide">
									<div class="carousel-caption">
										<h3>AVOID EGO-LIFTING</h3>
										<p>Lift poundages you can safely handle.</p>
									</div>
								</div>
								<div class="carousel-item">
									<img src="../../uploads/policies/help.jpg" alt="Third slide">
									<div class="carousel-caption">
										<h3>ASK FOR ASSISTANCE</h3>
										<p>Ask for assistance when needed.</p>
									</div>
								</div>
								<div class="carousel-item">
									<img src="../../uploads/policies/return.jpg" alt="Third slide">
									<div class="carousel-caption">
										<h3>RETURN EQUIPMENT</h3>
										<p>All weights and equipment must be returned back in place after use.</p>
									</div>
								</div>
								<div class="carousel-item">
									<img src="../../uploads/policies/safety.jpg" alt="Fourth slide">
									<div class="carousel-caption">
										<h3>THINK SAFETY</h3>
										<p>THINK SAFETY: Exercise with caution. Your safety and others’ welfare are of prime importance.</p>
									</div>
								</div>
								<div class="carousel-item">
									<img src="../../uploads/policies/dropping.jpg" alt="Fifth slide">
									<div class="carousel-caption">
										<h3>HANDLE EQUIPMENT PROPERLY</h3>
										<p>Handle equipment and weights properly to prevent injury. E.g. dropping of dumbbells of weights.</p>
										</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				</div>
				<div class="card-body collapse in">
        <div class="card-block">
            <div class="card-text">
                <ul>
					@foreach ($policies as $policy)
                    <li>{{$policy->policy_description}}</li>
					@endforeach
                </ul>
            </div>
        </div>
    </div>
				
			</div>
		</div>



		   <div class="col-md-6">

			<div class="card">
			<div class="card card-image" style="background-image: url(../../memimg/frame.jpg)">
				<div class="card-header">
				
					<center><h3 class="card-title"><b><font color="#CC3300">COURTESY</font></b></h3></center>
					</div>
				</div>
				<div class="card card-image" style="background-image: url(../../memimg/frame1.jpg);">
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
									<img src="../../uploads/policies/attire.jpg" alt="First slide">
									<div class="carousel-caption">
										<h3>PROPER ATTIRE</h3>
										<p>Always wear the proper attire while training in the gym. I.e: Rubber shoes, T-shirt, Short Pants/Jogging Pants</p>
										</div>
								</div>
								<div class="carousel-item">
									<img src="../../uploads/policies/towels.jpg" alt="Second slide">
									<div class="carousel-caption">
										<h3>BRING TOWELS</h3>
										<p>Bring your towels for hygienic purposes.</p>
									</div>
								</div>
								<div class="carousel-item">
									<img src="../../uploads/policies/respect.jpg" alt="Third slide">
									<div class="carousel-caption">
										<h3>RESPECT</h3>
										<p>Each member must respect the rights of other gym members.</p>
									</div>
								</div>
								<div class="carousel-item">
									<img src="../../uploads/policies/secure.jpg" alt="Fourth slide">
									<div class="carousel-caption">
										<h3>SECURE BELONGINGS</h3>
										<p>Always secure and care for your personal belongings at all times.</p>
									</div>
								</div>
								<div class="carousel-item">
									<img src="../../uploads/policies/home.jpg" alt="Fifth slide">
									<div class="carousel-caption">
										<h3>BRING HOME</h3>
										<p>Bring home your work-out clothes and rubber shoes or avail for a locker instead.</p>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				</div>
				<div class="card-body collapse in">
        <div class="card-block">
            <div class="card-text">
                <ul>
					@foreach ($policies1 as $policy1)
                    <li>{{$policy1->policy_description}}</li>
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
    
@endsection
