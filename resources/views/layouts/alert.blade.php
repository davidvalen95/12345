@if($success)


    <div class='row'>
        <div class='col-xs-12'>
            <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h4><i class="icon fa fa-check"></i>Success</h4>
            {{$success}}
          </div>
        </div>
    </div>
@endIf
@if ($danger)
        <div class="alert alert-danger alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h4><i class="icon fa fa-info"></i> Ooopppss...</h4>
                        {{$danger}}
          </div>
      {{-- type --}}
@endif
