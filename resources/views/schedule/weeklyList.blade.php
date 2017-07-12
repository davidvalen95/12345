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

                    <li class="@if($i==0)active @endIf"><a href="#schedule{{++$i}}" data-toggle="tab" aria-expanded="true">{{dateTimeToString($schedule->due)}}
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
                    <div class="tab-pane @if($i==0)active @endIf" id="schedule{{++$i}}">

                        <p class="text-muted text-center">{{dateTimeToString($schedule->due)}}
                            @if($schedule->isExpired())
                                <span class='label label-danger'>Expired</span>

                            @endIf
                        </p>
                        <a href='{{action('ScheduleController@getAllSong')}}'>All Schedule's Songs</a>



                        {{-- <div class='callout callout-info'>
                            <h4>Add schedule</h4>
                            <p>
                                Open song page first, then add ;)
                            </p>

                        </div> --}}

                        <form >
                            {{csrf_field()}}
                            <ul class="list-group list-group-unbordered dragsort">
                                @php ($j=0 )
                                @foreach($schedule->getSongDetail as $songDetail)

                                    @php($song = $songDetail->getSong)
                                    @php($song->setDefaultPreferences())
                                    <li class="list-group-item"><a href={{$song->getSongDetailUrl()}}>
                                        {{++$j}}.
                                        <b>{{$song->title}}</b> <a href={{$song->getSongDetailUrl()}} class="pull-right">({{$song->getSongDetail->count()}})</a>
                                    </a>
                                    <input type='hidden' name='id' value='{{$songDetail->pivot->id}}'  />
                                    {{-- {{debug($songDetail->pivot->id)}} --}}
                                    </li>
                                @endForeach

                            </ul>
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
