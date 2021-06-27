<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Possession;
use Illuminate\Http\Request;

class GachaController extends Controller
{
    public function roll() {
        // userの取得
        $user = auth()->user();

        // ガチャの実装
        $rand_number = rand(1, 100);
        if ($rand_number === 1) {
            $items = Item::where('rarity_id', 1)->get();
        } elseif ($rand_number >= 2 && $rand_number <= 11) {
            $items = Item::where('rarity_id', 2)->get();
        } elseif ($rand_number >= 12 && $rand_number <= 41) {
            $items = Item::where('rarity_id', 3)->get();
        } else {
            $items = Item::where('rarity_id', 4)->get();
        }

        // アルファベットの決定
        $item = $items[rand(0, count($items) - 1)];

        if ($possession = Possession::where('user_id', $user->id)->where('item_id', $item->id)->first()) {
            $possession->number += 1;
            $possession->save();
        } else {
            $possession = Possession::create([
                'user_id' => $user->id,
                'item_id' => $item->id,
                'number' => 1
            ]);
        }

        return $possession;
    }
}
