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
@php
function isExistKeyValue($array, $key, $val)
{
    foreach ($array as $item)
        {
            if (is_array($item) && isExistKeyValue($item, $key, $val)) return true;

            if (isset($item[$key]) && $item[$key] == $val) return true;
        }

    return false;
}
@endphp
@extends('layouts.master')

@section('script')
    <script>
        $(document).ready(function(){
            var recentHeart = '';
            $('.myModal').click(function(){
                var fullReference = $(this).data('full-reference');
                var id = $(this).data('target-id');
                var content = $(`#${id}`).html();
                $('#modalVerseContent').html(content);
                $('#modalFullReference').html(fullReference);
                $('#modalInputContent').val(content);
                $('#modalInputFullReference').val(fullReference);
                var comment = $('#modalInputComment').val('');

                recentHeart = $(this).attr('id');
            })
            $('.tag').click(function(){
                $('#modalInputComment').val($(this).html());
            })
            $('#modalForm').submit(function(e){
                    e.preventDefault();
                    $(`#${recentHeart}>i`).css('color','#ca0101');
                    var comment = $('#modalInputComment').val();
                    if(comment == ''){
                        alert('Tag must be filled');
                        $(`#${recentHeart}>i`).css('color','#e0e0e0');
                        return;
                    }
                    $('#modal-favorite').modal('hide');
                    $.ajax({
                        url:'{{route('post.verseFavorite')}}',
                        type:"POST",
                        data: $(this).serialize(),
                        success:function(result){
                            $
                        },
                        error: function(result){
                            alert("Something is wrong, cannot add to favorite");
                            $(`#${recentHeart}>i`).css('color','#e0e0e0');

                        }
                    });

            });
        })
    </script>
@endSection

@section('content')
    <section class="content-header">
        @php($currentYear =  dateTimeToString(getDefaultDatetime(),"Y"))
        <h1>{{dateTimeToString(getDefaultDatetime("$day-$month-$currentYear"),"D, d-M")}}</h1>
        <h4>{{$sections}} <small>{{strToUpper($version)}}</small></h4>
        <a href='{{route('get.alpet')}}'>Open <b>Today's Alpet</b></a>
        <a style='display:block' href='{{route('get.favoriteVerse')}}'>See my <i style='color:#ca0101;' class="fa fa-heart" aria-hidden="true"></i> verses</a>
    </section>
    <section class='content'>

        <div class='row'>

            <div id='parent'class='col-xs-12 col-lg-6'>


                @foreach ($alpetVerses as $alpetVerse)

                    @foreach ($alpetVerse->contents as $book)


                        <div id='{{$book->book}}{{$book->chapter}}Panel' class="box box-default">
                            <a data-toggle="collapse" data-parent="#parent" href="#target-{{$book->book}}{{$book->chapter}}Panel" aria-expanded="false" class="collapsed">
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
                            <div id="target-{{$book->book}}{{$book->chapter}}Panel" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
                                <div class="box-body" style='font-size:16px;'>
                                    @php($i=0)
                                    @foreach($book->completeChapter as $currentJson)
                                            {{-- @php(debug($currentJson)); --}}
                                            <div class='row'>

                                                <div class='col-xs-12'>
                                                    @if($currentJson->type == "verse")
                                                        @php $id = "$book->book{$i}"; $i++;@endPhp


                                                        @if(Auth::check())
                                                            @php
                                                                $ids = array_column(array($favorites), 'id', 'id');
                                                                $color =   isExistKeyValue((array) $favorites,'verse',$currentJson->fullReference) ? "#cc0101" : "#e0e0e0";
                                                                $modal =   isExistKeyValue((array) $favorites,'verse',$currentJson->fullReference) ? "" : "modal";
                                                            @endphp

                                                            <a id='{{$id}}Heart'  href='#'  data-target-id='{{$id}}' data-full-reference='{{$currentJson->fullReference}}'  data-toggle="{{$modal}}" data-target="#modal-favorite"  class="myModal pull-left">
                                                                <i style='color:{{$color}}' class="fa fa-heart" aria-hidden="true"></i>
                                                            </a>
                                                        @else
                                                            <a class=" pull-left" href='{{route('login')}}'><i style='color:#e0e0e0' class="fa fa-heart" aria-hidden="true"></i></a>
                                                        @endIf
                                                        <p class='' style="margin-bottom:22px;padding-left:30px;">
                                                            <a href='http://alkitab.mobi/tb/{{$book->book}}/{{$book->chapter}}/{{$currentJson->verse}}/'><b>{{$currentJson->verse}}. </b></a>
                                                            <span id='{{$id}}'>{{$currentJson->content}}</span>

                                                        </p>

                                                    @elseif ($currentJson->type == "title")
                                                        <p class='text-center'><b >{{$currentJson->content}}</b></p>
                                                    @endIf
                                                    {{-- @php(debug($currentContent->content)) --}}
                                                {{-- col12 --}}
                                                </div>
                                            {{-- row --}}
                                            </div>

                                    @endForeach
                                </div>
                            <!-- /.box-body -->
                            </div>
                        </div>




                    @endforeach
                    {{-- <h3>{{$alpetVerse->book}}</h3> --}}
                @endforeach
            </div>
        </div>
    </section>


    {{-- modal favorite --}}
    <div class="modal fade" id="modal-favorite">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span></button>
                    <h4 class="modal-title">Favorite this</h4>
                </div>
                <form method='POST' action='{{route('post.verseFavorite')}}' role='form' id='modalForm'>

                    <div class="modal-body">
                        <h4 id='modalFullReference'></h4>
                        <p id='modalVerseContent'>

                        </p>
                            {{csrf_field()}}
                            <input type='hidden' id='modalInputFullReference' name='verse' value=''/>
                            <input type='hidden' id='modalInputContent' name='content' value=''/>
                            <div class='box-body'>
                                <div class='form-group'>
                                    <label>Tag, about this verse</label>
                                    <input id='modalInputComment' class="form-control" placeholder='Ex. mengampuni, kesabaran, menurut pada boss dll' name='comment' type="text" />
                                </div>
                            </div>
                            <div class='row'>
                                <div class='col-xs-12'>
                                    <h5><b>Your tags history</b> </h5>
                                    <p>
                                        click this to automatically fill the tag field
                                    </p>
                                    @php($defaultTags = ['Kesabaran','Pengampunan','Kasih'])
                                    @foreach ($tags as $tag)
                                        @php($tag->comment = ucwords($tag->comment))
                                        <a  style='display:inline-block;margin-right:10px' href='#' class='tag btn btn-default'>{{$tag->comment}}</a>
                                    @endforeach
                                    @foreach ($defaultTags as $tag)
                                        <a  style='display:inline-block;margin-right:10px' href='#' class='tag btn btn-default'>{{$tag}}</a>
                                    @endforeach
                                </div>
                            </div>
                    {{-- modal body --}}
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success ">Add to my favorite</button>
                        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">cancel</button>
                    </div>
                </form>

            </div>
        <!-- /.modal-content -->
        </div>
    <!-- /.modal-dialog -->
    </div>



@endSection
