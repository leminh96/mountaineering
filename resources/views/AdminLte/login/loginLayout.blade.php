<!DOCTYPE html>
<html lang="en">
<head>

  @yield('head')
  
</head>
<body class="hold-transition login-page bg-image">
  <div class="fixed-block"></div>
    <div class="spans"></div>
        <div class="spans"></div>
        <div class="spans"></div>
        <div class="spans"></div>
        <div class="spans"></div>
        <div class="spans"></div>
        <div class="spans"></div>
        <div class="spans"></div>
        <div class="spans"></div>
        <div class="spans"></div>
<div class="login-box">
  <!-- /.login-logo -->
  @yield('content')
  <!-- /.card -->
</div>
<!-- /.login-box -->
<div class="modal fade" id="forgetPassword" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
      <div class="modal-content">
          <form action="{{ route('password.email') }}" method="POST" class="forgotPasswordForm">
              @csrf
          <div class="modal-body">


              <h3 class="display-8 mb-4 text-center text-hover">We will send password reset link to your email
              </h3>
              
                  <div class="form-group">
                      <input id="username" name="username" type="text" class="form-control form-input"
                          placeholder="Username" required>
                  </div>

                  
                  {{-- <button type="button" class="btn btn-link" data-bs-toggle="modal" data-bs-target="#forgotPasswordModal">
                  Forgot Password?
                </button> --}}

              


          </div>
          <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="submit"
              class="btn-custom btn btn-primary    request-button">Request</button>
          </div>
      </form>
      </div>
  </div>
</div>
@yield('script')
</body>
</html>
