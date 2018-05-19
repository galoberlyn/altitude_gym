


<!-- MODAL FOR Customize program -->
    <div class="modal fade   footer-to-bottom" id="customize" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="icon-cross"></i></button>
                      <h2 class="modal-title text-xs-center">Creating Programs for {{session('program_name')}}</h2>

                </div>
                <div class="modal-body">
                  <!-- big tabs nalang -->
                <h3 class="teal text-xs-center"> Available Workouts </h3>

                <ul class="nav nav-tabs" role="tablist">
                  <?php for($i=1; $i<=session('num_days'); $i++) { ?>
                  <li class="nav-item">
                    <a class="nav-link {{$i == 1 ? 'active' : '' }}" href="#day_cust{{$i}}" role="tab" data-toggle="tab">Day {{$i}}</a>
                  </li>
                  <?php } ?>
                </ul>

                <form action="/programs_add" method="POST" onsubmit="return confirm('Are you sure about the program?');">
                  {{csrf_field()}}
                <div class="tab-content">
                <?php for($i=1; $i<=session('num_days'); $i++){ ?>
                  <div role="tabpanel" class="tab-pane fade in {{ $i == 1 ? 'active' : ''}}" id="day_cust{{$i}}">
                  
                        <table class="table table-striped">                                        
                          <tr>
                             
                           <th>Muscle Group</th> 
                           <th>Workout Name</th> 
                           <th>Sets</th> 
                           <th>Reps</th> 
                          </tr> 
                  @foreach($all_programs as $all_custom)

                            


                          <tr> 
                    
                          <td>
                            <input type="checkbox" class="check_custom" name="customize_program_name[]" value="{{$all_custom->workout_name}}" 
                            onclick="twin()">

                            <input hidden type="checkbox" class="check_custom1" name="customize_program_day[] " value="{{$i}}">
                            <input hidden type="checkbox" class="check_custom2" name="customize_program_type[]" value="{{$all_custom->workout_type}}">
                            <input hidden type="checkbox" class="check_custom4" name="customize_program_sets[] " value="{{$all_custom->sets}}">
                            <input hidden type="checkbox" class="check_custom3" name="customize_program_reps[] " value="{{$all_custom->reps}}">


                            {{$all_custom->workout_type}}</td>
                          <td>{{$all_custom->workout_name}}</td> 
                          <td>{{$all_custom->sets}}</td> 
                          <td>{{$all_custom->reps}}</td> 

                          </tr>

                  @endforeach
                        </table>
                  </div>

                <?php } ?>


                <div class="text-xs-center">
                  <input hidden value="{{session('program_name')}}" name="program_name">
                  <input type="submit" class="btn btn-danger">
                </div>
                </div>
                </form>

               
                    <!-- end -->
                </div>
                <div class="modal-footer">
   
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>