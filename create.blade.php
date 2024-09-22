<!DOCTYPE HTML>
<html　lang="ja">
    <head>
        <meta charset='UTF-8'>
        @vite(['resources/sass/app.scss', 'resources/js/app.js'])
        <link rel="stylesheet" href="../style.css" type="text/css">
        <title>TestApp_登録フォーム画面</title>
    </head>
    <body>
        <div class="mt-5 mb-5 w-50 mx-auto text-center">
            <h1>登録フォーム</h1>
        </div>
        <div class="mb-5 w-50 mx-auto text-center">
            <p class="mb-0">行きたい場所や欲しいものなどを、</p>
            <p>イメージ画像も合わせて登録しよう！</p>
        </div>
        <div class="w-50 mx-auto text-center border-top">
            @if($errors->any())
            <div class="mt-4 text-danger">
                <ul class="mb-0 ps-0">
                    @foreach($errors->all() as $error)
                    <p class="mb-0">{{ $error }}</p>
                    @endforeach
                </ul>
            </div>
            @endif
            <form method="post" action="{{ url('/create') }}" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="mb-5 pt-5 pb-5 border-bottom">
                    <div class="form-group mb-4">
                        <label class="form-label">やりたいこと</label>
                        <textarea class="form-control w-75 mx-auto" name="dream" value="{{ old('dream') }}"></textarea>
                    </div>
                    <div class="form-group">
                        <label class="form-label">イメージ画像</label>
                        <input class="form-control w-75 mx-auto" type="file" name="image" value="{{ old('image') }}">
                    </div>
                </div>
                <div class="mb-4">
                    <input class="btn btn-outline-success" type="submit" value="入力内容を確認">
                </div>
            </form>
        </div>
        <div class="w-50 mx-auto text-center">
            <form method="get" action="{{ url('/index') }}">
                {{ csrf_field() }}
                <input class="btn btn-outline-success" type="submit" value="やりたいことリストを確認">
            </form>
        </div>
    </body>
</html>
