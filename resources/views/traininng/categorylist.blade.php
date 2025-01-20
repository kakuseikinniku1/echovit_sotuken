<!doctype html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>カテゴリー</title>
  <link rel="stylesheet" href="{{ asset('/css/style.css')  }}">
</head>
<body>
    <header>
      <h1 class="title" style="font-size: 30px;"><a href="{{route('main')}}" style="color:white;">echovit</a></h1>
      <nav class="nav">
        <ul class="menu-group" style="display: flex">
          <li class="menu-item"><a href="{{route('search')}}" class="serch" style="text-decoration:none;"><img src="../../images/kkrn_icon_mushimegane_1.png"></a></li>
          <li class="menu-item"><a href="{{route('profile', ['id' => $id])}}" style="text-decoration:none; color: white;"><img src="../../images/kkrn_icon_user_1.png"></a></li>
      </nav>
    </header>
      <div class="category-image">
        <h2>カテゴリー<h2>
        <ul class="blogList">
          @foreach ($categorys as $category)
          <li>
          <a href="{{route('category', ['id' => $category->categoryId])}}">
            <figure class="pic">
              <img src= "{{asset($category->image)}}">
            </figure>
            <div>
              <h1 class="title">{{$category->categoryName}}</h1>
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