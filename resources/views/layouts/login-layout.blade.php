<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- Main CSS File -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" media="all">
    <link href="{{ asset('vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <script src="{{ asset('js/sweetalert2@11.js') }}"></script>
    <script src="{{ asset('js/fontawesome.js') }}"></script>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Inter:wght@100;200;300;400;500;600;700;800;900&family=Nunito:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">


    <style>
        .login-container {
            max-width: 400px;
            margin: 50px auto;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            overflow: hidden;
        }

        .login-header img {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }

        .login-form {
            padding: 30px;
        }

        .social-buttons {
            margin: 10px 0;
            display: flex;
            justify-content: center;
            gap: 10px;
        }

        .form-check-label {
            font-size: 14px;
        }

        .login-footer {
            text-align: center;
            margin-top: 10px;
            font-size: 14px;
        }

        .login-footer a {
            text-decoration: none;
            color: #198754;
        }

        .login-footer a:hover {
            text-decoration: underline;
        }
        body{
            background-image: url('{{ asset("img/hero-bg-light.webp") }}');
            font-family: 'Roboto', sans-serif;
        }
         
    </style>
</head>

<body>
    <div class="container">
        <div class="login-container bg-white">
            <!-- Header -->
            <div class="login-header">
                <img src="{{ asset('img\banner.jpg') }}" alt="Header Image">
            </div>
            @yield('content')
        </div>
    </div>
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>

</body>

</html>
