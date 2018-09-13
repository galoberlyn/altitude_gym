@if(session('confirm'))
  @include('member.layouts.confirm')
@endif

<div class="row">
    <div class="col-sm-12">
      <div class="card-group">
          <div class="card">
                  <div class="card-block">                                   
                      <div class="media">
  <h5 class="teal"> <i class="icon-thumbs-o-up"></i> The recommended exercises to do within a day is 6-8 </h5> <br>
@foreach($user_lvl as $lvl)
   <span class="red"> Your are level : {{$lvl->slevel}} </span><br>
   <span class="orange"> Your Experience points : {{$lvl->exp}} pts</span>

   <progress class="progress progress-striped progress-teal mt-1 mb-0" value="{{$lvl->exp}}" max="{{$lvl->base_point}}"></progress><br>
@endforeach
                        
                      </div>
                  </div>
          </div>
      </div>
    </div>


</div>


<ul class="nav nav-tabs" role="tablist">
  @foreach($user_workout as $key=> $uwork)
  <li class="nav-item">
    <a class="nav-link {{ $key == 0 ? 'active' : ''}}" href="#day{{$uwork->day}}_checklist" role="tab" data-toggle="tab">Day {{$uwork->day}}</a>
  </li>
  @endforeach
</ul> 
<!-- progress bar -->

<h3 class="teal text-xs-center"> Program Progress <i class="icon-star5"></i> </h3> <br>

@foreach($user_workout as $uwork_day)

<div class="col-xs-2 col-xs-2 col-xs-2 text-xs-center">
        <label class="text-xs-center">
        <input {{ $uwork_day->point_status == 'rendered' ? 'checked disabled' : 'disabled'}} 
        class="checker"  type="checkbox" autocomplete="off"> Day {{$uwork_day->day}}</label>
</div>
@endforeach <br>
<div class="text-xs-center teal lead"> 
 <progress id="dayprogress" class="progress progress-striped progress-indigo mt-1 mb-0" value="" max="100"></progress>
 <span id="dayprogress_text">  </span> % complete  
 </div>

<!-- Tab panes -->
<form method="POST" action="/workout_checklist">
  <input hidden name="progress_value" id="dayprogress_text_form">
<div class="tab-content">
  {{ csrf_field() }}

  <?php for($i=1; $i<=count($user_workout); $i++) { ?>
  <div role="tabpanel" class="tab-pane fade in {{ $i == 1 ? 'active' : ''}}" id="day{{$i}}_checklist">
  
        <table class="table table-striped">                                        
          <tr> 
           <th>Muscle Group</th> 
           <th>Workout Name</th> 
           <th>Sets</th> 
           <th>Reps</th> 
           <th>Points</th>
          </tr> 
  @foreach($workout_checklist as $checklist)
    @if($checklist->day == $i && ($checklist->workout_status == "on going"))
                     

          <tr> 
          <td>{{$checklist->workout_type}} </td>
          <td>{{$checklist->workout_name}}</td> 
          <td>{{$checklist->sets}}</td> 
          <td>{{$checklist->reps}}</td> 
          <td>{{$checklist->points}}</td> 
          </tr>


    @elseif($checklist->day == $i && $checklist->workout_status == "done" && ($checklist->point_status == "for_rendering" || $checklist->point_status == "rendered") && $checklist->row_status == 'active')

          <tr class="table-success">
            <td><i class="icon-android-checkbox-outline"> </i> {{$checklist->workout_type}}</td>
            <td>{{$checklist->workout_name}} </td>
            <td>{{$checklist->sets}}</td>
            <td>{{$checklist->reps}}</td>
          <td>{{$checklist->points}}</td> 
            
          </tr>

    @endif
  @endforeach
        </table>

@foreach($user_workout as $work)
  @if(($work->day==$i) && ($work->point_status=='unrendered'))
<button type="submit" class="btn btn-info" value="{{$i}}" name="day_identifier"> Request for Confirmation </button>
  
  @elseif(($work->day==$i) && ($work->point_status=='for_rendering'))
  <h3 class="teal text-xs-center"> Waiting for validation...</h3>
  
  @elseif(($work->day==$i) && ($work->point_status=='rendered'))
  <h3 class="teal text-xs-center"> Day {{$i}} Completed </h3>
  
  @endif
@endforeach
  </div>

<?php } ?>
</form>
</div>
@if(count($check_equal2) == count($check_equal))
  @if(count($created_program) == 1)
<form action="/workout_checklist2" method="POST">
  {{csrf_field()}}
  <input hidden value = "{{$checklist->type}}" name="program_name">
  <button type="submit" class="btn btn-block btn-danger" value="{{$i}}" name="refresh"> Check Points  </button>
</form>
  @else
  <form action="/workout_checklist3" method="POST">
  {{csrf_field()}}
  <input hidden value ="{{$checklist->type}}" name="program_name">

  <button type="submit" class="btn btn-block btn-danger" value="{{$i}}" name="refresh"> Check Points  </button>
</form>
  @endif
@endif



