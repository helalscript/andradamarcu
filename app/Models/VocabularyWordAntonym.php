<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VocabularyWordAntonym extends Model
{
    use HasFactory;

    protected $fillable = ['vocabulary_word_id', 'antonym'];

    protected $casts = [
        'id' => 'integer',
        'vocabulary_word_id' => 'integer',
        'antonym' => 'string',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
}
