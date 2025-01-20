<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>投稿内容画面</title>
</head>
<body>
    <header>
        <h1>echovit</h1>
    </header>

    <div id="post-content">
        <h2>タイトル: <span id="post-title"></span></h2>
        <p>内容: <span id="post-content-text"></span></p>

    </div>
    <script>
        // URLパラメータを取得する関数
        function getUrlParameter(name) {
            const urlParams = new URLSearchParams(window.location.search);
            return urlParams.get(name);
        }

        // フォームから送信されたタイトルと内容を表示
        document.getElementById("post-title").textContent = getUrlParameter('title');
        document.getElementById("post-content-text").textContent = getUrlParameter('content');
    </script>
</body>
</html>