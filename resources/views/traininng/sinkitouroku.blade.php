<!DOCTYPE html>
<head>
    <title>会員登録画面</title>
    <link rel="stylesheet" href="{{ asset('/css/sinki_style.css')  }}">
</head>
<body>
    <header>
        <h1 class="title" style="font-size: 30px;">echovit</h1>
        <nav class="nav">
        </nav>
    </header>
    <form method="post" action="{{route('store')}}">
    @csrf
        <div class="main">
            <p>名前</p>
            <input type="text" name="name" maxlength="100" placeholder="山田太郎">
            <p style="color: red;font-size: 15px">{{ $errors->first('name') }}</p>
            <p>メールアドレス</p>
            <input type="text" name="email" maxlength="254" placeholder="aaaa@gmail.com">
            <p style="color: red;font-size: 15px;">{{ $errors->first('email') }}</p>
            <p>パスワード</p>
            <input type="password" name="password" maxlength="20" placeholder="半角英数8文字以上">
            <p style="color: red;font-size: 15px">{{ $errors->first('password') }}</p>
            <p>パスワード再入力</p>
            <input type="password" name="password2" maxlength="20" placeholder="半角英数8文字以上">
            <p style="color: red; font-size: 15px">{{ $errors->first('password2') }}</p>
            <p><input type="submit" value="会員登録を行う" class="register"></p>
        </div>
    </form>
    <a href="{{route('login')}}" style="margin-left:38%">ログインはこちら</a>
</body>
</html>