<?php

namespace App;

use Barryvdh\LaravelIdeHelper\Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;

/**
 * App\Page
 *
 * @property int $id
 * @property string $title
 * @property string|null $url
 * @property string|null $body
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Collection|Attachment[] $attachments
 * @property-read int|null $attachments_count
 * @method static Builder|Page newModelQuery()
 * @method static Builder|Page newQuery()
 * @method static Builder|Page query()
 * @method static Builder|Page whereBody($value)
 * @method static Builder|Page whereCreatedAt($value)
 * @method static Builder|Page whereId($value)
 * @method static Builder|Page whereTitle($value)
 * @method static Builder|Page whereUpdatedAt($value)
 * @method static Builder|Page whereUrl($value)
 * @mixin Eloquent
 * @property string $name
 * @property int|null $page_block
 * @property-read \App\ApiMenuItem $apiMenuItem
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\InlineBlock[] $inline_blocks
 * @property-read int|null $inline_blocks_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Video[] $videos
 * @property-read int|null $videos_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Page whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Page wherePageBlock($value)
 */
class Page extends Model
{
    protected $fillable = ['name', 'url', 'body', 'page_block'];

    const PROJECTS = 1;

    /**
     * Get upload relation.
     */
    public function attachments()
    {
        return $this->morphMany(Attachment::class, 'entity');
    }

    /**
     * @return HasMany
     */
    public function inline_blocks()
    {
        return $this->hasMany(InlineBlock::class);
    }

    /**
     * @return HasMany
     */
    public function videos()
    {
        return $this->hasMany(Video::class);
    }

    /**
     * @return BelongsTo
     */
    public function apiMenuItem()
    {
        return $this->belongsTo(ApiMenuItem::class, 'page_id', 'id');
    }
}
