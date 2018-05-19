<h5 class="teal"> <i class="icon-thumbs-o-up"></i> The recommended exercises to do within a day is 6-8 </h5> <br>
<ul class="nav nav-tabs" role="tablist">
@foreach ($day_beginner as $day_begin)
  <li class="nav-item">
    <a class="nav-link" href="#dayB{{$day_begin -> day}}" role="tab" data-toggle="tab">Day {{$day_begin -> day}}</a>
  </li>
@endforeach
</ul>
<!-- Tab panes -->
<div class="tab-content">
<?php for ($i=0; $i <= count($day_beginner); $i++){ ?>
  <div role="tabpanel" class="tab-pane fade in {{ $i == 1 ? 'active' : ''}}" id="dayB{{$i}}">
        <table class="table table-striped">                                         
          <tr>  
            <th>Workout Name</th> 
            <th>Reps</th> 
            <th>Sets</th>
            <th>Action</th>
          </tr> 


      @foreach ($all_prog as $beginners)
        @if ($beginners -> day == $i && $beginners -> type == "Beginner")
          <tr>
            <td>{{$beginners -> workout_name}}</td>
            <td>{{$beginners -> reps}}</td>
            <td>{{$beginners -> sets}}</td>
            <form action="/rem_work" method="POST">
            {{csrf_field()}}
            <td><button onclick="confirm('Are you sure you want remove this workout?')" class="btn btn-danger" type="submit" name="rem_work" value="{{$beginners -> id}}">Remove</button></td>
            </form>
          </tr>
        @endif
      @endforeach
        </table>
        <form action="/edit_work" method="GET">
          {{csrf_field()}}
          @foreach ($all_prog as $all_progs)
          <input name="prog_identifier" hidden value="Beginner"> 
          @endforeach
          <input name="days_identifier" hidden value="{{count($day_beginner)}}"> 
          <div class="text-xs-right">
          <button class="btn btn-green" type="submit">Edit Program</button>
          </div>
        </form>
  </div>
<?php }?>
</div>