@extends('layouts.master')

<!--
    $songTitle
    $username

    objek
        schedules:Schedule
        $user (dari master)
-->


@section('content')
    <section class='content'>
        <div class='row'>
            <div class=' col-md-6 col-xs-12'>
                <form action='{{route('post.emailDraft')}}' method='POST' >
                    {{csrf_field()}}
                    <div class='form-group'>
                        <label>Subject</label>
                        <input name='subject' class='form-control' />
                    </div>
                    <div class='form-group'>
                        <label>Text Message</label>
                        <textarea name='textMessage' class='form-control'></textarea>
                    </div>
                    <div class='form-group'>
                        <label>isDebug</label>
                        <input name='isDebug' type='radio'  value='0'  />false
                        <input checked="checked" name='isDebug' type='radio' value='1' /> true
                    </div>
                    <button class='btn btn-success'>Send</button>
                </form>

            </div>

        </div>
        <div class='row'>
            <div class='col-md-6 col-xs-12'>
                <ul>
                    <li>
                        \{\{name\}\}
                    </li>
                </ul>
            </div>
        </div>
    </section>

    @php
        define("name",'name');
    @endphp
    <div style='text-align:center'>
        <p style='font-size:18px;'>
            Hallo <b>David</b> !!
        </p>
        <p style='font-size:8px;color:#9f9f9f;'>
            Yang tadi salah nama xD maap ye
        </p>
        <p style='font-size:15px;color:#9f9f9f;'>
            Udah baca alpet blm hari ini??
        </p>
        <p style='14px'>
            Ada fitur baru dari gbzworshipper.com yaitu baca alpet ga pake ribet. lgsg buka dan baca ayat2 untuk hari ini.. klik link di bawah ini ya
        </p>
        <a href='http://gbzworshipper.com/alpet' style='margin-top:16px; display: inline-block; text-align:center;background-color:#7D56A9;color:white; padding:10px'>Alpet hari ini</a>

    </div>







    <div style='text-align:center'>
        <p style='font-size:18px;'>
            Hallo lagi, <b>{{name}}</b>
        </p>
        <p style='font-size:15px;color:#9f9f9f;'>
            Ada fitur baru lagi
        </p>
        <p style='font-size:14px'>
            Kamu sekarang bisa nge-save ayat-ayat favorit waktu lagi baca alpet. Jadi ayat itu akan disimpen di idmu. Kamu bisa melihat ayat favoritmu kapanpun
        </p>
        <p style='font-size:14px'>
            Ayat akan dikelompokan sesuai <b><i>Tag</i></b> jadi memudahkan untuk di baca ulang, kamu harus <b>login dulu ya</b> biar bisa save
        </p>

        <div style=';display:block;margin:30px auto; max-width:250px;'>
            <p style='font-size:16px'>
                Langkah satu klik hati disebelah ayat
            </p>
            <img style='border:1px solid #5b5b5b; width: 100%;margin-bottom:14px' src='http://gbzworshipper.com/images/alpet/1.png'/>
            <p style='font-size:16px'>
                Langkah dua, isi tag untuk tagging ayat, atau bisa klik tombol tag yang tersedia
            </p>
            <img style='border:1px solid #5b5b5b; width: 100%;margin-bottom:14px' src='http://gbzworshipper.com/images/alpet/2.png'/>
            <p style='font-size:16px'>
                Langkah tiga, buka ayat favoritmu di menu
            </p>
            <img style='border:1px solid #5b5b5b; width: 100%;margin-bottom:14px' src='http://gbzworshipper.com/images/alpet/3.png'/>
            <p style='font-size:16px'>
                Langkah empat, Ayat di kelompokan sesuai tag untuk memudahkan membaca
            </p>
            <img style='border:1px solid #5b5b5b; width: 100%;margin-bottom:14px' src='http://gbzworshipper.com/images/alpet/4.png'/>

        </div>
        <p style='font-size:13px;color:#9f9f9f;'>
            Happy alpeting
        </p>
        <p style='font-size:12px;color:#9f9f9f;'>
            <i>"Tetapi yang terutama: kasihilah sungguh-sungguh seorang akan yang lain, sebab kasih menutupi banyak sekali dosa."</i>

        </p>
        <a href='http://gbzworshipper.com/alpet' style='margin-top:16px; display: inline-block; text-align:center;background-color:#7D56A9;color:white; padding:10px'>Lihat alpet hari ini</a>

    </div>






@endsection
