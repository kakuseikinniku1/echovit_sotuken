<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="{{asset('css/style_search.css')}}">
  <title>検索画面</title>
</head>
<body>
  <a href="{{route('main')}}">
    <div>
      <header>
        <h1 class="title">echovit</h1>
      </header>
    </div>
  </a>

  <!-- ナビゲーションメニュー（初期状態では非表示） -->
  <!-- 検索フォーム -->
  <form action="{{route('searchCharenge')}}" method="post">
    @csrf
    <input type="search" name="search" placeholder="トレーニングメニューを検索" class="search-input" value="">
    <input type="submit" src="https://kotonohaworks.com/free-icons/wp-content/uploads/kkrn_icon_mushimegane_1.png" width="50" height="40" alt="検索" class="search-button">
  </form>


  <script src="{{asset('js/script.js')}}"></script>
</body>
</html>

