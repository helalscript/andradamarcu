<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomWord extends Model
{
    use HasFactory;

    protected $fillable = ['custom_group_id', 'word', 'definition'];

    protected $casts = [
        'id' => 'integer',
        'custom_group_id' => 'integer',
        'word' => 'string',
        'definition' => 'string',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function customGroup()
    {
        return $this->belongsTo(CustomGroup::class, 'custom_group_id');
    }
}
