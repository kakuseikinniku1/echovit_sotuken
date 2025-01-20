<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>プロフィール編集</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        header {
  display: flex;
  justify-content: space-between; /* 左右にタイトルとメニューを配置 */
  align-items: center; /* 垂直方向に中央揃え */
  background-color: #000;
  color: white;
  height: 80px;
  padding: 0 30px; /* 余白調整 */
}

header .title a {
  color: white;
  font-size: 30px;
  font-weight: bold;
  text-decoration: none;
  display: flex;
  align-items: center;
}

header .nav {
  display: flex; /* 横並びにする */
  align-items: center; /* アイコンを縦中央揃え */
}

.menu-item {
  list-style: none;
  margin-left: 20px; /* アイコン間隔 */
}

.menu-item a {
  display: block;
  text-decoration: none;
  color: white;
  font-size: 24px;
}

.menu-item a:hover {
  color: #ddd;
}

.menu-item img {
  height: 50px;
  width: 50px;
}
        .profile-container {
            max-width: 900px;
            margin: 20px auto;
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            font-size: 2rem;
            text-align: center;
            margin-bottom: 20px;
        }
        .form-group {
            margin-bottom: 20px;
        }
        .form-group label {
            font-size: 1rem;
            margin-bottom: 5px;
            display: block;
        }
        .form-group input,
        .form-group textarea,
        .form-group select {
            width: 100%;
            padding: 10px;
            font-size: 1rem;
            border-radius: 5px;
            border: 1px solid #ccc;
            box-sizing: border-box;
        }
        .form-group input[type="file"] {
            padding: 0;
        }
        .form-group textarea {
            resize: vertical;
            height: 150px;
        }
        .skills {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }
        .skills input[type="text"] {
            width: 200px;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }
        .form-buttons {
            text-align: center;
        }
        .form-buttons button {
            background-color: #0073e6;
            color: white;
            padding: 10px 20px;
            font-size: 1rem;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        .form-buttons button:hover {
            background-color: #005bb5;
        }
        .form-buttons button.cancel-btn {
            background-color: #ff4d4d;
        }
        .form-buttons button.cancel-btn:hover {
            background-color: #e60000;
        }
    </style>
</head>
<body>
<header>
      <h1 class="title" style="font-size: 30px;"><a href="{{route('main')}}" style="color:white;">echovit</a></h1>
      <nav class="nav">
        <ul class="menu-group" style="display: flex">
          <li class="menu-item"><a href="{{route('search')}}" class="serch" style="text-decoration:none;"><img src="../../images/kkrn_icon_mushimegane_1.png"></a></li>
          <li class="menu-item"><a href="{{route('profile', ['id' => $id])}}" style="text-decoration:none; color: white;"><img src="../../images/kkrn_icon_user_1.png"></a></li>
        </ul>
      </nav>
    </header>
    <div class="profile-container">
        <h1>プロフィール編集</h1>
        
        <!-- プロフィール編集フォーム -->
        <form action="{{route('profileup')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <!-- プロフィール画像 -->
            <div class="form-group">
                <label for="profile-img">プロフィール画像</label>
                <input type="file" id="image" name="image">
            </div>

            <!-- ユーザー名 -->
            <div class="form-group">
                <label for="username">ユーザー名</label>
                <input type="text" id="name" name="name" value="{{$profile->name}}">
            </div>

            <div class="form-group">
                <label for="content">自己紹介</label>
                <input type="text" id="content" name="content" value="{{$profile->content}}">
            </div>

            <!-- 自己紹介 -->
            <div class="form-group">
                <label for="bio">経歴</label>
                <textarea id="explain" name="explain">{{$profile->explain}}</textarea>
            </div>

            <!-- 更新ボタン -->
            <div class="form-buttons">
                <button type="submit">更新する</button>
                <button type="button" class="cancel-btn" onclick="window.location.href='/profile'">キャンセル</button>
            </div>
        </form>
    </div>
</body>
</html>
