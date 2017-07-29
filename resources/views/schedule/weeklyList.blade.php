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

                {{-- detail --}}
                @php($i=0)
                @foreach($schedules as $schedule)

                    {{-- schedule tab --}}
                    <div class="tab-pane @if($i==0)active @endIf" id="schedule{{$i}}">

                        <p class="text-muted ">
                            {{-- {{dateTimeToString($schedule->due)}} --}}
                            @if($schedule->isExpired())
                                <span class='pull-right label label-danger'>Expired</span>

                            @endIf

                            <a href='{{action('ScheduleController@getAllSong')}}'>All latest schedule's songs</a>

                        </p>



                        <form action='{{route('post.reorder')}}' method='POST'>
                            {{csrf_field()}}
                            <ul class="list-group list-group-unbordered @if(!$schedule->isExpired())dragsort @endIf">
                                @php ($j=0 )
                                @foreach($schedule->getSongDetail()->orderBy('schedule_song_detail.order','asc')->get() as $songDetail)

                                    @php($song = $songDetail->getSong)
                                    @php($song->setDefaultPreferences())
                                    <li class="list-group-item">
                                        {{++$j}}.
                                        <a href={{$song->getSongDetailUrl()}} class="">{{$song->title}} ({{$song->getSongDetail->count()}})</a>
                                        @if(!$schedule->isExpired())
                                            <button type='button' data-toggle="modal" data-target="#modal-schedule-{{$songDetail->id}}"  class="btn btn-default label pull-right bg-red">Remove <span class='fa fa-times'></span></button>

                                        @endIf









                                    <input type='hidden' name='id[]' value='{{$songDetail->pivot->id}}'  />
                                    {{-- {{debug($songDetail->pivot->id)}} --}}
                                    </li>
                                @endForeach

                            </ul>

                            @if(!$schedule->isExpired() && $i==0)
                                <p>
                                    Drag and drop list to reorder song
                                </p>
                                <button class='btn btn-warning'>Save order</button>
                            @endIf
                            @php($i++)
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





{{-- modal delete --}}
@foreach(APP\Model\Schedule::getLatestSchedule()->getSongDetail as $songDetail)
<div class="modal fade" id="modal-schedule-{{$songDetail->id}}">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Confirmation</h4>
            </div>
            <div class="modal-body">
                <p>
                    Remove <b>{{$songDetail->getSong->title}}</b> from schedule?
                </p>


            </div>
            <div class="modal-footer">
                <form class='pull-right' method='POST' action='{{route('delete.scheduleSongDetail')}}'>
                    {{method_field('DELETE')}}
                    {{csrf_field()}}
                    <input type='hidden' name='schedule_id' value='{{$songDetail->pivot->schedule_id}}'/>
                    <input type='hidden' name='song_detail_id' value='{{$songDetail->id}}'/>
                    <button type="submit" class="btn btn-danger ">Remove</button>

                </form>
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">cancel</button>

            </div>
        </div>
    <!-- /.modal-content -->
    </div>
<!-- /.modal-dialog -->
</div>
@endForeach







    {{-- modal tambah schedule--}}
    <div class="modal fade" id="modal-add-schedule" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span></button>
                    <h4 class="modal-title">Add schedule</h4>
                </div>
                <form action={{route('post.schedule')}} method='post'>
                    {{csrf_field()}}
                    <div class="modal-body">
                        @php($scheduleForm = new App\Helper\Form("Play date", 'due', 'datepicker', ""))
                        {!!$scheduleForm->getFormFormat($errors)!!}


                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Add schedule</button>
                    </div>
                </form>
            </div>
        <!-- /.modal-content -->
        </div>
    <!-- /.modal-dialog -->
    </div>




<script>
        // (function ($){
        //     /* plugin code */
        // })(jQuery);
        $old(".dragsort").dragsort();
        // alert();
</script>
