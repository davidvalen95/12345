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
                          <img  class="mSongCover profile-user-img img-responsive img-circle" src={!!$song->imageUrl !!} alt="User profile picture">

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

                          <a href="#" class="btn btn-primary btn-block"><b>Add to myFavorite</b></a>
                            {{-- <iframe width="420" height="315" src="https://www.youtube.com/embed/iiNXf0n_hrA">
                            </iframe> --}}

                        </div>
                        <!-- /.box-body -->
                      </div>

        <!-- col               -->
        </div>


        <div class='col-md-9 col-xs-12'>
            <div class='row'>
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                    <li class="active"><a href="#activity" data-toggle="tab" aria-expanded="true">Statistic</a></li>
                    <li class=""><a href="#settings" data-toggle="tab" aria-expanded="false">Add new arangement</a></li>
                    </ul>
                    <div class="tab-content">



                        <div class="tab-pane active" id="activity">
                            <ul class='mDetail'>
                                <li>
                                    <i style='' class="fa fa-video-camera bg-maroon mDetailIcon"></i>
                                    <span class='mInlineBlock ml-'>Total arangement: {{$songDetails->count()}}</span>
                                </li>

                            </ul>

                        {{-- activity --}}
                        </div>


                        <div class="tab-pane" id="settings">
                            <form class="form-horizontal" method='POST' action={{route('post.song.detail')}}>
                                {{csrf_field()}}
                                @foreach($forms as $form)
                                {!!$form->getFormFormat2($errors)!!}


                                @endForeach


                                <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-10">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </div>
                            </form>
                        {{-- id setting --}}
                        </div>
                        <!-- tabcontent -->
                    </div>

                    <!-- nav tab -->
                </div>
            {{-- row  menu atas--}}
            </div>




            <div class='row'>

                @foreach($songDetails as $songDetail)

                    <?php
                        $userContributor = $songDetail->getUser;
                    ?>
                    <div class="col-md-6">
                    <!-- Widget: user widget style 1 -->
                        <div class="box box-widget widget-user-2">
                        <!-- Add the bg color to the header using any of the bg-* classes -->
                            <div class="widget-user-header">
                                <div class="widget-user-image">
                                    <img class="img-circle" src="../dist/img/user7-128x128.jpg" alt="User Avatar">
                                </div>
                                <!-- /.widget-user-image -->
                                <h3 class="widget-user-username">{{$songDetail->title}}</h3>
                                <h5 class="widget-user-desc">Contributor: {{$userContributor->name}}</h5>
                            </div>
                            <div class="box-footer no-padding">
                                {{-- <ul class="nav nav-stacked">
                                    <li><a href="#">Projects <span class="pull-right badge bg-blue">31</span></a></li>
                                    <li><a href="#">Tasks <span class="pull-right badge bg-aqua">5</span></a></li>
                                    <li><a href="#">Completed Projects <span class="pull-right badge bg-green">12</span></a></li>
                                    <li><a href="#">Followers <span class="pull-right badge bg-red">842</span></a></li>
                                </ul> --}}

                                <iframe style='height:400px' class='col-xs-12' frameborder="0" src={{$songDetail->embedUrl}} allowfullscreen></iframe>

                            </div>
                        </div>
                    <!-- /.widget-user -->
                    </div>

                @endForeach
            </div>


        {{-- div md 9 --}}
        </div>

    <!-- row -->
    </div>




<!-- section -->
</section>



@endSection
