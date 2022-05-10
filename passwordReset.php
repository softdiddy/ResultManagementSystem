<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>IBBUL SOFTWARE | Log in</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <script src="https://cdn.onesignal.com/sdks/OneSignalSDK.js" async=""></script>
<script>
  window.OneSignal = window.OneSignal || [];
  OneSignal.push(function() {
    OneSignal.init({
      appId: "9241943b-c190-4ff4-85d1-0924a25021bb",
      notifyButton: {
        enable: true,
      },
    });
  });
</script>
</head>
<body class="hold-transition login-page" style="background-color:white;">
<div class="login-box">
  <div class="login-logo">
    <img src="images/ibbulogo.jpeg" width="30%"/>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Reset Password</p>

      <div>
        <div class="input-group mb-3">
          <input type="email" class="form-control" placeholder="Enter your email Address" id="un">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
       
      </div>

      <div class="social-auth-links text-center mb-3">
		
        <a href="#" class="btn btn-block btn-success" onclick="resetPassword()">
          <i class="fas fa-lock"></i> Reset My Password
        </a>
       	<div id="error" ></div>
       <hr/>
       <b style="color:green;">Forgot Password?</b>
       <a href="index.php" style="color:green;">
           Signin
        </a>
      </div>
      <!-- /.social-auth-links -->

     
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<script src="build/js/out.js"></script>
</body>
</html>
