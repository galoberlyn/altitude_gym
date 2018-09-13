@extends('ManagerModule.layouts.app')
@section('content')  

<title>Altitude Gym | Notification</title>
<div class="app-content content container-fluid">
  <div class="content-wrapper">
    <div class="content-header row">
      <div class="col-xl-12 col-lg-12">
       <div class="card">

        <div class="card-header table-inverse">
          <h4 class="card-title"><i class="icon-ios-list-outline"></i>Notification</h4>
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
                <form action="/sorting_notif" method="GET">
                  {{ csrf_field() }}
                  <span class="float-xs-right">

                    <select onchange="this.form.submit()" type="text" name="sorting_notif">
                     <option value="" selected>Choose Filter: </option>
                     <option value="ASC">Ascending</option>
                     <option value="DESC">Descending</option>
                   </select>
                 </span>
               </form>
             </span>
           </div>

           <form action="/search_n" method="GET">
            {{ csrf_field() }}
            <span class="float-xs-right">
              <input type="text" name="search_for" placeholder="Search.."></input>
              <button type="submit" role="button" class="btn-group btn-group-xs btn-link"><span style="font-size:25px;" class="icon-ios-search-strong"></span></button>
            </span>                </form>

          </div>                                   
        </div>
        <div class="card-body">                
          <div class="table-responsive">
            <table id="myTable" class="tablesorter table table-hover mb-0">
              <thead style="background-color:#99FF99">
                <tr>
                  <th><i class="icon-user"></i>     Sender</th>
                  <th><i class="icon-envelope"></i>     Message</th>
                  <th><i class="icon-question-circle-o"></i>     Type</th>
                  <th><i class="icon-calendar-check-o"></i>     Date</th>
                </tr>
              </thead>
              @if(count($notif_status) > 0)
              <tbody class="table-hover">
                @foreach ($notif_status as $notifstat)
                <tr>
                  <td> <span class="avatar">
                    <img src="../../uploads/avatars/{{ strtolower($notifstat -> avatar) }}" alt="{{$notifstat -> avatar}}"></img>
                  </span> {{$notifstat -> first_name}} {{$notifstat -> last_name}}   ({{$notifstat -> user_type}})</td>
                  <td>{{$notifstat -> message}}</td>
                  <td> {{$notifstat -> notification_type}}</td>
                  <td> {{$notifstat -> created_at}}</td>
                </tr>
                @endforeach                  

              </tbody>
              @else

              <td>No available data</td>
              @endif
            </table>
          </div>

          <div class="text-xs-center">
            {{$notif_status ->links()}}
          </div>
          
        </div>
      </div>
    </div>
  </div>
</div>
</div>


@endsection