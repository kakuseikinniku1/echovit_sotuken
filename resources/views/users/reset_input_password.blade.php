<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>パスワード再設定</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 400px;
            margin: 50px auto;
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        .form-group {
            margin-bottom: 20px;
        }
        label {
            display: block;
            margin-bottom: 8px;
            font-size: 14px;
            color: #333;
        }
        input[type="password"], input[type="email"], button {
            width: 100%;
            padding: 10px;
            margin: 8px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        button {
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
        }
        button:hover {
            background-color: #45a049;
        }
        .link {
            display: block;
            text-align: center;
            margin-top: 10px;
            font-size: 14px;
        }
        .link a {
            color: #007bff;
            text-decoration: none;
        }
        .link a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>パスワード再設定</h2>

    <!-- パスワード再設定フォーム -->
    <form action="{{ route('reset.password.update') }}" method="POST">
        @csrf
        <!-- 新しいパスワード入力欄 -->
        <div class="form-group">
            <label for="new-password">新しいパスワード</label>
            <input type="password" id="password" name="password" required placeholder="新しいパスワード">
        </div>

        <!-- パスワード確認入力欄 -->
        <div class="form-group">
            <label for="confirm-password">パスワード確認</label>
            <input type="password" id="confirm-password" name="confirm-password" required placeholder="新しいパスワードを再入力">
        </div>

        <!-- 再設定ボタン -->
        <button type="submit">パスワードを再設定</button>
        <input type="hidden" name="email" value={{$userMail}}>
    </form>

    <div class="link">
        <p><a href="/login">ログイン画面に戻る</a></p>
        @if(session("errors"))
        <p style="color: red;font-size: 15px;">パスワードは8文字以上255文字以下で設定してください</p></div>
        @endif
</div>

</body>
</html>