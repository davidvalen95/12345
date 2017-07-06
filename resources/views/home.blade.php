@extends('layouts.master')

<!--
    $title
    $username

-->



@section('content')

  <!-- Content Wrapper. Contains page content -->

  <section class="content-header">
      <h1>
      Dashboard
      <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
          <li><a href={{route('home')}}><i class="fa fa-dashboard"></i> Home</a></li>
          <li class="active">Dashboard</li>
      </ol>
  </section>
    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
        <div class="row">
            <a href='https://google.com'>
                <a style='color:'href='https://docs.google.com/spreadsheets/d/1iSMUs-vzDJfl6NoKnWKkNYjVfv7HmtT_4f1H2fLXdws/edit?usp=sharing'><div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-yellow">
                    <span class="info-box-icon"><i class="fa fa-calendar"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Monthly Schedule</span>
                        <span class="info-box-number"></span>

                        <span class="progress-description">
                            Klik untuk jadwal bulanan
                        </span>
                    </div>
                    <!-- /.info-box-content -->
                    </div>
                <!-- /.info-box -->
                </div></a>
            </a>
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                <span class="info-box-icon bg-red"><i class="fa fa-music"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Total song</span>
                    <span class="info-box-number">{{App\Model\Song::count()}}</span>
                </div>
                <!-- /.info-box-content -->
                </div>
            <!-- /.info-box -->
            </div>
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                <span class="info-box-icon bg-aqua"><i class="fa fa-music"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Total Arangement</span>
                    <span class="info-box-number">{{App\Model\SongDetail::count()}}</span>
                </div>
                <!-- /.info-box-content -->
                </div>
            <!-- /.info-box -->
            </div>
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                <span class="info-box-icon bg-olive"><i class="fa fa-user"></i></span>

                <div class="info-box-content">

                    <?php $instruments = ['gitar','bass','keyboard','drum'];?>
                    @foreach($instruments as $instrument)
                    <span class="progress-description">{{ucwords($instrument)}}: {{App\User::where('instrument', '=' , $instrument)->get()->count()}}</span>

                    @endForeach
                    </div>
                <!-- /.info-box-content -->
                </div>
            <!-- /.info-box -->
            </div>






        <!-- row -->
        </div>
        <div class='row'>
            <div class="col-md-4 col-xs-12">
                <div class="box box-primary">
                <div class="box-body box-profile">
                    <img class="profile-user-img img-responsive img-circle" src={{IMAGE_LOGO}} alt="User profile picture">

                    <h3 class="profile-username text-center">Jadwal Musik</h3>

                    <p class="text-muted text-center">{{dateTimeToString($schedule->due,'D d-m-y')}}</p>

                    <ul class="list-group list-group-unbordered">
                        @php ($i=0 )



                        @foreach($songFromSchedule as $song)

                            @php($song->setDefaultPreferences())
                            <a href={{$song->getSongDetailUrl()}}><li class="list-group-item">
                                {{++$i}}.
                                <b>{{$song->title}}</b> <a href={{$song->getSongDetailUrl()}} class="pull-right">({{$song->getSongDetail->count()}})</a>
                            </li></a>
                        @endForeach

                    </ul>

                    <a href="#" class="btn btn-primary btn-block"><b>Add next schedule</b></a>
                </div>
                <!-- /.box-body -->
                </div>

            <!-- col3 -->
            </div>
                          <!-- /.box -->
            <div class="col-md-8 col-xs-12">
                <div class="box box-primary">
                    <div class="box-header">

                        <h3 class="box-title">Song we have</h3>
                        <div class="pull-right"><a href={{action('SongController@getNewSong')}} class='label bg-green'>Add song</a></div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body no-padding">
                        <table class="table table-striped">
                            <tbody>
                                <tr>
                                    <th style="width: 10px">#</th>
                                    <th>Title</th>
                                    <th>Mark</th>
                                    <th style='width:60px'>
                                        Arangement
                                    </th>
                                </tr>
                                @php($i=1)
                                @foreach($songs as $song)
                                    @php($song->setDefaultPreferences())
                                    <tr>
                                    {{-- buat logika warna --}}

                                        <td>{{$i++}}.</td>
                                        <td><a href={{$song->getSongDetailUrl()}}>{{$song->title}}</a></td>
                                        @php
                                            $count = $song->getSongDetail->count();
                                            if($count <=1 ){
                                                $progress = "danger";
                                                $bg = "red";
                                            }
                                            if($count >= 2 && $count <= 3 ){
                                                $progress = "yellow";
                                                $bg = "yellow";
                                            }
                                            if($count >=4 ){
                                                $progress = "green";
                                                $bg = "green";
                                            }

                                        @endphp
                                        <td>
                                            <div class="progress progress-xs">
                                                <div class="progress-bar progress-bar-{{$progress}}" style="width: {{$count/10*100}}%"></div>
                                            </div>
                                        </td>
                                        <td>
                                            <span class="badge bg-{{$bg}}">{{$count}}</span>
                                        </td>
                                    </tr>
                                @endForeach

                            </tbody>
                        </table>
                    </div>
                <!-- /.box-body -->
                </div>
            <!-- /.box -->
            </div>
        <!-- row table -->
        </div>
      <!-- /.row -->
      <!-- Main row -->


    </section>
    <!-- /.content -->


@endsection
