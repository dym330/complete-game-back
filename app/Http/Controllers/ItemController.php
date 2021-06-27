<?php

namespace App\Http\Controllers;

use App\Models\Possession;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function index() {
        // userの取得
        $user = auth()->user();

        // userが所持しているitemを一覧で取得
        $items = $user->items()->select(['name', 'number'])->get();

        // item名だけの配列の形に変換
        // $possession_items = [];
        // foreach($items as $item) {
        //     $possession_items[] = $item['name'];
        // }
        // return response(['possession_items' => $possession_items], 200);

        return response()->json($items, 200);
    }

    public function delete() {
        // userの取得
        $user = auth()->user();

        // userが所持しているitemを削除
        Possession::where('user_id', $user->id)->delete();

        return response(['message' => '削除しました'], 200);
    }
}
