<!DOCTYPE html>
<html lang="en">
<head>
    <base href="{{asset('frontend')}}/">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=.ce, initial-scale=1.0">
    <title>Đăng nhập</title>
    <link rel="stylesheet" href="./dist/css/login.css">
</head>
<body>
    <div class="center">
        <h1>Đăng Nhập</h1>
        <form action="{{ route('login.check') }}" method="post">
            @csrf

            @if ($errors->any())
				<div class="alert alert-info">
					<ul>
						@foreach ($errors->all() as $error)
							<li>{{ $error }}</li>
						@endforeach
					</ul>
				</div>
			@endif

            @if (session('status'))
                <div class="alert alert-danger">
                    {{ session('status') }}
                </div>
			@endif  

            <div class="txt-field">
                <input type="text" name="username" value="{{ old('username') }}" required>
                <span></span>
                <label>Tài khoản</label>
            </div>
            <div class="txt-field">
                <input type="password" name="password" value="" required>
                <span></span>
                <label>Mật khẩu</label>
            </div>
            <div class="pass">Quên mật khẩu?</div>
            <input type="submit" value="Đăng nhập">
            <div class="signup-link">
                Chưa có tài khoản? <a href="">Đăng ký</a>
            </div>
        </form>
    </div>
</body>
</html>