@extends('ManagerModule.layouts.app_man')
@section('content')
<title>Altitude Gym | Expiring Membership</title>

<div class="row">
  <div class="col-xl-12 col-lg-12">
    <section id="collapsible">

      <div class="row"> 
        <div class="card-header table-inverse">
          <h4 class="card-title"></i>Expiring Memberships for the Week</h4>
          <a class="heading-elements-toggle"><i class="icon-ellipsis font-medium-3"></i></a>
        </div>
      </div>

      <div class="row">
        <div class="col-xs-12 mt-1">
          <div class="card">

            <div id="headingCollapse1"  class="card-header">

              <a data-toggle="collapse" href="#collapse1" aria-expanded="false" aria-controls="collapse1" class="card-title lead collapsed">Expired Memberships</a>
            </div>
            <div id="collapse1" role="tabpanel" aria-labelledby="headingCollapse1" class="card-collapse collapse in" aria-expanded="false">
              <div class="card-body">
                <div class="card-block">
                 <table class="table table-hover">
                  <thead style="background-color:#CC9966">
                    <tr>
                      <th>Member ID     <i class="icon-pencil2"></i></th>
                      <th>Member     <i class="icon-pencil"></i></th>
                      <th>Amount     <i class="icon-money"></i></th>
                      <th>Status     <i class="icon-briefcase2"></th>
                      <th>Expiration Date     <i class="icon-cross"></i></th>
                    </tr>
                  </thead>
                  @if(count($exp_mem) > 0)
                  <tbody>
                    @foreach($exp_mem as $exp_mbr)

                    <tr>

                      <td>&nbsp;&nbsp;&nbsp; {{ $exp_mbr-> id_number}} </td>
                      <td><span class="avatar"><img src="../../uploads/avatars/{{ strtolower($exp_mbr -> avatar) }}" alt="{{$exp_mbr -> avatar}}"></span> {{ $exp_mbr-> first_name}} {{ $exp_mbr-> last_name}} </td>
                      <td>&nbsp;&nbsp;&nbsp;&nbsp; {{ $exp_mbr-> amount}} </td>
                      <td> {{ $exp_mbr-> status}} </td>
                      <td> {{ $exp_mbr-> expiration_date}} </td>

                    </tr>

                    @endforeach

                  </tbody>
                  @else

                  <td>No available data</td>

                  @endif  
                </table>
              </div>
            </div>

            <div class="text-xs-center">
              {{ $exp_mem ->links()}}
            </div>
          </div>

          <div id="headingCollapse2"  class="card-header">

            <a data-toggle="collapse" href="#collapse2" aria-expanded="false" aria-controls="collapse2" class="card-title lead collapsed">{{date('F j,Y')}}</a>
          </div>
          <div id="collapse2" role="tabpanel" aria-labelledby="headingCollapse2" class="card-collapse collapse" aria-expanded="false">
            <div class="card-body">
              <div class="card-block">
               <table class="table table-hover">
                <thead style="background-color:#CC9966">
                  <tr>
                    <th>Member ID     <i class="icon-pencil2"></i></th>
                    <th>Member     <i class="icon-pencil"></i></th>
                    <th>Amount     <i class="icon-money"></i></th>
                    <th>Status     <i class="icon-briefcase2"></th>
                  </tr>
                </thead>
                @if(count($cur_exp) > 0)
                <tbody>
                 @foreach($cur_exp as $payment)
                 <tr>

                  <td>&nbsp;&nbsp;&nbsp; {{ $payment-> id_number}} </td>
                  <td><span class="avatar"><img src="../../uploads/avatars/{{ strtolower($payment -> avatar) }}" alt="{{$payment -> avatar}}"></span> {{ $payment-> first_name}} {{ $payment-> last_name}} </td>
                  <td>&nbsp;&nbsp;&nbsp;&nbsp; {{ $payment-> amount}} </td>
                  <td> {{ $payment-> status}} </td>

                </tr>
                @endforeach        

              </tbody> 
              @else

              <td>No available data</td>
              @endif  
            </table>
          </div>
        </div>      
        <div class="text-xs-center">
          {{ $cur_exp ->links()}}
        </div>
      </div>

      <div id="headingCollapse3"  class="card-header">
        <a data-toggle="collapse" href="#collapse3" aria-expanded="false" aria-controls="collapse3" class="card-title lead collapsed"> {{ date('F j,Y', strtotime($expmem)) }}</a>
      </div>
      <div id="collapse3" role="tabpanel" aria-labelledby="headingCollapse3" class="card-collapse collapse" aria-expanded="false">
        <div class="card-body">
          <div class="card-block">
            <table class="table table-hover">
              <thead style="background-color:#CC9966">
                <tr>
                  <th>Member ID     <i class="icon-pencil2"></i></th>
                  <th>Member     <i class="icon-pencil"></i></th>
                  <th>Amount     <i class="icon-money"></i></th>
                  <th>Status     <i class="icon-briefcase2"></th>
                </tr>
              </thead>
              @if(count($expiring) > 0)
              <tbody>
               @foreach($expiring as $expire)

               <tr>

                <td>&nbsp;&nbsp;&nbsp; {{ $expire-> id_number}} </td>
                <td><span class="avatar"><img src="../../uploads/avatars/{{ strtolower($expire -> avatar) }}" alt="{{$expire -> avatar}}"></span> {{ $expire-> first_name}} {{ $expire-> last_name}} </td>
                <td>&nbsp;&nbsp;&nbsp;&nbsp; {{ $expire-> amount}} </td>
                <td> {{ $expire-> status}} </td>
                {{Form::close()}}

              </tr>


              @endforeach
            </tbody>
            @else

            <td>No available data</td>

            @endif  
          </table>
        </div>
      </div>

      <div class="text-xs-center">
        {{ $expiring ->links()}}
      </div>
    </div>

    <div id="headingCollapse4"  class="card-header">
      <a data-toggle="collapse" href="#collapse4" aria-expanded="false" aria-controls="collapse4" class="card-title lead collapsed">{{ date('F j,Y', strtotime($expmem1)) }}</a>
    </div>
    <div id="collapse4" role="tabpanel" aria-labelledby="headingCollapse4" class="card-collapse collapse" aria-expanded="false" style="height: 0px;">
      <div class="card-body">
        <div class="card-block">
          <table class="table table-hover">
           <thead style="background-color:#CC9966">
            <tr>
              <th>Member ID     <i class="icon-pencil2"></i></th>
              <th>Member     <i class="icon-pencil"></i></th>
              <th>Amount     <i class="icon-money"></i></th>
              <th>Status     <i class="icon-briefcase2"></th>
            </tr>
          </thead>
          @if(count($expired) > 0)
          <tbody>
           @foreach($expired as $expire_1)

           <tr>

            <td>&nbsp;&nbsp;&nbsp; {{ $expire_1-> id_number}} </td>
            <td><span class="avatar"><img src="../../uploads/avatars/{{ strtolower($expire_1 -> avatar) }}" alt="{{$expire_1 -> avatar}}"></span> {{ $expire_1-> first_name}} {{ $expire_1-> last_name}} </td>
            <td>&nbsp;&nbsp;&nbsp;&nbsp; {{ $expire_1-> amount}} </td>
            <td> {{ $expire_1-> status}} </td>
            {{Form::close()}}

          </tr>

          @endforeach
        </tbody>
        @else

        <td>No available data</td>
        @endif  
      </table>
    </div>
  </div>       
  <div class="text-xs-center">
    {{ $expired ->links()}}
  </div>
