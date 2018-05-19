@extends('ManagerModule.layouts.app')
@section('content')  

    <title>Altitude Gym | Confirmation</title>
<div class="app-content content container-fluid">
      <div class="content-wrapper">
        <div class="content-header row">
    <div class="col-xl-12 col-lg-12">
         @include('ManagerModule.inc.message')

        
 <div class="card">

            <div class="card-header table-inverse">
                <h4 class="card-title"><i class="icon-ios-list-outline"></i>Confirmation</h4>
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
          <form action="/sorting_confirm" method="GET">
                {{ csrf_field() }}
                <span class="float-xs-right">
        
          <select onchange="this.form.submit()" type="text" name="sorting_confirm">
           <option value="" selected>Choose Filter: </option>
                  <option value="ASC">Ascending</option>
                  <option value="DESC">Descending</option>
                  </select>
                </span>
                </form>
        </span>
        </div>


        <form action="/search_for" method="GET">
                {{ csrf_field() }}
                  <span class="float-xs-right">
                  <input type="text" name="search_for" placeholder="Search.."></input>
                  <button type="submit" role="button" class="btn-group btn-group-xs btn-link"><span style="font-size:25px;" class="icon-ios-search-strong"></span></button>
                </span>                
        </form>


 </div>                                   
                </div>

                @include('ManagerModule.layouts.usersconfirm')
            <div class="card-body">                
                <div class="table-responsive">
                    <table id="myTable" class="tablesorter table table-hover mb-0">
                        <thead style="background-color:#D3D3D3">
                            <tr>
                                <th><i class="icon-user"></i>     Name</th>
                                <th> Details </th>
                                <th><i class="icon-calendar-check-o"></i>     Date</th>
                                <th><i class="icon-check-square-o"></i>     Request</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody class="table-hover">
                          @foreach ($point_status as $pointstat)
                          <tr>
                          <td> <span class="avatar">
                              <img src="../../uploads/avatars/{{ strtolower($pointstat -> avatar) }}" alt="{{$pointstat -> avatar}}"></img>
                              </span> {{$pointstat -> first_name}} {{$pointstat -> last_name}}</td>
                              <td>
                          Day {{$pointstat->day_identifier}} of {{$pointstat->type}} Program
                        
                        </td>

                          <td>{{$pointstat -> create}}</td>
                          <td> <button type="button" class="btn btn-success" data-toggle="modal" data-target="#confirm{{$pointstat -> iduniq}}">Accept</button></td>
                          <td> <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#decline{{$pointstat -> iduniq}}">Decline</button></td>
                           </tr>
                          @endforeach                  


                        </tbody>
                    </table>
                </div>

@foreach ($point_status as  $pointstat_conf)
                          <div id ="confirm{{$pointstat_conf -> iduniq}}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel18" aria-hidden="true">
                            <div class="modal-dialog modal-sm" role="document">
                              <div class="modal-content">
                                    <div class="modal-header bg-info white">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    
                                    <h4 class="modal-title" id="myModalLabel18"><i class="icon-question"></i> Confirmation</h4>

                                  </div>
                              
                                  <div class="modal-body">
                                <form action="/confirm_man" method="POST">
                                {{ csrf_field() }}
                                  <input type="text" name="identifier" hidden value="{{$pointstat_conf -> user_id}}">
                                  <input hidden value="{{$pointstat_conf->day_identifier}}" name="day_identifier">
                                  <p class = "text-justify">Member <b class ="success">{{$pointstat_conf -> first_name}}</b> had finished <b class ="success">Day {{$pointstat_conf -> day_identifier}}</b> of <b class ="success">{{$pointstat_conf-> type}}</b> workout! Confirmation is needed to earn points!</p>
 
                                  <div class="modal-footer">
                                  <button type="button" class="btn grey btn-outline-secondary" data-dismiss="modal">Cancel</button>
                                  <button type="submit" name="rendered" class="btn btn-info">Confirm</button>
                                </div>
                                </form>                                        
                                </div>
                              </div>
                            </div>
                          </div>
@endforeach  

@foreach ($point_status as  $pointstat3)
                          <div id ="decline{{$pointstat3 -> iduniq}}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel18" aria-hidden="true">
                            <div class="modal-dialog modal-sm" role="document">
                              <div class="modal-content">
                                    <div class="modal-header bg-danger white">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <h3 class="modal-title" id="myModalLabel18"><i class="icon-question"></i>Confirmation</h3>
                                  </div>
                              
                                  <div class="modal-body">
                                <form action="/declined" method="POST">
                                {{ csrf_field() }}
                                  <input type="text" name="identifier" hidden value="{{$pointstat3 -> user_id}}">
                                  <p class = "text-justify">Please input reason why member's request is being declined:</p>
                                  
                                  <textarea rows="5" cols="40" name="mess"></textarea>
                                  <input hidden value="{{$pointstat3->day_identifier}}" name="day_identifier">
                                  
 
                                  <div class="modal-footer">
                                  <button type="button" class="btn grey btn-outline-secondary" data-dismiss="modal">Cancel</button>
                                  <button type="submit" name="unrendered" class="btn btn-success">Confirm</button>
                                </div>
                                </form>                                        
                                </div>
                              </div>
                            </div>
                          </div>
@endforeach  

        
        </div>

 <div class="text-xs-center">
                  {{$point_status ->links()}}
                </div>
        
      </div>
              
    </div>
  </div>
 
            </div>
        </div>
    </div>
    </div>
    </div>
    </div>

@endsection