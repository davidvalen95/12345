{{--
    objek
        schedules


--}}


<div class="box box-primary">
    <div class="box-body box-profile">
        <img class="profile-user-img img-responsive img-circle" src={{IMAGE_LOGO}} alt="User profile picture">

        <h3 class="profile-username text-center">Jadwal Musik</h3>


        {{-- navtab untuk jadwal --}}
        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
                @php($i=0)
                @foreach($schedules as $schedule)
                    {{-- {{debug($schedule->due->format('d-m-y'))}} --}}

                    <li class="@if($i==0)active @endIf"><a href="#schedule{{$i++}}" data-toggle="tab" aria-expanded="true">{{dateTimeToString($schedule->due)}}
                        @if(!$schedule->isExpired())
                            <span class='label label-success'><span class='fa fa-check'></span></span>

                        @endIf
                    </a></li>
                @endForeach
            </ul>
            <div class="tab-content">
                @php($i=0)
                @foreach($schedules as $schedule)

                    {{-- schedule tab --}}
                    <div class="tab-pane @if($i==0)active @endIf" id="schedule{{$i}}">

                        <p class="text-muted ">
                            {{-- {{dateTimeToString($schedule->due)}} --}}
                            @if($schedule->isExpired())
                                <span class='pull-right label label-danger'>Expired</span>

                            @endIf
                            <a href='{{action('ScheduleController@getAllSong')}}'>All Schedule's Songs</a>

                        </p>




                        {{-- <div class='callout callout-info'>
                            <h4>Add schedule</h4>
                            <p>
                                Open song page first, then add ;)
                            </p>

                        </div> --}}

                        <form action='{{route('post.reorder')}}' method='POST'>
                            {{csrf_field()}}
                            <ul class="list-group list-group-unbordered dragsort">
                                @php ($j=0 )
                                @foreach($schedule->getSongDetail()->orderBy('schedule_song_detail.order','asc')->get() as $songDetail)

                                    @php($song = $songDetail->getSong)
                                    @php($song->setDefaultPreferences())
                                    <li class="list-group-item">
                                        {{++$j}}.
                                        {{$song->title}} <a href={{$song->getSongDetailUrl()}} class="pull-right">detail ({{$song->getSongDetail->count()}})</a>
                            
                                    <input type='hidden' name='id[]' value='{{$songDetail->pivot->id}}'  />
                                    {{-- {{debug($songDetail->pivot->id)}} --}}
                                    </li>
                                @endForeach

                            </ul>
                            @if($i++==0)
                                <p>
                                    Drag and drop list to reorder song
                                </p>
                                <button class='btn btn-warning'>Save order</button>
                            @endIf
                        </form>
                    {{-- schedule tab --}}
                    </div>
                @endForeach


                <!-- tabcontent -->
            </div>

            <!-- nav tab -->
        </div>


        @if(App\Model\Schedule::getLatestSchedule()->isExpired())
            <button href="#" data-toggle='modal' data-target='#modal-add-schedule' class="btn btn-primary btn-block"><b>Add next schedule</b></button>
        @endIf
</div>
<!-- /.box-body -->
</div>


<script>
        $(".dragsort").dragsort();
</script>
