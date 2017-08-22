
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
    <section>

            <div class='row'>


                <div class='content'>
                    <div class='col-xs-12'>
                        <div class="box box-primary">
                            <div class="box-header with-border">
                            <h3 class="box-title">Recently Update</h3>

                            <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                            </div>
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body">
                                <ul class="products-list product-list-in-box">



                                    <li class="item">
                                        <div class="product-img">
                                            <img src="dist/img/default-50x50.gif" alt="Product Image">
                                        </div>
                                        <div class="product-info">
                                            <h1><a  class="product-title">Saturday 19th August 2017</a></h1>
                                            <ol>
                                                <li>
                                                    new: welcome KAP!, including split functionality between kap and pelajar
                                                </li>
                                                <li>
                                                    new: auto schedule added per saturday, no need input manual
                                                </li>

                                            </ol>
                                        </div>
                                    </li>


                                    <li class="item">
                                        <div class="product-img">
                                            <img src="dist/img/default-50x50.gif" alt="Product Image">
                                        </div>
                                        <div class="product-info">
                                            <a  class="product-title">Saturday 19th August 2017</a>
                                            <ol>
                                                <li>
                                                    new: Forget password
                                                </li>
                                                <li>
                                                    new: now can see WL in each schedule
                                                </li>
                                                <li>
                                                    new: can see history of all schedule
                                                </li>
                                                <li>
                                                    update: View current schedule's arangement instead only showing latest arangement
                                                </li>
                                                <li>
                                                    update: remove save order in phone, so wont accidentaly click again
                                                </li>

                                            </ol>
                                        </div>
                                    </li>





                                    <li class="item">
                                        <div class="product-img">
                                            <img src="dist/img/default-50x50.gif" alt="Product Image">
                                        </div>
                                        <div class="product-info">
                                            <a  class="product-title">Monday 8th August 2017</a>
                                            <ol>
                                                <li>
                                                    update: Song lyric, Capitalize
                                                </li>
                                                <li>
                                                    udpate: Song we have, sort by alphabet
                                                </li>
                                                <li>
                                                    new: Song we have, Show history instead of mark of arangement! #important
                                                </li>
                                                <li>
                                                    new: All song in latest schedule, can view lyric in all song schedule
                                                </li>
                                                <li>
                                                    update: Recent Activity, reveal who deletes and changes schedule
                                                </li>
                                            </ol>
                                        </div>
                                    </li>


                                    <li class="item">
                                        <div class="product-img">
                                            <img src="dist/img/default-50x50.gif" alt="Product Image">
                                        </div>
                                        <div class="product-info">
                                            <a  class="product-title">Thursday 3rd August 2017</a>
                                            <ol>
                                                <li>
                                                    new: Add arangement, Automatically get youtube video's title, no need to insert title
                                                </li>
                                                <li>
                                                    update: Add arangement, Tackle same video code
                                                </li>
                                                <li>
                                                    new: Add arangement, picture guideline
                                                </li>
                                                <li>
                                                    new: New recent activities
                                                </li>

                                            </ol>
                                        </div>
                                    </li>






                                    <li class="item">
                                        <div class="product-img">
                                            <img src="dist/img/default-50x50.gif" alt="Product Image">
                                        </div>
                                        <div class="product-info">
                                            <a  class="product-title">Monday 31st July 2017</a>
                                            <ol>
                                                <li>
                                                    update: Search song, improve search algorithm for easier lookup in 10000+ songs. try it;)
                                                </li>
                                                <li>
                                                    update: Add song, Base reformating for title. Cannot add 'tiba saatnya2' anymore xD
                                                </li>
                                            </ol>
                                        </div>
                                    </li>














                                <!-- /.item -->
                                </ul>
                            </div>
                            <!-- /.box-body -->
                            <div class="box-footer text-center">

                            </div>
                        <!-- /.box-footer -->
                        </div>
                    </div>

                </div>




            {{-- row --}}
            </div>

    </section>

@endSection
