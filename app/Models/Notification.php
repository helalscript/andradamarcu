<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    // Set the table name if it differs from the default plural form
    protected $table = 'notifications';

    // Set the primary key column if it's not the default 'id'
    protected $primaryKey = 'id';

    // If the 'id' is not auto-incrementing (since it's UUID)
    public $incrementing = false;

    // Set the column to be used as the UUID primary key
    protected $keyType = 'string';

    protected $fillable = [
        'type',
        'notifiable_type',
        'notifiable_id',
        'data',
        'user_id',
        'read_at'
    ];

    protected $casts = [
        'id' => 'string',  // UUID is stored as string
        'type' => 'string',  // 'type' is a string, no need to cast unless you want to enforce it
        'notifiable_type' => 'string',  // 'notifiable_type' is part of morphs, so it's string
        'notifiable_id' => 'uuid',  // This is the ID part of the polymorphic relationship, and it’s stored as UUID
        'data' => 'array',  // 'data' is stored as JSON/text, casting it to array
        'user_id' => 'integer',  // 'user_id' is an integer (foreign key to users table)
        'read_at' => 'datetime',  // 'read_at' is a timestamp, casting it to datetime format
        'created_at' => 'datetime',  // 'created_at' is a timestamp, casting it to datetime
        'updated_at' => 'datetime',  // 'updated_at' is a timestamp, casting it to datetime
    ];
}
