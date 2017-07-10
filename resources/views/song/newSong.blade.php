
{{--
    variable
        title



    object
        user


    section
        content

--}}



@extends('layouts.master')





@section('content')

<section class="content-header">
    <h1>
    Song
    <small>Control panel</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href={{route('home')}}><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Song</li>
    </ol>
</section>
<section class='content'>
    <div class='row'>
        <div class="col-md-8 col-xs-12">
              <!-- general form elements -->
              <div class="box box-success">
                <div class="box-header with-border">
                  <h3 class="box-title">Entry New Song</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <form method='POST' action={{url('song/new')}} role="form">
                  <div class="box-body">
                      <input type='hidden' name='_token' value={{csrf_token()}} />
                    @foreach($forms as $form)
                        {!!$form->getFormFormat($errors)!!}
                    @endForeach

                    <div class="box-footer">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                      </div>

                      <!-- box body -->
                  </div>
                </form>
                <!-- box success -->
            </div>

        <!-- col -->
        </div>
    </div>
    <!-- row -->
    </div>


</section>
@endSection
