
<h5 class="teal"> <i class="icon-thumbs-o-up"></i> The recommended exercises to do within a day is 6-8 </h5> <br>
<ul class="nav nav-tabs" role="tablist">
  @foreach($workout_beginner_days as $key => $begin_days)
  <li class="nav-item">
    <a class="nav-link {{$key == 0 ? 'active' : '' }}" href="#day{{$begin_days->day}}" role="tab" data-toggle="tab">Day {{$begin_days->day}}</a>
  </li>
  @endforeach
</ul>

<!-- Tab panes -->


<div class="tab-content">
<?php for($i=1; $i<=count($workout_beginner_days); $i++){ ?>
  <div role="tabpanel" class="tab-pane fade in {{ $i == 1 ? 'active' : ''}}" id="day{{$i}}">
  
        <table class="table table-striped">                                        
          <tr> 
           <th>Muscle Group</th> 
           <th>Workout Name</th> 
           <th>Sets</th> 
           <th>Reps</th> 
          </tr> 
  @foreach($workout_beginner as $begin)
  @if($begin->day == $i)
            


          <tr> 
    
          <td>{{$begin->workout_type}}</td>
          <td>{{$begin->workout_name}}</td> 
          <td>{{$begin->sets}}</td> 
          <td>{{$begin->reps}}</td> 
          </tr>

  @endif
  @endforeach
        </table>
  </div>

<?php } ?>
  
</div>