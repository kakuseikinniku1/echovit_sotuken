<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>パスワードを忘れた場合</title>
    <link rel="stylesheet" href="{{asset('css/mailStyle.css')}}">
</head>
<body>
    <div class="container">
        <h1>パスワードを忘れた場合</h1>
        <p>ご登録のメールアドレスを入力してください。パスワードリセットのリンクをお送りします。</p>

        <form action="{{route('reset.send')}}" method="POST">
            @csrf
            <label for="mail">メールアドレス</label>
            <input type="mail" id="mail" name="mail" required placeholder="メールアドレスを入力">

            <button type="submit">送信</button>
        </form>
        <p style="color: red;font-size: 15px;">{{ $errors->first('password') }}</p>
        <p><a href="/login">ログイン画面に戻る</a></p>
    </div>
</body>
</html>