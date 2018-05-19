<!-- MODAL FOR Customize program -->
<form action="/add_workout" method="POST">
  {{csrf_field()}}
    <div class="modal fade   footer-to-bottom" id="addworkout" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="icon-cross"></i></button>
                      <h2 class="modal-title text-xs-center">Add a workout</h2>

                </div>
                <div class="modal-body"> <span class="h2"> Add Workout To: </span> 
                  <select name="workout_program">
                  @foreach($all_programs_distinct as $distinct)
                    <option value="{{$distinct->type}}">{{$distinct->type}} </option>
                  @endforeach
                  </select>
                  <!-- content -->
                   <table> 
        <tr>
          <th> Workout Type </th>
          <th> Workout Name </th>
          <th> Day </th>
          <th> Sets</th>
          <th> Reps </th>


        </tr>
        <tbody id="days_work">
        <tr id="days_tr">
          <td> <input class="form-control" type="text" name="work_type[]" required> </td>
          <td> <input class="form-control" type="text" name="work_name[]" required> </td>
          <td> <input class="form-control" type="number" min="1" maxlength="60" name="work_day[]" required> </td>
          <td> <input class="form-control" type="text" name="work_sets[]" required> </td>
          <td> <input class="form-control" type="text" min="1" maxlength="60" name="work_reps[]"> </td>
          <td> <button class="btn btn-danger" type="button" onclick="event.srcElement.parentElement.parentElement.remove();rmv_day()"> Delete Row </button> </td>
        </tr>
        </tbody>
      </table>
      <button class="btn btn-success" type="button" id="button_day" onclick="addItem_day()"> Add Row </button>
            




                <div class="text-xs-center">
  
                  <input type="submit" class="btn btn-danger">
                </div>
                </div>

               
                    <!-- end -->
                </div>
                <div class="modal-footer">
   
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
</form>