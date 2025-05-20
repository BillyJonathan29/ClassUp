<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Edukasi</title>

    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/atlantis.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendors/ladda/ladda-themeless.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom/login-added.css') }}">

    <script src="{{ url('js/plugin/webfont/webfont.min.js') }}"></script>
    <script>
        WebFont.load({
            google: {
                "families": ["Lato:300,400,700,900"]
            },
            custom: {
                "families": ["Flaticon", "Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands",
                    "simple-line-icons"
                ],
                urls: [`{{ url('css/fonts.min.css') }}`]
            },
            active: function() {
                sessionStorage.fonts = true;
            }
        });
    </script>



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
            background-color: blue;
            background-size: cover;
            min-height: 400px;
        }

        .btn {
            margin-left: 13px;
            width: 94%;
        }
    </style>
</head>

<body class="bg-light">
    <div class="container login-container">
        <div class="row login-box">
            <div class="col-md-6 login-left d-none d-md-block"></div>
            <div class="col-md-6 p-5">
                <h3 class="text-center mb-4">Form Login</h3>
                <form action="{{ route('login.authenticate') }}" method="POST" id="formLogin">
                    @csrf
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" name="username" class="form-control" id="username"
                            placeholder="Masukkan username" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" name="password" class="form-control" id="password"
                            placeholder="Masukkan password" required>
                    </div>
                    <p class="message-error text-danger"></p>
                    <button type="submit" class="btn btn-primary ladda-button" data-style="expand-right">Login</button>
                    <p class="text-center mt-3"><a href="#">Lupa password?</a></p>
                </form>
            </div>
        </div>
    </div>

    <!-- JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="{{ asset('js/core/bootstrap.min.js') }}"></script>
    <script src="{{ asset('vendors/ladda/spin.min.js') }}"></script>
    <script src="{{ asset('vendors/ladda/ladda.min.js') }}"></script>
    <script src="{{ asset('vendors/ladda/ladda.jquery.min.js') }}"></script>
    <script src="{{ asset('js/plugin/bootstrap-notify/bootstrap-notify.min.js') }}"></script>
    <script src="{{ asset('js/myJs.js') }}"></script>

    <script>
        $(document).ready(function() {
            const $formLogin = $('#formLogin');
            const $formLoginSubmitBtn = $formLogin.find(`[type="submit"]`).ladda();

            $formLogin.on('submit', function(e) {
                e.preventDefault();
                $('.message-error').html('');
                const formData = $(this).serialize();
                $formLoginSubmitBtn.ladda('start');

                ajaxSetup();

                $.ajax({
                    url: `{{ route('login.authenticate') }}`,
                    method: `post`,
                    data: formData,
                    dataType: `json`,
                }).done(response => {
                    successNotification('Berhasil', response.message);
                    setTimeout(() => {
                        window.location.href = `{{ url('dashboard') }}`;
                    }, 1000);
                }).fail(error => {
                    $formLoginSubmitBtn.ladda('stop');
                    errorNotification('Error', 'Username atau password salah');
                    $('.message-error').html('Username atau password salah');
                });
            });
        });
    </script>
</body>

</html>
