<?php

namespace App;

use Barryvdh\LaravelIdeHelper\Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * App\InlineBlock
 *
 * @property int $id
 * @property int $page_id
 * @property string $name
 * @property string|null $body
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Collection|Attachment[] $attachments
 * @property-read int|null $attachments_count
 * @property-read Page $page
 * @method static Builder|InlineBlock newModelQuery()
 * @method static Builder|InlineBlock newQuery()
 * @method static Builder|InlineBlock query()
 * @method static Builder|InlineBlock whereBody($value)
 * @method static Builder|InlineBlock whereCreatedAt($value)
 * @method static Builder|InlineBlock whereId($value)
 * @method static Builder|InlineBlock whereName($value)
 * @method static Builder|InlineBlock wherePageId($value)
 * @method static Builder|InlineBlock whereUpdatedAt($value)
 * @mixin Eloquent
 * @property string|null $url
 * @method static \Illuminate\Database\Eloquent\Builder|\App\InlineBlock whereUrl($value)
 * @property-read mixed $attachment_url
 */
class InlineBlock extends Model
{
    protected $fillable = ['page_id', 'name', 'url', 'body'];

    public function page()
    {
        return $this->belongsTo(Page::class);
    }
    /**
     * Get upload relation.
     */
    public function attachments()
    {
        return $this->morphMany(Attachment::class, 'entity');
    }

    public function getAttachmentUrlAttribute()
    {
        return $this->attachments->isNotEmpty() ?  config('app.url') . '/storage/' . $this->attachments[0]->file : "";
    }
}
