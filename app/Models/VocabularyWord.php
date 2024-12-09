<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VocabularyWord extends Model
{
    use HasFactory;

    protected $fillable = ['group_id', 'word', 'definition'];

    protected $casts = [
        'id' => 'integer',
        'group_id' => 'integer',
        'word' => 'string',
        'definition' => 'string',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function vocabularyGroup()
    {
        return $this->belongsTo(VocabularyGroup::class, 'group_id');
    }

    public function synonyms()
    {
        return $this->hasMany(VocabularyWordSynonym::class, 'vocabulary_word_id');
    }

    public function antonyms()
    {
        return $this->hasMany(VocabularyWordAntonym::class, 'vocabulary_word_id');
    }
}
