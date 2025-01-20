<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>プロフィール画面</title>
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
            max-width: 1200px;
            margin: 20px auto;
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        .profile-header {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }
        .profile-header img {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            margin-right: 20px;
        }
        .profile-header h1 {
            font-size: 2rem;
            margin: 0;
        }
        .profile-header p {
            color: #555;
            font-size: 1rem;
        }
        .skills {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-top: 20px;
        }
        .skills span {
            background-color: #0073e6;
            color: white;
            padding: 5px 10px;
            border-radius: 5px;
            font-size: 0.9rem;
        }
        .courses-list {
            margin-top: 30px;
        }
        .course-item {
            background-color: #f9f9f9;
            padding: 15px;
            margin-bottom: 15px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        .course-item h3 {
            margin: 0;
            font-size: 1.5rem;
        }
        .course-item p {
            color: #777;
        }
        /* ログアウトボタン */
        .logout-btn {
            background-color: #ff4d4d;
            color: white;
            border: none;
            padding: 10px 20px;
            font-size: 1rem;
            cursor: pointer;
            border-radius: 5px;
            margin-top: 20px;
            transition: background-color 0.3s;
        }
        .logout-btn:hover {
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
        <!-- プロフィールヘッダー -->
        <div class="profile-header">
            <img src='{{asset("storage/$profile->image")}}'style="background-color:gray">
            <div>
                <h1>{{$profile->name}}</h1>
                <p>{{$profile->content}}</p>
            </div>
        </div>

        <!-- 自己紹介 -->
        <div class="bio">
            <p>{{$profile->explain}}</p>
        </div>

        @if($id == $myId)
            <a href="{{route('profileUpdate', ['id' => $id])}}">編集する</a>
            <a href="{{route('management')}}">動画を管理する</a>
        @endif

        <!-- スキル -->
        <!-- <div class="skills">
            <span>Python</span>
            <span>データサイエンス</span>
            <span>機械学習</span>
            <span>AI</span>
        </div> -->

        <!-- 提供コース -->
        <div class="courses-list">
            @foreach($movies as $movie)
            <label>
                <a href="{{route('showMovie', ['id' => $movie->id])}}">
                    <div class="course-item">
                        <h3>{{$movie->lesson}}</h3>
                        <p>{{$movie->content}}</p>
                    </div>
                </a>
            </label>
            @endforeach
        </div>

        <!-- ログアウトボタン -->
        @if($id == $myId)
        <button class="logout-btn" onclick="location.href='{{ route('logout') }}' ">ログアウト</button>
        @endif
    </div>
</body>
</html>
