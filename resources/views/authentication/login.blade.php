<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login - Edukasi</title>
    <!-- CSS Files -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <style>
        .login-container {
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .login-box {
            max-width: 900px;
            width: 100%;
            background: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            overflow: hidden;
        }

        .login-left {
            background: url("{{ asset('img/head-meja.png') }}") no-repeat center;
            background-size: cover;
            height: 100%;
            min-height: 400px;
        }
    </style>
</head>

<body class="bg-light">
    <div class="container login-container">
        <div class="row login-box">
            <div class="col-md-6 login-left d-none d-md-block d-flex flex-column justify-content-center">
            </div>
            <div class="col-md-6 p-5">
                <h3 class="text-center text mb-4">Form Login</h3>
                <form action="{{ route('login.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" name="email" class="form-control" id="email"
                            placeholder="Masukkan email">
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" name="password" class="form-control" id="password"
                            placeholder="Masukkan password">
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">Login</button>
                    <p class="text-center mt-3"><a href="#">Lupa password?</a></p>
                </form>
            </div>
        </div>
    </div>
</body>

</html>
