<!DOCTYPE html>
<html lang="en" data-textdirection="ltr" class="loading">
 
  @include('member.layouts.head')
   
    <title>Gamification  Policies</title>
    
  <body data-open="click" data-menu="vertical-menu" data-col="2-columns" class="vertical-layout vertical-menu 2-columns  fixed-navbar">

    @include('member.layouts.nav')      
    
    @include('member.layouts.main_menu') 


    
    <div class="app-content content container-fluid">
      <div class="content-wrapper">
        <div class="content-header row">
        </div>
        <div class="content-body"><!-- stats -->
        
 <div class="row">
    <div class="col-xl-8 col-xs-12">
      @include('member.layouts.notification')
        <div class="card">
           
           <div class="card-header">
               <h2 class="green card-title">Gamification Policies</h2>
           </div>
           
            <div class="card-body">
                <div class="card-block">

                    <div class="media">
    
                            <ul class="list-group list-group-flush">
								@foreach ($gamepoli as $game)
								<li class="list-group-item">{{$game->policy_description}}</li>
								@endforeach
							</ul>
                            
                        </div>
                        <div class="card-header">
                        <h3 class="blue">Leveling-Up</h3>
                            
                        </div>
             <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="bg-teal bg-lighten-4">
                            <tr>
                                <th>Level</th>
                                <th>Rank</th>
                                <th>Base Point</th>
                                <th>Rank Base</th>
                                <th>Increment per Level</th>                                   
                            </tr>
                        </thead>
                        <tbody>
							@foreach($points as $pts)
								<tr>
									<td>{{$pts->level}}</td>
									<td>{{$pts->rank}} </td>
									<td>{{$pts->base_point}}</td>
									<td>{{$pts->rank_base}} </td>
									<td>{{$pts->increment_per_level}}</td>
								</tr>
							@endforeach
                        </tbody>
                    </table>
                </div>

                    </div>        
                       
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-xs-12">
        <div class="card" style="width: 23rem;">  
          <div class="card-block">
            <div class="row match-height">
      <div class="mb-1 text-xs-center"> 
        <h4>Gym Achievements <i class="icon-ribbon-b"></i></h4>
        <p>How achievements are gained</p>
      </div>
      <div id="accordionWrapa1" role="tablist" aria-expanded="true"> 
        <div class="card">
          <div id="heading1"  class="card-header">
            <a data-toggle="collapse" data-parent="#accordionWrapa1" href="#accordion1" aria-expanded="false" aria-controls="accordion2" class="card-title lead collapsed red">GREEN HORN</a>
          </div>
          <div id="accordion1" role="tabpanel" aria-labelledby="heading1" class="card-collapse collapse" aria-expanded="true">
            <div class="card-body">
              <div class="card-block">
              <div class="row">
               <img src="images/badges/GreenHorn.png" style="width:120px;height:150px;" class="mx-auto d-block">
              </div>
               <div class="row">
               <p class="text-xs-center">    
                Rewarded for registration     (5  points)
               </p>
               </div>
              </div>
            </div>
          </div>
          <div id="heading2"  class="card-header">
            <a data-toggle="collapse" data-parent="#accordionWrapa1" href="#accordion2" aria-expanded="false" aria-controls="accordion2" class="card-title lead collapsed red">GYM ADEPT</a>
          </div>
          <div id="accordion2" role="tabpanel" aria-labelledby="heading2" class="card-collapse collapse" aria-expanded="false">
           
           <div class="card-body">
              <div class="card-block">
              <div class="row">
               <img src="images/badges/gymadept.png" style="width:120px;height:150px;" class="mx-auto d-block">
              </div>
               <div class="row">
               <p class="text-xs-center">    
                Rewarded for one month members		(5  points)
               </p>
               </div>
              </div>
            </div>
          </div>
          <div id="heading3"  class="card-header">
            <a data-toggle="collapse" data-parent="#accordionWrapa1" href="#accordion3" aria-expanded="false" aria-controls="accordion3" class="card-title lead collapsed red">GYM INTERMIDIATE</a>
          </div>
          <div id="accordion3" role="tabpanel" aria-labelledby="heading3" class="card-collapse collapse" aria-expanded="false">
           
           <div class="card-body">
              <div class="card-block">
              <div class="row">
               <img src="images/badges/gymintermidiate.png" style="width:120px;height:150px;" class="mx-auto d-block">
              </div>
               <div class="row">
               <p class="text-xs-center">    
                Rewarded for 6 months members		(5  points)
               </p>
               </div>
              </div>
            </div>
          </div>
          <div id="heading4"  class="card-header">
            <a data-toggle="collapse" data-parent="#accordionWrapa1" href="#accordion4" aria-expanded="false" aria-controls="accordion4" class="card-title lead collapsed red">GYM VETERAN</a>
          </div>
          <div id="accordion4" role="tabpanel" aria-labelledby="heading4" class="card-collapse collapse" aria-expanded="false" style="height: 0px;">
           
           <div class="card-body">
              <div class="card-block">
              <div class="row">
               <img src="images/badges/gymveteran.png" style="width:120px;height:150px;" class="mx-auto d-block">
              </div>
               <div class="row">
               <p class="text-xs-center">    
                Rewarded for one year members		(5  points)
               </p>
               </div>
              </div>
            </div>
            
          </div>
		  <div id="heading5"  class="card-header">
            <a data-toggle="collapse" data-parent="#accordionWrapa1" href="#accordion5" aria-expanded="false" aria-controls="accordion5" class="card-title lead collapsed red">FIRST STEPS</a>
          </div>
          <div id="accordion5" role="tabpanel" aria-labelledby="heading6" class="card-collapse collapse" aria-expanded="false">
           
           <div class="card-body">
              <div class="card-block">
              <div class="row">
               <img src="images/badges/firststep.png" style="width:120px;height:150px;" class="mx-auto d-block">
              </div>
               <div class="row">
               <p class="text-xs-center">    
                Rewarded for 1k treadmill		(5  points)
               </p>
               </div>
              </div>
            </div>
           
          </div>
		  <div id="heading6"  class="card-header">
            <a data-toggle="collapse" data-parent="#accordionWrapa1" href="#accordion6" aria-expanded="false" aria-controls="accordion6" class="card-title lead collapsed red">POINT RUNNER</a>
          </div>
          <div id="accordion6" role="tabpanel" aria-labelledby="heading6" class="card-collapse collapse" aria-expanded="false">
           
           <div class="card-body">
              <div class="card-block">
              <div class="row">
               <img src="images/badges/pointrunner.png" style="width:120px;height:150px;" class="mx-auto d-block">
              </div>
               <div class="row">
               <p class="text-xs-center">    
                Rewarded for 2k on treadmill		(10  points)
               </p>
               </div>
              </div>
            </div>
           
          </div>
		  <div id="heading7"  class="card-header">
            <a data-toggle="collapse" data-parent="#accordionWrapa1" href="#accordion7" aria-expanded="false" aria-controls="accordion7" class="card-title lead collapsed red">MARATHONIST</a>
          </div>
          <div id="accordion7" role="tabpanel" aria-labelledby="heading7" class="card-collapse collapse" aria-expanded="false">
           
           <div class="card-body">
              <div class="card-block">
              <div class="row">
               <img src="images/badges/marathonist.png" style="width:120px;height:150px;" class="mx-auto d-block">
              </div>
               <div class="row">
               <p class="text-xs-center">    
                Rewarded for 5k, 7k etc. 		(15 points)
               </p>
               </div>
              </div>
            </div>
           
          </div>
		  <div id="heading8"  class="card-header">
            <a data-toggle="collapse" data-parent="#accordionWrapa1" href="#accordion8" aria-expanded="false" aria-controls="accordion8" class="card-title lead collapsed red">SLIMMING DOWN</a>
          </div>
          <div id="accordion8" role="tabpanel" aria-labelledby="heading8" class="card-collapse collapse" aria-expanded="false">
           
           <div class="card-body">
              <div class="card-block">
              <div class="row">
               <img src="images/badges/slimmingdown.png" style="width:120px;height:150px;" class="mx-auto d-block">
              </div>
               <div class="row">
               <p class="text-xs-center">    
                Rewarded for losing 2% of body weight	(15 points)
               </p>
               </div>
              </div>
            </div>
           
          </div>
		  <div id="heading9"  class="card-header">
            <a data-toggle="collapse" data-parent="#accordionWrapa1" href="#accordion9" aria-expanded="false" aria-controls="accordion9" class="card-title lead collapsed red">BEEFING UP</a>
          </div>
          <div id="accordion9" role="tabpanel" aria-labelledby="heading9" class="card-collapse collapse" aria-expanded="false">
           
           <div class="card-body">
              <div class="card-block">
              <div class="row">
               <img src="images/badges/beefingup.png" style="width:120px;height:150px;" class="mx-auto d-block">
              </div>
               <div class="row">
               <p class="text-xs-center">    
                Rewarded for gaining 2% of body weight	(15 points)
               </p>
               </div>
              </div>
            </div>
           
          </div>
		  <div id="heading10"  class="card-header">
            <a data-toggle="collapse" data-parent="#accordionWrapa1" href="#accordion10" aria-expanded="false" aria-controls="accordion10" class="card-title lead collapsed red">PROGRAM FINISHER</a>
          </div>
          <div id="accordion10" role="tabpanel" aria-labelledby="heading10" class="card-collapse collapse" aria-expanded="false">
           
           <div class="card-body">
              <div class="card-block">
              <div class="row">
               <img src="images/badges/programfinisher.png" style="width:120px;height:150px;" class="mx-auto d-block">
              </div>
               <div class="row">
               <p class="text-xs-center">    
                Rewarded for finishing a 2 program that is given by the trainor       (15 points)
               </p>
               </div>
              </div>
            </div>

          </div>
		  <div id="heading11"  class="card-header">
            <a data-toggle="collapse" data-parent="#accordionWrapa1" href="#accordion11" aria-expanded="false" aria-controls="accordion11" class="card-title lead collapsed red">CHEST BUILDER</a>
          </div>
          <div id="accordion11" role="tabpanel" aria-labelledby="heading11" class="card-collapse collapse" aria-expanded="false">
           
           <div class="card-body">
              <div class="card-block">
              <div class="row">
               <img src="images/badges/chestbuilder.png" style="width:120px;height:150px;" class="mx-auto d-block">
              </div>
               <div class="row">
               <p class="text-xs-center">    
                Rewarded for using weights of 20kg in chest exercise	 	      (10 points)
               </p>
               </div>
              </div>
            </div>
           
          </div>
		  <div id="heading12"  class="card-header">
            <a data-toggle="collapse" data-parent="#accordionWrapa1" href="#accordion12" aria-expanded="false" aria-controls="accordion12" class="card-title lead collapsed red">CHIEF CHEST</a>
          </div>
          <div id="accordion12" role="tabpanel" aria-labelledby="heading12" class="card-collapse collapse" aria-expanded="false">
           
           <div class="card-body">
              <div class="card-block">
              <div class="row">
               <img src="images/badges/chiefchest.png" style="width:120px;height:150px;" class="mx-auto d-block">
              </div>
               <div class="row">
               <p class="text-xs-center">    
                Rewarded for using weigths of 50kg in chest excercise		      (15 points)
               </p>
               </div>
              </div>
            </div>

          </div>
		  <div id="heading13"  class="card-header">
            <a data-toggle="collapse" data-parent="#accordionWrapa1" href="#accordion13" aria-expanded="false" aria-controls="accordion13" class="card-title lead collapsed red">PRO PRESS</a>
          </div>
          <div id="accordion13" role="tabpanel" aria-labelledby="heading13" class="card-collapse collapse" aria-expanded="false">
           
           <div class="card-body">
              <div class="card-block">
              <div class="row">
               <img src="images/badges/propress.png" style="width:120px;height:150px;" class="mx-auto d-block">
              </div>
               <div class="row">
               <p class="text-xs-center">    
                Rewarded for using weigths of 100kg in chest excercise		      (20 points)
               </p>
               </div>
              </div>
            </div>
           
          </div>
          
		  <div id="heading14"  class="card-header">
            <a data-toggle="collapse" data-parent="#accordionWrapa1" href="#accordion14" aria-expanded="false" aria-controls="accordion14" class="card-title lead collapsed red">BABY BICEPS</a>
          </div>
          <div id="accordion14" role="tabpanel" aria-labelledby="heading14" class="card-collapse collapse" aria-expanded="false">
            <div class="card-body">
              <div class="card-block">
              <div class="row">
                  <img src="images/badges/babybiceps.png" style="width:120px;height:150px;" class="mx-auto d-block">
              </div>
              <div class="row">
                  <p class="text-xs-center">
                    Rewarded for using weights of 20kg in bicep exercise	 	      (10 points)      
                  </p>
              </div>
              </div>
            </div>
          </div>
		  <div id="heading15"  class="card-header">
            <a data-toggle="collapse" data-parent="#accordionWrapa1" href="#accordion15" aria-expanded="false" aria-controls="accordion15" class="card-title lead collapsed red">BICEPTIONIST</a>
          </div>
          <div id="accordion15" role="tabpanel" aria-labelledby="heading15" class="card-collapse collapse" aria-expanded="false">
            <div class="card-body">
              <div class="card-block">
              <div class="row">
                  <img src="images/badges/biceptionist.png" style="width:120px;height:150px;" class="mx-auto d-block">
              </div>
              <p class="text-xs-center">
                Rewarded for using weights of 50kg in bicep exercise	 	      (15 points)  
              </p>
				
              </div>
            </div>
          </div>
		  <div id="heading16"  class="card-header">
            <a data-toggle="collapse" data-parent="#accordionWrapa1" href="#accordion16" aria-expanded="false" aria-controls="accordion16" class="card-title lead collapsed red">THE GUNS</a>
          </div>
          <div id="accordion16" role="tabpanel" aria-labelledby="heading16" class="card-collapse collapse" aria-expanded="false">
            <div class="card-body">
              <div class="card-block">
              <div class="row">
                  <img src="images/badges/theguns.png" style="width:120px;height:150px;" class="mx-auto d-block">
              </div>
              <div class="row">
                  <p class="text-xs-center">
                    Rewarded for using weights of 100kg in bicep exercise	 	      (20 points)      
                  </p>
              </div>
				
              </div>
            </div>
          </div>
		  <div id="heading17"  class="card-header">
            <a data-toggle="collapse" data-parent="#accordionWrapa1" href="#accordion17" aria-expanded="false" aria-controls="accordion17" class="card-title lead collapsed red">PADS</a>
          </div>
          <div id="accordion17" role="tabpanel" aria-labelledby="heading17" class="card-collapse collapse" aria-expanded="false">
            <div class="card-body">
              <div class="card-block">
              <div class="row">
                  <img src="images/badges/pads.png" style="width:120px;height:150px;" class="mx-auto d-block">
              </div>
              <div class="row">
                Rewarded for using weights of 20kg in Tricep exercise	 	      (10 points)  
              </div>
				
              </div>
            </div>
          </div>
		  <div id="heading18"  class="card-header">
            <a data-toggle="collapse" data-parent="#accordionWrapa1" href="#accordion18" aria-expanded="false" aria-controls="accordion18" class="card-title lead collapsed red">BUNS</a>
          </div>
          <div id="accordion18" role="tabpanel" aria-labelledby="heading18" class="card-collapse collapse" aria-expanded="false">
            <div class="card-body">
              <div class="card-block">
              <div class="row">
                  <img src="images/badges/buns.png" style="width:120px;height:150px;" class="mx-auto d-block">
              </div>
              <div class="row">
                  <p class="text-xs-center">
                    Rewarded for using weights of 50kg in Tricep exercise	 	      (15 points)      
                  </p>
              </div>
              </div>
            </div>
          </div>
          
		  <div id="heading19"  class="card-header">
            <a data-toggle="collapse" data-parent="#accordionWrapa1" href="#accordion19" aria-expanded="false" aria-controls="accordion19" class="card-title lead collapsed red">HORSESHOE</a>
          </div>
          <div id="accordion19" role="tabpanel" aria-labelledby="heading19" class="card-collapse collapse" aria-expanded="false">
            <div class="card-body">
              <div class="card-block">
              <div class="row">
                  <img src="images/badges/horseshoe.png" style="width:120px;height:150px;" class="mx-auto d-block">
              </div>
              <div class="row">
                  <p class="text-xs-center">
                    Rewarded for using weights of 100kg in Tricep exercise	 	      (20 points)      
                  </p>
              </div>
              </div>
            </div>
          </div>
		  <div id="heading20"  class="card-header">
            <a data-toggle="collapse" data-parent="#accordionWrapa1" href="#accordion20" aria-expanded="false" aria-controls="accordion20" class="card-title lead collapsed red">THE BAKI</a>
          </div>
          <div id="accordion20" role="tabpanel" aria-labelledby="heading20" class="card-collapse collapse" aria-expanded="false">
            <div class="card-body">
              <div class="card-block">
              <div class="row">
                  <img src="images/badges/thebaki.png" style="width:120px;height:150px;" class="mx-auto d-block">
              </div>
              <div class="row">
                  <p class="text-xs-center">
                    Rewarded for using weights of 20 kg in back excercise		      (10 points)      
                  </p>
              </div>
              </div>
            </div>
          </div>
		  <div id="heading21"  class="card-header">
            <a data-toggle="collapse" data-parent="#accordionWrapa1" href="#accordion21" aria-expanded="false" aria-controls="accordion21" class="card-title lead collapsed red">THE SUPERMAN</a>
          </div>
          <div id="accordion21" role="tabpanel" aria-labelledby="heading21" class="card-collapse collapse" aria-expanded="false">
            <div class="card-body">
              <div class="card-block">
              <div class="row">
                  <img src="images/badges/thesuperman.png" style="width:120px;height:150px;" class="mx-auto d-block">
              </div>
              <div class="row">
                  <p class="text-xs-center">
                    Rewarded for using weights of 50 kg in back exercise		      (15 points)      
                  </p>
              </div>
              </div>
            </div>
          </div>
		  <div id="heading22"  class="card-header">
            <a data-toggle="collapse" data-parent="#accordionWrapa1" href="#accordion22" aria-expanded="false" aria-controls="accordion22" class="card-title lead collapsed red">COBRA</a>
          </div>
          <div id="accordion22" role="tabpanel" aria-labelledby="heading22" class="card-collapse collapse" aria-expanded="false">
            <div class="card-body">
              <div class="card-block">
              <div class="row">
                  <img src="images/badges/cobra.png" style="width:120px;height:150px;" class="mx-auto d-block">
              </div>
              <div class="row">
                  <p class="text-xs-center">
                    Rewarded for using weights of 100 kg in back excercise		      (20 points)      
                  </p>
              </div>
					
              </div>
            </div>
          </div>
		  <div id="heading23"  class="card-header">
            <a data-toggle="collapse" data-parent="#accordionWrapa1" href="#accordion23" aria-expanded="false" aria-controls="accordion23" class="card-title lead collapsed red">SCORER</a>
          </div>
          <div id="accordion23" role="tabpanel" aria-labelledby="heading23" class="card-collapse collapse" aria-expanded="false">
            <div class="card-body">
              <div class="card-block">
              <div class="row">
                  <img src="images/badges/scorer.png" style="width:120px;height:150px;" class="mx-auto d-block">
              </div>
              <div class="row">
                  <p class="text-xs-center">
                      Rewarded for members who are in Top 15 in the leader board	      (20 points)
                  </p>
              </div>
					
              </div>
            </div>
          </div>
		  <div id="heading24"  class="card-header">
            <a data-toggle="collapse" data-parent="#accordionWrapa1" href="#accordion24" aria-expanded="false" aria-controls="accordion24" class="card-title lead collapsed red">SCORE-TECHNICIAN</a>
          </div>
          <div id="accordion24" role="tabpanel" aria-labelledby="heading24" class="card-collapse collapse" aria-expanded="false">
            <div class="card-body">
              <div class="card-block">
              <div class="row">
                  <img src="images/badges/scoretechnitian.png" style="width:120px;height:150px;" class="mx-auto d-block">
              </div>
              <div class="row">
                  <p class="text-xs-center">
                    Rewarded for members who are in Top 10 in the leader board	      (25 points)  
                  </p>
              </div>
              </div>
            </div>
          </div>
		  <div id="heading25"  class="card-header">
            <a data-toggle="collapse" data-parent="#accordionWrapa1" href="#accordion25" aria-expanded="false" aria-controls="accordion25" class="card-title lead collapsed red">SCORING MACHINE</a>
          </div>
          <div id="accordion25" role="tabpanel" aria-labelledby="heading25" class="card-collapse collapse" aria-expanded="false">
            <div class="card-body">
              <div class="card-block">
              <div class="row">
                  <img src="images/badges/scoringmachine.png" style="width:120px;height:150px;" class="mx-auto d-block">
              </div>
              <div class="row">
                  <p class="text-xs-center">
                    Rewarded for members who are in Top 5 in the leader board	      (30 points)      
                  </p>
              </div>
              </div>
            </div>
          </div>
		  <div id="heading26"  class="card-header">
            <a data-toggle="collapse" data-parent="#accordionWrapa1" href="#accordion26" aria-expanded="false" aria-controls="accordion26" class="card-title lead collapsed red">ORGANIZER</a>
          </div>
          <div id="accordion26" role="tabpanel" aria-labelledby="heading26" class="card-collapse collapse" aria-expanded="false">
            <div class="card-body">
              <div class="card-block">
              <div class="row">
                  <img src="images/badges/organizer.png" style="width:120px;height:150px;" class="mx-auto d-block">
              </div>
              <div class="row">
                  <p class="text-xs-center">
                Rewarded for those who avails locker				      (10 points)      
                  </p>
              </div>
				
              </div>
            </div>
          </div>
          
          <div id="heading27"  class="card-header">
            <a data-toggle="collapse" data-parent="#accordionWrapa1" href="#accordion27" aria-expanded="false" aria-controls="accordion27" class="card-title lead collapsed red">BOOSTER</a>
          </div>
          <div id="accordion27" role="tabpanel" aria-labelledby="heading27" class="card-collapse collapse" aria-expanded="false">
            <div class="card-body">
              <div class="card-block">
              <div class="row">
                  <img src="images/badges/organizer.png" style="width:120px;height:150px;" class="mx-auto d-block">
              </div>
              <div class="row">
                  <p class="text-xs-center">
                Reward for those who have helped other members on their workout				      (10 points)      
                  </p>
              </div>
				
              </div>
            </div>
          </div>
          
          <div id="heading28"  class="card-header">
            <a data-toggle="collapse" data-parent="#accordionWrapa1" href="#accordion28" aria-expanded="false" aria-controls="accordion28" class="card-title lead collapsed red">GRINDER</a>
          </div>
          <div id="accordion28" role="tabpanel" aria-labelledby="heading28" class="card-collapse collapse" aria-expanded="false">
            <div class="card-body">
              <div class="card-block">
              <div class="row">
                  <img src="images/badges/grinder.png" style="width:120px;height:150px;" class="mx-auto d-block">
              </div>
              <div class="row">
                  <p class="text-xs-center">
                Rewarded for those who gained 2 or more levels in one day				      (10 points)      
                  </p>
              </div>
              </div>
            </div>
          </div>
          
          <div id="heading29"  class="card-header">
            <a data-toggle="collapse" data-parent="#accordionWrapa1" href="#accordion29" aria-expanded="false" aria-controls="accordion29" class="card-title lead collapsed red">MAC ARTHUR</a>
          </div>
          <div id="accordion29" role="tabpanel" aria-labelledby="heading29" class="card-collapse collapse" aria-expanded="false">
            <div class="card-body">
              <div class="card-block">
              <div class="row">
                  <img src="images/badges/macarthur.png" style="width:120px;height:150px;" class="mx-auto d-block">
              </div>
              <div class="row">
                  <p class="text-xs-center">
                Rewarded for those who re-subscribed to the gym after being inactive for 3 months				      (5 points)
                  </p>
              </div>
              </div>
            </div>
          </div>
          
          <div id="heading30"  class="card-header">
            <a data-toggle="collapse" data-parent="#accordionWrapa1" href="#accordion30" aria-expanded="false" aria-controls="accordion30" class="card-title lead collapsed red">SECOND HOME</a>
          </div>
          <div id="accordion30" role="tabpanel" aria-labelledby="heading30" class="card-collapse collapse" aria-expanded="false">
            <div class="card-body">
              <div class="card-block">
              <div class="row">
                  <img src="images/badges/secondhome.png" style="width:120px;height:150px;" class="mx-auto d-block">
              </div>
              <div class="row">
                  <p class="text-xs-center">
                Rewarded for those that have logged a total of  72 hours in the gym 				      (15 points)
                  </p>
              </div>
              </div>
            </div>
          </div>
          
          <div id="heading31"  class="card-header">
            <a data-toggle="collapse" data-parent="#accordionWrapa1" href="#accordion31" aria-expanded="false" aria-controls="accordion31" class="card-title lead collapsed red">YOUR DAY</a>
          </div>
          <div id="accordion31" role="tabpanel" aria-labelledby="heading31" class="card-collapse collapse" aria-expanded="false">
            <div class="card-body">
              <div class="card-block">
              <div class="row">
                  <img src="images/badges/yourday.png" style="width:120px;height:150px;" class="mx-auto d-block">
              </div>
              <div class="row">
                  <p class="text-xs-center">
                Rewarded for those members that have logged in during their birthday 				      (10 points)
                  </p>
              </div>
              </div>
            </div>
          </div>
          
          <div id="heading32"  class="card-header">
            <a data-toggle="collapse" data-parent="#accordionWrapa1" href="#accordion32" aria-expanded="false" aria-controls="accordion32" class="card-title lead collapsed red">EARLY BIRD</a>
          </div>
          <div id="accordion32" role="tabpanel" aria-labelledby="heading32" class="card-collapse collapse" aria-expanded="false">
            <div class="card-body">
              <div class="card-block">
              <div class="row">
                  <img src="images/badges/earlybird.png" style="width:120px;height:150px;" class="mx-auto d-block">
              </div>
              <div class="row">
                  <p class="text-xs-center">
                Rewarded for being logging in during the first 30 minutes of opening 				      (5 points)
                  </p>
              </div>
              </div>
            </div>
          </div>
          
          <div id="heading33"  class="card-header">
            <a data-toggle="collapse" data-parent="#accordionWrapa1" href="#accordion33" aria-expanded="false" aria-controls="accordion33" class="card-title lead collapsed red">OWLER</a>
          </div>
          <div id="accordion33" role="tabpanel" aria-labelledby="heading33" class="card-collapse collapse" aria-expanded="false">
            <div class="card-body">
              <div class="card-block">
              <div class="row">
                  <img src="images/badges/owler.png" style="width:120px;height:150px;" class="mx-auto d-block">
              </div>
              <div class="row">
                  <p class="text-xs-center">
                Rewarded for those who logged out 30 minutes before closing 				      (5 points)
                  </p>
              </div>
              </div>
            </div>
          </div>
          
          <div id="heading33"  class="card-header">
            <a data-toggle="collapse" data-parent="#accordionWrapa1" href="#accordion33" aria-expanded="false" aria-controls="accordion33" class="card-title lead collapsed red">ON A ROLL</a>
          </div>
          <div id="accordion33" role="tabpanel" aria-labelledby="heading33" class="card-collapse collapse" aria-expanded="false">
            <div class="card-body">
              <div class="card-block">
              <div class="row">
                  <img src="images/badges/onaroll.png" style="width:120px;height:150px;" class="mx-auto d-block">
              </div>
              <div class="row">
                  <p class="text-xs-center">
                Rewarded for those who have gained the highest points for the day 				      (15 points)
                  </p>
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
        
        
</div>        
 


      </div>
    </div>
    <!-- ////////////////////////////////////////////////////////////////////////////-->


    
    <!-- BEGIN VENDOR JS-->
    <script src="../../app-assets/js/core/libraries/jquery.min.js" type="text/javascript"></script>
    <script src="../../app-assets/vendors/js/ui/tether.min.js" type="text/javascript"></script>
    <script src="../../app-assets/js/core/libraries/bootstrap.min.js" type="text/javascript"></script>
    <script src="../../app-assets/vendors/js/ui/perfect-scrollbar.jquery.min.js" type="text/javascript"></script>
    <script src="../../app-assets/vendors/js/ui/unison.min.js" type="text/javascript"></script>
    <script src="../../app-assets/vendors/js/ui/blockUI.min.js" type="text/javascript"></script>
    <script src="../../app-assets/vendors/js/ui/jquery.matchHeight-min.js" type="text/javascript"></script>
    <script src="../../app-assets/vendors/js/ui/screenfull.min.js" type="text/javascript"></script>
    <script src="../../app-assets/vendors/js/extensions/pace.min.js" type="text/javascript"></script>
    <!-- BEGIN VENDOR JS-->
    <!-- BEGIN PAGE VENDOR JS-->
    <script src="../../app-assets/vendors/js/charts/chart.min.js" type="text/javascript"></script>
    <!-- END PAGE VENDOR JS-->
    <!-- BEGIN ROBUST JS-->
    <script src="../../app-assets/js/core/app-menu.js" type="text/javascript"></script>
    <script src="../../app-assets/js/core/app.js" type="text/javascript"></script>
    <!-- END ROBUST JS-->
    <!-- BEGIN PAGE LEVEL JS-->
    <script src="../../app-assets/js/scripts/pages/dashboard-lite.js" type="text/javascript"></script>
    <!-- END PAGE LEVEL JS-->
  </body>
</html>
