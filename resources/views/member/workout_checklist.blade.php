
<h5 class="teal"> <i class="icon-thumbs-o-up"></i> The recommended exercises to do within a day is 6-8 </h5> <br>
<ul class="nav nav-tabs" role="tablist">
  <li class="nav-item">
    <a class="nav-link active" href="#day1_checklist" role="tab" data-toggle="tab">Day 1</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="#day2_checklist" role="tab" data-toggle="tab">Day 2</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="#day3_checklist" role="tab" data-toggle="tab">Day 3</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="#day4_checklist" role="tab" data-toggle="tab">Day 4</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="#day5_checklist" role="tab" data-toggle="tab">Day 5</a>
  </li>
</ul> 
<!-- progress bar -->
<h3 class="teal text-xs-center"> Program Progress <i class="icon-star5"></i> </h3>
@foreach($progress as $prog)
<div class="text-xs-center teal lead"> <span id="dayprogress_text"> {{$prog->progress_value}} </span> % complete  
 <progress id="dayprogress" class="progress progress-sm progress-teal mt-1 mb-0" value="{{$prog->progress_value}}" max="100"></progress>

 </div><br>
@endforeach
<!-- Tab panes -->
<div class="tab-content">
  <div role="tabpanel" class="tab-pane fade in active" id="day1_checklist">
 
            
        <table class="table table-striped">                                        
          <tr> 
           <th>Muscle Group</th> 
           <th>Workout Name</th> 
           <th>Sets</th> 
           <th>Reps</th> 
          </tr> 

<form method="POST" action="/workout_checklist">
  <input hidden name="progress_value" id="dayprogress_text_form">
  {{ csrf_field() }}
@foreach($workout_checklist as $checklist)
    @if($checklist->day == "1" && ($checklist->workout_status == "on going"))
                       

          <tr> 
    
          <td><input type="checkbox" class="day1" name="day_checklist[]" value="{{$checklist->workout_name}}">{{$checklist->workout_type}} </td>
          <td>{{$checklist->workout_name}}</td> 
          <td>{{$checklist->sets}}</td> 
          <td>{{$checklist->reps}}</td> 
          </tr>
    @elseif($checklist->day =="1" && $checklist->workout_status == "done")

          <tr class="table-success">
            <td><input type="checkbox" hidden checked="true"><i class="icon-android-checkbox-outline"> </i> {{$checklist->workout_type}}</td>
            <td>{{$checklist->workout_name}}
            <td>{{$checklist->sets}}</td>
            <td>{{$checklist->reps}}</td>
          </tr>

    @endif
@endforeach
        </table>
  <input type="submit" class="btn btn-info" value="Save">
  <button type='button' class='btn btn-warning' onclick='markAll()'> Mark/Unmark All</button>

  </div>

  <div role="tabpanel" class="tab-pane fade" id="day2_checklist">
         
        <table class="table table-striped">                                        
          <tr> 
           <th>Muscle Group</th> 
           <th>Workout Name</th> 
           <th>Sets</th> 
           <th>Reps</th> 
          </tr> 

@foreach($workout_checklist as $checklist)
    @if($checklist->day == "2" && ($checklist->workout_status=="on going"))
                       
          <tr> 
    
          <td><input type="checkbox" class="day2" name="day_checklist[]" value="{{$checklist->workout_name}}">{{$checklist->workout_type}}</td>
          <td>{{$checklist->workout_name}}</td> 
          <td>{{$checklist->sets}}</td> 
          <td>{{$checklist->reps}}</td> 
          </tr>
    @elseif($checklist->day == "2" && ($checklist->workout_status=="done"))

          <tr class="table-success">
            <td><input type="checkbox" hidden checked="true"><i class="icon-android-checkbox-outline"> </i> {{$checklist->workout_type}}</td>
            <td>{{$checklist->workout_name}}</td>
            <td>{{$checklist->sets}}</td>
            <td>{{$checklist->reps}}</td>
          </tr>

    @endif
