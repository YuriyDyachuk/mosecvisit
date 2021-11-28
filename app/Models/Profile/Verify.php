<?php

declare(strict_types=1);

namespace App\Models\Profile;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Verify
 *
 * @property int $id
 * @property string|null $code
 * @property int $user_id
 * @property int $count_sms Number of messages to register per day
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Verify newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Verify newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Verify query()
 * @method static \Illuminate\Database\Eloquent\Builder|Verify whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Verify whereCountSms($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Verify whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Verify whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Verify whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Verify whereUserId($value)
 * @mixin \Eloquent
 */
class Verify extends Model
{

    protected $guarded = [];

    protected $casts = [];



    #================================== [CUSTOM METHODS] ==================================#



    #===================================================== Relationship methods  =====================================================#

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }


}
