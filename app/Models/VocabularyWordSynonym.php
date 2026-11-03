<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VocabularyWordSynonym extends Model
{
    use HasFactory;

    protected $fillable = ['vocabulary_word_id', 'synonym'];

    protected $casts = [
        'id' => 'integer',
        'vocabulary_word_id' => 'integer',
        'synonym' => 'string',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
}
