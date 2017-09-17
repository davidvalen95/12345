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
    <div class='content'>
        <div class='row'>
            <div class='col-xs-12'>
                <h2>Today read: <span>{{$sections}}</span></h2>

                @foreach ($alpetVerses as $alpetVerse)

                    @foreach ($alpetVerse->contents as $book)

                        @if($alpetVerse->type == VERSE_TYPE_VERSES)
                            <h3>{{$alpetVerse->rawReference}}</h3>
                        @else
                            <h3>{{$book->book}} {{$book->chapter}}</h3>
                        @endIf

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
    </div>


@endSection
