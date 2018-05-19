<!-- navbar-fixed-top-->
    <nav class="header-navbar navbar navbar-with-menu navbar-fixed-top navbar-semi-dark navbar-shadow">
      <div class="navbar-wrapper">
        <div class="navbar-header">
          <ul class="nav navbar-nav">
            <li class="nav-item mobile-menu hidden-md-up float-xs-left"><a class="nav-link nav-menu-main menu-toggle hidden-xs"><i class="icon-menu5 font-large-1"></i></a></li>
            <li class="nav-item"><a href="/dashboard" class="navbar-brand nav-link"><img alt="branding logo" src="/memimg/altilogo.png" data-expand="/memimg/altilogo.png" data-collapse="/memimg/Altismall.png" class="brand-logo"></a></li>
            <li class="nav-item hidden-md-up float-xs-right"><a data-toggle="collapse" data-target="#navbar-mobile" class="nav-link open-navbar-container"><i class="icon-ellipsis pe-2x icon-icon-rotate-right-right"></i></a></li>
          </ul>
        </div>
        <div class="navbar-container content container-fluid">
          <div id="navbar-mobile" class="collapse navbar-toggleable-sm">
            <ul class="nav navbar-nav">
              <li class="nav-item hidden-sm-down"><a class="nav-link nav-menu-main menu-toggle hidden-xs"><i class="icon-menu5">         </i></a></li>
              <li class="nav-item hidden-sm-down"><a href="#" class="nav-link nav-link-expand"><i class="ficon icon-expand2"></i></a></li>
              
            </ul>
            <ul class="nav navbar-nav float-xs-right">
              
              <li class="dropdown dropdown-notification nav-item"><a href="#" data-toggle="dropdown" class="nav-link nav-link-label"><i class="ficon icon-bell4"></i><span class="tag tag-pill tag-default tag-danger tag-default tag-up">{{count($notify_member) + count($notify_system)}}</span></a>
                <ul class="dropdown-menu dropdown-menu-media dropdown-menu-right">
                  <li class="dropdown-menu-header">
                    <h6 class="dropdown-header m-0"><span class="grey darken-2">Notifications</span><span class="notification-tag tag tag-default tag-danger float-xs-right m-0">
                      <?php $notif_ctr=0; $notif_sys_ctr=0;?>
                      @foreach($notify_member as $key => $notif)
                        @if($notif->read_at == NULL)
                        <?php $notif_ctr++ ?>
                        @endif
                      @endforeach

                      @foreach($notify_system as $key => $notif)
                        @if($notif->read_at == NULL)
                        <?php $notif_sys_ctr++ ?>
                        @endif
                      @endforeach

                      {{$notif_ctr + $notif_sys_ctr}} New
                    </span></h6>
                  </li>
                  @foreach($notify_member as $notify)
                  <li class="list-group scrollable-container"><a href="javascript:void(0)" class="list-group-item">
                      <div class="media">
                        <div class="media-left valign-middle"><i class="icon-cart3 icon-bg-circle bg-cyan"></i></div>
                        <div class="media-body">
                          <h6 class="media-heading">{{$notify->first_name}} {{$notify->last_name}}</h6>
                          <p class="notification-text font-small-3 text-muted">{{$notify->message}}</p><small>
                            <time datetime="2015-06-11T18:29:20+08:00" class="media-meta text-muted">{{$notify->created_at}}</time></small>
                        </div>
                      </div></a><a href="javascript:void(0)" class="list-group-item">
                  @endforeach
                  @foreach($notify_system as $system)
                  <li class="list-group scrollable-container"><a href="javascript:void(0)" class="list-group-item">
                      <div class="media">
                        <div class="media-left valign-middle"><i class="icon-cart3 icon-bg-circle bg-cyan"></i></div>
                        <div class="media-body">
                          <h6 class="media-heading">System</h6>
                          <p class="notification-text font-small-3 text-muted">{{$system->message}}</p><small>
                            <time datetime="2015-06-11T18:29:20+08:00" class="media-meta text-muted">{{$system->created_at}}</time></small>
                        </div>
                      </div></a><a href="javascript:void(0)" class="list-group-item">
                  @endforeach    
                  <li class="dropdown-menu-footer"><a href="/member_notifications" class="dropdown-item text-muted text-xs-center">Read all notifications</a></li>
                  <li class="dropdown-menu-footer"><form action="/clear" method="POST">{{csrf_field()}}<button type="submit" class="dropdown-item text-muted text-xs-center">Clear all notifications</button></form></li>
                </ul>
              </li>
             
                @foreach($name_result as $username)
              <li class="dropdown dropdown-user nav-item"><a href="#" data-toggle="dropdown" class="dropdown-toggle nav-link dropdown-user-link"><span class="avatar avatar-online"><img src="/uploads/avatars/{{$username->avatar}}" alt="avatar"><i></i></span><span class="user-name">
                      {{ $username->nickname }}
                @endforeach
              </span></a>
                <div class="dropdown-menu dropdown-menu-right"><a href="/editprofile" class="dropdown-item"><i class="icon-head"></i> Edit Profile</a>
                  <a href="" data-toggle="modal" data-target="#changePw" class="dropdown-item"><i class="icon-lock4"></i> Change Password </a>
                  <div class="dropdown-divider"></div>
                  <!-- logout -->
                  <a href="{{ route('logout') }}" onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();" class="dropdown-item"><i class="icon-power3"></i> Logout
                  </a>
                  <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                  {{ csrf_field() }}
                  <!-- end -->
                  </form>
                </div>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </nav>

    <!-- ////////////////////////////////////////////////////////////////////////////-->

<!--Change Password Modal-->
    <div class="container">
  <!-- Modal -->
  <div class="modal fade" id="changePw" role="dialog">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Change Password <i class="icon-lock4"></i></h4>
        </div>
        <div class="modal-body">
            <form class="form" method="POST" action="/changer">
              {{ csrf_field()}}
              <div class="form-body">
                <div class="form-group">
                
                  <div class="form-group">
                  <label for="newPassConfirm">Old Password</label>
                  <input type="password" id="newPassConfirm" class="form-control" required placeholder="Old Password" name="oldpw">
                </div>

                  <label for="newPass">New Password</label>
                  <input type="password" id="newPass" class="form-control" required placeholder="New Password" name="newpw">
                </div>
                
                <div class="form-group">
                  <label for="newPassConfirm">Confirm New Password</label>
                  <input type="password" id="newPassConfirm" class="form-control" required placeholder="Confirm New Password" name="confnewpw">
                </div>
              </div>
        </div>
        <div class="modal-footer">
          <div class="form-actions">
                <button type="button" class="btn btn-warning mr-1">
                  <i class="icon-cross2"></i> Cancel
                </button>
                <button type="submit" class="btn btn-primary">
                  <i class="icon-check2"></i> Save
                </button>
            </form>
              </div>
        </div>
      </div>
    </div>
  </div>
</div>
  <!--Change PW Modal End-->