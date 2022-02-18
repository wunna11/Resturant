<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    public function dish()
    {
        return $this->belongsTo(Dish::class);
    }

    public function table()
    {
        return $this->belongsTo(Table::class);
    }
}
