@extends('ManagerModule.layouts.app_man')
@section('content')
<title>Altitude Gym | Member Log</title>

<div class="row">
  <div class="col-xl-12 col-lg-12">
    <div class="card">
      <div class="card">
        <div class="card-header table-inverse">
          <h4 class="card-title"><i class="icon-ios-list"></i>Member Log</h4>
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
                <form action="/sorting" method="GET">
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

             <form action="/searcher" method="GET">
              {{ csrf_field() }}
              <span class="float-xs-right">
                <input type="text" name="searcher" placeholder="Search.."></input>
                <button type="submit" role="button" class="btn-group btn-group-xs btn-link"><span style="font-size:25px;" class="icon-ios-search-strong"></span></button>
              </span>
            </form>
          </div>                                   
        </div>
        <div class="table-responsive">

          <table id="myTable" class="tablesorter table table-hover table-striped mb-0 ">
            <thead style="background-color:#C2DFFF">
              <tr>
                <th>Member ID    <i class="icon-profile"></i></th>
                <th>Member Name    <i class="icon-pencil2"></i></th>
                <th>Date  <i class="icon-calendar3"></i></th>
                <th>Time In    <i class="icon-clock3"></th>
                <th>Time Out    <i class="icon-clock22"></th> 
              </tr>
            </thead>
            <tbody>
              @if(count($memberSearch) > 0)
              @foreach($memberSearch as $user)
              <tr>

                <td>&nbsp;&nbsp;&nbsp;{{ $user-> id_number }} </td>
                <td> <span class="avatar"><img src="../../uploads/avatars/{{ strtolower($user -> avatar) }}" alt="{{$user -> avatar}}"></img></span>    {{ $user-> first_name}} {{ $user-> last_name}} </td>
                <td> {{ $user-> date_recorded }} </td>
                <td> {{ $user-> time_in}} </td>
                <td> {{ $user-> time_out}} </td>

                @endforeach

                @else

                <td><p class = "text-justify">No one has log in yet</p></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                @endif
              </tr>
            </tbody>
          </table>
        </div>

        <div class="text-xs-center">
          {{ $memberSearch ->links()}}
        </div>

      </div>
    </div>
  </div>
</div>

</div>

</div>
</div>
@endsection
