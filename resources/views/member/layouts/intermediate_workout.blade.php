
<h5 class="teal"> <i class="icon-thumbs-o-up"></i> The recommended exercises to do within a day is 6-8 </h5> <br>
<ul class="nav nav-tabs" role="tablist">
  @foreach($workout_intermediate_days as $key => $inter_days)
  <li class="nav-item">
    <a class="nav-link {{$key == 0 ? 'active' : '' }}" href="#day{{$inter_days->day}}_i" role="tab" data-toggle="tab">Day {{$inter_days->day}}</a>
  </li>
  @endforeach
</ul>

<!-- Tab panes -->
<div class="tab-content">
<?php for($i=1; $i<=count($workout_intermediate_days); $i++){ ?>
  <div role="tabpanel" class="tab-pane fade in {{ $i == 1 ? 'active' : ''}}" id="day{{$i}}_i">
  
        <table class="table table-striped">                                        
          <tr> 
           <th>Muscle Group</th> 
           <th>Workout Name</th> 
           <th>Sets</th> 
           <th>Reps</th> 
          </tr> 
  @foreach($workout_intermediate as $inter)
  @if($inter->day == $i)
            


          <tr> 
    
          <td>{{$inter->workout_type}}</td>
          <td>{{$inter->workout_name}}</td> 
          <td>{{$inter->sets}}</td> 
          <td>{{$inter->reps}}</td> 
          </tr>

  @endif
  @endforeach
        </table>
  </div>

<?php } ?>
  
</div>