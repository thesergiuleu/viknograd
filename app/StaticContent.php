<?php

namespace App;

use Barryvdh\LaravelIdeHelper\Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * App\StaticContent
 *
 * @property int $id
 * @property string $alias
 * @property string $title
 * @property string $group_by
 * @property int $is_active
 * @property string $description
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|StaticContent newModelQuery()
 * @method static Builder|StaticContent newQuery()
 * @method static Builder|StaticContent query()
 * @method static Builder|StaticContent whereAlias($value)
 * @method static Builder|StaticContent whereCreatedAt($value)
 * @method static \Illuminate\Database\\Eloquent\Builder|\App\StaticContent whereDescription($value)
 * @method static Builder|StaticContent whereGroupBy($value)
 * @method static Builder|StaticContent whereId($value)
 * @method static Builder|StaticContent whereIsActive($value)
 * @method static Builder|StaticContent whereTitle($value)
 * @method static Builder|StaticContent whereUpdatedAt($value)
 * @mixin Eloquent
 */
class StaticContent extends Model
{
    protected $fillable = [
        'title',
        'group_by',
        'description',
        'is_active',
        'alias'
    ];

    const CONTACTS      = 'КОНТАКТЫ';
    const GENERIC       = 'РЕЖИМ РАБОТЫ';
    const WORK_HOURS    = 'Общее';
}
