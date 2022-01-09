<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    use HasFactory;

    public function list()
    {
        return $this->belongsTo(Lists::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
