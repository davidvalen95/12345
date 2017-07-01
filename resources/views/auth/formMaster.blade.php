



@include('layouts.header')

{{--

    yield
        formTitle
        action buat formw
        button  <button type="submit" class="mCenter btn btn-primary btn-block btn-flat">Register</button>

--}}

<body class="hold-transition register-page">
<div class="register-box">
  <div class="register-logo">
    <a href="../../index2.html">{{TITLE}}</a>
  </div>

  <div class="register-box-body">
    <p class="login-box-msg">@yield('formTitle')</p>


    <form action="@yield('action')" method="post">
      <input type="hidden" name="_token" value="{{ csrf_token() }}">

      <?php
      $i=0;

      foreach($forms as $form){

        echo $form->getFormFormat($i,$errors);
        $i++;
      }



      ?>
      <div class="row">

        <!-- /.col -->

            @yield('button')

        <!-- /.col -->
      </div>
    </form>
  </div>
  <!-- /.form-box -->
</div>
<!-- /.register-box -->

<!-- jQuery 3.1.1 -->
<script src="../../plugins/jQuery/jquery-3.1.1.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="../../bootstrap/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="../../plugins/iCheck/icheck.min.js"></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' // optional
    });
  });
</script>
</body>
</html>
