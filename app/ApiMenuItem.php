<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\ApiMenuItem
 *
 * @property int $id
 * @property int|null $parent_id
 * @property int $page_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Page $page
 * @property-read \App\ApiMenuItem|null $parent
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ApiMenuItem newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ApiMenuItem newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ApiMenuItem query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ApiMenuItem whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ApiMenuItem whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ApiMenuItem wherePageId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ApiMenuItem whereParentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ApiMenuItem whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property int|null $position
 * @property int|null $top_position
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\ApiMenuItem[] $children
 * @property-read int|null $children_count
 * @property-read mixed $page_name
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ApiMenuItem wherePosition($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ApiMenuItem whereTopPosition($value)
 */
class ApiMenuItem extends Model
{
    protected $fillable = ['parent_id', 'page_id', 'position','top_position'];

    public function parent()
    {
        return $this->belongsTo(self::class);
    }

    public function page()
    {
        return $this->belongsTo(Page::class);
    }

    public function children()
    {
        return $this->hasMany(self::class, 'parent_id', 'id')->orderBy('position');
    }

    public function getPageNameAttribute()
    {
        return $this->page ? $this->page->name : "";
    }
}
