@extends('ManagerModule.layouts.app')
@section('content')  

<title>Altitude Gym | Add Badge</title>
<div class="app-content content container-fluid">
  <div class="content-wrapper">
    <div class="row">
      <div class="col-xl-12 col-lg-12">
        @include('ManagerModule.inc.message')
        <div class="card">
          <div class="card-block">
            <div class="media">
              <div class="media-body green text-xs-left">
                <h3 class="green">Badges</h3>
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".badge-modal-sm">Add Badge</button>
              </div>
              <div class="media-right media-middle">
                <i class="icon-shield font-large-3 float-xs-right"></i>
              </div>
            </div>
          </div>
        </div>

        <div class="row match-height">
          @foreach ($badges as $badge)
          @if($badge->status == 'active')
          <div class="col-xl-3 col-md-3 col-sm-12">
            <div class="card">
              <div class="card-body">
                <div class="card-block">
                  <h4 class="card-title cyan text-xs-center" style = 'text-transform:uppercase'>{{$badge->badge_name}}</h4>
                  {!! Form::open ([ 'action' => 'BadgeController@disable_m' , 'method' => 'POST']) !!}
                  {!! Form::text('badge_id', $badge->id, ['class' => 'hidden']) !!}
                  {!! Form::submit('Disable', ['class'=>'btn btn-danger float-xs-right']) !!}
                  {!! Form::close() !!} 
                  <button type="button" class="btn btn-secondary"> <a href="/assignBadge/{{$badge->id}}">Award</a></button>
                </div>
                <img class="img-fluid mx-auto d-block" src="../badges/{{ strtolower($badge->badge_name) }}.png" alt="{{$badge->badge_name}}" height="150" width= "159"></img>
                <div class="card-block">
                  <h5 class="card-text orange">{{$badge->badge_description}}.</h5>
                </div>
              </div>
            </div>
          </div>
          @else
          <div class="col-xl-3 col-md-3 col-sm-12">
            <div class="card bg-grey bg-lighten-2">
              <div class="card-body">
                <div class="card-block">
                  <h4 class="card-title blue-grey text-xs-center">{{$badge->badge_name}}</h4>
                  {!! Form::open ([ 'action' => 'BadgeController@enable_m' , 'method' => 'POST']) !!}
                  {!! Form::text('badge_id', $badge->id, ['class' => 'hidden']) !!}
                  {!! Form::submit('Enable', ['class'=>'btn btn-danger float-xs-right']) !!}
                  {!! Form::close() !!} 
                  <button type="button" class="btn btn-grey disabled"> <a href="/assignBadge/{{$badge->id}}">Award</a></button>
                </div>
                <img class="img-fluid mx-auto d-block" src="../badges/{{ strtolower($badge->badge_name) }}.png" alt="{{$badge->badge_name}}" height="150" width= "159" style="filter: grayscale(100%);"></img>
                <div class="card-block">
                  <h5 class="card-text blue-grey">{{$badge->badge_description}}.</h5>
                </div>
              </div>
            </div>
          </div>
          @endif
          @endforeach 
          
          <!--/ stats -->
          <!--/ project charts -->
        </div>
      </div>

      <div class="text-xs-center">
        {{$badges ->links()}}
      </div>
      <!--/ project charts -->
      <!-- Recent invoice with Statistics -->


      <div class="modal fade badge-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm">
          <div class="modal-content">
           {!! Form::open ([ 'action' => 'BadgeController@store', 'method' => 'POST', 'files' => true]) !!}
           <div class="modal-header"> Add Badge
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          </div>
          <div class="modal-body">
            <form>
              <div class="form-group">
                {!! Form::label('badge_name', 'Badge Name') !!}
                {!! Form::text('badge_name', '', ['class' => 'form-control', 'placeholder' => '', 'style' => 'text-transform:uppercase']) !!}
                <small id="emailHelp" class="form-text text-muted">Please input words with spaces for every word. Ex: MISTER INCREDIBLE</small>
              </div>
              <div class="form-group">
                {!! Form::label('badge_description', 'Badge Description') !!}
                {!! Form::textarea('badge_description', '', ['class' => 'form-control', 'rows' => '4']) !!}
              </div>
              <div class="form-group">
                {!! Form::label('image', 'File Input') !!}
                {!! Form::file('image', ['class' => 'form-control-file', 'aria-describedby'=>'fileHelp']) !!}
                <small id="fileHelp" class="form-text text-muted">Choose an image for your badge with a '.png' file extension</small>
              </div>
              
              <div class="modal-footer">
               {!! Form::submit('Save', ['class'=>'btn btn-primary']) !!}
             </div>
           </form> 
         </div>
         {!! Form::close() !!} 
       </div>
     </div>
   </div>

 </div>
</div>

</div>
</div>

@endsection