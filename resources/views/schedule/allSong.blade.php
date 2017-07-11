
{{--
    variable
        title



    object
        user
        scheudles


    section
        content

--}}
@extends("layouts.master")


@section('content')

    <section class="content-header">
        <h1>
        Schedule
        <small>All song video</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href={{route('home')}}><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Dashboard</li>
        </ol>
    </section>

    <section class="content">

        {{-- jadwal mingguan atas --}}
        <div class='row'>
            <div class=" col-sm-6 col-xs-12">
                @include('schedule.weeklyList')

            <!-- col3 -->
            </div>

        </div>



        {{-- all song  video--}}
        <div class='row'>
            @foreach($schedules->first()->getSongDetail()->orderBy('created_at','asc')->get() as $songDetail)

                <?php
                    $userContributor = $songDetail->getUser;
                    $userContributor->setDefaultPreferences();
                    $thisSong = true;
                ?>
                <div class="col-sm-6 col-lg-4 col-xs-12">
                <!-- Widget: user widget style 1 -->
                    <div class="box box-widget widget-user-2">
                    <!-- Add the bg color to the header using any of the bg-* classes -->
                        <div class="widget-user-header @if($thisSong)bg bg-warning @endIf ">
                            <div class="widget-user-image">
                                <img class="img-circle" src={{IMAGE_LOGO}} alt="User Avatar">
                                @if($thisSong)<i class="fa fa-star pull-right" aria-hidden="true"></i> @endIf

                            </div>
                            <!-- /.widget-user-image -->
                            <h3 class="widget-user-username">{{$songDetail->getSong->setDefaultPreferences()->title}}</h3>
                            <h5 class="widget-user-desc">Contributor: {{$userContributor->name}}</h5>

                        </div>

                        <div style='margin-top:12px' class="box-footer">
                            <iframe style='height:400px; margin-bottom: 12px;' class='col-xs-12' frameborder="0" src="https://www.youtube.com/embed/{{$songDetail->embedUrl}}?vq=hd720" allowfullscreen></iframe>

                            <h5 style='padding-left:18px;'><b>Description</b></h5>

                            <p style='padding-left:18px;'>
                                {{$songDetail->description}}
                            </p>

                            <h5 style='padding-left:18px;'><b>Video Title</b></h5>

                            <p style='padding-left:18px;'>
                                {{$songDetail->title}}
                            </p>
                            <a style='padding-left:18px;' href='{{$songDetail->getSong->getSongDetailUrl()}}'>Song detail</a>


                        </div>
                    </div>
                <!-- /.widget-user -->
                </div>

            @endForeach
        </div>

    </section
@endSection
