@extends('ManagerModule.layouts.app')
@section('content')  
<title>Altitude Gym | Gamification Policies</title>

<div class="app-content content container-fluid">
  <div class="content-wrapper">
    <div class="content-header row">
    </div>
    <div class="content-body"><!-- stats -->
       <div class="row">
           <div class="col-md">
            <!--ard-->
            <!-- Card -->
            <div class="card card-image" style="background-image: url(../../memimg/frame.png)">

                <div class="col-sm" style="margin-top: 140px; margin-left: 100px; margin-right: 60px;">
                    <center><h1>Gamification Policies</h1></center>
                    @foreach ($gamepoli as $game)

                    <ul>         
                        <li><h5>{!! nl2br(e($game->policy_description)) !!}</h5></li>

                    </ul>
                    @endforeach  

                </div>
                <div class="col-sm" style="margin-top: 30px; margin-left: 100px; margin-right: 100px;">
                    <div class="card">
                        <table class="table table-hover mb-0">
                            <thead class="bg-teal bg-lighten-4">
                                <tr>

                                    <th>Base Point</th>
                                    <th>Category</th>
                                    <th>Level</th> 
                                                                      
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($points as $pts)
                                <tr>

                                    <td>{{$pts->base_point}}</td>
                                    <td>{{$pts->category}} </td>
                                    <td>{{$pts->level}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>

                <!-- Content -->
            </div>
            <!-- Card -->
        </div>

    </div>

    <!-- ////////////////////////////////////////////////////////////////////////////-->
    <!--/ End Safety -->

</div>
</div>
</div>

@endsection