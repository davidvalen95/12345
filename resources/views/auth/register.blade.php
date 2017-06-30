



@include('layouts.header')



<body class="hold-transition register-page">
<div class="register-box">
  <div class="register-logo">
    <a href="../../index2.html"><?php echo TITLE;?></a>
  </div>

  <div class="register-box-body">
    <p class="login-box-msg">Register a new membership</p>


    <form action="{{route('register')}}" method="post">
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
        <div class="col-xs-12">
          <button type="submit" class="mCenter btn btn-primary btn-block btn-flat">Register</button>
        </div>
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
