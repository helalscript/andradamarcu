<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomGroup extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'name'];

    protected $casts = [
        'id' => 'integer',
        'user_id' => 'integer',
        'name' => 'string',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function customWords()
    {
        return $this->hasMany(CustomWord::class, 'custom_group_id');
    }
}
