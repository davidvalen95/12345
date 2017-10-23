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






@endsection
