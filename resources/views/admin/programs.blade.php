<!DOCTYPE html>
<html lang="en" data-textdirection="ltr" class="loading">
<head>
    @include('admin.layouts.css_links')
    <title>Altitude Gym | Add Programs</title>
  </head>
 <body data-open="click" data-menu="vertical-menu" data-col="2-columns" class="vertical-layout vertical-menu 2-columns  fixed-navbar">
    @include('admin.layouts.nav')
    @include('admin.layouts.main_menu')
	 <div class="app-content content container-fluid">
      <div class="content-wrapper">
        <div class="content-header row">
          <div class="content-header-left col-md-12 col-xs-12 mb-1">
            @include('admin.inc.message')
            @include('admin.layouts.app-stats')

<!-- ////////////////////////////////////////////////////////////////////////////-->
@if(session('success_add'))

@include('admin.layouts.success')

@endif


</div>

<!--/ Member Table -->
<section id="anchors-n-buttons">
<div class="row">
<div class="col-xs-12">
  <h4 class="h4 teal">Programs</h4>
  <div class="alert bg-teal white font-medium-1"><strong>Beginner Program is strongly recommended for new users</strong>.</div>

<div class="row">
  <div class="col-xs-6">
<button type="button" class="btn btn-danger btn-block font-medium-1" data-toggle="modal" data-target="#addDayModal" data-whatever="@mdo"> <i class="icon-plus2"></i> Add a new program </button>
  </div>

<div class="col-xs-6">
<button type="button" class="btn btn-warning btn-block font-medium-1" data-toggle="modal" data-target="#addworkout" data-whatever="@mdo"><i class="icon-plus2"></i> Add a new workout </button>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="addDayModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Program Details</h5>

        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-body">
         <div class="form-group">
           
        <form method="POST" action='/day'>
          {{csrf_field()}}
        <label>Number of workout days:</label>
        <input class="form-control" type="number" min="1" maxlength="60" required name="num_days"><br>
        Name of the program: <input class="form-control" type="text" min="1" name="program_name" required>
         </div> 
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-danger">Create Program</button>

      </div>
    </form>
    </div>
  </div>
</div>

  <hr>
</div>
</div>

<h2 class="warning text-xs-center"> All Programs </h2>
@include('admin.layouts.program_list')
@include('admin.layouts.add_workout')

@if(session('num_days'))
  
  @include('admin.layouts.program_creator')

@endif








<!-- ////////////////////////////////////////////////////////////////////////////-->



<!-- BEGIN VENDOR JS-->
@include('admin.layouts.scripts')
<!-- END PAGE LEVEL JS-->
<!-- add a day -->

<!-- add rows in a day -->
<script>
function addItem_day(){

  var tablebody = document.getElementById('days_work');
  if(tablebody.rows.length == 1){
    tablebody.rows[0].cells[tablebody.rows[0].cells.length-1].children[0].style.display="";
  }


  var tablebody = document.getElementById('days_work');
  var iClone = tablebody.children[0].cloneNode(true);
  for(var i = 0; i< iClone.cells.length; i++){
    iClone.cells[i].children[0].value ="";
  }

  tablebody.appendChild(iClone);
}

function rmv_day(){
  var tabRow = document.getElementById('days_work');
  if(tabRow.rows.length == 1){
    tabRow.rows[0].cells[tabRow.rows[0].cells.length-1].children[0].style.display="none";
  }
  else{
    tabRow.rows[0].cells[tabRow.rows[0].cells.length-1].children[0].style.display="";
  }
}
</script>
<script>
  $('#customize').modal({
    show:true
  });

  $('#success_add').modal({
        show: true
    });

  var x = document.getElementsByClassName('check_custom');
  var y = document.getElementsByClassName('check_custom1');
  var z = document.getElementsByClassName('check_custom2');
  var a = document.getElementsByClassName('check_custom3')
  var b = document.getElementsByClassName('check_custom4')

  
function twin(){

  for(var i=0; i<=x.length; i++){

    if(x[i].checked){
      y[i].checked = true;
      z[i].checked = true;
      a[i].checked = true;
      b[i].checked = true;
    }else{
      y[i].checked = false;
      z[i].checked = false;
      a[i].checked = false;
      b[i].checked = false;
    }

  }
 
}


</script>
</body>
</html>
