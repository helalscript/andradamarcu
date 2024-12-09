<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContentCMS extends Model
{
    use HasFactory;

    // Specify the table name
    protected $table = 'content_c_m_s';

    // Define the columns you want to be mass-assignable
    protected $fillable = [
        'type',
        'position',
        'content',
        'description',
        'logo',
        'status',
        'url'
    ];

    // Define the casts for each column
    protected $casts = [
        'id' => 'integer',  
        'position' => 'integer',  
        'content' => 'string',  
        'description' => 'string',  
        'logo' => 'string',  
        'status' => 'string', 
        'url' => 'string',  
        'created_at' => 'datetime',  
        'updated_at' => 'datetime' 
    ];


    public function getLogoAttribute($value): string|null
    {
        if (filter_var($value, FILTER_VALIDATE_URL)) {
            return $value;
        }
        // Check if the request is an API request
        if (request()->is('api/*') && !empty($value)) {
            // Return the full URL for API requests
            return url($value);
        }

        // Return only the path for web requests
        return $value;
    }
}
