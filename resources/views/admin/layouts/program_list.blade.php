 @foreach($all_programs_distinct as $types)
   

<div class="col-xl-3 col-md-6 col-sm-12">
      <div class="card">
        <div class="card-body">
          <div class="card-block text-xs-center">
            <h2 class="card-title">{{$types->type}}</h2>
            
            <a data-toggle="modal" data-target="#{{$types->type}}" class="btn btn-outline-deep-orange">View Workouts</a>
          </div>
        </div>
      </div>
    </div>


@endforeach

       
@foreach($all_programs_distinct as $progs)
<div class="modal fade" id="{{$progs->type}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title" id="exampleModalLabel">{{$progs->type}} Workouts</h2>
                
            </div>
            <div class="modal-body">
              
               <table class="table table-striped">
                <thead>
                      <th> Workout Type </th>
                      <th> Workout Name </th>
                      <th> Sets </th>
                      <th> Reps </th>
                      <th> Day </th>
                </thead>

                @foreach($all_programs as $progs2)
                @if($progs->type==$progs2->type)
                <tbody>
                      <td>{{$progs2->workout_type}}
                      <td>{{$progs2->workout_name}}</td>
                      <td>{{$progs2->sets}} </td>
                      <td>{{$progs2->reps}} </td>
                      <td>{{$progs2->day}}</td>
                </tbody>
                @endif
               @endforeach

               </table>
                
            </div>
            <div class="modal-footer">
              <form method="GET" action="/edit_work">
                {{csrf_field()}}
                <button type="submit" class="btn btn-danger btn-sm" name="prog_identifier" value="{{$progs->type}}">Edit</button>
              </form>
                <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Close</button>

            </div>
        </div>
    </div>
</div>
@endforeach