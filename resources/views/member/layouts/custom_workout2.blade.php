 <!-- as of now yan muna kasi di ko na maisip kung pano i group yung days -->

 <!-- sidebar modal-->
    <!-- Modal -->
  @foreach($workout_custom as $key => $custom)
  <div class="modal right fade" id="custom{{$key}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2">
    <div class="modal-dialog" role="document">
      <div class="modal-content">

        <div class="modal-header bg-info">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h3 class="text-xs-center" modal-title" id="myModalLabel2">{{$custom->type}}</h3>
          <form action="/myworkout" method="POST">
            {{csrf_field()}}
            <button type="submit" class="btn btn-danger btn-block" name="program_chooser" value="{{$custom->type}}"> Start Program! </button>
          </form>
        </div>

        <div class="modal-body">

          <table class="table table-striped">                                        
          <tr> 
           <th>Day </th> 
           <th>Muscle Group</th> 
           <th>Workout Name</th> 
           <th>Sets</th>
           <th>Reps</th> 
          </tr> 
          <?php for($i=1; $i<=count($workout_custom_all); $i++) {  ?>

          @foreach($workout_custom_all as $all)
            @if( ($all->type == $custom->type) && ($all->day == $i) )
  


          <tr> 
    
          <td>{{$all->day}}</td>
          <td>{{$all->workout_type}}</td>
          <td>{{$all->workout_name}}</td> 
          <td>{{$all->sets}}</td> 
          <td>{{$all->reps}}</td> 
          </tr>

            @endif
          @endforeach

          <?php } ?>
        </table>
        </div>

      </div><!-- modal-content -->
    </div><!-- modal-dialog -->
  </div><!-- modal -->
 @endforeach
  
  
</div><!-- container -->