 <div class="card">


             <div class="card-body">
                <div class="card-block">

<div class="row">
  <div class="col-md-6">
 &nbsp;<button type="button" class="btn btn-info btn-block" data-toggle="modal" data-target="#conf_user">Accept/Decline all Request of Member</button>
</div>
  <div class="col-md-6">
 &nbsp;<button type="button" class="btn btn-info btn-block" data-toggle="modal" data-target="#conf_user_date">Accept/Decline all Request by date</button>
</div>
</div>
 

</div>
</div>
</div>


  <div id ="conf_user" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel18" aria-hidden="true">
                            <div class="modal-dialog modal-sm" role="document">
                              <div class="modal-content">
                                    <div class="modal-header bg-info white">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    
                                    <h4 class="modal-title" id="myModalLabel18"><i class="icon-question"></i> Select user</h4>

                                  </div>
                              
                                  <div class="modal-body">

                                 <form onsubmit="return confirm('Are you sure about the Request?')" action="/accept_conf_name" method="POST">
                                  {{ csrf_field() }}
                                 
                          
                             User's Name: 
                            <select  type="text" name="accept_conf" required>

                             @foreach($list_confirm as $conf)
                                    <option value="{{$conf->user_id}}">{{$conf->first_name}} {{$conf->last_name}}</option>
                              @endforeach
                                    </select>
                                 

                                 </div>
                                                                   <div class="modal-footer">
                                  <input type="submit" class="btn btn-success" value="Accept" name="conf_name">
                                  <input type="submit" class="btn btn-danger" value="Decline" name="conf_name">
                                </div>
                                  </form>
      </div>
    </div>
   </div>





     <div id ="conf_user_date" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel18" aria-hidden="true">
                            <div class="modal-dialog modal-sm" role="document">
                              <div class="modal-content">
                                    <div class="modal-header bg-info white">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    
                                    <h4 class="modal-title" id="myModalLabel18"><i class="icon-question"></i> Select date to accept/decline</h4>

                                  </div>
                              
                                  <div class="modal-body">
                                     <form onsubmit="return confirm('Are you sure about the Request?')" action="/accept_conf_date" method="POST">
                                  {{ csrf_field() }}
                                 
                          
                             Date: 
                            <select  type="text" name="accept_conf_date" required>

                             @foreach($list_confirm_date as $conf_date)
                                    <option value="{{$conf_date->date2}}">{{$conf_date->date2}}</option>
                              @endforeach
                                    </select>
                                 

                              
                                                                   <div class="modal-footer">
                                  <input type="submit" class="btn btn-success" value="Accept" name="conf_name">
                                  <input type="submit" class="btn btn-danger" value="Decline" name="conf_name">
                                </div>
                                  </form>
                                

                                 </div>
      </div>
    </div>
   </div>