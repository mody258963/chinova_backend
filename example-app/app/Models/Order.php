<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'description',
        'title',
        'price',
        'wieght',
        'user_id',
        'image',

    ];

    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }

}
