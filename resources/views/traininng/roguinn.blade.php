<!DOCTYPE html>
<head>
    <title>ログイン</title>
    <link rel="stylesheet" href="{{ asset('/css/roguinn_style.css')  }}">
</head>
<body>
    <header>
        <h1 class="title" style="font-size: 30px;">echovit</h1>
        <nav class="nav">
        </nav>
    </header>
    <form method="post" action="{{route('logincharenge')}}">
        @csrf
        <div class="main">
            <p>メールアドレス</p>
            <input type="text" name="email" maxlength="254" placeholder="aaaa@gmail.com">
            <p>パスワード</p>
            <input type="password" name="password" maxlength="20" placeholder="半角英数8文字以上">
            <p><input type="submit" value="ログイン" class="register"></p>
        </div>
    </form>
    @if (session("errors"))
        <p style="margin-left: 35%; color: red;">メールアドレスまたはパスワードが正しくありません。もう一度入力してください。</p>
    @endif
    <div style="margin-left:38%"><a href="{{ route('reset.form') }}">パスワードをお忘れの方</a></div>
    <div><a href="{{route('registration')}}" style="margin-left:38%">新規登録はこちら</a></div>
</body>
</html>