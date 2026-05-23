<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>GLOBAL ACCOUNT SYSTEM</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('plugins/fontawesome-free/css/all.min.css')}}">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="{{asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('dist/css/adminlte.min.css')}}">
  
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <!-- /.login-logo -->
  <div class="card card-outline card-primary moii">
    <div class="card-header text-center">
      <a href="#" class="h1"><b>GLOBAL </b>ACCOUNT SYSTEM</a>
    </div>
    <div class="card-body">
      <p class="login-box-msg">EXCLUSIVE FOR DISTRIBUTORS</p>

@if(session()->has('status'))
                <div class="text-danger">
                    {{session('status')}}
                </div>
                @endif

      @if ($errors->any())
     @foreach ($errors->all() as $error)
     <div class="text-danger">
    {{ $error }}
           </div>
    @endforeach
@endif
      <form action="{{route('loginuser')}}" method="post"  enctype="multipart/form-data">
        @csrf
        <div class="input-group mb-3 d-flex flex-column">
          <label for="email" class="text-muted mb-0">User Id</label>
          <div class="input-group ">
            <input type="text" class="form-control" name="user_id" id="mail" onkeydown="updateMail()" placeholder="Enter User Id">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-envelope"></span>
              </div>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <label for="password" class="text-muted mb-0">Password</label>
          <div class="input-group ">
            <input type="password" class="form-control" name="password" id="pass" onkeydown="updatePass()" placeholder="Enter Password">
            <div class="input-group-append">
              <div class="input-group-text" style="cursor:pointer;" onclick="showPass()">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>
        </div>
        
        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" id="remember">
              <label for="remember">
                Remember Me
              </label>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" id="dimak" class="btn btn-primary btn-block" disabled>Sign In</button>
          </div>
          <!-- /.col -->
        </div>
      </form>
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
</div>
<!-- /.login-box -->
<script>
  function showPass(){
    document.getElementById('pass').type = "text";
    setTimeout(() => {
    document.getElementById('pass').type = "password";
    },2000);
  }

  let mail = false;
  let pass = false;

  function updateMail(){
    mail = true;
    check();
  }

  function updatePass(){
    pass = true;
    check();
  }

  function check(){
    if(mail == true && pass == true){
      document.getElementById('dimak').removeAttribute('disabled');
    }
  }

</script>
<!-- jQuery -->
<script src="{{asset('plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{asset('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('dist/js/adminlte.min.js')}}"></script>
</body>
</html>
