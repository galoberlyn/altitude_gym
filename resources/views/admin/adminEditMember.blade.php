<!DOCTYPE html>
<html lang="en" data-textdirection="ltr" class="loading">
  <head>
    @include('admin.layouts.css_links')
    <title>Altitude Gym | Edit Member</title>
  </head>
  <body data-open="click" data-menu="vertical-menu" data-col="2-columns" class="vertical-layout vertical-menu 2-columns  fixed-navbar">
    @include('admin.layouts.nav')
    @include('admin.layouts.main_menu')
    <div class="app-content content container-fluid">
      <div class="content-wrapper">
        <div class="content-header row">
           @include('admin.inc.message')
          <div class="content-header-left col-md-6 col-xs-12 mb-1">
            <h2 class="content-header-title cyan"><i class="icon-android-person-add"></i>   Edit Member</h2>
          </div>
          <div class="content-header-right breadcrumbs-right breadcrumbs-top col-md-6 col-xs-12">
            <div class="breadcrumb-wrapper col-xs-12">
				<a class=" float-xs-right" href = '/members'><i class="icon-arrow-left"></i>  Back to Member List</a>
            </div>
          </div>
        </div>
        <div class="content-body"><!-- Description -->
    <div class="content-body">
          {{ csrf_field() }}
<section id="description" class="card">
    <div class="card-body collapse in">
        <div class="card-block">
         {!! Form::open ([ 'action' => ['AdminMemberController@update', $member->id], 'method' => 'POST']) !!}
                     
           <div class="tab-content px-1 pt-1">
              <div role="tabpanel" class="tab-pane active" id="tab1" aria-expanded="true" aria-labelledby="base-tab1">
              <div class="col-md-6 col-sm-12">
                <form class="form-horizontal">
                    <fieldset>
            <h4 class="form-section"><i class="icon-profile"></i>Details</h4>
              <div class="form-group">
                {{Form::label('user_type', 'User type')}}
                <div class="position-relative has-icon-left">
                    {{Form::select('user_type', array('member' => 'member', 'manager' => 'manager', 'admin' => 'admin'),$member->user_type, ['class' => 'round border-success'])}}
                </div>
              </div>
                
				<div class="form-group">
                {{Form::label('rfid_number', 'RFID Number')}}
                <div class="position-relative has-icon-left">
                {{Form::text('rfid_number', $member->rfid_number, ['class' => 'form-control round border-success', 'placeholder' => 'ex. 2102456'])}}
                <div class="form-control-position">
                        <i class="icon-credit-card2 warning"></i>
                      </div>
                  </div> 
                </div>
				
               <div class="form-group">
                {{Form::label('first_name', 'First name')}}
                <div class="position-relative has-icon-left">
                    {{Form::text('first_name', $member->first_name, ['class' => 'form-control round border-success', 'placeholder' => "The user's first name"])}}
                    <div class="form-control-position">
                      <i class="icon-head warning"></i>
                    </div>
                </div>               
                             </div>
               
              <div class="form-group">
                {{Form::label('middle_initial', 'Middle initial')}}
                <div class="position-relative has-icon-left">
                    {{Form::text('middle_initial', $member->middle_initial, ['class' => 'form-control round border-success', 'placeholder' => "The user's middle initial"])}}
                    <div class="form-control-position">
                      <i class="icon-file-empty warning"></i>
                    </div>
                </div>
              </div>
              
              <div class="form-group">
                {{Form::label('last_name', 'Last name')}}
                <div class="position-relative has-icon-left">
                    {{Form::text('last_name', $member->last_name, ['class' => 'form-control round border-success', 'placeholder' => "The user's last name"])}}
                    <div class="form-control-position">
                      <i class="icon-file-text warning"></i>
                    </div>
                </div>
              </div>
              
              <div class="form-group">
                {{Form::label('nickname', 'Nickname')}}
                <div class="position-relative has-icon-left">
                    {{Form::text('nickname', $member->nickname, ['class' => 'form-control round border-success', 'placeholder' => "The user's nickname"])}}
                    <div class="form-control-position">
                      <i class="icon-smile2 warning"></i>
                    </div>
                </div>
              </div>
              
              <div class="col-md-6">
              <div class="form-group">
                {{Form::label('sex', 'Sex')}}
                <div class="position-relative has-icon-left">
                    {{Form::select('sex', array('male' => 'male', 'female' => 'female'), $member->sex, ['class' => 'form-control round border-success'])}}
                    <div class="form-control-position">
                      <i class="icon-intersex warning"></i>
                    </div>
                </div>
              </div>
              </div>
              <div class="col-md-6">
              <div class="form-group">
                {{Form::label('birthdate', 'Birthdate')}}
                <div class="position-relative has-icon-left">
                    {{Form::date('birthdate', $member->birthdate, ['class' => 'form-control round border-success'])}}
                    <div class="form-control-position">
                      <i class="icon-calendar5 warning"></i>
                    </div>
                </div>
              </div>
              </div>
              
              <div class="col-md-6">
              <div class="form-group">
                {{Form::label('civil_status', 'Civil status')}}
                <div class="position-relative has-icon-left">
                    {{Form::select('civil_status', array('single' => 'single', 'married' => 'married', 'widowed' => 'widowed', 'separated' => 'separated'), $member->civil_status, ['class' => 'form-control round border-success'])}}
                    <div class="form-control-position">
                      <i class="icon-circle warning"></i>
                    </div>
                </div>
              </div>
              </div>
              <div class="col-md-6">
              <div class="form-group">
                {{Form::label('used_gym', 'Used gym')}}
                <div class="position-relative has-icon-left">
                    {{Form::select('used_gym', array('yes' => 'yes', 'no' => 'no'), $member->used_gym, ['class' => 'form-control round border-success'])}}
                    <div class="form-control-position">
                      <i class="icon-question warning"></i>
                    </div>
                </div>
              </div>
              </div>
              
              <div class="form-group">
                {{Form::label('occupation', 'Occupation')}}
                <div class="position-relative has-icon-left">
                    {{Form::text('occupation', $member->occupation, ['class' => 'form-control round border-success', 'placeholder' => "The user's occupation (enter either 'student' or their profession)"])}}
                    <div class="form-control-position">
                      <i class="icon-briefcase4 warning"></i>
                    </div>
                </div>
              </div>

              <div class="form-group">
                 {{Form::label('school_workplace', 'School or workplace')}}
                <div class="position-relative has-icon-left">
                    {{Form::text('school_workplace', $member->school_workplace, ['class' => 'form-control round border-success', 'placeholder' => "The user's school or user's workplace"])}}
                    <div class="form-control-position">
                      <i class="icon-building warning"></i>
                    </div>
                </div>
              </div>
              
              <div class="form-group">
                 {{Form::label('medical_condition', 'Medical condition')}}
                <div class="position-relative has-icon-left">
                    {{Form::textarea('medical_condition', $member->medical_condition, ['class' => 'form-control round border-success', 'placeholder' => "The user's medical condition (enter 'no' when the user has no noteworthy medical condition)"])}}
                    <div class="form-control-position">
                      <i class="icon-ios-medkit warning"></i>
                    </div>
                </div>
              </div>
        </div>
                            
              <div class="col-md-6 col-sm-12">
                <form class="form-horizontal">
                    <fieldset>
                        <h4 class="form-section"><i class="icon-clipboard4"></i>Stats</h4>
            
              <div class="form-group">
                 {{Form::label('height', 'Height')}}
                <div class="position-relative has-icon-left">
                    {{Form::text('height', $member_stats->height, ['class' => 'form-control round border-danger', 'placeholder' => "The user's height (in meters)"])}}
                    <div class="form-control-position">
                      <i class="icon-point-up success"></i>
                    </div>
                </div>
              </div>
              
              <div class="form-group">
                   {{Form::label('weight', 'Weight')}}
                <div class="position-relative has-icon-left">
                    {{Form::text('weight', $member_stats->weight, ['class' => 'form-control round border-danger', 'placeholder' => "The user's weight (in kilograms)"])}}
                    <div class="form-control-position">
                      <i class="icon-food success"></i>
                    </div>
                </div>
              </div>

            <h4 class="form-section"><i class="icon-mail6"></i>Contact</h4>

              <div class="form-group">
                     {{Form::label('address', 'Address')}}
                <div class="position-relative has-icon-left">
                    {{Form::text('address', $member->address, ['class' => 'form-control round border-info', 'placeholder' => "The user's address"])}}
                    <div class="form-control-position">
                      <i class="icon-home2 danger"></i>
                    </div>
                </div>
              </div>
              
              <div class="form-group">
                     {{Form::label('contact_no', 'Contact number')}}
                <div class="position-relative has-icon-left">
                    {{Form::text('contact_no', $member->contact_no, ['class' => 'form-control round border-info', 'placeholder' => "The user's contact number"])}}
                    <div class="form-control-position">
                      <i class="icon-credit-card2 danger"></i>
                    </div>
                </div>
              </div>
              
              <div class="form-group">
                     {{Form::label('emergency_contact', 'Emergency contact')}}
                <div class="position-relative has-icon-left">
                    {{Form::text('emergency_contact', $member->emergency_contact, ['class' => 'form-control round border-info', 'placeholder' => "The user's contact in case of an emergency"])}}
                    <div class="form-control-position">
                      <i class="icon-ios-contact danger"></i>
                    </div>
                </div>
              </div>
              
              <div class="form-group">
                     {{Form::label('emergency_no', 'Emergency no')}}
                <div class="position-relative has-icon-left">
                     {{Form::text('emergency_no', $member->emergency_no, ['class' => 'form-control round border-info', 'placeholder' => "The emergency contact's contact number"])}}
                    <div class="form-control-position">
                      <i class="icon-cc-mastercard danger"></i>
                    </div>
                </div>
              </div>
              
              <div class="form-group">
                     {{Form::label('email_address', 'Email address')}}
                <div class="position-relative has-icon-left">
                     {{Form::text('email_address', $member->email_address, ['class' => 'form-control round border-info', 'placeholder' => "The user's e-mail address"])}}
                    <div class="form-control-position">
                      <i class="icon-email-unread danger"></i>
                    </div>
                </div>
              </div>


<!--             <h4 class="form-section"><i class="icon-wallet"></i>Payment</h4>
            
              <div class="form-group">
                      {{Form::label('subscription', 'Subscription')}}
                <div class="position-relative has-icon-left">
                     {{Form::text('subscription', '', ['class' => 'form-control round border-info', 'placeholder' => 'ex.950, 850, 500, muay thai'])}}
                    <div class="form-control-position">
                      <i class="icon-coin-dollar danger"></i>
                    </div>
                </div>
              </div>
              
              <div class="form-group">
                 {{Form::label('payment_type', 'Payment type' )}}
                <div class="position-relative has-icon-left">
                    {{Form::select('payment_type', array('student' => 'student', 'regular' => 'regular', 'muay thai' => 'muay thai'),'', ['class' => 'round border-info'])}}
                </div>
              </div> -->

                            {{Form::hidden('_method', 'PUT')}}
                            {{Form::submit('Submit', ['class'=>'btn btn-primary'])}}
                            
                            </fieldset>
                            </form>
                                </div>
              </div>
             
            </div>
             {!! Form::close() !!} 
          
          </div>
    </div>
        
</section>

<!--/ Description -->


        </div>
      </div>
    </div>

    @include('admin.layouts.scripts') 
  </body>
</html>