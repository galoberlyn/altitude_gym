<div class="row">
    <div class="col-xl-3 col-lg-6 col-xs-12">
        <div class="card">
            <div class="card-body">
                <div class="card-block">
                    <div class="media">
                    
                        <div class="media-body text-xs-left">
            
                        <h3 class="pink" >@if(count($exp_date)==0)
            {{"0"}}
            @else
                        @foreach($exp_date as $exp_dates)
            {{$exp_dates -> expi}}
                        @endforeach
            @endif</h3>
                            <span>Expiring Memberships</span>
                        </div>
                   
                        <div class="media-right media-middle">
                             <i class="icon-bag2 pink font-large-1 float-xs-right"></i>
                        </div>
                    </div>
 
                </div>
            </div>
        </div>
    </div>

    @foreach ($mems as $mem)
    <div class="col-xl-3 col-lg-6 col-xs-12">
        <div class="card">
            <div class="card-body">
                <div class="card-block">
                    <div class="media">
                        <div class="media-body text-xs-left">
                            <h3 class="teal">{{$mem -> status}}</h3>
                            <span>Members</span>
                        </div>
                        <div class="media-right media-middle">
                            <i class="icon-user1 teal font-large-2 float-xs-right"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
          @foreach ($active_members as $active_member)
    </div>
    <div class="col-xl-3 col-lg-6 col-xs-12">
        <div class="card">
            <div class="card-body">
                <div class="card-block">
                    <div class="media">
                        <div class="media-body text-xs-left">
                            <h3 class="deep-orange">{{$active_member -> status}}</h3>
                            <span>Active Members</span>
                        </div>
                        <div class="media-right media-middle">
                            <i class="icon-diagram deep-orange font-large-2 float-xs-right"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach
    <div class="col-xl-3 col-lg-6 col-xs-12">
        <div class="card">
            <div class="card-body">
                <div class="card-block">
                    <div class="media">
                        <div class="media-body text-xs-left">
                            <h3 class="cyan">
                            {{ date('M d, Y') }}</h3>
                            <span>Date</span>
                        </div>
                        <div class="media-right media-middle">
                            <i class="icon-ios-help-outline cyan font-large-2 float-xs-right"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('admin.inc.message')
