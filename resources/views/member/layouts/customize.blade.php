<h3 class="teal text-xs-center"> Available Workouts </h3>

<ul class="nav nav-tabs" role="tablist">
  @foreach($all_workout_day as $key => $customize_days)
  <li class="nav-item">
    <a class="nav-link {{$key == 0 ? 'active' : '' }}" href="#day_cust{{$customize_days->day}}" role="tab" data-toggle="tab">Day {{$customize_days->day}}</a>
  </li>
  @endforeach
</ul>

<form action="/custom" method="POST" onsubmit="return confirm('Are you sure about the program?');">
	{{csrf_field()}}
<div class="tab-content">
<?php for($i=1; $i<=count($all_workout_day); $i++){ ?>
  <div role="tabpanel" class="tab-pane fade in {{ $i == 1 ? 'active' : ''}}" id="day_cust{{$i}}">
  
        <table class="table table-striped">                                        
          <tr> 
           <th>Muscle Group</th> 
           <th>Workout Name</th> 
           <th>Category </th>
           <th>Sets</th> 
           <th>Reps</th> 
           <th> Points </th>
          </tr> 
  @foreach($all_workout as $all_custom)
  @if($all_custom->day == $i)
            


          <tr> 
    
          <td>
          	<input type="checkbox" class="check_custom" name="customize_program[]" value="{{$all_custom->workout_name}}" 
          	onclick="twin()">

          	<input hidden type="checkbox"  class="check_custom1" name="customize_program_day[] " value="{{$all_custom->day}}">
          	<input hidden type="checkbox" class="check_custom2" name="customize_program_type[]" value="{{$all_custom->type}}">
          	{{$all_custom->workout_type}}</td>
          <td>{{$all_custom->workout_name}}</td> 
          <td>{{$all_custom->type}}</td>
          <td>{{$all_custom->sets}}</td> 
          <td>{{$all_custom->reps}}</td> 
          <td>{{$all_custom->points}}</td>

          </tr>

  @endif
  @endforeach
        </table>
  </div>

<?php } ?>
<div class="text-xs-center">
  <input type="submit" class="btn btn-danger"> 
</div>
</div>
</form>