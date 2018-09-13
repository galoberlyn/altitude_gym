@extends('ManagerModule.layouts.app')
@section('content')
<title>Altitude Gym | Assign Badge</title>

<!--/ Member Table -->
<div class="row">
  <div class="app-content content container-fluid">
    <div class="content-wrapper">
      <div class="content-header row">
        <div class="col-xl-12 col-lg-12">
         @include('ManagerModule.inc.message')

         <div class="card">
          <div class="card">
            <div class="card-header table-inverse">
              <h4 class="card-title"><i class="icon-shield"></i>     Assign Badge</h4>
              <a class="heading-elements-toggle"><i class="icon-ellipsis font-medium-3"></i></a>
              <div class="heading-elements">
                <ul class="list-inline mb-0">
                  <li><a data-action="expand"><i class="icon-expand2"></i></a></li>
                </ul>
              </div>
            </div>
            <div class="card-body">
              <div class="card-block">


                <div class="dropdown">
                  <span class="float-xs-left">
                    <form action="/sort_badge/{{$badge_id}}" method="GET">
                      {{ csrf_field() }}
                      <span class="float-xs-right">

                        <select onchange="this.form.submit()" type="text" name="sorting">
                         <option value="" selected>Choose Filter: </option>
                         <option value="ASC">Ascending</option>
                         <option value="DESC">Descending</option>
                       </select>
                     </span>
                   </form>
                 </span>

                 <form action="/search_b/{{$badge_id}}" method="GET">
                  {{ csrf_field() }}

                  <span class="float-xs-right">
                    <input type="text" name="search_b" placeholder="Search.."></input>
                    <button type="submit" role="button" class="btn-group btn-group-xs btn-link"><span style="font-size:25px;" class="icon-ios-search-strong"></span></button>
                  </span>
                </form>
              </div>                                   
            </div>
            <div class="table-responsive">

              <table id="myTable" class="tablesorter table table-hover table-striped mb-0">
                <thead style="background-color:#9999FF">
                  <tr>
                    <th>Member ID    <i class="icon-profile"></i></th>
                    <th>Member Name    <i class="icon-pencil2"></i></th>
                    <th>Earned Badges     <i class="icon-star"></i></th>
                    <th>Assign to User  <i class="icon-edit"></i></th>
                  </tr>
                </thead>
                @if(count($memberSearch) > 0)
                <tbody>
                  @foreach($memberSearch as $user)
                  <tr>


                    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ $user-> user_id }} </td>
                    <td> <span class="avatar"><img src="../../uploads/avatars/{{ strtolower($user -> avatar) }}" alt="{{$user -> avatar}}"></img></span>    {{ $user-> first_name}} {{ $user-> last_name}} </td>


                    <td> <button type="button" class="btn btn-outline-secondary" data-toggle="modal" data-target=".viewbadge{{$user -> user_id}}">View</button> </td>

                    <td> <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".assignbadge{{$user -> user_id}}">Award Badge</button></td>

                  </tr>
                  @endforeach



                </tbody>
                @else
                <td><p class = "text-justify">No available data</p></td>
                <td></td>
                <td></td>
                <td></td>

                @endif
              </table>
            </div>

            @foreach($memberSearch as $user)
            <div class="modal fade viewbadge{{$user -> user_id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel18" aria-hidden="true">
              <div class="modal-dialog modal-sm" role="document">
                <div class="modal-content">
                  <div class="modal-header bg-primary white">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel18"><i class="icon-star"></i> Earned Badges of Member</h4>
                  </div>

                  <div class="modal-body">
                    @foreach($membadge as $adm)
                    @if($adm->user_id == $user->user_id)

                    <td> <span class="avatar"><img class="img-fluid mx-auto d-block" src="../../badges/{{ strtolower($adm->badge_name) }}.png" alt="{{$adm->badge_name}}" data-toggle="tooltip" title="{{$adm->badge_name}}"></img></span></td>

                    @endif
                    @endforeach
                  </div>                                       

                </div>
              </div>
            </div>
            @endforeach

            @foreach($memberSearch as $user)
            <div class="modal fade assignbadge{{$user -> user_id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel18" aria-hidden="true">
              <div class="modal-dialog modal-sm" role="document">
                <div class="modal-content">
                  <div class="modal-header bg-primary white">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel18"><i class="icon-question"></i>Assign Badge</h4>
                  </div>


                  <form action="/assign_badge/{{$badge_id}}" method="POST">
                    {{ csrf_field() }}
                    <input type="text" name="identifier" hidden value="{{$user -> user_id}}">
                    <input type="text" name="badge" hidden value="{{$badge_id}}">

                    <p class = "text-justify">Assign <b class ="success">{{$badge_name}}</b> badge to <b class ="success">{{$user -> first_name}} {{$user -> last_name}}?</b></p>

                    <div class="modal-footer">
                      <button type="button" class="btn grey btn-outline-secondary" data-dismiss="modal">Cancel</button>

                      <button type="submit" name="assign" class="btn btn-primary">Award</button>

                    </div>
                  </form>                                        

                </div>
              </div>
            </div>
            @endforeach
            <div class="text-xs-center">
              {{ $memberSearch ->links()}}
            </div>
          </div>
        </div>
      </div>
    </div>
    
  </div>
  <!--End Member Table -->

</div>
</div>

@endsection
