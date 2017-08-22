
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






        @foreach ($categories as $category)


            <div class='row'>

                <div class='col-xs-12'>


                    <div class="box collapsed-box  box-warning">
                        <div class="box-header with-border">
                            <h3 class="box-title"><img class='img img-circle' style='height:30px;width:30px;' src='{{$category->getImageLogo()}}'/>{{$category->setDefaultPreferences()->name}}</h3>

                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                                </button>
                            </div>
                        <!-- /.box-tools -->
                        </div>
                    <!-- /.box-header -->
                        <div class="box-body">
                            <table class="table table-striped">
                                <tbody>
                                    <tr>
                                        <th style="width: 10px">#</th>
                                        <th style="width: 100px">Date</th>
                                        <th style="">WL</th>
                                        <th>Songs</th>
                                    </tr>
                                    @php($i=1)
                                    @foreach($category->getSchedules()->orderBy('due','desc')->get() as $schedule)
                                        <tr>
                                            <td>{{$i++}}</td>
                                            <td>{{dateTimeToString($schedule->due)}} </td>
                                            <td>
                                                @php($wl = $schedule->getWorshipLeader)
                                                {{-- <b>{{$schedule->getCategory->setDefaultPreferences()->name}}</b>:  --}}
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






                    {{-- xs --}}
                    </div>


                {{-- row --}}
                </div>

            @endforeach


    </section>
@endSection
