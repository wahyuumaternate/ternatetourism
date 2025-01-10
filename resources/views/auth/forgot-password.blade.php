<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password - Ternate Tourism</title>
    <link href="{{ asset('admin/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">

    <link rel="icon" type="image/png" href="{{ asset('favicon-32x32.png') }}" sizes="32x32" />
    <link rel="icon" type="image/png" href="{{ asset('favicon-16x16.png') }}" sizes="16x16" />
    <link href="{{ asset('favicon.ico') }}" rel="icon">
    <style>
        .forgot-container {
            min-height: 100vh;
            background: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)),
                url('{{ asset('assets/fora.jpg') }}') center/cover no-repeat;
        }

        .forgot-box {
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

        .btn-reset {
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

        .btn-reset:hover {
            background: #34495e;
            transform: translateY(-2px);
        }

        .back-to-login {
            color: #2c3e50;
            text-decoration: none;
            transition: all 0.3s;
        }

        .back-to-login:hover {
            color: #34495e;
            text-decoration: underline;
        }
    </style>
</head>

<body>

    <div class="forgot-container d-flex align-items-center justify-content-center">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-5">
                    <div class="forgot-box">
                        <div class="text-center">
                            <img src="{{ asset('assets/TTE_TOURISM_LOGO.png') }}" alt="Logo" class="brand-logo">
                            <h4 class="mb-3">Lupa Password?</h4>
                            <p class="text-muted mb-4">
                                Masukkan email Anda dan kami akan mengirimkan link untuk mereset password Anda.
                            </p>
                        </div>

                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('password.email') }}" method="POST">
                            @csrf
                            <div class="mb-4">
                                <input type="email" class="form-control" name="email"
                                    placeholder="Masukkan email Anda" required value="{{ old('email') }}">
                            </div>

                            <button type="submit" class="btn btn-reset mb-4">
                                Kirim Link Reset Password
                            </button>
                        </form>

                        <div class="text-center">
                            <a href="{{ route('login') }}" class="back-to-login">
                                <i class="fas fa-arrow-left me-2"></i> Kembali ke halaman login
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('admin/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="https://kit.fontawesome.com/your-fontawesome-kit.js"></script>
</body>

</html>
