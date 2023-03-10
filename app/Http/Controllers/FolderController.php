<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Folder; // ★ この行を追記！
use App\Http\Requests\CreateFolder; // ★ 追加
// ★ Authクラスをインポートする
use Illuminate\Support\Facades\Auth;

class FolderController extends Controller
{
    public function showCreateForm()
    {
        return view('folders/create');
    }

    public function create(CreateFolder $request) // ★ 引数の型を変更
    {
        // フォルダモデルのインスタンスを作成する
        $folder = new Folder();
        // タイトルに入力値を代入する
        $folder->title = $request->title;
        // ★ ユーザーに紐づけて保存
        Auth::user()->folders()->save($folder);
        
        return redirect()->route('tasks.index', [
            'folder' => $folder->id,
        ]);
    }
}
