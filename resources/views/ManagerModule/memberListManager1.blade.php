
@extends('ManagerModule.layouts.app_man')
@section('content')  

<title>Altitude Gym | Member List</title>

<div class="row">
  <div class="col-xl-12 col-lg-12">
    @include('ManagerModule.inc.message')
    <div class="card">
      <div class="card">
        <div class="card-header table-inverse">
          <h4 class="card-title"><i class="icon-ios-list-outline"></i>Member List</h4>

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
                <form action="/sorting_m" method="GET">
                  {{ csrf_field() }}
                    <select onchange="this.form.submit()" type="text" name="sorting_m">
                     <option value="" selected>Choose Filter: </option>
                     <option value="ASC">Ascending</option>
                     <option value="DESC">Descending</option>
                   </select>
               </form>
             </span>
          </div>

             <form action="/searching" method="GET">
              {{ csrf_field() }}
              <span class="float-xs-right">
                <button type="button" class="btn btn-primary float-xs-left" data-toggle="modal" data-target=".addlocker" style="margin-right: 25px;"><b>Add Locker</b></button>
                <input type="text" name="searching" placeholder="Search.."></input>
                <button type="submit" role="button" class="btn-group btn-group-xs btn-link"><span style="font-size:25px;" class="icon-ios-search-strong"></span></button>
              </span>                </form>
            </div>                                   
          </div>
          <div class="card-body">                
            <div class="table-responsive">
              <table id="myTable" class="tablesorter table table-hover mb-0">
                <thead style="background-color:#D3D3D3">
                  <tr>
                    <th style="width: 150px;">Member Name</th>
                    <th>Username</th>
                    <th>Member Subscription</th>
                    <th>Status</th>
                    <th>Locker Number</th> 
                    <th>Assign Locker</th>
                    <th>Unassign Locker</th> 
                  </tr>
                </thead>
                @if(count($memberSearch) > 0)
                <tbody class="table-hover">
                  @foreach ($memberSearch as $members)
                  <form action="/members_m" method="POST">
                    {{ csrf_field() }}
                    <tr>
                      <td> <span class="avatar">
                        <img src="../../uploads/avatars/{{ strtolower($members -> avatar) }}" alt="{{$members -> avatar}}"></img>
                      </span>   {!! $members -> first_name." ".$members -> last_name !!}</td>
                      <td>{{$members -> username}}</td>
                      <td class="text-truncate">{{$members -> subscription}}</td>
                      <td>{{$members -> status}}</td>
                      <td><i id = "locker">
                        {{$members -> locker_number}}
                      </td>

                      @if( $members -> locker_number == null )

                      <td><button type="button" class="btn btn-primary" data-toggle="modal" data-target=".assignlocker{{$members -> user_id}}">Assign Locker</button></td>

                      <td><button onclick="return confirm('Unassign locker {{$members -> locker_number}} to {{$members -> first_name}}?')" type="submit" name="available" class="btn btn-danger disabled" value="{{$members -> user_id}}">Remove</button></td>

                      @else

                      <td><button type="button" class="btn btn-primary disabled" data-toggle="modal" data-target=".assignlocker{{$members -> user_id}}">Assign Locker</button></td>

                      
                      <td><button onclick="return confirm('Unassign locker {{$members -> locker_number}} to {{$members -> first_name}}?')" type="submit" name="available" class="btn btn-danger" value="{{$members -> user_id}}">Remove</button></td>

                      @endif
                      
                      </form>

                    </tr>                          

                    <div class="modal fade assignlocker{{$members -> user_id}}" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                      <div class="modal-dialog1 modal-dialog1">
                        <div class="modal-content">
                          <div class="modal-header">

                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                           
                            <h4 class="modal-title">Assign Locker</h4>

                          </div>

                          <div class="row">

                            @foreach($manager_distinct as $distinct)
                            <div class="col-md-6" style="margin-left: -0.6%;">

                             <h1 style="margin-left: 15px;">{{$distinct->locker_set}}</h1>

                             @foreach ($managerLocker as $mem)
                             @if(strpos($mem->locker_number, $distinct->locker_set) === 0)
                             <div class="col-sm-2" style="margin-bottom: 5px;">
                               <form action="/members_man" method="POST">
                                {{ csrf_field() }}

                                @if ($mem -> status == 'unavailable')

                                <a href="#" class="btn btn-sq btn-danger disabled">
                                  <i class="icon-lock"></i></i><br/>
                                  {{$mem -> locker_number}}<br>
                                  {{$mem -> first_name}}{{$mem -> last_name}}<br><br>
                                  <span class="avatar">
                                    <img src="../../uploads/avatars/{{ strtolower($mem -> avatar) }}" alt="{{$mem -> avatar}}"></img>
                                  </span>

                                </a>

                                @else

                                <button onclick="return confirm('Assign locker {{$mem -> locker_number}} to {{$members -> first_name}}?')"  class="btn btn-sq btn-success" type="submit" name="assign">
                                  <i class="icon-unlock-alt"></i><br/>
                                  <input name="identifier" id="identifier" hidden value="{{$members -> user_id}}"> 
                                  <input name="lockers" id="lockers" hidden value="{{$mem -> locker_number}}">{{$mem -> locker_number}}

                                </button>

                                @endif
                              </form> 
                            </div> 
                            @endif

                            @endforeach
                          </div>
                          @endforeach

                        </div>

                      </div>                              
                      @endforeach

                    </div>
                  </div>

                  <div class="modal fade addlocker" tabindex="-1" role="dialog" aria-labelledby="myModalLabel18" aria-hidden="true">
                    <div class="modal-dialog modal-sm" role="document">
                      <div class="modal-content">
                        <div class="modal-header bg-warning white">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                          <h3 class="modal-title" id="myModalLabel18"><i class="icon-question"></i>Add Locker</h3>
                        </div>
                        <form action="/add_lock" method="POST">
                          {{ csrf_field() }} 
                          <p class = "text-justify">*maximum lockers per set is 30</p>
                          <center>
                            <b class ="warning">Set:</b> <br><input type="text" name="set"><br>
                            <p>ex. E</p>

                            <b class ="warning">Number of lockers:</b> <br><input type="text" name="lock_num"><br>
                            <p>ex. 30</p>
                          </center>
                          <div class="modal-footer">
                            <button type="button" class="btn grey btn-outline-secondary" data-dismiss="modal">Cancel</button>
                            <button type="submit" name="addlock" class="btn btn-warning">Add</button>
                          </div>
                        </form>                                        

                      </div>
                    </div>
                  </div>  

                </tbody>
                @else

                <td style="width: 200px;"><p class = "text-justify">No available data</p></td>
                @endif
              </table>
            </div>
            <div class="text-xs-center">
              {{$memberSearch ->links()}}
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>
</div>

@endsection