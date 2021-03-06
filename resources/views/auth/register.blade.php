<html>

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no" />
    <title>Register</title>
    <link rel="stylesheet" href='{{ asset("assets/bootstrap/css/bootstrap.min.css") }}'>
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
    <link rel="stylesheet" href='{{ asset("assets/fonts/fontawesome-all.min.css") }}'>
    <link rel="stylesheet" href='{{ asset("assets/fonts/font-awesome.min.css") }}'>
    <link rel="stylesheet" href='{{ asset("assets/fonts/fontawesome5-overrides.min.css") }}'>
</head>

<body class="bg-gradient-primary">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="card shadow-lg o-hidden border-0 my-5">
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h4 class="text-dark mb-4">Pleased To Meet You!</h4>
                                    </div>
                                    <form class="user" action="{{ route('register') }}" method="POST">
                                        @csrf
                                        <div class="mb-3"><input class="form-control form-control-user" type="email"
                                                id="exampleInputEmail" name="email" aria-describedby="emailHelp"
                                                placeholder="Enter Email Address..." name="email" /></div>
                                        @error('email')
                                        <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                        <div class="mb-3"><input class="form-control form-control-user" type="password"
                                                id="exampleInputPassword" placeholder="Confirm Password"
                                                name="password_confirmation" name="password" />
                                            @error('password')
                                            <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>

                                        <div class="mb-3"><input class="form-control form-control-user" type="password"
                                                id="exampleInputPassword" placeholder="Password" name="password" />
                                        </div>
                                        <div class="mb-3">
                                            <div class="custom-control custom-checkbox small">
                                                {{-- <div class="form-check"><input
                                                        class="form-check-input custom-control-input" type="checkbox"
                                                        id="formCheck-1" /><label
                                                        class="form-check-label custom-control-label"
                                                        for="formCheck-1">Remember Me</label></div> --}}
                                            </div>
                                        </div><button class="btn btn-primary d-block btn-user w-100"
                                            type="submit">Register</button>
                                            <br>
                                            <small>Already have an account? <a href="{{ route('login') }}">Login</a> </small>
                                        <hr />
                                    </form>
                                    {{-- <div class="text-center"><a class="small" href="forgot-password.html">Forgot
                                            Password?</a></div>
                                    <div class="text-center"><a class="small" href="register.html">Create an
                                            Account!</a></div> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src='{{ asset("assets/bootstrap/js/bootstrap.min.js") }}'></script>
    <script src='{{ asset("assets/js/theme.js") }}'></script>

</body>

</html>
