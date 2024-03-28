<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    use HasFactory;

    protected $fillable = [
        'namaProduk',
        'harga',
        'stock',
        'code'
    ];

    public function logstock()
    {
        return $this->hasMany(stockLog::class);
    }

}
