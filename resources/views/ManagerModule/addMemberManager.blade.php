@extends('ManagerModule.layouts.app')
@section('content')  
<title>Altitude Gym | Add Member</title>

<div class="app-content content container-fluid">
  <div class="content-wrapper">
    <div class="content-header row">
      @include('ManagerModule.inc.message')
      <div class="content-header-left col-md-6 col-xs-12 mb-1">

        <h2 class="content-header-title cyan"><i class="icon-android-person-add"></i>   Add Member</h2>
      </div>

      <div class="content-header-right breadcrumbs-right breadcrumbs-top col-md-6 col-xs-12">
        <div class="breadcrumb-wrapper col-xs-12">

        </div>
      </div>
    </div>
    <div class="content-body"><!-- Description -->

      <section id="description" class="card">

        <div class="card-body collapse in">
          <div class="card-block">

           {!! Form::open ([ 'action' => 'userController@store', 'method' => 'POST']) !!}
           <ul class="nav nav-tabs">

           </ul>
           <div class="tab-content px-1 pt-1">
             <div role="tabpanel" class="tab-pane active" id="tab1" aria-expanded="true" aria-labelledby="base-tab1">
               <div class="col-md-6 col-sm-12">
                <form class="form-horizontal">

                 <fieldset>

                            <!-- Form Name 
                            <legend>Register Yourself</legend>
                          -->


                          <h4 class="form-section"><i class="icon-profile"></i>Details</h4>
                          <!-- Text input-->

                          <div class="form-group">
                            {{Form::label('rfid_number', 'RFID Number')}}
                            <div class="position-relative has-icon-left">
                              {{Form::text('rfid_number', '', ['class' => 'form-control round border-success', 'placeholder' => 'ex. 2102456'])}}
                              <div class="form-control-position">
                                <i class="icon-credit-card2 warning"></i>
                              </div>
                            </div> 
                          </div>        

                          <div class="form-group">
                            {{Form::label('id_number', 'ID Number')}}
                            <div class="position-relative has-icon-left">
                              {{Form::text('id_number', '', ['class' => 'form-control round border-success', 'placeholder' => 'ex. 2102456'])}}
                              <div class="form-control-position">
                                <i class="icon-credit-card2 warning"></i>
                              </div>
                            </div> 
                          </div>

                          <div class="form-group">
                            {{Form::label('first_name', 'First name')}}
                            <div class="position-relative has-icon-left">
                              {{Form::text('first_name', '', ['class' => 'form-control round border-success', 'placeholder' => 'First name'])}}
                              <div class="form-control-position">
                                <i class="icon-head warning"></i>
                              </div>
                            </div>
                          </div>
                          <div class="form-group">
                            {{Form::label('middle_initial', 'Middle initial')}}
                            <div class="position-relative has-icon-left">
                              {{Form::text('middle_initial', '', ['class' => 'form-control round border-success', 'placeholder' => 'Middle initial'])}}
                              <div class="form-control-position">
                                <i class="icon-file-empty warning"></i>
                              </div>
                            </div>
                          </div>
                          <div class="form-group">
                            {{Form::label('last_name', 'Last name')}}
                            <div class="position-relative has-icon-left">
                              {{Form::text('last_name', '', ['class' => 'form-control round border-success', 'placeholder' => 'Last name'])}}
                              <div class="form-control-position">
                                <i class="icon-file-text warning"></i>
                              </div>
                            </div>
                          </div>
                          <div class="form-group">
                            {{Form::label('nickname', 'Nickname')}}
                            <div class="position-relative has-icon-left">
                              {{Form::text('nickname', '', ['class' => 'form-control round border-success', 'placeholder' => 'Nickname'])}}
                              <div class="form-control-position">
                                <i class="icon-smile2 warning"></i>
                              </div>
                            </div>
                          </div>

                          <div class="form-group">
                            {{Form::label('sex', 'Sex')}}
                            <div class="position-relative has-icon-left">
                              {{Form::select('sex', array('male' => 'male', 'female' => 'female'),'', ['class' => 'form-control round border-success'])}}
                              <div class="form-control-position">
                                <i class="icon-intersex warning"></i>
                              </div>
                            </div>
                          </div>
                          <div class="form-group">
                            {{Form::label('birthdate', 'Birthdate')}}
                            <div class="position-relative has-icon-left">
                              {{Form::date('birthdate','', ['class' => 'form-control round border-success'])}}
                              <div class="form-control-position">
                                <i class="icon-calendar5 warning"></i>
                              </div>
                            </div>
                          </div>
                          <div class="form-group">
                            {{Form::label('civil_status', 'Civil status')}}
                            <div class="position-relative has-icon-left">
                              {{Form::select('civil_status', array('single' => 'single', 'married' => 'married', 'separated' => 'separated', 'widowed' => 'widowed'),'', ['class' => 'form-control round border-success'])}}
                              <div class="form-control-position">
                                <i class="icon-circle warning"></i>
                              </div>
                            </div>
                          </div>
                          <div class="form-group">
                            {{Form::label('occupation', 'Occupation')}}
                            <div class="position-relative has-icon-left">
                              {{Form::text('occupation', '', ['class' => 'form-control round border-success', 'placeholder' => "student|profession"])}}
                              <div class="form-control-position">
                                <i class="icon-briefcase4 warning"></i>
                              </div>
                            </div>
                          </div>
                          <div class="form-group">
                            {{Form::label('school_workplace', 'School or workplace')}}
                            <div class="position-relative has-icon-left">
                              {{Form::text('school_workplace', '', ['class' => 'form-control  round border-success', 'placeholder' => 'school|workplace'])}}
                              <div class="form-control-position">
                                <i class="icon-building warning"></i>
                              </div>
                            </div>
                          </div>

                          <h4 class="form-section"><i class="icon-clipboard4"></i>Stats</h4>

                          <div class="form-group">
                            {{Form::label('height', 'Height')}}
                            <div class="position-relative has-icon-left">
                              {{Form::text('height', '', ['class' => 'form-control round border-danger', 'placeholder' => 'cm'])}}
                              <div class="form-control-position">
                                <i class="icon-point-up success"></i>
                              </div>
                            </div>
                          </div>

                          <div class="form-group">
                            {{Form::label('weight', 'Weight' )}}
                            <div class="position-relative has-icon-left">
                              {{Form::text('weight', '', ['class' => 'form-control round border-danger', 'placeholder' => 'kg'])}}
                              <div class="form-control-position">
                                <i class="icon-food success"></i>
                              </div>
                            </div> 
                          </div>
                        </div>

                        <div class="col-md-6 col-sm-12">
                          <form class="form-horizontal">
                            <fieldset>


                              <h4 class="form-section"><i class="icon-mail6"></i>Contact</h4>


                              <div class="form-group">
                                {{Form::label('address', 'Address')}}
                                <div class="position-relative has-icon-left">
                                  {{Form::text('address', '', ['class' => 'form-control round border-info', 'placeholder' => 'Address'])}}
                                  <div class="form-control-position">
                                    <i class="icon-home2 danger"></i>
                                  </div>
                                </div>
                              </div>

                              <div class="form-group">
                                {{Form::label('contact_no', 'Contact no')}}
                                <div class="position-relative has-icon-left">
                                  {{Form::text('contact_no', '', ['class' => 'form-control round border-info', 'placeholder' => '09123456789'])}}
                                  <div class="form-control-position">
                                    <i class="icon-credit-card2 danger"></i>
                                  </div>
                                </div>
                              </div>
                              <div class="form-group">
                                {{Form::label('emergency_contact', 'Emergency contact')}}
                                <div class="position-relative has-icon-left">
                                  {{Form::text('emergency_contact', '', ['class' => 'form-control round border-info', 'placeholder' => 'Emergency Contact Person'])}}
                                  <div class="form-control-position">
                                    <i class="icon-ios-contact danger"></i>
                                  </div>
                                </div>
                              </div>
                              <div class="form-group">
                                {{Form::label('emergency_no', 'Emergency no')}}
                                <div class="position-relative has-icon-left">
                                  {{Form::text('emergency_no', '', ['class' => 'form-control  round border-info', 'placeholder' => 'Emergency contact number of person'])}}
                                  <div class="form-control-position">
                                    <i class="icon-cc-mastercard danger"></i>
                                  </div>
                                </div>
                              </div>
                              <div class="form-group">
                                {{Form::label('email_address', 'Email address')}}
                                <div class="position-relative has-icon-left">
                                  {{Form::text('email_address', '', ['class' => 'form-control round border-info', 'placeholder' => 'youremail@gmail.com'])}}
                                  <div class="form-control-position">
                                    <i class="icon-email-unread danger"></i>
                                  </div>
                                </div>
                              </div>

                              <h4 class="form-section"><i class="icon-ios-people"></i>Membership</h4>

                              <div class="form-group">
                                {{Form::label('used_gym', 'Gym Experience')}}
                                <div class="position-relative has-icon-left">
                                  {{Form::select('used_gym', array('yes' => 'yes', 'no' => 'no'),'', ['class' => 'form-control round border-success', 'placeholder' => 'has this member used a gym before?'])}}
                                  <div class="form-control-position">
                                    <i class="icon-question warning"></i>
                                  </div>
                                </div>
                              </div>

                              <div class="form-group">
                                {{Form::label('medical_condition', 'Special Medical Condition')}}
                                <div class="position-relative has-icon-left">
                                  {{Form::textarea('medical_condition', '', ['class' => 'form-control round border-success', 'placeholder' => 'Specify special medical condition|none'])}}
                                  <div class="form-control-position">
                                    <i class="icon-ios-medkit warning"></i>
                                  </div>
                                </div>
                              </div>
                              
                              <div class="form-group">
                                {{Form::label('subscription', 'Subscription' )}}
                                <div class="position-relative has-icon-left">
                                  {{Form::select('subscription', array('regular(new)' => 'regular(new)', 'regular(old)' => 'regular(old)', 'student' => 'student', 'muay thai' => 'muay thai'),'', ['class' => 'form-control round border-info'])}}
                                  <div class="form-control-position">
                                    <i class="icon-coin-dollar danger"></i>
                                  </div>
                                </div>
                              </div>

                              <div class="form-group">
                                {{Form::label('amount', 'Amount')}}
                                <div class="position-relative has-icon-left">
                                  {{Form::text('amount', '', ['class' => 'form-control round border-info', 'placeholder' => 'enter amount'])}}
                                  <div class="form-control-position">
                                    <i class="icon-money danger"></i>
                                  </div>
                                </div>
                              </div>

                              <div class="form-group">
                                {{Form::label('date_subscription', 'Date Start')}}
                                <div class="position-relative has-icon-left">
                                  {{Form::date('date_subscription','', ['class' => 'form-control round border-success'])}}
                                  <div class="form-control-position">
                                    <i class="icon-calendar5 warning"></i>
                                  </div>
                                </div>
                              </div>


                              {{Form::submit('Submit', ['class'=>'btn btn-warning'])}}

                            </fieldset>
                          </form>
                        </div>


                        {!! Form::close() !!} 

                      </div>
                    </div>

                  </section>

                  <!--/ Description -->


                </div>
              </div>
            </div>
            
            @endsection