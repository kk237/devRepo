<?php

namespace App\Http\Controllers;

// use宣言
use Illuminate\Http\Request;
use App\Models\Dream;                       // Dreamクラス
use Illuminate\Support\Facades\Storage;     // Storageクラス
use Validator;                              // バリデーション

class DreamController extends Controller
{
    // 配列宣言
    private $formItems = [
        'dream',
        'imagePath'
    ];

    // バリデーション宣言
    private $validator = [
        'dream' => 'required|string|max:50',
        'imagePath' => 'required|string|max:259'
    ];

    /**
     * フォーム画面表示処理
     */
    public function create()
    {
        // フォーム画面を表示
        return view('/create');
    }

    /**
     * セッション登録処理
     */
    public function post(Request $request) {

        // 画像ファイルを取得
        $image = $request->file('image');

        // 画像ファイルが選択されていない、または取得が失敗した場合
        if(empty($image)) {

            // 登録フォーム画面にエラーメッセージを表示
            return redirect('/create')
            ->withErrors('イメージ画像が選択されていません');

        }

        // 指定したパスに画像ファイルを保存
        $imagePath = $image->store('public/images');

        // formItemsの全メンバを取得
        $input = $request->all($this->formItems);

        // formItemsの「imagePath」に画像ファイルパスを代入
        $input['imagePath'] = $imagePath;

        // 入力値検証を実行
        $validator = Validator::make($input, $this->validator);

        // 入力値の文字数がオーバーしている場合
        if($validator->fails()) {

            // 保存した画像ファイルを削除
            Storage::delete($imagePath);

            // 登録フォーム画面にエラーメッセージを表示
            return redirect('/create')
            ->withInput()
            ->withErrors($validator);

        }

        // 入力値にキー名「formInput」を付けて、セッションに保存
        $request->session()->put('formInput', $input);

        // 確認画面をリダイレクト
        return redirect('/confirm');

    }

    /**
     * 確認画面表示処理
     */
    public function confirm(Request $request)
    {
        // セッションから入力値を取得
        $input = $request->session()->get('formInput');

        // 確認画面に入力値を渡し、表示
        return view('/confirm', compact('input'));
    }

    /**
     * DB登録処理
     */
    public function store(Request $request)
    {
        // Dreamクラス（Models）をインスタンス化
        $dream = new Dream();

        // セッションから入力値を取得
        $input = $request->session()->get('formInput');

        // 入力値をDBに追加
        $dream->dream = $input['dream'];
        $dream->image_path = $input['imagePath'];

        // deaamsテーブルを保存
        $dream->save();

        // セッションから入力値を削除
        $request->session()->forget('form_input');

        // 完了画面へリダイレクト
        return redirect('/complete');
    }

    /**
     * 完了画面表示処理
     */
    function complete() {

        // 完了画面を表示
        return view('/complete');
    }

    /**
     * 一覧画面表示処理
     */
    public function index()
    {
        // dreamテーブルから全カラムを取得
        $dreams = Dream::all();

        // 一覧画面へdreamテーブルの全データを渡し、表示
        return view('index', compact('dreams'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
