<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>動画再生</title>
  <link rel="stylesheet" href="{{asset('css/douga.css')}}">
</head>
<body>
<header>
      <h1 class="title" style="font-size: 30px;"><a href="{{route('main')}}" style="color:white;">echovit</a></h1>
      <nav class="nav">
        <ul class="menu-group">
          <li class="menu-item"><a href="{{route('search')}}" class="serch" style="text-decoration:none;"><img src="../../images/kkrn_icon_mushimegane_1.png" style="height: 70px; width: 70px; padding-top: 20px;"></a></li>
          <li class="menu-item"><a href="{{route('profile', ['id' => $id])}}" style="text-decoration:none; color: white;"><img src="../../images/kkrn_icon_user_1.png"></a></li>
        </ul>
      </nav>
    </header>
  <div class="main-container">
    <!-- 動画プレイヤー -->
    <div class="video-container">
      <video id="video" class="video" width="100%" height="auto" controls>
        <source src='{{asset("storage/$m->movie")}}' type="video/mp4">
        あなたのブラウザはvideoタグに対応していません。
      </video>
      
      <!-- 動画詳細 -->
      <div class="video-details">
        <h1 class="video-title">{{$m->title}}</h1>
        <h3 class="video-date">投稿日: {{$m->updated_at->format("Y年m月d日")}}</h3>
        <h3 class="video-description">{{$m->content}}</h3>
      </div>
      <a href="{{route('profile', ['id' => $profile->userId])}}">
        <div class="profile-header">
              <img src='{{asset("storage/$profile->image")}}'  style="background-color:gray">
              <div>
                  <h1 style="color:white">{{$profile->name}}</h1>
              </div>
          </div>
      </a>
      @if($favorite)
      <button id="favoriteBtn" class="favorite-btn" onclick="location.href='{{ route('dellfavorite', ['id' => $m->id]) }}' " style="cursor: pointer;">⭐ お気に入り</button>
      
      @else
      <button type="botton" id="favoriteBtn" class="favorite-btn-before" onclick="location.href='{{ route('addfavorite', ['id' => $m->id]) }}' "style="cursor: pointer;">⭐ お気に入り</button>

      @endif

      <!-- コメント欄 -->
      <div class="comments-section">
        <h3>コメント</h3>
        @foreach($comments as $comment)
        <div class="comment">
          <h3><strong>{{$comment->userName}}:</strong>{{$comment->comment}}</h3>
        </div>
        @endforeach

        <div class="comment-form">
          <form action="{{route('addComment')}}" method="post">
            @csrf
            <textarea id="commentInput" name="comment" placeholder="コメントを追加..." rows="3"></textarea>
            <button type="sbmit" id="commentSubmit" class="comment-submit-btn">コメントを投稿</button>
            <input type="hidden" id="movieid" name="movieid" value = "{{$m->id}}">
          </form>
        </div>
      </div>
    </div>

    <!-- 動画一覧 -->
    <div class="video-list">
      <h3>レッスン一覧</h3>
      @foreach($movies as $movie)
      @if($m->id != $movie->id)
      <a href="{{route('showMovie', ['id' => $movie->id])}}" style="text-decoration:none;font-color:black">
      <div class="video-item" style="filter: drop-shadow(2px 2px 0.5px gray);">
          <img src='{{asset("storage/$movie->image")}}' alt="サムネイル" style="height:100px;width:200px;background-color: gray;">
          <h3><a href="{{route('showMovie', ['id' => $movie->id])}}" style="text-decoration:none;color:black">{{$movie->title}}</h3>
      </div>
      </a>
      @endif
      @endforeach
    </div>
  </div>
</body>
</html>
