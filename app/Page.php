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
 * @property string|null $page_header
 * @property int|null $parent_id
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Page[] $children
 * @property-read int|null $children_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Attachment[] $thumbnails
 * @property-read int|null $thumbnails_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Page wherePageHeader($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Page whereParentId($value)
 */
class Page extends Model
{
    protected $fillable = ['name', 'page_header','url', 'body', 'page_block', 'parent_id', 'created_at'];

    const PROJECTS      = 1;
    const CONTACTS      = 2;
    const OUR_WORKS     = 3;
    const JOBS          = 4;
    const NEWS          = 5;


    const PAGE_BLOCKS = [
        self::PROJECTS,
        self::CONTACTS,
        self::OUR_WORKS,
        self::JOBS,
        self::NEWS,
    ];

    /**
     * Get upload relation.
     */
    public function attachments()
    {
        return $this->morphMany(Attachment::class, 'entity')->where('file', 'not like', 'thumbnails/%');
    }

    public function thumbnails()
    {
        return $this->morphMany(Attachment::class, 'entity')->where('file', 'like', 'thumbnails/%');
    }

    public function children()
    {
        return $this->hasMany(self::class, 'parent_id', 'id');
    }

    public function childrenFormed()
    {
        foreach ($this->children as $item) {
            $item['thumbnail_url'] = $item->thumbnails->isNotEmpty() ? $item->thumbnails[0] ? $item->thumbnails[0]->file : null : null;
        }
        return $this->children;
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

    public function url()
    {
        switch ($this->page_block) {
            case self::PROJECTS:
                $entity = 'project';
                break;
            case self::CONTACTS:
                $entity = 'contact';
                break;
            case self::OUR_WORKS:
                $entity = 'our_work';
                break;
            case self::JOBS:
                $entity = 'job';
                break;
            case self::NEWS:
                $entity = 'new';
                break;
            default:
                $entity = 'page';
                break;
        }
        return env('APP_URL') . "/admin/$entity/" . $this->page_block;
    }
}
