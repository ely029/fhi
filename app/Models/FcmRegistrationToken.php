<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\FcmRegistrationToken
 *
 * @property int $id
 * @property int $user_id
 * @property string $registration_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Database\Factories\FcmRegistrationTokenFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|FcmRegistrationToken newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FcmRegistrationToken newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FcmRegistrationToken query()
 * @method static \Illuminate\Database\Eloquent\Builder|FcmRegistrationToken whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FcmRegistrationToken whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FcmRegistrationToken whereRegistrationId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FcmRegistrationToken whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FcmRegistrationToken whereUserId($value)
 * @mixin \Eloquent
 */
// @TB: See FcmClient
class FcmRegistrationToken extends Model
{
    use HasFactory;
}
