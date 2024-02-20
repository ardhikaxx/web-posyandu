<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login | Posyandu</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v6.0.0/css/all.css" />
    <link rel="stylesheet" href="{{asset('login/assets/vendor/fonts/boxicons.css')}}" />
    <link rel="stylesheet" href="{{asset('login/assets/vendor/css/core.css')}}" class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{asset('login/assets/vendor/css/theme-default.css')}}" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{asset('login/assets/css/demo.css')}}" />
    <link rel="stylesheet" href="{{asset('login/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css')}}" />
    <link rel="stylesheet" href="{{asset('login/assets/vendor/css/pages/page-auth.css')}}" />
    <script src="{{asset('login/assets/vendor/js/helpers.js')}}"></script>
    <script src="{{asset('login/assets/js/config.js')}}"></script>
</head>

<body>
    <div class="container-xxl">
        <div class="authentication-wrapper authentication-basic container-p-y">
          <div class="authentication-inner">
            <!-- Register -->
            <div class="card">
              <div class="card-body">
                <!-- Logo -->
                <div class="app-brand justify-content-center">
                  <a href="index.html" class="app-brand-link gap-2">
                    <span class="app-brand-logo demo">
                      <img src="{{asset('assets/images/logobiru.png')}}" alt="logo" width="150">
                    </span>
                    
                  </a>
                </div>
                <!-- /Logo -->
                <h4 class="mb-2">Selamat Datang Di Posyandu</h4>
                @if (Session::get('status') == 'failed')
                    <p style="color: red">{{Session::get('message')}}</p>
                @endif
                <p class="mb-4">Mohon login untuk melanjutkan</p>
  
                <form id="formAuthentication" class="mb-3" action="/login" method="POST">
                  @csrf
                  <div class="mb-3">
                    <label for="email" class="form-label">Username</label>
                    <input
                      type="text"
                      class="form-control"
                      id="email"
                      name="username"
                      placeholder="Enter your username"
                      autofocus
                    />
                  </div>
                  <div class="mb-3 form-password-toggle">
                    <div class="d-flex justify-content-between">
                      <label class="form-label" for="password">Password</label>
                      <a href="auth-forgot-password-basic.html">
                        <small class="text-primary">Lupa Password?</small>
                      </a>
                    </div>
                    <div class="input-group input-group-merge">
                      <input
                        type="password"
                        id="password"
                        class="form-control"
                        name="password"
                        placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                        aria-describedby="password"
                      />
                      <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                    </div>
                  </div>
                  <div class="mb-3">
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" id="remember-me" />
                      <label class="form-check-label" for="remember-me">Remember me</label>
                    </div>
                  </div>
                  <div class="mb-3">
                    <button class="btn btn-primary d-grid w-100" type="submit">Login</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{asset('login/assets/vendor/libs/jquery/jquery.js')}}"></script>
    <script src="{{asset('login/assets/vendor/libs/popper/popper.js')}}"></script>
    <script src="{{asset('login/assets/vendor/js/bootstrap.js')}}"></script>
    <script src="{{asset('login/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js')}}"></script>
    <script src="{{asset('login/assets/vendor/js/menu.js')}}"></script>
    <script src="{{asset('login/assets/js/main.js')}}"></script>
    <script async defer src="https://buttons.github.io/buttons.js"></script>
</body>

</html>