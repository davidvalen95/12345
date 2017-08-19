
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
        Schedule History
        </h1>
        <ol class="breadcrumb">
            <li><a href={{route('home')}}><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">History</li>
        </ol>
    </section>

    <section class="content">
        <div class='row'>

            <div class='col-xs-12'>
                <div class="box">
                    <div class="box-header">
                    <h3 class="box-title">Schedule History</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body no-padding">
                        <table class="table table-striped">
                            <tbody>
                                <tr>
                                    <th style="width: 10px">#</th>
                                    <th style="width: 100px">Date</th>
                                    <th style="">WL</th>
                                    <th>Songs</th>
                                </tr>
                                @php($i=1)
                                @foreach($schedules as $schedule)
                                    <tr>
                                        <td>{{$i++}}</td>
                                        <td>{{dateTimeToString($schedule->due)}}</td>
                                        <td>
                                            @php($wl = $schedule->getWorshipLeader)
                                            @if($wl!=null)
                                                {{$wl->setDefaultPreferences()->name}}
                                            @else
                                                No Data
                                            @endIf
                                        </div>
                                        </td>
                                        <td>
                                            <ol>
                                            @foreach($schedule->getSongDetail as $songDetail)
                                                @php($song = $songDetail->getSong->setDefaultPreferences())
                                                <li>
                                                    <a href='{{$song->getSongDetailUrl()}}'>{{$song->title}}</a>
                                                </li>
                                            @endForeach
                                            </ol>
                                        </td>
                                    </tr>
                                @endForeach


                            </tbody>
                        </table>
                    </div>
                <!-- /.box-body -->
                </div>
            </div>


        {{-- row --}}
        </div>
    </section>
@endSection
