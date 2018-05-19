<!DOCTYPE html>
<html>
<head>
    @include('admin.layouts.css_links')
</head>
<body data-open="click" data-menu="vertical-menu" data-col="2-columns" class="vertical-layout vertical-menu 2-columns  fixed-navbar">

    <!-- navbar-fixed-top-->
    @include('admin.layouts.nav')
    <!-- ////////////////////////////////////////////////////////////////////////////-->
    <!-- main menu-->
    @include('admin.layouts.main_menu')
    <!-- / main menu-->
<div class="app-content content container-fluid">
    <div class="content-wrapper">
        <div class="content-body">
            <div class="form-group row">
                <h1>Edit {{$prog_identifier}} Program</h1>

                <form action="/edit_workout" method="POST">
                <input name="day_prog" hidden value="{{$days_identifier}}"> 
                {{csrf_field()}}
                <input name="name_prog" hidden value="{{$prog_identifier}}"> 
                <table class="table table-striped">                                         
                      <tr> 
                        <th>Workout Type</th>
                        <th>Workout Name</th> 
                        <th>Reps</th> 
                        <th>Sets</th>
                        <th>Day</th>  

                      </tr> 
                @foreach ($edit_prog as $edit_progs)
                    <tr>
                    <td><input class="col-6 form-control" type="text" name="edit_type[]" value="{{$edit_progs -> workout_type}}"><input name="id_prog[]" hidden value="{{$edit_progs -> id}}"></td>
                    <td><input class="col-6 form-control" type="text" name="edit_name[]" value="{{$edit_progs -> workout_name}}"></td>
                    <td><input class="col-6 form-control" type="text" name="edit_reps[]" value="{{$edit_progs -> reps}}"></td>
                    <td><input class="col-6 form-control" type="text" name="edit_sets[]" value="{{$edit_progs -> sets}}"></td>
                    <td><input class="col-6 form-control" type="text" name="edit_day[]" value="{{$edit_progs -> day}}"></td>
                    </tr>
                @endforeach
                    </table>
                    <div class="float-xs-right">
                    <button onclick="alert('Workout/s Saved!')" class="btn btn-primary" type="submit">Save</button>
                    </div>
                </form>

                @include('admin.layouts.scripts')    
            </div>
        </div>
    </div>
</div>
</body>
</html>