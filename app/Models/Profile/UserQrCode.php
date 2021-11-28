<?php

declare(strict_types=1);

namespace App\Models\Profile;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\User
 *
 * @property int $id
 * @property string $public_id
 * @property string|null $link
 * @property int $user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|UserQrCode newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserQrCode newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserQrCode query()
 * @method static \Illuminate\Database\Eloquent\Builder|UserQrCode whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserQrCode wherePublicId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserQrCode whereLink($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Verify whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserQrCode whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserQrCode whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class UserQrCode extends Model
{
    protected $table = 'user_qr_code';

    protected $guarded = [];

    protected $casts = [];



    #================================== [CUSTOM METHODS] ==================================#

    public function getRouteKeyName(): string
    {
        return 'public_id';
    }



    #===================================================== Relationship methods  =====================================================#

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }


}