</div>

<div id="headingCollapse5"  class="card-header">
  <a data-toggle="collapse" href="#collapse5" aria-expanded="false" aria-controls="collapse5" class="card-title lead collapsed"> {{ date('F j,Y', strtotime($expmem2)) }}</a>
</div>
<div id="collapse5" role="tabpanel" aria-labelledby="headingCollapse5" class="card-collapse collapse" aria-expanded="false">
  <div class="card-body">
    <div class="card-block">
      <table class="table table-hover">
        <thead style="background-color:#CC9966">
          <tr>
            <th>Member ID     <i class="icon-pencil2"></i></th>
            <th>Member     <i class="icon-pencil"></i></th>
            <th>Amount     <i class="icon-money"></i></th>
            <th>Status     <i class="icon-briefcase2"></th>
          </tr>
        </thead>
        @if(count($exp) > 0)
        <tbody>
         @foreach($exp as $expire_2)

         <tr>

           <td>&nbsp;&nbsp;&nbsp; {{ $expire_2-> id_number}} </td>
           <td><span class="avatar"><img src="../../uploads/avatars/{{ strtolower($expire_2 -> avatar) }}" alt="{{$expire_2 -> avatar}}"></span> {{ $expire_2-> first_name}} {{ $expire_2-> last_name}} </td>
           <td>&nbsp;&nbsp;&nbsp;&nbsp; {{ $expire_2-> amount}} </td>
           <td> {{ $expire_2-> status}} </td>
           {{Form::close()}}

         </tr>


         @endforeach
       </tbody>
       @else

       <td>No available data</td>

       @endif  
     </table>
   </div>
 </div>

 <div class="text-xs-center">
  {{ $exp ->links()}}
</div>
</div>

<div id="headingCollapse6"  class="card-header">
  <a data-toggle="collapse" href="#collapse6" aria-expanded="false" aria-controls="collapse6" class="card-title lead collapsed">{{ date('F j,Y', strtotime($expmem3)) }}</a>
