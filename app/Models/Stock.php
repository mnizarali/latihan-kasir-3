<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function logstock()
    {
        return $this->hasMany(stockLog::class, 'id', 'product_id');
    }

    public function detailPenjualan() {
        return $this->hasMany(detailPenjualan::class);
    }

}
