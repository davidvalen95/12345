@if(session("message"))
    @foreach(session("message") as $type => $value)

    @if($type == "success")

    <div class='row'>
        <div class='col-xs-12'>
            <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h4><i class="icon fa fa-check"></i>Yeahhh feels good...</h4>
            {{$value}}
          </div>
        </div>
    </div>
@elseif ($type == "danger")
        <div class="alert alert-danger alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h4><i class="icon fa fa-info"></i> Ooopppss...</h4>
                        {{$value}}
          </div>
      {{-- type --}}
     @endif
 @endForeach
{{-- message --}}
@endif
