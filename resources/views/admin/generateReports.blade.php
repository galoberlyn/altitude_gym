<!DOCTYPE html>
<html lang="en" data-textdirection="ltr" class="loading">
  <head>
    @include('admin.layouts.css_links')
    <title>Altitude Gym | Generate Reports</title>
  </head>
  <body data-open="click" data-menu="vertical-menu" data-col="2-columns" class="vertical-layout vertical-menu 2-columns  fixed-navbar">
    @include('admin.layouts.nav')
    @include('admin.layouts.main_menu')

    <div class="app-content content container-fluid">
      <div class="content-wrapper">
        <div class="content-header row">
          <div class="content-header-left col-md-6 col-xs-12 mb-1">
                @include('admin.inc.message')
            <h2 class="content-header-title orange"><i class="icon-list"></i>   Generate Reports</h2>
          </div>
          <div class="content-header-right breadcrumbs-right breadcrumbs-top col-md-6 col-xs-12">
            <div class="breadcrumb-wrapper col-xs-12">
              
            </div>
          </div>
        </div>
        <div class="content-body">
<section id="description" class="card">
    <div class="card-body collapse in">
        <div class="card-block">
            <div class="tab-content px-1 pt-1">
              <div role="tabpanel" class="tab-pane active" id="tab1" aria-expanded="true" aria-labelledby="base-tab1">
                <div class="col-md-12 col-sm-12">
                  <h3>Generate report for:</h3>
                  <center><table class = "table-striped table-bordered table-warning">
                    <tr>
                      <td style = "padding:10px;">Members</td>
                      <td style = "padding:10px;">
                      <form action="/reports/1" method="GET">
                          <input type="checkbox" name="1-selected" value="1-selected" checked/> Registered On<br>
                          <input type="checkbox" name="2-selected" value="2-selected" checked/> Member's ID<br>
                          <input type="checkbox" name="3-selected" value="3-selected" checked/> Username<br>
                          <input type="checkbox" name="4-selected" value="4-selected" checked/> First name<br>
                          <input type="checkbox" name="5-selected" value="5-selected" checked/> Middle initial<br>
                          <input type="checkbox" name="6-selected" value="6-selected" checked/> Last name<br>
                          <input type="checkbox" name="7-selected" value="7-selected" checked/> Sex<br>
                          <input type="checkbox" name="8-selected" value="8-selected" checked/> Birthdate<br>
                          <input type="checkbox" name="9-selected" value="9-selected" checked/> Address<br>
                          <input type="checkbox" name="10-selected" value="10-selected" checked/> Contact number<br>
                          <input type="checkbox" name="11-selected" value="11-selected" checked/> Civil status<br>
                          <input type="checkbox" name="12-selected" value="12-selected" checked/> Email address<br>
                          <input type="checkbox" name="13-selected" value="13-selected" checked/> Occupation<br>
                          <input type="checkbox" name="14-selected" value="14-selected" checked/> School or workplace<br>
                          <input type="checkbox" name="15-selected" value="15-selected" checked/> Used gym?<br>
                          <input type="checkbox" name="16-selected" value="16-selected" checked/> Medical condition<br>
                          <input type="checkbox" name="17-selected" value="17-selected" checked/> Emergency contact<br>
                          <input type="checkbox" name="18-selected" value="18-selected" checked/> Emergency contact's number<br>
                          <input type="checkbox" name="19-selected" value="19-selected" checked/> Profile status<br>
                      </td>
                      <td style = "padding:10px;"><br>
                        From<br>
                        <input type="date" name="date" value="date"></input><br>
                        To<br>
                        <input type="date" name="date2"></input><br>
                         <br>
                        <button type="submit" role="button" class="btn btn-default">Download</button>
                        </form>
                      </td>
                    </tr>
                    <tr>
                      <td style = "padding:10px;">Member log</td>
                      <td style = "padding:10px;">
                            <form action="/reports/2" method="GET">
                            <input type="checkbox" name="1-selected" value="4-selected" checked/> Log date<br>
                            <input type="checkbox" name="2-selected" value="1-selected" checked/> Member ID<br>
                            <input type="checkbox" name="3-selected" value="2-selected" checked/> Member's first name<br>
                            <input type="checkbox" name="4-selected" value="3-selected" checked/> Member's last name<br>
                            <input type="checkbox" name="5-selected" value="5-selected" checked/> Time In<br>
                            <input type="checkbox" name="6-selected" value="6-selected" checked/> Time Out<br>
                          </td>
                          <td style = "padding:10px;"><br>
                            From<br>
                            <input type="date" name="date" value="date"></input><br>
                            To<br>
                            <input type="date" name="date2"></input><br>
                             <br>
                            <button type="submit" role="button" class="btn btn-default" data-toggle="modal" data-target=".download">Download</button>
                        </form>
                    </td>
                    </tr>
                    <tr>
                      <td style = "padding:10px;">Expiring memberships</td><td style = "padding:10px;">
                        <form action="/reports/3" method="GET">
                          </select>
                          <br>
                        <input type="checkbox" name="1-selected" value="1-selected" checked/> Expiration date<br>
                        <input type="checkbox" name="2-selected" value="2-selected" checked/> Transaction ID<br>
                        <input type="checkbox" name="3-selected" value="3-selected" checked/> User ID<br>
                        <input type="checkbox" name="4-selected" value="4-selected" checked/> First name<br>
                        <input type="checkbox" name="5-selected" value="5-selected" checked/> Last name<br>
                        <input type="checkbox" name="6-selected" value="6-selected" checked/> Amount<br>
                      </td>
                      <td style = "padding:10px;">
                        From<br>
                        <input type="date" name="date" value="date"></input><br>
                        To<br>
                        <input type="date" name="date2"></input><br>
                         <br>
                        <button type="submit" role="button" class="btn btn-default" data-toggle="modal" data-target=".download">Download</button>
                        </form>
                    </tr>
                    <tr>
                      <td style = "padding:10px;">Membership payments</td>
                      <td style = "padding:10px;">
                        <form action="/reports/7" method="GET">
                        <input type="checkbox" name="1-selected" value="1-selected" checked/> Payment date<br>
                        <input type="checkbox" name="2-selected" value="2-selected" checked/> Member's first name<br>
                        <input type="checkbox" name="3-selected" value="3-selected" checked/> Member's last name<br>
                        <input type="checkbox" name="4-selected" value="4-selected" checked/> Amount<br>
                      </td>
                      <td style = "padding:10px;"><br>
                        From<br>
                        <input type="date" name="date" value="date"></input><br>
                        To<br>
                        <input type="date" name="date2"></input><br>
                         <br>
                        <button type="submit" role="button" class="btn btn-default" data-toggle="modal" data-target=".download">Download</button>

                      </form>
                    </td>
                    </tr>
                    <tr>
                      <td style = "padding:10px;">Current locker subscriptions</td>
                      <td style = "padding:10px;">
                        <form action="/reports/5" method="GET">
                        <input type="checkbox" name="1-selected" value="1-selected" checked/> Locker number<br>
                        <input type="checkbox" name="2-selected" value="2-selected" checked/> Subscription date<br>
                        <input type="checkbox" name="3-selected" value="3-selected" checked/> Status<br>
                        <input type="checkbox" name="4-selected" value="4-selected" checked/> Member ID<br>
                        <input type="checkbox" name="5-selected" value="5-selected" checked/> Member's first name<br>
                        <input type="checkbox" name="6-selected" value="6-selected" checked/> Member's last name<br>
                        <input type="checkbox" name="7-selected" value="7-selected" checked/> Locker set<br>
                      </td>
                        <td style = "padding:10px;"><button type="submit" role="button" class="btn btn-default">Download</button></td>
                      </form>
                    </tr>
                    <tr>
                      <td style = "padding:10px;">Locker payments</td>
                      <td style = "padding:10px;">
                        <form action="/reports/6" method="GET">
                        <input type="checkbox" name="1-selected" value="1-selected" checked/> Payment date<br>
                        <input type="checkbox" name="2-selected" value="2-selected" checked/> Member's first name<br>
                        <input type="checkbox" name="3-selected" value="3-selected" checked/> Member's last name<br>
                        <input type="checkbox" name="4-selected" value="4-selected" checked/> Amount<br>
                      </td>
                      <td style = "padding:10px;"><br>
                        From<br>
                        <input type="date" name="date" value="date"></input><br>
                        To<br>
                        <input type="date" name="date2"></input><br>
                         <br>
                        <button type="submit" role="button" class="btn btn-default" data-toggle="modal" data-target=".download">Download</button>
                      </form>
                    </td>
                    </tr>
                    <tr>
                      <form action="/reports/4" method="GET">
                        <td style = "padding:10px;">Leaderboard</td><td style = "padding:10px;">
                          <input type="radio" name="leaderboard-selection" value="beginner" checked />Beginner<br>
                          <input type="radio" name="leaderboard-selection" value="intermediate" />Intermediate<br>
                          <input type="radio" name="leaderboard-selection" value="advanced" />Advanced</td>
                        </td>
                        <td style = "padding:10px;"><button type="submit" role="button" class="btn btn-default">Download</button></td>
                          </form>
                    </tr>
                  </table>
				  </center>
                </div>
              </div>
            </div> 
          </div>
    </div>
      <div class="modal fade download" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
            <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>
          <center>
            <br>
            <b>File downloaded!</b><br>
            Check your download directory.
            <br>
          </center>
          <div class="modal-footer">
        </div>                                      

      </div>
    </div>
  </div>
        
</section>

<!--/ Description -->
        </div>
      </div>
    </div>

        @include('admin.layouts.scripts')    
    <footer class="footer footer-static footer-light navbar-border">
      <p class="clearfix text-muted text-sm-center mb-0 px-2"><span class="float-md-center d-xs-block d-md-inline-block">Copyright  &copy; 2018 <b>ALTITUDEGYM</b> </a>, All rights reserved. </span></p>
    </footer>
  </body>
</html>