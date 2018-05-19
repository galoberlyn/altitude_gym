<!-- this blade only outputs the custom program from the serve -->
<div class="container">
      <div class="row">    

      @foreach($prog_type as $key => $custom_type)
   

        <div class="col-xs-3">
      <div class="project project-default">
        <div class="shape">
          <div class="shape-text">
            <i class="icon-star6"></i>             
          </div>
        </div>
        <div class="project-content"><br>
          <p class="lead teal">
            {{$custom_type->type}} 
          </p><br>
          <button type="button" class="btn btn-block" data-toggle="modal" data-target="#custom_types{{$key}}">
            View
            </button>
       
            
          
        </div>
      </div>
    </div>

    @endforeach
  </div>
</div>



