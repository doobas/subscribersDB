<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Query\Builder;

class Subscriber extends Model
{
    use SoftDeletes;

    const TABLE = 'subscribers';
    protected $table = self::TABLE;

    const A_NAME = 'name';
    const A_EMAIL = 'email';
    const A_STATE = 'state';

    protected $fillable = [
        self::A_NAME,
        self::A_EMAIL,
        self::A_STATE,
    ];

    const REL_FIELDS = 'fields';

    const STATE_ACTIVE = 'active';
    const STATE_UNSUBSCRIBED = 'unsubscribed';
    const STATE_JUNK = 'junk';
    const STATE_BOUNCED = 'bounced';
    const STATE_UNCONFIRMED = 'unconfirmed';

    const DEFAULT_STATE = self::STATE_ACTIVE;

    const STATES = [
        self::STATE_ACTIVE,
        self::STATE_UNSUBSCRIBED,
        self::STATE_JUNK,
        self::STATE_BOUNCED,
        self::STATE_UNCONFIRMED,
    ];

    protected $with = [
        self::REL_FIELDS
    ];

    /**
     * Relations
     */

    public function fields()
    {
        return $this->belongsToMany(Field::class)->withPivot(Field::PIVOT_VALUE);
    }
}
