<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('css/style2.css')}}">
    <title>投稿画面</title>

</head>
<body>
    <header>
        <h1 class="title"><a href="{{route('main')}}" style="color:white;text-decoration: none;">echovit</a></h1>
        <nav class="nav"></nav>
        </header>    
 
        <form action="{{route('checkUplode')}}" method="post" enctype='multipart/form-data'>
            @csrf
            <div class="form-group">
                <label for="title">レッスン名</label>
                <input type="text" id="lessonName" name="lessonName" required>
            </div>

            <!-- タイトル -->
            <div class="form-group">
                <label for="title">タイトル</label>
                <input type="text" id="title" name="title" required>
            </div>

            <div class="form-group">
                <label for="title">カテゴリー</label>
                <select name="category" id="category">
                    @foreach($categorys as $category)
                        <option value="{{$category->categoryId}}">{{$category->categoryName}}</option>
                    @endforeach
                </select> 
            </div>

            <!-- 投稿内容 -->
            <div class="form-group">
                <label for="content">内容</label>
                <textarea id="content" name="content" required></textarea>
            </div>

            <!-- 画像アップロード -->
            <div class="form-group">
                <label for="image">画像を選択 (オプション)</label>
                <input type="file" id="image" name="image" accept="image/*">
            </div>
            <div class="form-group">
                <label for="movie">動画を選択 (オプション)</label>
                <input type="file" id="movie" name="movie" accept="image/*">
            </div>
 
            <!-- 投稿ボタン --> 
            <button type="submit">投稿する</button>

        </form>
        <h3 style="color:red">{{$errors->first()}}</h3>
</body>
</html>