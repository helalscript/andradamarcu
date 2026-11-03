<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VocabularyGroup extends Model
{
    use HasFactory;

    protected $fillable = ['vocabulary_id', 'name'];

    protected $casts = [
        'id' => 'integer',
        'vocabulary_id' => 'integer',
        'name' => 'string',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Relationship with VocabularyWord.
     */
    public function vocabularyWords()
    {
        return $this->hasMany(VocabularyWord::class, 'group_id');
    }


}
