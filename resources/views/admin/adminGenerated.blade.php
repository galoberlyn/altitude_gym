<!DOCTYPE html>
<html lang="en" data-textdirection="ltr" class="loading">
  <head>
    @include('admin.layouts.css_links')
    <title>Altitude Gym | Add Payment</title>
  </head>
  <body data-open="click" data-menu="vertical-menu" data-col="2-columns" class="vertical-layout vertical-menu 2-columns  fixed-navbar">
    @include('admin.layouts.nav')
    @include('admin.layouts.main_menu')
    <div class="app-content content container-fluid">
      <div class="content-wrapper">
        <div class="content-header row">
           @include('admin.inc.message')
          <div class="content-header-left col-md-6 col-xs-12 mb-1">
            <h4 class="card-title"><i class="icon-coin-dollar"></i>   Add Payment</h4>
          </div>
          <div class="content-header-right breadcrumbs-right breadcrumbs-top col-md-12 col-xs-12">
            <div>
        <a class=" float-xs-right" href = '/expirations'><i class="icon-arrow-left"></i>  Back</a>
            </div>
          </div>
        </div>
        <div class="content-body"><!-- Description -->
    <div class="content-body">
          {{ csrf_field() }}
<section id="description" class="card">
    <div class="card-body collapse in">
        <div class="card-block">
         {!! Form::open ([ 'action' => ['AdminExpirationsController@update', $payment->id], 'method' => 'POST']) !!}
            <div class="tab-content px-1 pt-1">
              <div role="tabpanel" class="tab-pane active" id="tab1" aria-expanded="true" aria-labelledby="base-tab1">
              <div class="col-md-6 col-sm-12">
                <form class="form-horizontal">
                 
<fieldset>
                            
              <div class="form-group">
                {{Form::label('amount', 'Full amount')}}<br>
                <b>PHP {{$payment->amount}}</b>
              </div> 
        
                <div class="form-group">
                 {{Form::label('amount', 'Amount paid')}}
                <div class="position-relative has-icon-left">
                    {{Form::text('amount', $payment->amount, ['class' => 'form-control round border-success', 'placeholder' => "The user's first name"])}}
                    <div class="form-control-position">
                      <i class="icon-money warning"></i>
                    </div>
                </div>
              </div>
                <fieldset>
                            <!-- Text input-->
                             <!-- First Name-->

                            {{Form::hidden('_method', 'PUT')}}
                            {{Form::submit('Add Payment', ['class'=>'btn btn-primary'])}}
                            
                </fieldset>         
              </div>
                            
              <div class="col-md-6 col-sm-12">
                <form class="form-horizontal">
                            
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