@extends('layouts.master')

<!--
    $title
    $username

    objek
        schedules:Schedule
-->



@section('content')

  <!-- Content Wrapper. Contains page content -->


  {{-- statistics atas --}}
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
                    <span class="info-box-text">Statistic</span>
                    <span class="progress-description">Total song: <b>{{App\Model\Song::count()}}</b></span>
                    <span class="progress-description">Total arangement: <b>{{App\Model\SongDetail::count()}}</b></span>
                    {{-- <span class="info-box-number">{{App\Model\Song::count()}}</span> --}}
                </div>
                <!-- /.info-box-content -->
                </div>
            <!-- /.info-box -->
            </div>
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                <span style='height:130px;' class="info-box-icon "><img src={{IMAGE_LOGO_KAP}} class="img-circle" style='width:70px;height:70px;'alt="User Image"></span>

                <div class="info-box-content">
                    @php($instruments = ['Gitar','Bass','Keyboard','Drum','Singer','Ava'])
                    @foreach($instruments as $instrument)
                    <span class="progress-description">{{ucwords($instrument)}}: <b>{{App\Model\Category::find(2)->getUsers->where('instrument',$instrument)->count()}}</b></span>

                    @endForeach
                </div>
                <!-- /.info-box-content -->
                </div>
            <!-- /.info-box -->
            </div>
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div style='height:100%;' class="info-box">
                    <span style='height:130px;' class="info-box-icon "><img src={{IMAGE_LOGO}} class="img-circle" style='width:70px;height:70px;'alt="User Image"></span>


                <div class="info-box-content">

                    @php($instruments = ['Gitar','Bass','Keyboard','Drum','Singer','Ava'])
                    @foreach($instruments as $instrument)
                    <span class="progress-description">{{ucwords($instrument)}}: <b>{{App\Model\Category::find(1)->getUsers->where('instrument',$instrument)->count()}}</b></span>

                    @endForeach
                    </div>
                <!-- /.info-box-content -->
                </div>
            <!-- /.info-box -->
            </div>





        {{-- jadwal mingguan kiri --}}
        <!-- row -->
        </div>
        <div class='row'>
            <div class="col-md-4 col-xs-12">


                                {{-- history --}}
                                <div class="box box-primary direct-chat direct-chat-primary">
                                    <div class="box-header with-border">
                                        <h3 class="box-title">Recent Activities</h3>

                                        <div class="box-tools pull-right">
                                            {{-- <span data-toggle="tooltip" title="" class="badge bg-yellow" data-original-title="3 New Messages">3</span>
                                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                            <button type="button" class="btn btn-box-tool" data-toggle="tooltip" title="" data-widget="chat-pane-toggle" data-original-title="Contacts">
                                                <i class="fa fa-comments"></i>
                                            </button>
                                            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i>
                                            </button> --}}
                                        </div>
                                    </div>
                                    <!-- /.box-header -->
                                    <div class="box-body">
                                        <!-- Conversations are loaded here -->

                                        <div class="direct-chat-messages">
                                            @foreach($events as $event)

                                                    @php($isMe = ($event->getUser == Auth::user()))

                                                    <!-- Message. Default to the left -->
                                                    <div class="direct-chat-msg @if(!$isMe)right @endIf">
                                                        <div class="direct-chat-info clearfix">
                                                            <span class="direct-chat-name pull-left">{{$event->getUser->setDefaultPreferences()->name}}</span>
                                                            <span class="direct-chat-timestamp pull-right">{{dateTimeToString($event->created_at,'D d-M H:i:s')}}</span>
                                                        </div>
                                                        <!-- /.direct-chat-info -->
                                                        {{-- <img class="direct-chat-img" src="dist/img/user1-128x128.jpg" alt="message user image"> --}}
                                                        <!-- /.direct-chat-img -->
                                                        <div class="direct-chat-text">
                                                            {!!$event->detail!!}
                                                        </div>
                                                        <!-- /.direct-chat-text -->
                                                    </div>
                                                    <!-- /.direct-chat-msg -->


                                                {{-- the message --}}

                                            @endForeach

                                        </div>



                                    {{-- body --}}
                                    </div>

                                    <div class="box-footer">

                                    {{-- footer --}}
                                    </div>

                                    </div>


                            {{-- endHistory --}}





                @include('schedule.weeklyList')
            <!-- col3 -->
            </div>






            {{-- list lagu --}}
            {{-- {{debug($songs->hasMorePages())}} --}}
                          {{-- <!-- /.box -->{{debug(old('songSearch'))}} --}}
            <div class="col-md-8 col-xs-12">
                <div class="box box-primary">
                    <div class="box-header">

                        <h3 class="box-title">Song we have</h3>
                        <div style='display: inline;' class=""><a href={{action('SongController@getNewSong')}} class='label bg-green'>Add song</a></div>

                        <div class="box-tools">
                            <form action='' method='post'>
                                {{csrf_field()}}
                                <div class="input-group input-group-sm" style="width: 250px;">



                                    <input name="songSearch" value="{{old('songSearch')}}" class="form-control pull-right" placeholder="Search by lyric / title" type="text">

                                    <div class="input-group-btn">
                                        <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                                    </div>
                                </div>
                            </form>
                        </div>

                    {{-- boxheader --}}
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



                    <div class="box-footer clearfix">
                        {!!pagination($songs)!!}
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