</div>
<div id="collapse6" role="tabpanel" aria-labelledby="headingCollapse6" class="card-collapse collapse" aria-expanded="false" style="height: 0px;">
  <div class="card-body">
    <div class="card-block">
      <table class="table table-hover">
       <thead style="background-color:#CC9966">
        <tr>
          <th>Member ID     <i class="icon-pencil2"></i></th>
          <th>Member     <i class="icon-pencil"></i></th>
          <th>Amount     <i class="icon-money"></i></th>
          <th>Status     <i class="icon-briefcase2"></th>
        </tr>
      </thead>
      @if(count($expired1) > 0)
      <tbody>
       @foreach($expired1 as $expire_3)

       <tr>

        <td>&nbsp;&nbsp;&nbsp; {{ $expire_3-> id_number}} </td>
        <td><span class="avatar"><img src="../../uploads/avatars/{{ strtolower($expire_3 -> avatar) }}" alt="{{$expire_3 -> avatar}}"></span> {{ $expire_3-> first_name}} {{ $expire_3-> last_name}} </td>
        <td>&nbsp;&nbsp;&nbsp;&nbsp; {{ $expire_3-> amount}} </td>
        <td> {{ $expire_3-> status}} </td>
        {{Form::close()}}

      </tr>

      @endforeach
    </tbody>
    @else

    <td>No available data</td>
    @endif  
  </table>
</div>
</div>       
<div class="text-xs-center">
  {{ $expired1 ->links()}}
</div>
</div>

<div id="headingCollapse7"  class="card-header">
  <a data-toggle="collapse" href="#collapse7" aria-expanded="false" aria-controls="collapse7" class="card-title lead collapsed">{{ date('F j,Y', strtotime($expmem4)) }}</a>
</div>
<div id="collapse7" role="tabpanel" aria-labelledby="headingCollapse7" class="card-collapse collapse" aria-expanded="false" style="height: 0px;">
  <div class="card-body">
    <div class="card-block">
      <table class="table table-hover">
       <thead style="background-color:#CC9966">
        <tr>
          <th>Member ID     <i class="icon-pencil2"></i></th>
          <th>Member     <i class="icon-pencil"></i></th>
          <th>Amount     <i class="icon-money"></i></th>
          <th>Status     <i class="icon-briefcase2"></th>
        </tr>
      </thead>
      @if(count($expired2) > 0)
      <tbody>
       @foreach($expired2 as $expire_4)

       <tr>

        <td>&nbsp;&nbsp;&nbsp; {{ $expire_4-> id_number}} </td>
        <td><span class="avatar"><img src="../../uploads/avatars/{{ strtolower($expire_4 -> avatar) }}" alt="{{$expire_4 -> avatar}}"></span> {{ $expire_4-> first_name}} {{ $expire_4-> last_name}} </td>
        <td>&nbsp;&nbsp;&nbsp;&nbsp; {{ $expire_4-> amount}} </td>
        <td> {{ $expire_4-> status}} </td>
        {{Form::close()}}

      </tr>

      @endforeach
    </tbody>
    @else

    <td>No available data</td>

    @endif  
  </table>
</div>
</div>   

<div class="text-xs-center">
  {{ $expired2 ->links()}}
</div>
</div>

<div id="headingCollapse8"  class="card-header">
  <a data-toggle="collapse" href="#collapse8" aria-expanded="false" aria-controls="collapse8" class="card-title lead collapsed">{{ date('F j,Y', strtotime($expmem5)) }}</a>
</div>
<div id="collapse8" role="tabpanel" aria-labelledby="headingCollapse8" class="card-collapse collapse" aria-expanded="false" style="height: 0px;">
  <div class="card-body">
    <div class="card-block">
      <table class="table table-hover">
       <thead style="background-color:#CC9966">
        <tr>
          <th>Member ID     <i class="icon-pencil2"></i></th>
          <th>Member     <i class="icon-pencil"></i></th>
          <th>Amount     <i class="icon-money"></i></th>
          <th>Status     <i class="icon-briefcase2"></th>
        </tr>
      </thead>
      @if(count($expired3) > 0)
      <tbody>
       @foreach($expired3 as $expire_5)

       <tr>

        <td>&nbsp;&nbsp;&nbsp; {{ $expire_5-> id_number}} </td>
        <td><span class="avatar"><img src="../../uploads/avatars/{{ strtolower($expire_5 -> avatar) }}" alt="{{$expire_5 -> avatar}}"></span> {{ $expire_5-> first_name}} {{ $expire_5-> last_name}} </td>
        <td>&nbsp;&nbsp;&nbsp;&nbsp; {{ $expire_5-> amount}} </td>
        <td> {{ $expire_5-> status}} </td>
        {{Form::close()}}

      </tr>

      @endforeach
    </tbody>
    @else

    <td>No available data</td>

    @endif  
  </table>
</div>
</div>       
<div class="text-xs-center">
  {{ $expired3 ->links()}}
</div>
</div>

</div>
</div>
</div>
</section>
</div>
</div>

@endsection