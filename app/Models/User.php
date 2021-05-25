<?php

declare(strict_types=1);

namespace App\Models;

use App\Notifications\MailResetPasswordNotification;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Storage;

/**
 * App\Models\User
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $role_id
 * @property string $photo_alt
 * @property string $photo_extension
 * @property string|null $fcm_notification_key
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\FcmRegistrationToken[] $fcmRegistrationTokens
 * @property-read int|null $fcm_registration_tokens_count
 * @property-read mixed $photo_name
 * @property-read mixed $photo_path
 * @property-read mixed $photo_url
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read \App\Models\Role|null $role
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Social[] $socials
 * @property-read int|null $socials_count
 * @method static \Database\Factories\UserFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereFcmNotificationKey($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePhotoAlt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePhotoExtension($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRoleId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class User extends Authenticatable
{
    use HasFactory, Notifiable;

    public const PATH_PREFIX = 'public/users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'middle_name',
        'username',
        'email',
        'password',
        'role_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // Improves performance since hasAccess is always called in the middleware
    // protected $with = ['role'];

    public function role()
    {
        return $this->hasOne(Role::class, 'id', 'role_id');
    }

    public function socials()
    {
        return $this->hasMany(Social::class);
    }

    public function hasAccess($route)
    {
        return $this->role->hasAccess($route);
    }

    public function getPhotoNameAttribute()
    {
        if ($this->id && $this->photo_extension) {
            return "{$this->id}.{$this->photo_extension}";
        }

        return null;
    }

    public function getPhotoPathAttribute()
    {
        $name = $this->getPhotoNameAttribute();

        return $name === null ? null : self::PATH_PREFIX . "/{$name}";
    }

    public function getPhotoUrlAttribute()
    {
        $path = $this->getPhotoPathAttribute();

        if (Storage::exists($path)) {
            return Storage::url($path) . '?t=' . Storage::lastModified($path);
        }

        return '/assets/dashboard/img/user_photo.jpg';
    }

    public function setPhotoExtensionAttribute($value)
    {
        $path = $this->getPhotoPathAttribute();

        if (Storage::exists($path)) {
            Storage::delete($path);
        }

        $this->attributes['photo_extension'] = $value;
    }

    public function fcmRegistrationTokens()
    {
        return $this->hasMany(FcmRegistrationToken::class);
    }

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new MailResetPasswordNotification($token));
    }

    public function getNameAttribute()
    {
        return $this->first_name .' '. $this->last_name; 
    }

}
