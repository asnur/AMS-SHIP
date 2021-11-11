<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>AMS</title>

    <!-- Custom fonts for this template-->
    <link href="{{ asset('asset-admin/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    {{-- <link href="/asset-admin/img/favicon.ico" rel="icon"> --}}
    <!-- Custom styles for this template-->
    <link href="{{ asset('asset-admin/css/sb-admin-2.min.css') }}" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

    <div class="container-fluid">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <img id="bg-login-image-bag" class="col-lg-8 d-none d-lg-block" src=""
                                style="width: 100%; object-fit:cover;">
                            <div class="col-lg-4">
                                <div class="p-5">
                                    <div class="text-center mb-2">
                                        <img src="/asset-admin/img/bag-icon.png">
                                    </div>
                                    <form class="user" method="POST" action="{{ route('login') }}">
                                        @csrf
                                        <div class="form-group">
                                            <input type="email"
                                                class="form-control form-control-user @error('email') is-invalid @enderror"
                                                name="email" value="{{ old('email') }}" required autocomplete="email"
                                                autofocus placeholder="Enter Email Address...">

                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="form-group mb-5">
                                            <input type="password"
                                                class="form-control form-control-user @error('password') is-invalid @enderror"
                                                name="password" required autocomplete="current-password"
                                                placeholder="Password">
                                            @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <button type="submit" class="btn btn-primary btn-user btn-block">
                                            Login
                                        </button>
                                    </form>
                                    <hr>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('asset-admin/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('asset-admin/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('asset-admin/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('asset-admin/js/sb-admin-2.min.js') }}"></script>
    <script>
        $(window).on("load", function(e) {
            var i = 0;
            var images = [
                '/asset-admin/img/capture-bag/2.jpg',
                '/asset-admin/img/capture-bag/3.jpg',
                '/asset-admin/img/capture-bag/4.jpg',
                '/asset-admin/img/capture-bag/5.jpg',
                '/asset-admin/img/capture-bag/6.jpg',
                '/asset-admin/img/capture-bag/7.jpg',
                '/asset-admin/img/capture-bag/8.jpg',
                '/asset-admin/img/capture-bag/9.jpg',
                '/asset-admin/img/capture-bag/10.jpg',
                '/asset-admin/img/capture-bag/11.jpg',
                '/asset-admin/img/capture-bag/12.jpg',
                '/asset-admin/img/capture-bag/13.jpg',
                '/asset-admin/img/capture-bag/14.jpg',
                '/asset-admin/img/capture-bag/15.jpg',
                '/asset-admin/img/capture-bag/16.jpg',
                '/asset-admin/img/capture-bag/17.jpg',
                '/asset-admin/img/capture-bag/18.jpg',
            ];
            var image = $('#bg-login-image-bag');
            image.attr('src', '/asset-admin/img/capture-bag/1.jpg');

            setInterval(function() {
                image.fadeOut(1000, function() {
                    image.attr('src', `${images[i++]}`);
                    image.fadeIn(1000);
                    if (i == images.length) {
                        i = 0;
                    }
                    console.log(i);
                });
            }, 3000);
        });
    </script>
</body>

</html>
