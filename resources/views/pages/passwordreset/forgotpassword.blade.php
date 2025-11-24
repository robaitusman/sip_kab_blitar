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
    <link rel="stylesheet" href="{{ asset('css/forgotpassword.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">


</head>

<body>
    <a href="javascript:history.back()" class="back-button">
        <i class="fas fa-arrow-left"></i>
    </a>
    <div class="screen-1">
        <div class="logo">
            <img src="{{ asset('img/logosipblitar.png') }}" alt="logo">
            <h2 class="text-primary">Password Reset</h2>
            <p>Harap berikan alamat email valid yang Anda gunakan</p>
        </div>

        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif
        <form role="form" action="{{ route('password.email') }}" class="needs-validation form page-form"
            method="post">
            @csrf
            <div class="email">
                <label for="email">Email</label>
                <div class="sec-2">
                    <ion-icon name="mail-outline"></ion-icon>
                    <input type="text" placeholder="Email" name="email" id="email" required="required" />
                </div>
            </div>
            <p>Tautan akan dikirim ke email Anda yang berisi informasi yang Anda perlukan untuk kata sandi Anda</p>
            <button class="login" type="submit">Kirim </button>
            @if ($errors->has('email'))
                <div class="alert alert-danger animated bounce">{{ $errors->first('email') }}</div>
            @endif
        </form>
    </div>
</body>

</html>
