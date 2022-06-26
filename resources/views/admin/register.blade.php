<!DOCTYPE html>
<html lang="en">

<head>
    <title>{{ $title }}</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--===============================================================================================-->
    <link rel="icon" type="image/png" href="/img/favicon.ico" />
    <!--===============================================================================================-->
    {{-- <link rel="stylesheet" type="text/css" href="/vendor/bootstrap/css/bootstrap.min.css"> --}}
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="/fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="/vendor/animate/animate.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="/vendor/css-hamburgers/hamburgers.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="/vendor/animsition/css/animsition.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="/vendor/select2/select2.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="/vendor/daterangepicker/daterangepicker.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="/css/auth01.css">
    <link rel="stylesheet" type="text/css" href="/css/auth02.css">
    <!--===============================================================================================-->
</head>

<body>

    <div class="limiter">
        <div class="container-login100" style="background-image: url('img/bg.jpg');">
            <div class="wrap-login100 p-t-30 p-b-50">
                <span class="login100-form-title p-b-41">
                    Form Register
                </span>
                <form class="login100-form validate-form p-b-33 p-t-5" action="/register" method="post">
                    @csrf
                    <div class="wrap-input100 validate-input" data-validate="Enter name">
                        <input class="input100 @error('name') is-invalid @enderror" type="text" name="name"
                            placeholder="Name" value="{{ old('name') }}" required>
                        <span class="focus-input100" data-placeholder="&#xe82a;"></span>
                        @error('name')
                            <div class="invalid-feedback text-center">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="wrap-input100 validate-input" data-validate="Enter username">
                        <input class="input100 @error('username') is-invalid @enderror" type="text" name="username"
                            placeholder="Username" value="{{ old('username') }}" required>
                        <span class="focus-input100" data-placeholder="&#xe82a;"></span>
                        @error('username')
                            <div class="invalid-feedback text-center">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="wrap-input100 validate-input" data-validate="Enter password">
                        <input class="input100 @error('password') is-invalid @enderror" type="password" name="password"
                            placeholder="Password" required>
                        <span class="focus-input100" data-placeholder="&#xe80f;"></span>
                        @error('password')
                            <div class="invalid-feedback text-center">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="container-login100-form-btn m-t-32">
                        <button class="login100-form-btn">
                            Register
                        </button>
                    </div>

                    <p class="text-danger text-center mt-3">
                        Belum Punya Akun?<a href="/register" class="text-danger"> Register</a>
                    </p>
                </form>
            </div>
        </div>
    </div>


    <div id="dropDownSelect1"></div>

    <!--===============================================================================================-->
    <script src="/vendor/jquery/jquery-3.2.1.min.js"></script>
    <!--===============================================================================================-->
    <script src="/vendor/animsition/js/animsition.min.js"></script>
    <!--===============================================================================================-->
    <script src="/vendor/bootstrap/js/popper.js"></script>
    {{-- <script src="/vendor/bootstrap/js/bootstrap.min.js"></script> --}}
    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <!--===============================================================================================-->
    <script src="/vendor/select2/select2.min.js"></script>
    <!--===============================================================================================-->
    <script src="/vendor/daterangepicker/moment.min.js"></script>
    <script src="/vendor/daterangepicker/daterangepicker.js"></script>
    <!--===============================================================================================-->
    <script src="/vendor/countdowntime/countdowntime.js"></script>
    <!--===============================================================================================-->
    <script src="/js/auth.js"></script>

</body>

</html>
