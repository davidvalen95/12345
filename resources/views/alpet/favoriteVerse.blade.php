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
                recentHeart = $(this).attr('id');
            })

            $('#modalForm').submit(function(e){
                    e.preventDefault();
                    $('#modal-favorite').modal('hide');
                    $(`#${recentHeart}>i`).css('color','red');
                    $.ajax({
                        url:'{{route('post.verseFavorite')}}',
                        type:"POST",
                        data: $(this).serialize(),
                        success:function(result){
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

    </section>
    <section class='content'>


            @foreach ($groupedFavorites as $groupFavoriteKey => $groupFavoriteValue)
                <div class='row'>

                    <div id='parent{{$groupFavoriteKey}}'class='col-xs-12 col-lg-6'>

                        <div class="box box-warning collapsed-box">
                            <div class="box-header with-border">
                                <h3 class="box-title">{{$groupFavoriteKey}}</h3>

                                <div class="box-tools pull-right">
                                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                                    </button>
                                </div>
                                <!-- /.box-tools -->
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body" style="display: none;">
                                <ul class="products-list product-list-in-box">
                                    @foreach ($groupFavoriteValue as $favorite)
                                        <li class="item">
                                            <div class="product-img">
                                                {{-- <img src="dist/img/default-50x50.gif" alt="Product Image"> --}}
                                            </div>
                                            <div class="product-info">
                                                <a href="#" class="product-title">
                                                    {{$favorite->verse}}
                                                    <span class="label label-warning pull-right">{{dateTimeToString($favorite->created_at,'D, d-m-y')}}</span>
                                                </a>
                                                <p class="">
                                                    {{$favorite->content}}
                                                </p>
                                            </div>
                                        </li>
                                        <!-- /.item -->
                                    @endforeach

                                </ul>
                            </div>
                        <!-- /.box-body -->
                        </div>


                    {{-- colxs12 --}}
                    </div>
                {{-- row --}}
                </div>
            @endforeach


    </section>





@endSection
