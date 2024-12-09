<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserGroup extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'vocabulary_group_id', 'completed', 'completed_at'];

    protected $casts = [
        'id' => 'integer',
        'user_id' => 'integer',
        'vocabulary_group_id' => 'integer',
        'completed' => 'boolean',
        'completed_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function vocabularyGroup()
    {
        return $this->belongsTo(VocabularyGroup::class, 'vocabulary_group_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
