 <!-- as of now yan muna kasi di ko na maisip kung pano i group yung days -->

 <!-- sidebar modal-->
    <!-- Modal -->

  @foreach($custom_prog as $key => $custom_types)
  <div class="modal right fade" id="custom_types{{$key}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2">
    <div class="modal-dialog" role="document">
      <div class="modal-content">

        <div class="modal-header bg-info">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h3 class="text-xs-center" modal-title" id="myModalLabel2">{{$custom_types->type}}</h3>
        </div>

        <div class="modal-body">

          <table class="table table-striped">                                        
          <tr>  
            <th>Workout Name</th> 
            <th>Sets</th>
            <th>Reps</th>
            <th>Action</th>  

          </tr> 
          <?php for($i=1; $i<=count($day_custom); $i++) {  ?>

          @foreach($day_custom as $customprog)
            @if( ($customprog->type == $custom_types->type) && ($customprog->day == $i) )
          <tr> 
          <td>{{$customprog->workout_type}}</td> 
          <td>{{$customprog->workout_name}}</td> 
          <td>{{$customprog->reps}}</td> 
          <td>{{$customprog->sets}}</td> 
          <form action="rem_work" method="POST">
          {{csrf_field()}}
          <td>
          <button onclick="confirm('Are you sure you want remove this workout?')" class="btn btn-danger" type="submit" name="rem_work" value="{{$customprog -> id}}">Remove</button>
          </td>
          </form>
          </tr>
            @endif
          @endforeach
          <?php } ?>
        </table>
        <form action="/edit_work" method="GET">
          {{csrf_field()}}
            <input name="prog_identifier" hidden value="{{$custom_types -> type}}"> 
            <input name="days_identifier" hidden value="{{count($day_custom)}}">
            <div class="text-xs-right"> 
            <button class="btn btn-green" type="submit">Edit Program</button>
            </div>
          </form>
        </div>

      </div><!-- modal-content -->
    </div><!-- modal-dialog -->
  </div><!-- modal -->
 @endforeach
  
  
</div><!-- container -->