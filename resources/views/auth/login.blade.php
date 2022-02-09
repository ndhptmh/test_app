<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Log in</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="/adminlte/plugins/fontawesome-free/css/all.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="/adminlte/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="/adminlte/dist/css/adminlte.min.css">
</head>
<body class="hold-transition login-page" 
{{-- style="background-image: url('/assets/images/background.jpg');  
background-position: center;
background-repeat: no-repeat;
background-size: cover;"  --}}
>
    <div class="login-box">
        {{-- <div class="login-logo">
            <a href="/"><b>Lab</a>
        </div> --}}
    <!-- /.login-logo -->
        <div class="card">
            <div class="card-body login-card-body">
                <h3 class="text-center"><a href="/"> Test App</a></h3>
                <a class="btn btn-danger" style="margin:auto;
                display:block;" href="{{ route('login.provider', 'google') }}">Masuk dengan Menggunakan Google</a>
            </div>
            <!-- /.login-card-body -->
        </div>
    </div>
    <!-- /.login-box -->

    <!-- jQuery -->
    <script src="/adminlte/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="/adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="/adminlte/dist/js/adminlte.min.js"></script>
</body>
</html>
