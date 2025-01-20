<!doctype html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>お気に入り</title>
  <link rel="stylesheet" href="{{ asset('/css/style.css')  }}">
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
      <div class="favorite-image">
        <h2>お気に入り<h2>
        <ul class="blogList">
          @foreach($favorites as $favorite)
          <!-- {{$favorite = App\Models\Movie::find($favorite->movieId)}} -->
          <li>
          <a href="{{route('showMovie', ['id'=>$favorite->id])}}">
            <figure class="pic">
              <img src='{{"storage/$favorite->image"}}' style="background-color: gray;">
            </figure>
            <div>
              <time>{{$favorite->created_at->format("Y.m.d")}}</time>
              <h1 class="title">{{$favorite->title}}</h1>
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