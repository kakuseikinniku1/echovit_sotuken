<!doctype html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>管理</title>
  <link rel="stylesheet" href="{{ asset('/css/style.css')  }}">
</head>
<body>
    <header>
      <h1 class="title" style="font-size: 30px;"><a href="{{route('main')}}" style="color:white;">echovit</a></h1>
      <nav class="nav">
        <ul class="menu-group" style="display: flex">
          <li class="menu-item"><a href="#" class="serch" style="text-decoration:none;"><img src="../../images/kkrn_icon_mushimegane_1.png" style="height: 70px; width: 70px; margin-top: 20px;"></a></li>
          <li class="menu-item"><a href="#" style="text-decoration:none; color: white;"><img src="../../images/kkrn_icon_user_1.png" style="height: 70px; width: 70px; margin-top: 20px;"></a></li>
        </ul>
      </nav>
    </header>
    <div class="main">
      <div class="main-image">
        <h2>投稿したレッスン<h2>
        <ul class="blogList">
          @foreach($myMovie as $movie)
          <li>
            <a href="{{route('managementShow', ['lesson'=>$movie->lesson])}}">
            <figure class="pic">
              <img src='{{asset("storage/$movie->image")}}' style="background-color: gray;">
            </figure>
            <div>
              <time>{{$movie->created_at->format("Y.m.d")}}</time>
              <h1 class="title">{{$movie->lesson}}</h1>
            </div>
            </a>
          </li>
        @endforeach
        </ul>
      </div>
    </div>
    <button class="fixed_btn" onclick="location.href='{{ route('uplode') }}' ">＋</button>
  </body>
</html>