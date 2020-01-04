<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Field extends Model
{
    use SoftDeletes;

    const TABLE = 'fields';
    protected $table = self::TABLE;

    const A_TITLE = 'title';
    const A_TYPE = 'type';

    protected $fillable = [
        self::A_TITLE,
        self::A_TYPE,
    ];

    const PIVOT_VALUE = 'value';

    const REL_SUBSCRIBERS = 'subscribers';

    const TYPE_DATE = 'date';
    const TYPE_NUMBER = 'number';
    const TYPE_STRING = 'string';
    const TYPE_BOOLEAN = 'boolean';

    const TYPES = [
        self::TYPE_DATE,
        self::TYPE_NUMBER,
        self::TYPE_STRING,
        self::TYPE_BOOLEAN,
    ];

    const TYPE_VALIDATION = [
        self::TYPE_DATE => 'date',
        self::TYPE_NUMBER => 'numeric',
        self::TYPE_STRING => 'string',
        self::TYPE_BOOLEAN => 'boolean',
    ];

    /**
     * RELATIONS
     */

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function subscribers()
    {
        return $this->belongsToMany(Subscriber::class)->withPivot(self::PIVOT_VALUE);
    }

    /**
     * Static methods
     */

    /**
     * @param $title
     * @return \Illuminate\Database\Eloquent\Builder|Model|null|Field
     */
    public static function findByTitle($title)
    {
        return self::query()->where(self::A_TITLE, $title)->first();
    }
}
