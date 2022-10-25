<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="assets/css/main/app.css">
    <link rel="stylesheet" href="assets/css/pages/auth.css">
    <link rel="shortcut icon" href="assets/images/logo/favicon.svg" type="image/x-icon">
    <link rel="shortcut icon" href="assets/images/logo/favicon.png" type="image/png">
    <title>Login - e-book</title>

    <style>
        *{
            overflow: hidden;
        }
    </style>
</head>

<body >
    <div id="auth">

        <div class="row h-100">
            <div class="col-lg-5 col-12">
                <div class="p-5 p-5 p-5">
                    <h1 class="auth-title">Log in</h1>
                    <p class="auth-subtitle mb-3">dengan akun e-book kamu yang sudah didaftarkan.</p>
                    <x-auth-validation-errors class="mb-4" :errors="$errors" />
                    <form action="{{ route('login') }}" method="POST">
                        @csrf
                        <div class="form-group position-relative has-icon-left mb-4">
                            <input type="text" class="form-control form-control-xl" placeholder="Email"
                                name="email">
                            <div class="form-control-icon">
                                <i class="bi bi-person"></i>
                            </div>
                        </div>
                        <div class="form-group position-relative has-icon-left mb-4">
                            <input type="password" class="form-control form-control-xl" placeholder="Password"
                                name="password">
                            <div class="form-control-icon">
                                <i class="bi bi-shield-lock"></i>
                            </div>
                        </div>
                        <button class="btn btn-primary btn-block btn-lg shadow-lg mt-3">Log in</button>
                    </form>
                    <div class="text-center mt-5 text-lg fs-4">
                        <p class="text-gray-600">Belum mempunyai akun ? <a href="{{ route('register') }}"
                                class="font-bold">Sign
                                up</a>.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-7 d-none d-lg-block">
                <div id="auth-right">
                    <img style="background-size: cover; background-position: center; width: 100%;" src="{{ asset('assets/auth/auth-hero.png') }}" alt="">
                </div>
            </div>
        </div>

    </div>
</body>

</html>