@endforeach
        </table>
        <button class="btn btn-info"> Save </button>
        <button type='button' class='btn btn-warning' onclick='markAll2()'> Mark/Unmark All</button>
  </div>
  <div role="tabpanel" class="tab-pane fade" id="day3_checklist">
           
        <table class="table table-striped">                                        
          <tr> 
           <th>Muscle Group</th> 
           <th>Workout Name</th> 
           <th>Sets</th> 
           <th>Reps</th> 
          </tr> 
@foreach($workout_checklist as $checklist)
    @if($checklist->day == "3" && $checklist->workout_status=="on going")
                       

          <tr> 
    
          <td><input type="checkbox" class="day3" name="day_checklist[]" value="{{$checklist->workout_name}}">{{$checklist->workout_type}}</td>
          <td>{{$checklist->workout_name}}</td> 
          <td>{{$checklist->sets}}</td> 
          <td>{{$checklist->reps}}</td> 
          </tr>

    @elseif($checklist->day== "3" && $checklist->workout_status=="done")

          <tr class="table-success">
            <td><input type="checkbox" hidden checked="true"><i class="icon-android-checkbox-outline"> </i> {{$checklist->workout_type}}</td>
            <td>{{$checklist->workout_name}}</td>
            <td>{{$checklist->sets}}</td>
            <td>{{$checklist->reps}}</td>
          </tr>

    @endif
@endforeach
        </table>
        <button class="btn btn-info"> Save </button>
        <button type='button' class='btn btn-warning' onclick='markAll3()'> Mark/Unmark All</button>
  </div>
  <div role="tabpanel" class="tab-pane fade" id="day4_checklist">
           
        <table class="table table-striped">                                        
          <tr> 
           <th>Muscle Group</th> 
           <th>Workout Name</th> 
           <th>Sets</th> 
           <th>Reps</th> 
          </tr> 
@foreach($workout_checklist as $checklist)
    @if($checklist->day == "4" && $checklist->workout_status=="on going")
                       

          <tr> 
    
          <td><input type="checkbox" class="day4" name="day_checklist[]" value="{{$checklist->workout_name}}">{{$checklist->workout_type}}</td>
          <td>{{$checklist->workout_name}}</td> 
          <td>{{$checklist->sets}}</td> 
          <td>{{$checklist->reps}}</td> 
          </tr>
    @elseif($checklist->day == "4" && $checklist->workout_status=="done")

          <tr class="table-success">
            <td><input type="checkbox" hidden checked="true"><i class="icon-android-checkbox-outline"> </i> {{$checklist->workout_type}}</td>
            <td>{{$checklist->workout_name}}
            <td>{{$checklist->sets}}</td>
            <td>{{$checklist->reps}}</td>
          </tr>

    @endif
@endforeach

        </table>
        <button class="btn btn-info"> Save </button>
        <button type='button' class='btn btn-warning' onclick='markAll4()'> Mark/Unmark All</button>
  </div>
  <div role="tabpanel" class="tab-pane fade" id="day5_checklist">
           
        <table class="table table-striped">                                        
          <tr> 
           <th>Muscle Group</th> 
           <th>Workout Name</th> 
           <th>Sets</th> 
           <th>Reps</th> 
          </tr> 
@foreach($workout_checklist as $checklist)
    @if($checklist->day == "5" && $checklist->workout_status=="on going")
                       

          <tr> 
          <td><input type="checkbox" class="day5" name="day_checklist[]" value="{{$checklist->workout_name}}">{{$checklist->workout_type}}</td>
          <td>{{$checklist->workout_name}}</td> 
          <td>{{$checklist->sets}}</td> 
          <td>{{$checklist->reps}}</td> 
          </tr>
    @elseif($checklist->day == "5" && $checklist->workout_status=="done")

          <tr class="table-success">
            <td><input type="checkbox" hidden checked="true"><i class="icon-android-checkbox-outline"> </i> {{$checklist->workout_type}}</td>
            <td>{{$checklist->workout_name}}
            <td>{{$checklist->sets}}</td>
            <td>{{$checklist->reps}}</td>
          </tr>

    @endif
@endforeach
        </table>
        <button class="btn btn-info"> Save </button>
        <button type='button' class='btn btn-warning' onclick='markAll5()'> Mark/Unmark All</button>
  
  </form>
  </div>
</div>