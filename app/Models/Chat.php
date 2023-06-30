<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;

class Chat extends Model
{
    use HasFactory;

    protected $guarded = [];


    public function user()
    {
        return $this->belongsTo(User::class,'to', 'id');
    }

    public function userFrom()
    {
        return $this->belongsTo(User::class, 'from','id');
    }

    public static function boot()
    {
        parent::boot();
        // Will fire everytime an User is created
        static::creating(function ($model) {
            $model->uuid = Uuid::uuid4()->toString();
        });
    }
}
