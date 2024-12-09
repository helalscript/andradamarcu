<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use HasFactory, Notifiable;

    // Rest omitted for brevity

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'user_name',
        'email',
        'phone',
        'avatar',
        'date_of_birth',
        'bio',
        'gender',
        'password',
        'otp',
        'reset_password_token',
        'reset_password_token_expire_at',
        'otp_expires_at',
        'remember_token',
        'email_verified_at',
        'created_at',
        'updated_at',
        'role',
        'status',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'otp',
        'otp_expires_at',
        'email_verified_at',
        'reset_password_token',
        'reset_password_token_expire_at',
        'is_otp_verified',
        'created_at',
        'updated_at',
        'role',
        'status',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'otp_expires_at' => 'datetime',
            'is_otp_verified' => 'boolean',
            'reset_password_token_expires_at' => 'datetime',
            'date_of_birth' => 'string',
            'password' => 'hashed'
        ];
    }

    public function getAvatarAttribute($value): string|null
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

    public function firebaseTokens()
    {
        return $this->hasMany(FirebaseTokens::class);
    }

    /**
     * Get all user words.
     */
    public function userWords(): HasMany
    {
        return $this->hasMany(UserWord::class);
    }
    /**
     * Get completed vocabulary words.
     */
    public function completedVocabularyWords()
    {
        return $this->userWords()->where('completed', true)->with('vocabularyWord');
    }

    /**
     * Get uncompleted vocabulary words.
     */
    public function uncompletedVocabularyWords()
    {
        return $this->userWords()->where('completed', false)->with('vocabularyWord');
    }
    /**
     * Get all remediation words for the user.
     */
    public function remediationWords(): HasMany
    {
        return $this->hasMany(RemediationWord::class);
    }

    /**
     * Get the user's custom groups.
     */
    public function customGroups(): HasMany
    {
        return $this->hasMany(CustomGroup::class);
    }

    /**
     * Get completed remediation words.
     */
    public function completedRemediationWords()
    {
        return $this->remediationWords()->where('completed', true);
    }

    /**
     * Get uncompleted remediation words.
     */
    public function uncompletedRemediationWords()
    {
        return $this->remediationWords()->where('completed', false);
    }

    /**
     * Get completed custom words for all custom groups.
     */
    public function completedCustomWords()
    {
        return CustomWord::whereIn('custom_group_id', $this->customGroups()->pluck('id'))
            ->whereHas('userWords', function ($query) {
                $query->where('completed', true);
            });
    }

    /**
     * Get uncompleted custom words for all custom groups.
     */
    public function uncompletedCustomWords()
    {
        return CustomWord::whereIn('custom_group_id', $this->customGroups()->pluck('id'))
            ->whereDoesntHave('userWords', function ($query) {
                $query->where('completed', true);
            });
    }

}
