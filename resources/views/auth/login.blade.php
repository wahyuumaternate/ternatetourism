<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Wonderful Ternate</title>
    <link href="{{ asset('admin/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    
    <link rel="icon" type="image/png" href="{{ asset('favicon-32x32.png') }}" sizes="32x32" />
    <link rel="icon" type="image/png" href="{{ asset('favicon-16x16.png') }}" sizes="16x16" />
    <link href="{{ asset('favicon.ico') }}" rel="icon">
    <style>
        .login-container {
            min-height: 100vh;
            background: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)),
                url('{{ asset('assets/kora_kora.jpg') }}') center/cover no-repeat;
        }

        .login-box {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 15px;
            padding: 40px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);
        }

        .brand-logo {
            width: 120px;
            margin-bottom: 30px;
        }

        .form-control {
            border-radius: 8px;
            padding: 12px 15px;
            border: 1px solid #ddd;
            margin-bottom: 20px;
        }

        .btn-login {
            background: #2c3e50;
            color: white;
            padding: 12px;
            border-radius: 8px;
            width: 100%;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            transition: all 0.3s;
        }

        .btn-login:hover {
            background: #34495e;
            transform: translateY(-2px);
        }

        .divider {
            margin: 30px 0;
            position: relative;
        }

        .divider::before {
            content: '';
            position: absolute;
            width: 100%;
            height: 1px;
            background: #ddd;
            top: 50%;
        }

        .divider span {
            background: white;
            padding: 0 15px;
            color: #666;
            position: relative;
            z-index: 1;
        }

        .social-login {
            display: flex;
            justify-content: center;
            gap: 15px;
        }

        .social-btn {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 1px solid #ddd;
            transition: all 0.3s;
        }

        .social-btn:hover {
            background: #f8f9fa;
            transform: translateY(-2px);
        }
    </style>
</head>

<body>

    <div class="login-container d-flex align-items-center justify-content-center">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-5">
                    <div class="login-box">
                        <div class="text-center">
                            <img src="{{ asset('assets/TTE_TOURISM_LOGO.png') }}" alt="Logo" class="brand-logo">
                            <h4 class="mb-4">Selamat Datang Kembali</h4>
                        </div>

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('login') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <input type="email" class="form-control" name="email" placeholder="Email" required>
                            </div>

                            <div class="mb-4">
                                <input type="password" class="form-control" name="password" placeholder="Password"
                                    required>
                            </div>

                            <div class="mb-4 d-flex justify-content-between align-items-center">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="remember" name="remember">
                                    <label class="form-check-label" for="remember">Ingat Saya</label>
                                </div>
                                <a href="{{ route('password.request') }}" class="text-decoration-none">Lupa
                                    Password?</a>
                            </div>

                            <button type="submit" class="btn btn-login mb-4">Masuk</button>
                        </form>


                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('admin/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
</body>

</html>
