<style>
.content-wrappers {
    background: url('http://localhost/clients/2024/client-05/homeowners_association_management_system/laravel-app/public/plugins/images/bg.jpg') no-repeat center center;
    background-size: cover; /* Ensures the image covers the entire area */
    padding: 1.875rem 1.875rem 0 1.875rem;
    width: 100%;
    -webkit-flex-grow: 1;
    flex-grow: 1;
}

</style>
<div class="container-scroller">
  <div class="container-fluid page-body-wrapper full-page-wrapper">
    <div class="content-wrappers d-flex align-items-center auth px-0">
      <div class="row w-100 mx-0">
        <div class="col-lg-4 mx-auto">
          <div class="auth-form-light text-left py-5 px-4 px-sm-5">
            <h3 class="brand-logo text-center">
              <img src="<?= env('APP_URL') ?>public/plugins/images/logbg.jpg" alt="logo">
              {{-- Welcome to Subdivision Homeowners Association Management System --}}
            </h3>
            <h3 class="brand-logo text-center">Welcome to Subdivision Homeowners Association Management System</h3>
            {{-- <h6 class="font-weight-light">Sign in to continue.</h6> --}}
            <form method="POST" class="pt-3 register-form" id="login-form">
              <div class="form-group">
                <input type="text" class="form-control form-control-lg" id="exampleInputEmail1" name = "username" placeholder="Username">
              </div>
              <div class="form-group">
                <input type="password" class="form-control form-control-lg" id="exampleInputPassword1" name = "password" placeholder="Password">
              </div>
              <div class="mt-3">
                <button type="submit" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn">SIGN IN</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    <!-- content-wrapper ends -->
  </div>
  <!-- page-body-wrapper ends -->
</div>