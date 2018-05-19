<!-- NOTIFICATION IF MEMBER IS NEARING EXPIRY -->
    
    @foreach($exp_date as $exp_dates)
      @if($exp_dates->exp_date <= 0 )
         <div class="isa_error">
         <i class="fa fa-error"></i>
         Your membership is already expired!
        </div>
      @elseif($exp_dates->exp_date < 4)
        <div class="isa_warning">
         <i class="fa fa-warning"></i>
         Your Membership will almost expire, don't forget to renew! :)
        </div>
      @endif
    @endforeach

    <!-- END NOTIF -->

    <!-- NOTIFICATION IF MEMBER IS NEARING EXPIRY LOCKEr -->
    @if(count($exp_date_locker) === 0)
    
    @else
    @foreach($exp_date_locker as $exp_locker)
    @endforeach
      @if($exp_locker->exp_locker <= 0 )
         <div class="isa_error">
         <i class="fa fa-error"></i>
         Your locker subscription is already expired!
        </div>
      @elseif($exp_locker->exp_locker < 4)
        <div class="isa_warning">
         <i class="fa fa-warning"></i>
         Your locker subscription will almost expire, don't forget to renew! :)
        </div>
      @endif
    @endif
    <!-- END NOTIF -->