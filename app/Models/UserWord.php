<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserWord extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'vocabulary_word_id', 'completed', 'attempted_at'];

    protected $casts = [
        'id' => 'integer',
        'user_id' => 'integer',
        'vocabulary_word_id' => 'integer',
        'completed' => 'boolean',
        'attempted_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function vocabularyWord()
    {
        return $this->belongsTo(VocabularyWord::class, 'vocabulary_word_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
}
