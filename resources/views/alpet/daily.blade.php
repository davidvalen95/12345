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
        <h1>Alpet: {{dateTimeToString(getDefaultDatetime())}}<small>{{$sections}}</small></h1>

    </section>
    <section class='content'>

        <div class='row'>

            <div class='col-xs-12'>


                @foreach ($alpetVerses as $alpetVerse)

                    @foreach ($alpetVerse->contents as $book)

                        {{-- @if($alpetVerse->type == VERSE_TYPE_VERSES) --}}
                            <h3>{{$alpetVerse->getReadable()}}</h3>


                        @foreach($book->completeChapter as $currentJson)
                            <p>
                                @if($currentJson->type == "verse")
                                    <b>{{$currentJson->verse}}. </b>
                                    <span>{{$currentJson->content}}</span>
                                @elseif ($currentJson->type == "title")
                                    <b>{{$currentJson->content}}</b>
                                @endIf
                                {{-- @php(debug($currentContent->content)) --}}
                            </p>
                        @endForeach


                    @endforeach
                    {{-- <h3>{{$alpetVerse->book}}</h3> --}}
                @endforeach
            </div>
        </div>
    </section>


@endSection
