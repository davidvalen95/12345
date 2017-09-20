{{--
    variable
        title
        danger
        success


    object
        user


    section
        content



--}}
@extends('layouts.master')


@section('content')
    <section class="content-header">
        <h1>{{dateTimeToString(getDefaultDatetime("$day-$month-2004"))}}</h1>
        <h4>{{$sections}} <small>{{strToUpper($version)}}</small></h4>
    </section>
    <section class='content'>

        <div class='row'>

            <div id='parent'class='col-xs-12 col-lg-6'>


                @foreach ($alpetVerses as $alpetVerse)

                    @foreach ($alpetVerse->contents as $book)

                        {{-- @if($alpetVerse->type == VERSE_TYPE_VERSES) --}}

                    {{-- <div class="box box-solid">
                    <div class="box-header with-border">
                    <h3 class="box-title">Collapsible Accordion</h3>
                    </div>
                    <!-- /.box-header -->
                        <div class="box-body">
                            <div class="box-group" id="accordion">
                            <!-- we are adding the .panel class so bootstrap.js collapse plugin detects it -->
                                <div class="panel box box-primary">
                                    <div class="box-header with-border">
                                    <h4 class="box-title">
                                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="false" class="collapsed">
                                    Collapsible Group Item #1
                                    </a>
                                    </h4>
                                    </div>
                                    <div id="collapseOne" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
                                    <div class="box-body">
                                    Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3
                                    wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum
                                    eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla
                                    assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred
                                    nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer
                                    farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus
                                    labore sustainable VHS.
                                    </div>
                                    </div>
                                    </div>

                            </div>
                        </div>
                    <!-- /.box-body -->
                    </div> --}}

                        <div id='{{$book->book}}{{$book->chapter}}' class="box box-default">
                            <a data-toggle="collapse" data-parent="#parent" href="#target-{{$book->book}}{{$book->chapter}}" aria-expanded="false" class="collapsed">
                                <div class="box-header with-border">

                                    <h3 class="box-title text-center">

                                        @if($alpetVerse->type == VERSE_TYPE_VERSES)
                                            {{$alpetVerse->getReadable()}}
                                        @elseif ($alpetVerse->type == VERSE_TYPE_PASAL)
                                            {{$book->book}} {{$book->chapter}}
                                        @endIf
                                        <small>{{strToUpper($version)}}</small>

                                    </h3>
                                </div>
                            </a>
                        <!-- /.box-header -->
                            <div id="target-{{$book->book}}{{$book->chapter}}" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
                                <div class="box-body" style='font-size:15px;'>

                                    @foreach($book->completeChapter as $currentJson)
                                            {{-- @php(debug($currentJson)); --}}
                                            @if($currentJson->type == "verse")
                                                <p style="margin-bottom:22px">
                                                    <a href='http://alkitab.mobi/tb/{{$book->book}}/{{$book->chapter}}/{{$currentJson->verse}}/'><b>{{$currentJson->verse}}. </b></a>
                                                    <span>{{$currentJson->content}}</span>
                                                </p>
                                            @elseif ($currentJson->type == "title")
                                                <p class='text-center'><b >{{$currentJson->content}}</b></p>
                                            @endIf
                                            {{-- @php(debug($currentContent->content)) --}}

                                    @endForeach
                                </div>
                            <!-- /.box-body -->
                            </div>
                        </div>

                        {{-- <h3 class='text-center'>
                            @if($alpetVerse->type == VERSE_TYPE_VERSES)
                                {{$alpetVerse->getReadable()}}
                            @elseif ($alpetVerse->type == VERSE_TYPE_PASAL)
                                {{$book->book}} {{$book->chapter}}
                            @endIf

                        </h3> --}}


                        {{-- @php(debug()); --}}



                    @endforeach
                    {{-- <h3>{{$alpetVerse->book}}</h3> --}}
                @endforeach
            </div>
        </div>
    </section>


@endSection
