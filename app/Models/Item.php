<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    // リレーション
    public function Rarity() {
        return $this->belongsTo(Rarity::class);
    }

    public function users() {
        return $this->belongsToMany(User::class, 'possessions');
    }
}
