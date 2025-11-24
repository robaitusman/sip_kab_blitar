<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
    <link rel='stylesheet'
        href='https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&amp;display=swap'>
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">


</head>

<body>
    <a href="javascript:history.back()" class="back-button">
        <i class="fas fa-arrow-left"></i>
    </a>
    <div class="screen-1">
        <div class="logo">
            <img src="{{ asset('img/logosipblitar.png') }}" alt="logo">
        </div>
        @if ($errors->any())
            <div class="alert alert-danger animated bounce">{{ $errors->first() }}</div>
        @endif
        <form name="loginForm" action="{{ route('auth.login') }}" class="needs-validation form page-form"
            method="post">
            @csrf
            <div class="email">
                <label for="email">Username</label>
                <div class="sec-2">
                    <ion-icon name="person-outline"></ion-icon>
                    <input type="text" placeholder="Username" name="username" required="required" />
                </div>
            </div>
            <div class="password">
                <label for="password">Password</label>
                <div class="sec-2">
                    <ion-icon name="lock-closed-outline"></ion-icon>
                    <input class="pas" type="password" required="required" name="password"
                        placeholder="············" />
                    {{-- <ion-icon class="show-hide" name="eye-outline"></ion-icon> --}}
                </div>
            </div>
            <button class="login" type="submit">Login </button>
        </form>

        <div class="footer">
            {{-- <a href="{{ route('auth.register') }}"><span>Register</span></a> --}}
            <a href="{{ route('password.forgotpassword') }}"><span>Lupa Password?</span></a>
        </div>
    </div>
</body>

</html>
