{{--
    variable
        title



    object
        user
        song


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
        <div class='col-md-3 col-xs-12'>
            <div class="box box-primary">
                        <div class="box-body box-profile">
                          <img style='width:150px;height:150px; display:block; margin-left: auto; margin-right: auto; border:0px solid tomato;' lass="profile-user-img img-responsive img-circle" src={{$song->imageUrl }} alt="User profile picture">

                          <h3 class="profile-username text-center">{{$song->title}}</h3>

                          <!-- <p class="text-muted text-center">Software Engineer</p> -->

                          <ul class="list-group list-group-unbordered">
                            <li class="list-group-item">
                              <b>Lyric</b> {!!$song->lyric!!}
                            </li>
                            <!-- <li class="list-group-item">
                              <b>Following</b> <a class="pull-right">543</a>
                            </li>
                            <li class="list-group-item">
                              <b>Friends</b> <a class="pull-right">13,287</a>
                            </li> -->
                          </ul>

                          <a href="#" class="btn btn-primary btn-block"><b>Follow</b></a>
                        </div>
                        <!-- /.box-body -->
                      </div>

        <!-- col               -->
        </div>
    <!-- row -->
    </div>
<!-- section -->
</section>



@endSection
