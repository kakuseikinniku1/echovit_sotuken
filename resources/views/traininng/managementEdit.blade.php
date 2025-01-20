<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('css/style2.css')}}">
    <title>管理</title>

</head>
<body>
    <header>
        <h1 class="title"><a href="{{route('main')}}" style="color:white; text-decoration:none;">echovit</a></h1>
        <nav class="nav"></nav>
        </header>    
 
        <form action="{{route('editMovie')}}" method="post" enctype='multipart/form-data'>
            @csrf

            <!-- タイトル -->
            <div class="form-group">
                <label for="title">タイトル</label>
                <input type="text" id="title" name="title" value="{{$editMovie->title}}" required>
            </div>

            <!-- 投稿内容 -->
            <div class="form-group">
                <label for="content">内容</label>
                <textarea id="content" name="content" value="{{$editMovie->content}}" required>{{$editMovie->content}}</textarea>
            </div>

            <!-- 画像アップロード -->
            <div class="form-group">
                <label for="image">画像を選択 (オプション)</label>
                <input type="file" id="image" name="image" value="{{$editMovie->image}}">
            </div>
            <!-- 投稿ボタン --> 
            <input type="hidden" name="id" value="{{$editMovie->id}}">
            <button type="submit">編集する</button>
            <input type="hidden" name="id" value="{{$editMovie->id}}">
            <button type="button" style="margin-right:20%;background-color:red;" onclick="location.href='{{ route('deleatMovie', ['id'=>$editMovie->id]) }}' ">消去する</button>

        </form>

</body>
</html>
