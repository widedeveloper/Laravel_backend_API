<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Admin</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
 

  <link rel="stylesheet" href="{{asset('assets/bootstrap/css/bootstrap.min.css')}}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- DataTables -->
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('assets/dist/css/AdminLTE.min.css')}}">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="{{asset('assets/dist/css/skins/_all-skins.min.css')}}">

  <!-- <script> -->

<!-- jQuery 2.2.3 -->
<script src="{{asset('assets/plugins/jQuery/jquery-2.2.3.min.js')}}"></script>
<!-- Bootstrap 3.3.6 -->
<script src="{{asset('assets/bootstrap/js/bootstrap.min.js')}}"></script>
<!-- DataTables -->
<script src="{{asset('assets/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('assets/plugins/datatables/dataTables.bootstrap.min.js')}}"></script>
<!-- SlimScroll -->
<script src="{{asset('assets/plugins/slimScroll/jquery.slimscroll.min.js')}}"></script>
<!-- FastClick -->
<script src="{{asset('assets/plugins/fastclick/fastclick.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('assets/dist/js/app.min.js')}}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{asset('assets/dist/js/demo.js')}}"></script>
</head>
<body class="hold-transition register-page">
<div class="register-box">
  <div class="register-logo">
    <a href="./assets/index2.html"><b>Admin SignUp</b></a>
  </div>

  <div class="register-box-body">
    <p class="login-box-msg">Register a new membership</p>

    <form action="{{route('register')}}" method="post">
    {{ csrf_field() }}

        <div class="form-group has-feedback {{ $errors->has('name') ? ' has-error' : '' }}">
            <input type="text" name="name" class="form-control" placeholder="User name">
            @if ($errors->has('name'))
                <span class="help-block">
                    <strong>{{ $errors->first('name') }}</strong>
                </span>
            @endif
            <span class="glyphicon glyphicon-user form-control-feedback"></span>
        </div>

        <div class="form-group has-feedback">
            <input type="email" name="email" class="form-control" placeholder="Email">
            @if ($errors->has('email'))
                <span class="help-block">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
            @endif
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
        </div>

        <div class="form-group has-feedback {{ $errors->has('password') ? ' has-error' : '' }}">
            <input type="password" name="password" class="form-control" placeholder="Password">
            @if ($errors->has('password'))
                <span class="help-block">
                    <strong>{{ $errors->first('password') }}</strong>
                </span>
            @endif
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
        </div>
        <div class="form-group has-feedback">
            <input type="password" name="password_confirmation" class="form-control" placeholder="Retype password">
            <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
        </div>
        <div class="row">
            <div class="col-xs-8">
            <div class="checkbox icheck">
                <label>
                <input type="checkbox"> I agree to the <a href="#">terms</a>
                </label>
            </div>
            </div>
            <!-- /.col -->
            <div class="col-xs-4">
            <button type="submit" class="btn btn-primary btn-block btn-flat">Register</button>
            </div>
            <!-- /.col -->
        </div>
    </form>

    <a href="{{route('login')}}" class="text-center">I already have a membership</a>
  </div>
  <!-- /.form-box -->
</div>
<!-- /.register-box -->

<!-- jQuery 2.2.3 -->
<script src="./assets/plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="./assets/bootstrap/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="./assets/plugins/iCheck/icheck.min.js"></script>
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
