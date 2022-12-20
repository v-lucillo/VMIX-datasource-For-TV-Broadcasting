
<!DOCTYPE html>
<html lang="en">
  <head>
    
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


    <title>VMIX Data Source</title>

    <!-- vendor css -->
    <link href="{{asset('admin/lib/fontawesome-free/css/all.min.css')}}" rel="stylesheet">
    <link href="{{asset('admin/lib/ionicons/css/ionicons.min.css')}}" rel="stylesheet">
    <link href="{{asset('admin/lib/typicons.font/typicons.css')}}" rel="stylesheet">
    <!-- azia CSS -->
    <link rel="stylesheet" href="{{asset('admin//css/azia.css')}}">
    <link rel="stylesheet" href="{{asset('jquery-toast-plugin-master/dist/jquery.toast.min.css')}}">
    <link rel="stylesheet" href="{{asset('sweetalert2.min.css')}}">
  </head>
  <body class="az-body">

    <div class="az-signin-wrapper">
      <div class="az-card-signin">
        <img src="https://upload.wikimedia.org/wikipedia/commons/d/d8/ManilaBctg.png">
        <h1 class=""><span></span>VMIX DATA SOURCE (<b><i>VDS</i></b>)</h1>
        <div class="az-signin-header">
          <h2>Welcome back!</h2>
          <h4>Please sign in to continue</h4>

          <form action="{{route('login')}}" method="POST">
            @csrf
            <div class="form-group">
              <label>Username</label>
              <input type="text" class="form-control" placeholder="Enter your username" name = "username">
            </div><!-- form-group -->
            <div class="form-group">
              <label>Password</label>
              <input type="password" class="form-control" placeholder="Enter your password" name = "password">
            </div><!-- form-group -->
            <button class="btn btn-az-primary btn-block">Sign In</button>
          </form>
        </div><!-- az-signin-header -->
       <!--  <div class="az-signin-footer">
          <p><a href="">Forgot password?</a></p>
          <p>Don't have an account? <a href="page-signup.html">Create an Account</a></p>
        </div> -->
        <!-- az-signin-footer -->
      </div><!-- az-card-signin -->
    </div><!-- az-signin-wrapper -->

    <script src="{{asset('admin/lib/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('admin/lib/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('admin//lib/ionicons/ionicons.js')}}"></script>
    <script src="{{asset('admin//js/jquery.cookie.js')}}" type="text/javascript"></script>
    <script src="{{asset('admin/js/jquery.cookie.js')}}" type="text/javascript"></script>
    <script type="text/javascript" src="{{asset('jquery-toast-plugin-master/dist/jquery.toast.min.js')}}"></script>
    <script src="{{asset('sweetalert2/sweetalert2.all.min.js')}}"></script>

    <script src="{{asset('admin//js/azia.js')}}"></script>
    <script>
      $(function(){
        'use strict'

      });
    </script>
    <script type="text/javascript">
      var login_error =  "{{$errors->any()}}";
      if(login_error){
        $.toast({
            heading: 'Error',
            text: "Invalid username or password",
            position: 'bottom-center',
            stack: false,
            hideAfter: 10000,
            icon: 'error'
        });
      }

      var access_warning =  "{{session('access_warning')}}";
      if(access_warning){
        Swal.fire(
          "Warning",
          access_warning,
          "warning"
        );
      }
    </script>
  </body>
</html>
