{{--
    variable
        title
        isUsed


    object
        user
        song
        songDetails
        usedSong

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

        {{-- lirik kiri --}}
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

        {{-- statistic atas --}}
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


                        <div class="tab-pane "  id="settings">
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
                            <div class='col-md-offset-2'>
                                <h3>Guidelines</h3>
                                <p>
                                    Example for valid video code :
                                    <img  class='.d-block img-thumbnail' src='{{asset('images/video-code-1.png')}}'/>
                                    {{-- <img  class='.d-block' src='{{asset('images/video-code-2.png')}}'/> --}}
                                </p>
                                <p>
                                    Example for valid video code:
                                    <img  class='.d-block img-thumbnail' src='{{asset('images/video-code-2.png')}}'/>

                                </p>
                                {{-- <p>
                                    Error message, it means it has copyright and cannot be inserted here
                                    <img  class='.d-block img-thumbnail' src='{{asset('images/error-copyright.png')}}'/>

                                </p> --}}
                                <p>
                                    Error message, wrong video code

                                    <img  class='.d-block img-thumbnail' src='{{asset('images/error-video-code.png')}}'/>

                                </p>
                            {{-- =guideline --}}
                            </div>

                        {{-- id setting --}}
                        </div>
                        <!-- tabcontent -->
                    </div>

                    <!-- nav tab -->
                </div>
            {{-- row  menu atas--}}
            </div>



            {{-- view utube --}}
            <div class='row'>
                @php($i=0)
                @foreach($songDetails as $songDetail)

                    @php

                        $thisSong = false;
                        $userContributor = $songDetail->getUser;
                        $userContributor->setDefaultPreferences();
                        if(isset($usedSong))
                            if($songDetail->id == $usedSong->id)
                                $thisSong = true;
                    @endPhp
                    {{-- row separator, for each 2 --}}
                    @if($i++%2==0)<div class='row'>@endIf
                    <div class="col-sm-6">
                    <!-- Widget: user widget style 1 -->
                        <div class="box box-widget widget-user-2">
                        <!-- Add the bg color to the header using any of the bg-* classes -->
                            <div class="widget-user-header @if($thisSong)bg bg-warning @endIf ">
                                <div class="widget-user-image">
                                    <img class="img-circle" src={{IMAGE_LOGO}} alt="User Avatar">
                                    @if($thisSong)<i class="fa fa-star pull-right" aria-hidden="true"></i> @endIf

                                </div>
                                <!-- /.widget-user-image -->
                                <h3 class="widget-user-username">{{$songDetail->title}}</h3>
                                <h5 class="widget-user-desc">Contributor: {{$userContributor->name}}</h5>

                            </div>

                            <div style='margin-top:12px' class="box-footer">

                                {{-- usage history --}}
                                <button class="btn btn-app" data-toggle="modal" data-target="#modal-schedule-{{$songDetail->id}}">
                                    <span class="badge bg-red">{{$songDetail->getSchedule->count()}}</span>
                                    <i class="fa fa-bar-chart"></i>
                                </button>

                                {{-- modal --}}
                                <div class="modal fade" id="modal-schedule-{{$songDetail->id}}">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">×</span></button>
                                                <h4 class="modal-title">{{$songDetail->title}} history</h4>
                                            </div>
                                            <div class="modal-body">
                                                <ul>
                                                    {{-- dapetin h2 dengan membandingkan --}}
                                                    @php($month = "")
                                                    @foreach($songDetail->getSchedule()->orderBy("due",'desc')->get() as $currentSchedule)
                                                        @if($month != dateTimeToString($currentSchedule->due,'M'))
                                                            @php($month = dateTimeToString($currentSchedule->due,'M'))
                                                            <h2 style='padding:0;margin-left:-30px;'>{{dateTimeToString($currentSchedule->due,'M Y')}}</h2>
                                                        @endIf
                                                        <li>
                                                            {{dateTimeToString($currentSchedule->due,'D d M Y')}} WL: <b>{{$currentSchedule->getWorshipLeaderName()}}</b>
                                                        </li>
                                                    @endForeach
                                                </ul>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>

                                            </div>
                                        </div>
                                    <!-- /.modal-content -->
                                    </div>
                                <!-- /.modal-dialog -->
                                </div>







                                <iframe style='height:400px; margin: 12px 0px;' class='col-xs-12' frameborder="0" src="https://www.youtube.com/embed/{{$songDetail->embedUrl}}" allowfullscreen></iframe>

                                <h5 style='padding-left:18px;'><b>Description</b></h5>

                                <p style='padding-left:18px;'>
                                    {{$songDetail->description}}
                                </p>
                                @php($latestSchedule = App\Model\Schedule::getLatestSchedule($user->getCategory))
                                @php($for =  " for <b>".$user->getCategory->setDefaultPreferences()->name. "</b> ". dateTimeToString($latestSchedule->due))
                                @if(!$isUsed)
                                    <form action={{action('ScheduleController@postAddScheduleSongDetail')}} method='POST'>

                                        @if(!$latestSchedule->isExpired())
                                            <button class='btn btn-success' style='margin-left:18px;'>Add to schedule {!!$for!!}</button>
                                        @else

                                             <button type='button' class='btn btn-danger disabled' style='margin-left:18px;'>Add to schedule (expired) {!!$for!!}</button>
                                        @endIf

                                        <input type='hidden' name='songDetailId' value={{$songDetail->id}} />
                                        {{csrf_field()}}
                                    </form>
                                @else
                                    <p style='margin-left:18px;' class='btn btn-default'>
                                        Already added {!!$for!!}
                                    </p>
                                @endIf

                            </div>
                        </div>


                    {{-- col 6 --}}
                    </div>
                    {{-- div nya row nutup per baru jika ==0  --}}
                    @if($i%2==0)</div>@endIf

                @endForeach
            </div>


        {{-- div md 9 --}}
        </div>

    <!-- row -->
    </div>




<!-- section -->
</section>



@endSection
